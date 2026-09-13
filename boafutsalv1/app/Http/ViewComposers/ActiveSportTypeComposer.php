<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SportType;

class ActiveSportTypeComposer
{
    public function compose(View $view): void
    {
        $activeSportType = Cache::rememberForever('active_sport_type', function () {
            return SportType::with(['galleries', 'fields.prices', 'pageSections'])
                ->where('is_active', true)
                ->first();
        });

        $view->with('activeSportType', $activeSportType);
    }
}
