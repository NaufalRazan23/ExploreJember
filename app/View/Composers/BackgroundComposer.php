<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\BackgroundService;

class BackgroundComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $backgroundImage = BackgroundService::getBackgroundImage();
        $backgroundClass = BackgroundService::getBackgroundClass();
        $overlayClass = BackgroundService::getOverlayClass();
        
        // Check if background image exists, use fallback if not
        if (!BackgroundService::backgroundExists($backgroundImage)) {
            $backgroundImage = BackgroundService::getFallbackImage();
        }
        
        $view->with([
            'backgroundImage' => $backgroundImage,
            'backgroundClass' => $backgroundClass,
            'overlayClass' => $overlayClass,
        ]);
    }
}
