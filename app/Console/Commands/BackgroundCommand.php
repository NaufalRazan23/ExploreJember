<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BackgroundService;
use Illuminate\Support\Facades\File;

class BackgroundCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'background:manage {action} {--page=} {--image=}';

    /**
     * The console command description.
     */
    protected $description = 'Manage background images for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listBackgrounds();
                break;
            case 'check':
                $this->checkBackgrounds();
                break;
            case 'config':
                $this->showConfig();
                break;
            default:
                $this->error("Unknown action: {$action}");
                $this->info("Available actions: list, check, config");
        }
    }

    /**
     * List all available background images
     */
    private function listBackgrounds()
    {
        $this->info('📁 Available Background Images:');
        $this->line('');

        $backgrounds = BackgroundService::getAvailableBackgrounds();
        
        if (empty($backgrounds)) {
            $this->warn('No background images found in public/images/backgrounds/');
            return;
        }

        foreach ($backgrounds as $image) {
            $path = public_path("images/backgrounds/{$image}");
            $size = File::size($path);
            $sizeFormatted = $this->formatBytes($size);
            
            $this->line("🖼️  {$image} ({$sizeFormatted})");
        }
    }

    /**
     * Check background configuration and missing files
     */
    private function checkBackgrounds()
    {
        $this->info('🔍 Checking Background Configuration:');
        $this->line('');

        $config = config('backgrounds.pages', []);
        $missing = [];
        $found = [];

        foreach ($config as $page => $bgConfig) {
            $image = $bgConfig['image'];
            $exists = BackgroundService::backgroundExists($image);
            
            if ($exists) {
                $found[] = $image;
                $this->line("✅ {$page}: {$image}");
            } else {
                $missing[] = $image;
                $this->line("❌ {$page}: {$image} (MISSING)");
            }
        }

        $this->line('');
        $this->info("Found: " . count($found) . " | Missing: " . count($missing));

        if (!empty($missing)) {
            $this->line('');
            $this->warn('Missing background images:');
            foreach (array_unique($missing) as $image) {
                $this->line("  - {$image}");
            }
        }
    }

    /**
     * Show current background configuration
     */
    private function showConfig()
    {
        $this->info('⚙️ Background Configuration:');
        $this->line('');

        $config = config('backgrounds.pages', []);
        
        foreach ($config as $page => $bgConfig) {
            $this->line("📄 {$page}:");
            $this->line("   Image: {$bgConfig['image']}");
            $this->line("   Class: {$bgConfig['class']}");
            $this->line("   Overlay: {$bgConfig['overlay']}");
            $this->line('');
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
