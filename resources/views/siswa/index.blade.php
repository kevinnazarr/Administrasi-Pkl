@extends('layouts.app')

@section('title', 'Data Siswa PKL')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-user-graduate mr-3"></i>
                        Data Siswa PKL
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Kelola data peserta PKL dengan effisien
                    </p>
                </div>

                                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Total Siswa
                    </p>
                    <p class="text-2xl font-bold">
                        {{ $total ?? 0 }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Data Aktif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 mb-6 animate-fade-in">
        <h2 class="text-xl font-bold text-dark mb-6">Filter Data</h2>

        <form method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Siswa</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Nama, NIS, atau Perusahaan...">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <select name="jurusan" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}"
                                @selected(request('jurusan') == $j->id_jurusan)>
                                {{ $j->jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>

                    <a href="{{ route('siswa.index') }}"
                        class="flex-1 flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-redo"></i>
                        Reset
                    </a>
                </div>

                <div class="flex items-end">
                    <a href="{{ route('siswa.create') }}"
                        class="w-full flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-user-plus"></i>
                        Tambah Siswa
                    </a>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 animate-slide-up">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="hidden md:block bg-white rounded-2xl shadow-md p-6 animate-fade-in">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">No</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Nama</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">JK</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Jurusan</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Pembimbing</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">DUDI</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Kelas</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Kendaraan</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($siswa as $row)
                    <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                        <td class="px-4 py-4">
                            <span class="text-gray-600 font-medium">
                                {{ $siswa->firstItem() + $loop->index }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $row->nama }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $row->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $row->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $row->jurusan->jurusan ?? '-' }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-chalkboard-teacher text-green-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700">{{ $row->pembimbing->nama ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-building text-purple-600 text-xs"></i>
                                </div>
                                <span class="text-gray-700">{{ $row->dudi->nama ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $row->kelas }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $row->kendaraan === 'pribadi' ? 'bg-indigo-100 text-indigo-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ $row->kendaraan === 'pribadi' ? 'Pribadi' : 'Umum' }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('siswa.edit', $row->id_siswa) }}"
                                    class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs transition">
                                    <i class="fas fa-edit text-xs"></i>
                                    Edit
                                </a>

                                <form action="{{ route('siswa.destroy', $row->id_siswa) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs transition">
                                        <i class="fas fa-trash text-xs"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-lg font-medium mb-1">Data siswa belum tersedia</p>
                                <p class="text-sm">Tambahkan data siswa untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($siswa->hasPages())
            <div class="mt-6 pt-6 border-t border-gray-200">
                {{ $siswa->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <div class="md:hidden space-y-4">
        @forelse($siswa as $row)
            <div class="bg-white rounded-2xl shadow-md p-5 animate-fade-in">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $row->nama }}</h3>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $row->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                        {{ $row->jenis_kelamin === 'L' ? 'L' : 'P' }}
                    </span>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center text-sm">
                        <div class="w-20 text-gray-500">Jurusan</div>
                        <div class="flex-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $row->jurusan->jurusan ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-20 text-gray-500">Pembimbing</div>
                        <div class="flex-1 flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-chalkboard-teacher text-green-600 text-xs"></i>
                            </div>
                            <span>{{ $row->pembimbing->nama ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-20 text-gray-500">DUDI</div>
                        <div class="flex-1 flex items-center">
                            <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-building text-purple-600 text-xs"></i>
                            </div>
                            <span>{{ $row->dudi->nama ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-20 text-gray-500">Kelas</div>
                        <div class="flex-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $row->kelas }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-20 text-gray-500">Kendaraan</div>
                        <div class="flex-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $row->kendaraan === 'pribadi' ? 'bg-indigo-100 text-indigo-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ $row->kendaraan === 'pribadi' ? 'Pribadi' : 'Umum' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-2">
                    <a href="{{ route('siswa.edit', $row->id_siswa) }}"
                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>

                    <form action="{{ route('siswa.destroy', $row->id_siswa) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                            <i class="fas fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-user-graduate text-gray-400 text-3xl"></i>
                    </div>
                    <p class="text-lg font-medium text-gray-700 mb-2">Data siswa belum tersedia</p>
                    <p class="text-gray-500 mb-4">Tambahkan data siswa untuk memulai</p>
                    <a href="{{ route('siswa.create') }}"
                        class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-user-plus"></i>
                        Tambah Siswa
                    </a>
                </div>
            </div>
        @endforelse

        @if($siswa->hasPages())
            <div class="mt-4">
                {{ $siswa->withQueryString()->links() }}
            </div>
        @endif
    </div>

@endsection
