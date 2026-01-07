@extends('layouts.app')

@section('title', 'Tambah Pembimbing')

@section('content')

    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-chalkboard-teacher mr-3"></i>
                        Tambah Pembimbing
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Lengkapi data pembimbing sekolah dan DUDI yang dibimbing
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
        <form action="{{ route('pembimbing.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Data Pembimbing -->
            <div class="space-y-4">
                <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    Data Pembimbing
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Nama Lengkap
                        </label>
                        <input type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Nama lengkap pembimbing">
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-id-card text-blue-500 mr-2"></i>
                            NIP
                        </label>
                        <input type="text"
                                name="nip"
                                value="{{ old('nip') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Nomor Induk Pegawai">
                        @error('nip')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pangkat -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-award text-blue-500 mr-2"></i>
                            Pangkat
                        </label>
                        <input type="text"
                                name="pangkat"
                                value="{{ old('pangkat') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Penata Muda">
                    </div>

                    <!-- Golongan -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-layer-group text-blue-500 mr-2"></i>
                            Golongan
                        </label>
                        <input type="text"
                                name="golongan"
                                value="{{ old('golongan') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="III/a">
                    </div>

                    <!-- Jabatan -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                            Jabatan
                        </label>
                        <input type="text"
                                name="jabatan"
                                value="{{ old('jabatan') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Guru Pembimbing">
                    </div>

                    <!-- Jumlah Jam Mengajar -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Jumlah Jam Mengajar / Minggu
                        </label>
                        <input type="number"
                                name="jumlah_jam_mengajar"
                                min="0"
                                value="{{ old('jumlah_jam_mengajar') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Contoh: 24">
                    </div>

                    <!-- Nomor HP -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-phone text-blue-500 mr-2"></i>
                            Nomor HP
                        </label>
                        <input type="text"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="08xxxxxxxxxx">
                    </div>

                    <!-- Foto Pembimbing -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-camera text-blue-500 mr-2"></i>
                            Foto Pembimbing
                        </label>
                        <input type="file"
                                name="foto"
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Format: JPG/PNG, maksimal 2MB
                        </p>
                    </div>
                </div>
            </div>

            <!-- DUDI yang Dibimbing -->
            <div class="space-y-4 pt-6 border-t border-gray-200">
                <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-building text-blue-500 mr-2"></i>
                    DUDI yang Dibimbing
                </h2>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Pilih Satu atau Lebih DUDI
                    </label>
                    <select name="dudi_ids[]"
                            multiple
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition h-44">
                        @foreach ($dudis as $dudi)
                            <option value="{{ $dudi->id_dudi }}"
                                {{ collect(old('dudi_ids'))->contains($dudi->id_dudi) ? 'selected' : '' }}>
                                {{ $dudi->nama }} • {{ Str::limit($dudi->alamat, 45) }}
                            </option>
                        @endforeach
                    </select>

                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Tahan <span class="font-semibold">Ctrl</span> (Windows) atau <span class="font-semibold">Cmd</span> (Mac) untuk memilih lebih dari satu
                    </p>

                    @error('dudi_ids')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('pembimbing.index') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data Pembimbing
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
