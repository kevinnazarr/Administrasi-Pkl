@extends('layouts.app')

@section('title', 'Detail Pembimbing')

@section('content')

    @php
        $role = auth()->user()->role;
        use Illuminate\Support\Str;
    @endphp

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex items-center gap-4">
                    @if($pembimbing->foto)
                        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white/30">
                            <img src="{{ asset('storage/' . $pembimbing->foto) }}"
                                alt="{{ $pembimbing->nama }}"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center border-4 border-white/30">
                            <i class="fas fa-chalkboard-teacher text-green-600 text-3xl"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">
                            {{ $pembimbing->nama }}
                        </h1>
                        <p class="text-blue-100 text-lg leading-relaxed">
                            NIP: {{ $pembimbing->nip }}
                        </p>
                    </div>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Total DUDI
                    </p>
                    <p class="text-2xl font-bold">
                        {{ $pembimbing->dudis->count() }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Total Siswa: {{ $pembimbing->siswas->count() }}
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
                    Informasi Pembimbing
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-award text-blue-500 mr-2 w-5"></i>
                            Pangkat
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $pembimbing->pangkat ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-layer-group text-blue-500 mr-2 w-5"></i>
                            Golongan
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $pembimbing->golongan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-briefcase text-blue-500 mr-2 w-5"></i>
                            Jabatan
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $pembimbing->jabatan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-2 w-5"></i>
                            Nomor HP
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $pembimbing->no_hp ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-graduation-cap text-blue-500 mr-2 w-5"></i>
                            Jurusan
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ optional($pembimbing->jurusan)->jurusan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-clock text-blue-500 mr-2 w-5"></i>
                            Total Jam Ajar
                        </p>
                        <p class="font-medium text-gray-800 text-lg">{{ $pembimbing->jumlah_jam_mengajar }} Jam/Minggu</p>
                    </div>
                </div>

                @if($pembimbing->foto)
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-camera text-blue-500 mr-2"></i>
                            Foto Pembimbing
                        </h3>
                        <div class="flex justify-center">
                            <div class="w-64 h-64 rounded-2xl overflow-hidden border-4 border-blue-200 shadow-lg">
                                <img src="{{ asset('storage/' . $pembimbing->foto) }}"
                                    alt="Foto {{ $pembimbing->nama }}"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in" style="animation-delay: 0.1s">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center">
                        <i class="fas fa-building text-blue-500 mr-2"></i>
                        DUDI yang Dibimbing
                    </h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $pembimbing->dudis->count() }} DUDI
                    </span>
                </div>

                @if ($pembimbing->dudis->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($pembimbing->dudis as $dudi)
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 hover:border-blue-300 transition">
                                <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                                    <i class="fas fa-building text-blue-500 mr-2"></i>
                                    {{ $dudi->nama }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                    {{ Str::limit($dudi->alamat, 70) }}
                                </p>

                                <div class="space-y-2">
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-500 w-24">Pimpinan:</span>
                                        <span class="font-medium">{{ $dudi->pimpinan ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-500 w-24">Jabatan:</span>
                                        <span class="font-medium">{{ $dudi->jabatan ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-500 w-24">Kuota:</span>
                                        <span class="font-medium">
                                            {{ $dudi->siswas->count() }} / {{ $dudi->daya_tampung }}
                                            (Sisa: {{ $dudi->daya_tampung - $dudi->siswas->count() }})
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-500 w-24">No. Telp:</span>
                                        <span class="font-medium">{{ $dudi->no_telp ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 italic">Belum terhubung dengan DUDI manapun</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.2s">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-dark flex items-center">
                        <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                        Siswa Bimbingan
                    </h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        {{ $pembimbing->siswas->count() }} Siswa
                    </span>
                </div>

                @if ($pembimbing->siswas->count())
                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                        @foreach ($pembimbing->siswas as $index => $siswa)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $siswa->nama }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $siswa->kelas }} • {{ optional($siswa->jurusan)->jurusan ?? '-' }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-500">{{ $index + 1 }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 italic">Belum ada siswa bimbingan</p>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 animate-fade-in" style="animation-delay: 0.3s">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cogs text-blue-500 mr-2"></i>
                    Aksi
                </h3>

                <div class="space-y-3">
                    <a href="{{ route('pembimbing.index') }}"
                        class="w-full flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Data Pembimbing
                    </a>

                    @if(in_array($role, ['super_admin', 'admin_jurusan']))
                    <a href="{{ route('pembimbing.edit', $pembimbing->id_pembimbing) }}"
                        class="w-full flex items-center justify-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-edit"></i>
                        Edit Data
                    </a>

                    <form action="{{ route('pembimbing.destroy', $pembimbing->id_pembimbing) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data pembimbing ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl font-medium transition">
                            <i class="fas fa-trash"></i>
                            Hapus Data
                        </button>
                    </form>
                    @endif
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
                        <span class="font-medium">{{ $pembimbing->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <span class="text-gray-600 w-32">Diupdate:</span>
                        <span class="font-medium">{{ $pembimbing->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
