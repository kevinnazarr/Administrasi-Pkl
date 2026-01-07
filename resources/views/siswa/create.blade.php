@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-user-plus mr-3"></i>
                        Tambah Siswa PKL
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Lengkapi data siswa peserta PKL
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
                        Form Tambah Siswa
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
        <form action="{{ route('siswa.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            value="{{ old('kelas') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Contoh: XII RPL 1">
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
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                        <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
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
                        <option value="pribadi" @selected(old('kendaraan') == 'pribadi')>
                            Kendaraan Pribadi
                        </option>
                        <option value="umum" @selected(old('kendaraan') == 'umum')>
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            {{ auth()->user()->role === 'admin_jurusan' ? 'disabled' : '' }}>
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}"
                                @selected(old('id_jurusan') == $j->id_jurusan)>
                                {{ $j->jurusan }}
                            </option>
                        @endforeach
                    </select>

                    @if(auth()->user()->role === 'admin_jurusan')
                        <input type="hidden"
                                name="id_jurusan"
                                value="{{ auth()->user()->jurusan_id }}">
                    @endif

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
                        <option value="">Pilih Pembimbing</option>
                        @foreach($pembimbing as $p)
                            <option value="{{ $p->id_pembimbing }}"
                                @selected(old('id_pembimbing') == $p->id_pembimbing)>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pembimbing')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-building text-blue-500 mr-2"></i>
                    DUDI
                </label>
                <select name="id_dudi"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Pilih DUDI</option>
                    @foreach($dudi as $d)
                        <option value="{{ $d->id_dudi }}"
                            {{ $d->isPenuh() ? 'disabled' : '' }}
                            @selected(old('id_dudi') == $d->id_dudi)>
                            {{ $d->nama }}
                            ({{ $d->siswas->count() }}/{{ $d->daya_tampung }})
                            {{ $d->isPenuh() ? ' - PENUH' : '' }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    DUDI yang penuh tidak dapat dipilih. Angka dalam tanda kurung menunjukkan kapasitas terisi/total.
                </p>
                @error('id_dudi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                    Alamat
                </label>
                <textarea name="alamat"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Masukkan alamat lengkap siswa">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('siswa.index') }}"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Data Siswa
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
