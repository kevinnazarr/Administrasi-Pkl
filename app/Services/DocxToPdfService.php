<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class DocxToPdfService
{
    public function convert(string $docxPath): string
    {
        if (!file_exists($docxPath)) {
            throw new \Exception("DOCX tidak ditemukan: {$docxPath}");
        }

        $containerDocx = '/tmp/' . basename($docxPath);

        $process = new Process([
            'docker',
            'exec',
            'libreoffice',
            'soffice',
            '--headless',
            '--convert-to',
            'pdf',
            '--outdir',
            '/tmp',
            $containerDocx
        ]);

        $process->setTimeout(120);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \Exception($process->getErrorOutput());
        }

        return str_replace('.docx', '.pdf', basename($docxPath));
    }
}
