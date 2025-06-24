<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class BackgroundService
{
    /**
     * Get background configuration for current route
     */
    public static function getBackgroundConfig(): array
    {
        $routeName = Route::currentRouteName();
        $config = config('backgrounds.pages', []);
        
        // Try exact route match first
        if (isset($config[$routeName])) {
            return $config[$routeName];
        }
        
        // Try wildcard matches
        foreach ($config as $pattern => $bgConfig) {
            if (str_contains($pattern, '*')) {
                $regex = str_replace('*', '.*', $pattern);
                if (preg_match("/^{$regex}$/", $routeName)) {
                    return $bgConfig;
                }
            }
        }
        
        // Return default configuration
        return [
            'image' => config('backgrounds.default', 'main-bg.jpg'),
            'class' => 'bg-main',
            'overlay' => 'bg-overlay',
        ];
    }
    
    /**
     * Get background image name for current route
     */
    public static function getBackgroundImage(): string
    {
        $config = self::getBackgroundConfig();
        return $config['image'];
    }
    
    /**
     * Get background CSS class for current route
     */
    public static function getBackgroundClass(): string
    {
        $config = self::getBackgroundConfig();
        return $config['class'];
    }
    
    /**
     * Get overlay CSS class for current route
     */
    public static function getOverlayClass(): string
    {
        $config = self::getBackgroundConfig();
        return $config['overlay'];
    }
    
    /**
     * Check if background image exists
     */
    public static function backgroundExists(string $imageName): bool
    {
        $directory = config('backgrounds.directory', 'images/backgrounds');
        $path = public_path("{$directory}/{$imageName}");
        return File::exists($path);
    }
    
    /**
     * Get fallback background image
     */
    public static function getFallbackImage(): string
    {
        $fallbacks = config('backgrounds.fallbacks', ['main-bg.jpg']);
        
        foreach ($fallbacks as $fallback) {
            if (self::backgroundExists($fallback)) {
                return $fallback;
            }
        }
        
        return $fallbacks[0] ?? 'main-bg.jpg';
    }
    
    /**
     * Get all available background images
     */
    public static function getAvailableBackgrounds(): array
    {
        $directory = config('backgrounds.directory', 'images/backgrounds');
        $path = public_path($directory);
        
        if (!File::exists($path)) {
            return [];
        }
        
        $files = File::files($path);
        $images = [];
        
        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                $images[] = $file->getFilename();
            }
        }
        
        return $images;
    }
}
