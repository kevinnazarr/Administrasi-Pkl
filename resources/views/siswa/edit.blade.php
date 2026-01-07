@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-edit mr-3"></i>
                        Edit Data Siswa
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Perbarui data siswa peserta PKL
                    </p>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        ID Siswa
                    </p>
                    <p class="text-2xl font-bold">
                        #{{ $siswa->id_siswa }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Terakhir diupdate: {{ $siswa->updated_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
        <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        Nama Lengkap
                    </label>
                    <input type="text"
                            name="nama"
                            value="{{ old('nama', $siswa->nama) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Masukkan nama lengkap siswa">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-school text-blue-500 mr-2"></i>
                        Kelas
                    </label>
                    <input type="text"
                            name="kelas"
                            value="{{ old('kelas', $siswa->kelas) }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Contoh: XII TKR 1">
                    @error('kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-venus-mars text-blue-500 mr-2"></i>
                        Jenis Kelamin
                    </label>
                    <select name="jenis_kelamin"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) == 'L')>
                            Laki-laki
                        </option>
                        <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) == 'P')>
                            Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-car text-blue-500 mr-2"></i>
                        Kendaraan
                    </label>
                    <select name="kendaraan"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Pilih Kendaraan</option>
                        <option value="pribadi" @selected(old('kendaraan', $siswa->kendaraan) == 'pribadi')>
                            Kendaraan Pribadi
                        </option>
                        <option value="umum" @selected(old('kendaraan', $siswa->kendaraan) == 'umum')>
                            Kendaraan Umum
                        </option>
                    </select>
                    @error('kendaraan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                        Jurusan
                    </label>
                    <select name="id_jurusan"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}"
                                @selected(old('id_jurusan', $siswa->id_jurusan) == $j->id_jurusan)>
                                {{ $j->jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_jurusan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                        Pembimbing Sekolah
                    </label>
                    <select name="id_pembimbing"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        @foreach($pembimbing as $p)
                            <option value="{{ $p->id_pembimbing }}"
                                @selected(old('id_pembimbing', $siswa->id_pembimbing) == $p->id_pembimbing)>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pembimbing')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-building text-blue-500 mr-2"></i>
                        DUDI
                    </label>
                    <select name="id_dudi"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        @foreach($dudi as $d)
                            <option value="{{ $d->id_dudi }}"
                                @selected(old('id_dudi', $siswa->id_dudi) == $d->id_dudi)>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_dudi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Alamat
                    </label>
                    <textarea name="alamat"
                                rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Masukkan alamat lengkap siswa">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('siswa.index') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data Siswa
                </a>

                <div class="flex gap-3 w-full md:w-auto">
                    <a href="{{ route('siswa.show', $siswa->id_siswa) }}"
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

    <!-- Informasi Data Siswa -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 rounded-2xl shadow-md p-6 animate-fade-in">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Informasi Data Saat Ini
            </h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Nama:</span>
                    <span class="font-medium">{{ $siswa->nama }}</span>
                </div>

                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Dibuat:</span>
                    <span class="font-medium">{{ $siswa->created_at->format('d/m/Y H:i') }}</span>
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
