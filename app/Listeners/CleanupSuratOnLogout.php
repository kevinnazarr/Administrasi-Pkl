<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\File;

class CleanupSuratOnLogout
{
    public function handle(Logout $event): void
    {
        $tmpPath = storage_path('app/tmp');

        if (!is_dir($tmpPath)) return;

        $files = File::files($tmpPath);

        foreach ($files as $file) {
            File::delete($file);
        }
    }
}
