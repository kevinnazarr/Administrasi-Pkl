@extends('layouts.app')

@section('title', 'Edit DUDI')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-edit mr-3"></i>
                        Edit Data DUDI
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Perbarui data Dunia Usaha & Dunia Industri
                    </p>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        ID DUDI
                    </p>
                    <p class="text-2xl font-bold">
                        #{{ $dudi->id_dudi }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Terakhir diupdate: {{ $dudi->updated_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
        <form action="{{ route('dudi.update', $dudi->id_dudi) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-building text-blue-500 mr-2"></i>
                        Nama DUDI
                    </label>
                    <input type="text"
                            name="nama"
                            value="{{ old('nama', $dudi->nama) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-user-tie text-blue-500 mr-2"></i>
                        Pimpinan
                    </label>
                    <input type="text"
                            name="pimpinan"
                            value="{{ old('pimpinan', $dudi->pimpinan) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('pimpinan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                        Pembimbing Industri
                    </label>
                    <input type="text"
                            name="pembimbing_dudi"
                            value="{{ old('pembimbing_dudi', $dudi->pembimbing_dudi) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('pembimbing_dudi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                        Jabatan Pembimbing
                    </label>
                    <input type="text"
                            name="jabatan"
                            value="{{ old('jabatan', $dudi->jabatan) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('jabatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        Daya Tampung
                    </label>
                    <input type="number"
                            name="daya_tampung"
                            min="1"
                            value="{{ old('daya_tampung', $dudi->daya_tampung) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('daya_tampung')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-phone text-blue-500 mr-2"></i>
                        Nomor Telepon
                    </label>
                    <input type="text"
                            name="no_telp"
                            value="{{ old('no_telp', $dudi->no_telp) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    @error('no_telp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                    Alamat Lengkap
                </label>
                <textarea name="alamat"
                            rows="3"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('alamat', $dudi->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map text-blue-500 mr-2"></i>
                    Kecamatan dan Kabupaten
                </label>
                <input type="text"
                    name="kecamatan"
                    value="{{ old('kecamatan', $dudi->kecamatan) }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                @error('kecamatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dudi.index') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data DUDI
                </a>

                <div class="flex gap-3 w-full md:w-auto">
                    <a href="{{ route('dudi.show', $dudi->id_dudi) }}"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-eye"></i>
                        Lihat Detail
                    </a>

                    <button type="submit"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-save"></i>
                        Update Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 rounded-2xl shadow-md p-6 animate-fade-in">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Informasi Data Saat Ini
            </h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Nama DUDI:</span>
                    <span class="font-medium">{{ $dudi->nama }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Jumlah Siswa:</span>
                    <span class="font-medium">{{ $dudi->siswas->count() }} / {{ $dudi->daya_tampung }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Dibuat:</span>
                    <span class="font-medium">{{ $dudi->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-green-50 rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.2s">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-lightbulb text-green-500 mr-2"></i>
                Tips Pengeditan
            </h3>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Pastikan semua data sudah benar sebelum menyimpan perubahan</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Data akan langsung diperbarui di sistem setelah disimpan</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                    <span>Anda dapat membatalkan pengeditan dengan tombol "Kembali"</span>
                </li>
            </ul>
        </div>
    </div>

@endsection
