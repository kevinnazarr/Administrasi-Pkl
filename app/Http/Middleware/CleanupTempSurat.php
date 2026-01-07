<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CleanupTempSurat
{
    public function handle(Request $request, Closure $next)
    {
        // kalau session surat sudah tidak ada
        if (!session()->has('surat_pdf') && !session()->has('surat_docx')) {
            $tmpPath = storage_path('app/public/tmp');

            if (is_dir($tmpPath)) {
                foreach (glob($tmpPath . '/surat-*') as $file) {
                    // hapus file yang lebih tua dari 1 jam
                    if (filemtime($file) < now()->subHour()->timestamp) {
                        @unlink($file);
                    }
                }
            }
        }

        return $next($request);
    }
}
