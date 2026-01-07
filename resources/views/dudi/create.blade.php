@extends('layouts.app')

@section('title', 'Tambah DUDI')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-building mr-3"></i>
                        Tambah DUDI
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Lengkapi data Dunia Usaha & Dunia Industri
                    </p>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Langkah
                    </p>
                    <p class="text-2xl font-bold">
                        1/1
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Form Tambah DUDI
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
        <form action="{{ route('dudi.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-building text-blue-500 mr-2"></i>
                        Nama DUDI
                    </label>
                    <input type="text"
                            name="nama"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Nama perusahaan / industri">
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
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Nama pimpinan perusahaan">
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
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Nama pembimbing dari DUDI">
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
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Jabatan pembimbing">
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
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Jumlah siswa yang diterima">
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Nomor telepon DUDI">
                    @error('no_telp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                    Alamat
                </label>
                <textarea name="alamat"
                            rows="3"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Alamat DUDI"></textarea>
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
                    value="{{ old('kecamatan') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Contoh: Kec.Leksono Kab.Wonosobo">
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
                    <button type="reset"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-redo"></i>
                        Reset Form
                    </button>

                    <button type="submit"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
