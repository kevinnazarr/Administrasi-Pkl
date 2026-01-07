<?php

namespace App\Services;

use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class DocxToPdfService
{
    public function convert(string $docxPath, string $outputDir): string
    {
        $pdfName = pathinfo($docxPath, PATHINFO_FILENAME) . '.pdf';

        $process = new Process([
            'docker',
            'exec',
            'libreoffice',
            'soffice',
            '--headless',
            '--convert-to',
            'pdf',
            '--outdir',
            '/data',
            '/data/' . basename($docxPath),
        ]);

        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException(
                'Gagal convert PDF: ' . $process->getErrorOutput()
            );
        }

        return $pdfName;
    }
}
