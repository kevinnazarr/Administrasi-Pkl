@extends('layouts.app')

@section('title', 'Preview Surat Penjajakan')

@section('content')

<div class="mb-6">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-indigo-500 to-blue-600 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    <i class="fas fa-eye mr-3"></i>
                    Preview Surat Penjajakan
                </h1>
                <p class="text-blue-100 text-lg">
                    Periksa surat sebelum dicetak atau diunduh
                </p>
            </div>

            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                <p class="text-sm text-blue-100">Status</p>
                <p class="text-xl font-bold">Siap Diproses</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
    <div class="border-b px-6 py-4 flex items-center justify-between">
        <h2 class="text-lg font-bold text-gray-800 flex items-center">
            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
            Pratinjau Surat
        </h2>
        <span class="text-sm text-gray-500">Format PDF</span>
    </div>

    <div class="h-[75vh] bg-gray-100">
        <iframe
            src="{{ route('surat.penjajakan.preview.file') }}"
            class="w-full h-full"
            frameborder="0">
        </iframe>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-md p-6">
    <div class="flex flex-col md:flex-row justify-between gap-4">

        <a href="{{ route('surat.penjajakan') }}"
            class="flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
            <i class="fas fa-arrow-left"></i>
            Kembali Edit
        </a>

        <div class="flex flex-col md:flex-row gap-3">
            <button onclick="printSurat()"
                class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                <i class="fas fa-print"></i>
                Cetak
            </button>

            <a href="{{ route('surat.penjajakan.download', ['type' => 'docx']) }}"
                class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition">
                <i class="fas fa-file-word"></i>
                Download DOCX
            </a>

            <a href="{{ route('surat.penjajakan.download', ['type' => 'pdf']) }}"
                class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition">
                <i class="fas fa-file-pdf"></i>
                Download PDF
            </a>
        </div>
    </div>
</div>


<script>
function printSurat() {
    const url = "{{ route('surat.penjajakan.preview.file') }}";
    const win = window.open(url, '_blank');
    win.onload = () => win.print();
}
</script>


@endsection
