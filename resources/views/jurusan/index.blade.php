@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-graduation-cap mr-3"></i>
                        Data Jurusan
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Daftar jurusan yang tersedia di sekolah
                    </p>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Total Jurusan
                    </p>
                    <p class="text-2xl font-bold">
                        {{ $jurusans->count() }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Data Aktif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-dark">Daftar Jurusan</h2>
            <span class="text-sm text-gray-500">
                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                Menampilkan semua jurusan
            </span>
        </div>

        @if($jurusans->count() > 0)
            <!-- Desktop View (Table) -->
            <div class="hidden md:block">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-4 py-4 text-left text-gray-600 font-semibold">No</th>
                                <th class="px-4 py-4 text-left text-gray-600 font-semibold">Nama Jurusan</th>
                                <th class="px-4 py-4 text-left text-gray-600 font-semibold">Kode</th>
                                <th class="px-4 py-4 text-left text-gray-600 font-semibold">Jumlah Siswa</th>
                                <th class="px-4 py-4 text-left text-gray-600 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($jurusans as $index => $jurusan)
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-4 py-4">
                                    <span class="text-gray-600 font-medium">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-graduation-cap text-blue-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $jurusan->jurusan }}</p>
                                            @if(isset($jurusan->deskripsi) && $jurusan->deskripsi)
                                                <p class="text-xs text-gray-500">{{ Str::limit($jurusan->deskripsi, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $jurusan->kode_jurusan ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-green-600 text-xs"></i>
                                        </div>
                                        <span class="font-medium">
                                            {{ isset($jurusan->siswas_count) ? $jurusan->siswas_count : ($jurusan->siswas->count() ?? 0) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $siswaCount = isset($jurusan->siswas_count) ? $jurusan->siswas_count : ($jurusan->siswas->count() ?? 0);
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $siswaCount > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        <i class="fas fa-circle mr-1 text-xs"></i>
                                        {{ $siswaCount > 0 ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View (Cards) -->
            <div class="md:hidden space-y-4">
                @foreach($jurusans as $jurusan)
                    <div class="bg-white rounded-2xl shadow-md p-5 animate-fade-in">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-graduation-cap text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $jurusan->jurusan }}</h3>
                                    @if(isset($jurusan->kode_jurusan) && $jurusan->kode_jurusan)
                                        <p class="text-sm text-gray-600">Kode: {{ $jurusan->kode_jurusan }}</p>
                                    @endif
                                </div>
                            </div>
                            @php
                                $siswaCount = isset($jurusan->siswas_count) ? $jurusan->siswas_count : ($jurusan->siswas->count() ?? 0);
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $siswaCount > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $siswaCount > 0 ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @if(isset($jurusan->deskripsi) && $jurusan->deskripsi)
                            <div class="flex items-start text-sm">
                                <div class="w-20 text-gray-500">Deskripsi</div>
                                <div class="flex-1">
                                    <p class="text-gray-700">{{ Str::limit($jurusan->deskripsi, 80) }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="flex items-center text-sm">
                                <div class="w-20 text-gray-500">Jumlah Siswa</div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-green-600 text-xs"></i>
                                        </div>
                                        <span class="font-medium">{{ $siswaCount }} siswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-gray-400 text-3xl"></i>
                </div>
                <p class="text-lg font-medium text-gray-700 mb-2">Data jurusan belum tersedia</p>
                <p class="text-gray-500">Saat ini belum ada data jurusan yang terdaftar</p>
            </div>
        @endif
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 rounded-2xl shadow-md p-6 animate-fade-in">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-pie text-blue-500 mr-2"></i>
                Statistik Jurusan
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-white rounded-xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-graduation-cap text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Jurusan</p>
                            <p class="text-lg font-bold text-gray-800">{{ $jurusans->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 bg-white rounded-xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Siswa</p>
                            <p class="text-lg font-bold text-gray-800">
                                @php
                                    $totalSiswa = 0;
                                    foreach($jurusans as $jurusan) {
                                        $totalSiswa += isset($jurusan->siswas_count) ? $jurusan->siswas_count : ($jurusan->siswas->count() ?? 0);
                                    }
                                @endphp
                                {{ $totalSiswa }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-green-50 rounded-2xl shadow-md p-6 animate-fade-in delay-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-green-500 mr-2"></i>
                Informasi Jurusan
            </h3>
            <p class="text-sm text-gray-600 mb-3">
                Halaman ini menampilkan daftar jurusan yang tersedia di sekolah. Data jurusan digunakan untuk mengelompokkan siswa berdasarkan bidang keahlian.
            </p>
        </div>
    </div>

@endsection
