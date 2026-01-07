@extends('layouts.app')

@section('title', 'Buat Surat')

@section('content')
    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-envelope-open-text mr-3"></i>
                        Buat Surat PKL
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Pilih jenis surat yang ingin Anda buat untuk keperluan PKL
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-linear-to-r from-yellow-50 to-yellow-100 rounded-xl p-6 border border-yellow-200 card-hover animate-slide-up h-full flex flex-col justify-between" style="animation-delay: 0.1s">
            <div class="text-center">
                <div class="bg-yellow-500 p-4 rounded-lg inline-flex mb-4">
                    <i class="fas fa-file-contract text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-dark mb-2">
                    Surat Penjajakan
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Buat surat permohonan PKL ke perusahaan atau instansi
                </p>
            </div>
            <a href="{{ route('surat.penjajakan') }}"
                class="mt-4 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                <span>Buat Surat</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="bg-linear-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200 card-hover animate-slide-up h-full flex flex-col justify-between" style="animation-delay: 0.2s">
            <div class="text-center">
                <div class="bg-blue-500 p-4 rounded-lg inline-flex mb-4">
                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-dark mb-2">
                    Surat Penempatan
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Buat surat penempatan siswa PKL di perusahaan
                </p>
            </div>
            <button onclick="showComingSoon()"
                    class="mt-4 text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                <span>Buat Surat</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>

        <div class="bg-linear-to-r from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200 card-hover animate-slide-up h-full flex flex-col justify-between" style="animation-delay: 0.3s">
            <div class="text-center">
                <div class="bg-purple-500 p-4 rounded-lg inline-flex mb-4">
                    <i class="fas fa-user-times text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-dark mb-2">
                    Surat Penarikan
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Buat surat penarikan siswa dari tempat PKL
                </p>
            </div>
            <button onclick="showComingSoon()"
                    class="mt-4 text-center bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                <span>Buat Surat</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>

        <div class="bg-linear-to-r from-green-50 to-green-100 rounded-xl p-6 border border-green-200 card-hover animate-slide-up h-full flex flex-col justify-between" style="animation-delay: 0.4s">
            <div class="text-center">
                <div class="bg-green-500 p-4 rounded-lg inline-flex mb-4">
                    <i class="fas fa-clipboard-check text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-dark mb-2">
                    Surat Tugas
                </h3>
                <p class="text-gray-600 text-sm mb-4">
                    Buat surat tugas untuk pembimbing PKL
                </p>
            </div>
            <button onclick="showComingSoon()"
                    class="mt-4 text-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                <span>Buat Surat</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-dark">Informasi Penting</h2>
                <div class="text-primary font-medium flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Panduan
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                    <div class="shrink-0 mt-1">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">
                            Pastikan semua data yang diinputkan sudah benar sebelum membuat surat
                        </p>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                    <div class="shrink-0 mt-1">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">
                            Anda dapat melihat preview surat sebelum mencetak atau mengunduh
                        </p>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                    <div class="shrink-0 mt-1">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">
                            Surat dapat diunduh dalam format PDF atau DOCX sesuai kebutuhan
                        </p>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                    <div class="shrink-0 mt-1">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">
                            Simpan draft surat untuk revisi di kemudian waktu
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="comingSoonModal" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 animate-fade-in">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 animate-slide-up">
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Segera Hadir!</h3>
                <p class="text-gray-600 mb-6">Fitur ini sedang dalam pengembangan dan akan segera tersedia.</p>
                <button onclick="hideComingSoon()"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
    function showComingSoon() {
        document.getElementById('comingSoonModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideComingSoon() {
        document.getElementById('comingSoonModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    </script>
@endsection
