@extends('layouts.app')

@section('title', 'Detail DUDI')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">
                            {{ $dudi->nama }}
                        </h1>
                        <p class="text-blue-100 text-lg leading-relaxed">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ Str::limit($dudi->alamat, 60) }}
                        </p>
                    </div>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Kapasitas
                    </p>
                    <p class="text-2xl font-bold">
                        {{ $dudi->siswas->count() }}/{{ $dudi->daya_tampung }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        @php
                            $percentage = ($dudi->siswas->count() / $dudi->daya_tampung) * 100;
                        @endphp
                        @if($percentage >= 100)
                            <span class="text-red-200">Penuh</span>
                        @elseif($percentage >= 80)
                            <span class="text-yellow-200">Hampir Penuh</span>
                        @else
                            <span class="text-green-200">Tersedia</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
                <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Informasi DUDI
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-user-tie text-blue-500 mr-2 w-5"></i>
                            Pimpinan
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->pimpinan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-chalkboard-teacher text-blue-500 mr-2 w-5"></i>
                            Pembimbing Industri
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->pembimbing_dudi }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-briefcase text-blue-500 mr-2 w-5"></i>
                            Jabatan Pembimbing
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->jabatan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-2 w-5"></i>
                            Nomor Telepon
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->no_telp ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-users text-blue-500 mr-2 w-5"></i>
                            Daya Tampung
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->daya_tampung }} siswa</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-user-check text-blue-500 mr-2 w-5"></i>
                            Siswa Aktif
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $dudi->siswas->count() }} siswa</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Alamat Lengkap
                    </h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-xl">
                        {{ $dudi->alamat }}
                    </p>
                </div>

                <div class="space-y-1">
                    <p class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-map text-blue-500 mr-2 w-5"></i>
                        Kecamatan
                    </p>
                    <p class="font-medium text-gray-800 text-lg">
                        {{ $dudi->kecamatan }}
                    </p>
                </div>


                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                        Tingkat Kepenuhan
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Kapasitas Terisi</span>
                            <span class="font-medium">{{ $dudi->siswas->count() }} / {{ $dudi->daya_tampung }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full transition-all duration-500"
                                style="width: {{ min(100, $percentage) }}%">
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>0%</span>
                            <span>{{ number_format($percentage, 1) }}%</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in" style="animation-delay: 0.1s">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center">
                        <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                        Daftar Siswa PKL
                    </h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $dudi->siswas->count() }} Siswa
                    </span>
                </div>

                @if($dudi->siswas->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">No</th>
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">Nama Siswa</th>
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">Kelas</th>
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">Jurusan</th>
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">Pembimbing Sekolah</th>
                                    <th class="px-4 py-4 text-left text-gray-600 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dudi->siswas as $siswa)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                        <td class="px-4 py-4">
                                            <span class="text-gray-600 font-medium">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $siswa->nama }}</p>
                                                    {{ $siswa->kelas }} • {{ optional($siswa->jurusan)->jurusan ?? '-' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ $siswa->kelas }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ optional($siswa->jurusan)->jurusan ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                                    <i class="fas fa-chalkboard-teacher text-green-600 text-xs"></i>
                                                </div>
                                                <span class="text-gray-700">{{ optional($siswa->pembimbing)->nama ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 italic">Belum ada siswa PKL di DUDI ini</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-blue-500 mr-2"></i>
                    Statistik Cepat
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kapasitas</p>
                                <p class="text-lg font-bold text-gray-800">{{ $dudi->siswas->count() }}/{{ $dudi->daya_tampung }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium px-2 py-1 rounded-full
                            @if($percentage >= 100)
                            @elseif($percentage >= 80) bg-yellow-100
                            @else text-green-800
                            @endif">
                            {{ number_format($percentage, 1) }}%
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user-check text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Siswa Aktif</p>
                                <p class="text-lg font-bold text-gray-800">{{ $dudi->siswas->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-chalkboard-teacher text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pembimbing Sekolah</p>
                                <p class="text-lg font-bold text-gray-800">
                                    {{ $dudi->siswas->pluck('pembimbing_id')->unique()->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.3s">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cogs text-blue-500 mr-2"></i>
                    Aksi
                </h3>

                <div class="space-y-3">
                    <a href="{{ route('dudi.index') }}"
                        class="w-full flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Data DUDI
                    </a>

                    <a href="{{ route('dudi.edit', $dudi->id_dudi) }}"
                        class="w-full flex items-center justify-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-edit"></i>
                        Edit Data
                    </a>

                    <form action="{{ route('dudi.destroy', $dudi->id_dudi) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data DUDI ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl font-medium transition">
                            <i class="fas fa-trash"></i>
                            Hapus Data
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-blue-50 rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.4s">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                    Informasi Tambahan
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center text-sm">
                        <span class="text-gray-600 w-32">Dibuat:</span>
                        <span class="font-medium">{{ $dudi->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-gray-600 w-32">Diupdate:</span>
                        <span class="font-medium">{{ $dudi->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-gray-600 w-32">Status:</span>
                        <span class="font-medium">
                            @if($percentage >= 100)
                                <span class="text-red-600">Penuh</span>
                            @elseif($percentage >= 80)
                                <span class="text-yellow-600">Hampir Penuh</span>
                            @else
                                <span class="text-green-600">Tersedia</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
