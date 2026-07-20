<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Display chatbot configuration page.
     */
    public function index()
    {
        $settings = ChatbotSetting::getSettings();
        return view('admin.chatbot.index', compact('settings'));
    }

    /**
     * Update chatbot configuration.
     */
    public function update(Request $request)
    {
        $request->validate([
            'wa_number' => 'required|string|max:20',
            'api_token' => 'nullable|string|max:255',
            'user_message_template' => 'nullable|string',
            'reply_message_template' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $settings = ChatbotSetting::getSettings();
        
        // Ensure we have an actual persisted row to update
        if (!$settings->exists) {
            $settings->save();
        }

        $settings->update([
            'wa_number' => $request->wa_number,
            'api_token' => $request->api_token,
            'user_message_template' => $request->user_message_template,
            'reply_message_template' => $request->reply_message_template,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : false,
        ]);

        return back()->with('success', 'Pengaturan Chatbot berhasil diperbarui!');
    }

    /**
     * Handle incoming Fonnte webhook message.
     */
    public function handleWebhook(Request $request)
    {
        $data = $request->all();
        Log::info('Fonnte Webhook Received Data: ', $data);

        $sender = $request->input('sender');
        $message = $request->input('message');

        if (!$sender || !$message) {
            return response()->json(['status' => 'ignored', 'reason' => 'Missing sender or message'], 200);
        }

        $settings = ChatbotSetting::getSettings();

        // If chatbot is disabled, do nothing
        if (!$settings->is_active) {
            return response()->json(['status' => 'ignored', 'reason' => 'Chatbot is inactive'], 200);
        }

        $userTemplate = $settings->user_message_template;
        $replyTemplate = $settings->reply_message_template;

        // Clean strings for keyword detection
        $incomingMessageClean = strtolower(trim($message));
        
        // Detect greeting from incoming message
        $matchedGreeting = null;
        if (str_contains($incomingMessageClean, 'pagi')) {
            $matchedGreeting = 'Pagi';
        } elseif (str_contains($incomingMessageClean, 'siang')) {
            $matchedGreeting = 'Siang';
        } elseif (str_contains($incomingMessageClean, 'sore')) {
            $matchedGreeting = 'Sore';
        } elseif (str_contains($incomingMessageClean, 'malam')) {
            $matchedGreeting = 'Malam';
        }

        // Match message by keywords (more flexible, works even if template differs slightly)
        $keywords = ['join member', 'bukti pembayaran', 'approve', 'membership'];
        $matched = false;
        foreach ($keywords as $keyword) {
            if (str_contains($incomingMessageClean, $keyword)) {
                $matched = true;
                break;
            }
        }

        // If it doesn't match any trigger keyword, ignore it to prevent replying to random WA chats
        if (!$matched) {
            return response()->json(['status' => 'ignored', 'reason' => 'Message does not match any trigger keyword'], 200);
        }

        // Generate reply with matching greeting (fallback to time-based greeting)
        if (!$matchedGreeting) {
            $hour = now()->timezone('Asia/Jakarta')->hour;
            if ($hour >= 4 && $hour < 11) {
                $matchedGreeting = 'Pagi';
            } elseif ($hour >= 11 && $hour < 15) {
                $matchedGreeting = 'Siang';
            } elseif ($hour >= 15 && $hour < 18) {
                $matchedGreeting = 'Sore';
            } else {
                $matchedGreeting = 'Malam';
            }
        }

        $replyMessage = str_replace('{greeting}', $matchedGreeting, $replyTemplate);

        $fonnteToken = $settings->api_token;
        if (empty($fonnteToken)) {
            Log::warning('Fonnte token is empty, cannot send reply.');
            return response()->json(['status' => 'error', 'reason' => 'API Token not configured'], 200);
        }

        // Send reply via Fonnte API as a background task to prevent webhook deadlock
        defer(function () use ($fonnteToken, $sender, $replyMessage) {
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $fonnteToken,
            ])->post('https://api.fonnte.com/send', [
                'target' => $sender,
                'message' => $replyMessage,
            ]);

            Log::info('Fonnte Send API Response (Deferred): ', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        });

        return response()->json([
            'status' => 'success',
            'replied' => true,
            'recipient' => $sender,
            'message' => $replyMessage
        ], 200);
    }
}
