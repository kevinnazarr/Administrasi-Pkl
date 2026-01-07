<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\Process\Process;
use PhpOffice\PhpWord\Element\TextRun;
use Carbon\Carbon;

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

    public function __construct()
    {
        Carbon::setLocale('id');
    }
    private function indoDate($date)
    {
        return \Carbon\Carbon::parse($date)->translatedFormat('j F Y');
    }

    private function rangeTanggal($mulai, $selesai)
    {
        if (!$mulai || !$selesai) return '-';

        $m = \Carbon\Carbon::parse($mulai);
        $s = \Carbon\Carbon::parse($selesai);

        if ($m->month === $s->month && $m->year === $s->year) {
            return $m->day . ' s.d ' . $s->translatedFormat('j F Y');
        }

        return $m->translatedFormat('j F Y') . ' s.d ' . $s->translatedFormat('j F Y');
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

        $tmpDir = storage_path('app/tmp');
        if (!is_dir($tmpDir)) mkdir($tmpDir, 0755, true);

        $uuid = Str::uuid();
        $docx = "surat-$uuid.docx";
        $pdf  = "surat-$uuid.pdf";

        $docxPath = "$tmpDir/$docx";
        $pdfPath  = "$tmpDir/$pdf";

        $tpl = new TemplateProcessor(storage_path('app/templates/surat-penjajakan.docx'));
        $tpl->setValues([
            'nomor_surat'      => $data['nomor_surat'],
            'tanggal_surat'    => $this->indoDate($data['tanggal_surat']),
            'nama_dudi'        => $dudi->nama,
            'alamat_jalan'     => $dudi->alamat,
            'alamat_kecamatan' => $data['alamat_kecamatan'],
            'jurusan'          => $jurusan->jurusan,
            'tingkat'          => $data['tingkat'],
            'lama_pkl'         => $data['lama_pkl'],
            'pembekalan'       => $this->rangeTanggal($data['m_pembekalan'], $data['s_pembekalan']),
            'pengujian'        => $this->rangeTanggal($data['m_pengujian'], $data['s_pengujian']),
        ]);

        $pelaksanaan = new TextRun();
        $pelaksanaan->addText(
            $this->rangeTanggal($data['tanggal_mulai'], $data['tanggal_selesai']),
            [
                'bold' => true,
                'name' => 'Arial',
                'size' => 12
            ]
        );

        $tpl->setComplexValue('pelaksanaan', $pelaksanaan);

        $tpl->saveAs($docxPath);

        copy($docxPath, "$tmpDir/$docx");

        $process = new Process([
            'docker',
            'exec',
            'libreoffice',
            'libreoffice',
            '--headless',
            '--convert-to',
            'pdf',
            '--outdir',
            '/data',
            "/data/$docx"
        ]);
        $process->setTimeout(60);
        $process->run();

        abort_unless($process->isSuccessful(), 500, $process->getErrorOutput());

        session([
            'surat_docx' => $docx,
            'surat_pdf'  => $pdf,
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

        $file = session("surat_{$type}");
        $path = storage_path("app/tmp/{$file}");

        abort_unless(file_exists($path), 404);

        return response()->download($path);
    }

    public function previewFile()
    {
        $file = session('surat_pdf');
        abort_unless($file, 404);

        $path = storage_path("app/tmp/$file");
        abort_unless(file_exists($path), 404);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
        ]);
    }
}
