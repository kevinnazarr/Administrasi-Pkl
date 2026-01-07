<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\Process\Process;

class SuratController extends Controller
{
    public function index()
    {
        return view('surat.index');
    }

    public function penjajakan()
    {
        return view('surat.penjajakan.create', [
            'dudis'    => Dudi::orderBy('nama')->get(),
            'jurusans' => Jurusan::orderBy('jurusan')->get(),
        ]);
    }

    public function penjajakanPreview(Request $request)
    {
        $data = $request->validate([
            'id_dudi'          => 'required|exists:dudi,id_dudi',
            'id_jurusan'       => 'required|exists:jurusan,id_jurusan',

            'nomor_surat'      => 'required',
            'tanggal_surat'    => 'required|date',

            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date',

            'lama_pkl'         => 'required',
            'tingkat'          => 'required',
            'alamat_kecamatan' => 'required',

            'm_pembekalan'     => 'nullable|date',
            's_pembekalan'     => 'nullable|date',

            'm_pengujian'      => 'nullable|date',
            's_pengujian'      => 'nullable|date',
        ]);

        $dudi    = Dudi::findOrFail($data['id_dudi']);
        $jurusan = Jurusan::findOrFail($data['id_jurusan']);

        $fmt = function ($value) {
            return $value ? date('d F Y', strtotime($value)) : '-';
        };

        $uuid   = Str::uuid();
        $tmpDir = storage_path('app/public/tmp');

        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        $docxName = "surat-{$uuid}.docx";
        $pdfName  = "surat-{$uuid}.pdf";

        $docxPath = "{$tmpDir}/{$docxName}";
        $pdfPath  = "{$tmpDir}/{$pdfName}";

        $template = new TemplateProcessor(
            storage_path('app/templates/surat-penjajakan.docx')
        );

        $template->setValues([
            'nomor_surat'      => $data['nomor_surat'],
            'tanggal_surat'    => $fmt($data['tanggal_surat']),

            'nama_dudi'        => $dudi->nama,
            'alamat_jalan'     => $dudi->alamat,
            'alamat_kecamatan' => $data['alamat_kecamatan'],

            'lama_pkl'         => $data['lama_pkl'],
            'tingkat'          => $data['tingkat'],
            'jurusan'          => $jurusan->jurusan,

            'tanggal_mulai'    => $fmt($data['tanggal_mulai']),
            'tanggal_selesai'  => $fmt($data['tanggal_selesai']),

            'm_pembekalan'     => $fmt($data['m_pembekalan'] ?? null),
            's_pembekalan'     => $fmt($data['s_pembekalan'] ?? null),

            'm_pengujian'      => $fmt($data['m_pengujian'] ?? null),
            's_pengujian'      => $fmt($data['s_pengujian'] ?? null),
        ]);

        $template->saveAs($docxPath);

        copy($docxPath, "/tmp/{$docxName}");

        $process = new Process([
            'docker',
            'exec',
            'libreoffice',
            'libreoffice',
            '--headless',
            '--convert-to',
            'pdf',
            '--outdir',
            '/tmp',
            "/tmp/{$docxName}"
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            abort(500, 'Gagal convert DOCX ke PDF via LibreOffice Docker');
        }

        copy("/tmp/{$pdfName}", $pdfPath);

        session([
            'surat_docx' => $docxName,
            'surat_pdf'  => $pdfName,
        ]);

        return redirect()->route('surat.penjajakan.preview.page');
    }

    public function previewPage()
    {
        abort_unless(session()->has('surat_pdf'), 404);

        return view('surat.penjajakan.preview', [
            'pdf'  => session('surat_pdf'),
            'docx' => session('surat_docx'),
        ]);
    }

    public function download(Request $request)
    {
        $type = $request->query('type');

        abort_unless(in_array($type, ['pdf', 'docx']), 404);

        $filename = session("surat_{$type}");
        $path     = storage_path("app/public/tmp/{$filename}");

        abort_unless(file_exists($path), 404);

        return response()->download($path);
    }
}
