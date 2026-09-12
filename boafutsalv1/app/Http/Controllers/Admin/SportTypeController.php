<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportType;
use App\Models\SportTypeGallery;
use App\Models\SportTypeSwitchLog;
use App\Services\ArchiveGalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SportTypeController extends Controller
{
    public function index()
    {
        $sportTypes = SportType::with(['fields.prices', 'galleries'])
            ->withCount(['fields', 'galleries'])
            ->get()
            ->map(function ($type) {
                // Count historical bookings associated with this sport type
                $type->historical_bookings_count = \App\Models\Booking::where('sport_type_name_snapshot', $type->name)
                    ->orWhereIn('field_id', $type->fields->pluck('id_field'))
                    ->count();

                // Has at least one valid field with prices
                $type->has_valid_fields = $type->fields
                    ->where('is_active', true)
                    ->filter(fn($f) => $f->prices->isNotEmpty())
                    ->isNotEmpty();

                return $type;
            });

        $switchLogs = SportTypeSwitchLog::with(['user', 'fromSportType', 'toSportType'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.sport-types.index', compact('sportTypes', 'switchLogs'));
    }

    public function create()
    {
        return view('admin.sport-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'facilities' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        $slug = Str::slug($request->name);
        $count = SportType::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $heroImagePath = null;
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $fileName = 'hero_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sport-types'), $fileName);
            $heroImagePath = 'uploads/sport-types/' . $fileName;
        }

        // Format facilities
        $facilities = [];
        if ($request->filled('facilities')) {
            foreach ($request->facilities as $item) {
                if (!empty($item['name'])) {
                    $facilities[] = [
                        'name' => $item['name'],
                        'desc' => $item['desc'] ?? '',
                        'icon' => $item['icon'] ?? 'parkir',
                    ];
                }
            }
        }

        $sportType = SportType::create([
            'name' => $request->name,
            'slug' => $slug,
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'description' => $request->description,
            'hero_image_path' => $heroImagePath,
            'facilities' => $facilities,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_active' => false,
        ]);

        // Upload gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $galleryFile) {
                $galleryName = 'gallery_' . time() . '_' . Str::random(6) . '.' . $galleryFile->getClientOriginalExtension();
                $galleryFile->move(public_path('uploads/sport-types/galleries'), $galleryName);
                
                SportTypeGallery::create([
                    'sport_type_id' => $sportType->id,
                    'image_path' => 'uploads/sport-types/galleries/' . $galleryName,
                    'caption' => $sportType->name . ' - Foto ' . ($index + 1),
                    'order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.sport-types.index')->with('success', "Sport Type {$sportType->name} berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $sportType = SportType::with(['galleries'])->findOrFail($id);
        return view('admin.sport-types.edit', compact('sportType'));
    }

    public function update(Request $request, $id)
    {
        $sportType = SportType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'facilities' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        $heroImagePath = $sportType->hero_image_path;
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $fileName = 'hero_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sport-types'), $fileName);
            $heroImagePath = 'uploads/sport-types/' . $fileName;
        }

        // Format facilities
        $facilities = [];
        if ($request->filled('facilities')) {
            foreach ($request->facilities as $item) {
                if (!empty($item['name'])) {
                    $facilities[] = [
                        'name' => $item['name'],
                        'desc' => $item['desc'] ?? '',
                        'icon' => $item['icon'] ?? 'parkir',
                    ];
                }
            }
        }

        $sportType->update([
            'name' => $request->name,
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'description' => $request->description,
            'hero_image_path' => $heroImagePath,
            'facilities' => $facilities,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        // Upload new gallery images
        if ($request->hasFile('gallery_images')) {
            $currentOrder = $sportType->galleries()->max('order') ?? 0;
            foreach ($request->file('gallery_images') as $galleryFile) {
                $currentOrder++;
                $galleryName = 'gallery_' . time() . '_' . Str::random(6) . '.' . $galleryFile->getClientOriginalExtension();
                $galleryFile->move(public_path('uploads/sport-types/galleries'), $galleryName);

                SportTypeGallery::create([
                    'sport_type_id' => $sportType->id,
                    'image_path' => 'uploads/sport-types/galleries/' . $galleryName,
                    'caption' => $sportType->name . ' - Galeri',
                    'order' => $currentOrder,
                ]);
            }
        }

        // Delete specific gallery item if requested
        if ($request->filled('delete_gallery_id')) {
            $galleryItem = SportTypeGallery::where('sport_type_id', $sportType->id)
                ->where('id', $request->delete_gallery_id)
                ->first();
            if ($galleryItem) {
                if (File::exists(public_path($galleryItem->image_path))) {
                    File::delete(public_path($galleryItem->image_path));
                }
                $galleryItem->delete();
            }
        }

        if ($sportType->is_active) {
            Cache::forget('active_sport_type');
        }

        return redirect()->route('admin.sport-types.index')->with('success', "Konten Sport Type {$sportType->name} berhasil diperbarui!");
    }

    public function activate(Request $request, $id)
    {
        $sportType = SportType::with(['fields.prices'])->findOrFail($id);

        if ($sportType->is_active) {
            return redirect()->back()->with('info', "Sport Type {$sportType->name} sudah dalam keadaan aktif.");
        }

        // Validation: must have at least 1 active field with prices
        $hasValidFields = $sportType->fields
            ->where('is_active', true)
            ->filter(fn($f) => $f->prices->isNotEmpty())
            ->isNotEmpty();

        if (!$hasValidFields) {
            return redirect()->back()->with('error', "Gagal mengaktifkan: Sport Type '{$sportType->name}' belum memiliki minimal 1 lapangan aktif dengan daftar harga!");
        }

        $currentActive = SportType::where('is_active', true)->first();

        // Switch active: Deactivate all, activate this
        SportType::query()->update(['is_active' => false]);
        $sportType->update(['is_active' => true]);

        // Audit log
        SportTypeSwitchLog::create([
            'user_id' => Auth::id(),
            'from_sport_type_id' => $currentActive ? $currentActive->id : null,
            'to_sport_type_id' => $sportType->id,
            'action' => 'activate',
            'created_at' => now(),
        ]);

        // Flush active cache immediately for real-time live switch
        Cache::forget('active_sport_type');

        return redirect()->route('admin.sport-types.index')->with('success', "Sport Type '{$sportType->name}' BERHASIL DI-SWITCH AKTIF! Perubahan langsung live di halaman publik.");
    }

    public function destroy(Request $request, $id, ArchiveGalleryService $archiveService)
    {
        $sportType = SportType::with(['fields', 'galleries'])->findOrFail($id);

        if ($sportType->is_active) {
            return redirect()->back()->with('error', "Gagal menghapus: Sport Type '{$sportType->name}' sedang aktif! Silakan switch ke Sport Type lain terlebih dahulu.");
        }

        // Archive galleries
        $archivedCount = $archiveService->archiveGalleries($sportType);

        // Audit log
        SportTypeSwitchLog::create([
            'user_id' => Auth::id(),
            'from_sport_type_id' => $sportType->id,
            'to_sport_type_id' => null,
            'action' => 'delete',
            'created_at' => now(),
        ]);

        $typeName = $sportType->name;

        // Delete associated fields (prices will cascade/delete)
        foreach ($sportType->fields as $field) {
            $field->prices()->delete();
            $field->delete();
        }

        // Delete sport type record
        $sportType->delete();

        Cache::forget('active_sport_type');

        return redirect()->route('admin.sport-types.index')->with('success', "Sport Type '{$typeName}' berhasil dihapus. {$archivedCount} file galeri berhasil dipindahkan ke folder arsip.");
    }
}
