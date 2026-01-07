@extends('layouts.app')

@section('title', 'Data DUDI')

@section('content')

    <div class="mb-6">
        <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <i class="fas fa-building mr-3"></i>
                        Data DUDI
                    </h1>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Dunia Usaha dan Dunia Industri
                    </p>
                </div>

                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 min-w-[220px] text-center md:text-right">
                    <p class="text-sm text-blue-100">
                        Total DUDI
                    </p>
                    <p class="text-2xl font-bold">
                        {{ $total ?? $dudis->total() }}
                    </p>
                    <p class="text-sm text-blue-100 mt-1">
                        Kapasitas Tersedia
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6 mb-6 animate-fade-in">
        <h2 class="text-xl font-bold text-dark mb-6">Filter Data</h2>

        <form method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari DUDI</label>
                    <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Cari nama atau alamat DUDI...">
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>

                    <a href="{{ route('dudi.index') }}"
                        class="flex-1 flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-redo"></i>
                        Reset
                    </a>
                </div>

                <div class="flex items-end">
                    <a href="{{ route('dudi.create') }}"
                        class="w-full flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-plus"></i>
                        Tambah DUDI
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
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Nama DUDI</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Pimpinan</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Pembimbing Industri</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Kapasitas</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Status</th>
                        <th class="px-4 py-4 text-left text-gray-600 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($dudis as $dudi)
                    <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-building text-purple-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $dudi->nama }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ Str::limit($dudi->alamat, 50) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <span class="text-gray-700">{{ $dudi->pimpinan ?? '-' }}</span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-chalkboard-teacher text-green-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $dudi->pembimbing_dudi }}</p>
                                    <p class="text-xs text-gray-500">{{ $dudi->jabatan ?? '-' }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-600">Terisi:</span>
                                    <span class="font-medium">{{ $dudi->siswas->count() }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full"
                                         style="width: {{ min(100, ($dudi->siswas->count() / $dudi->daya_tampung) * 100) }}%">
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-600">Total:</span>
                                    <span class="font-medium">{{ $dudi->daya_tampung }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            @php
                                $percentage = ($dudi->siswas->count() / $dudi->daya_tampung) * 100;
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($percentage >= 100) bg-red-100 text-red-800
                                @elseif($percentage >= 80) bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800
                                @endif">
                                @if($percentage >= 100)
                                    <i class="fas fa-times-circle mr-1"></i> Penuh
                                @elseif($percentage >= 80)
                                    <i class="fas fa-exclamation-circle mr-1"></i> Hampir Penuh
                                @else
                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                @endif
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('dudi.show', $dudi->id_dudi) }}"
                                    class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs transition">
                                    <i class="fas fa-eye text-xs"></i>
                                    Detail
                                </a>

                                <a href="{{ route('dudi.edit', $dudi->id_dudi) }}"
                                    class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs transition">
                                    <i class="fas fa-edit text-xs"></i>
                                    Edit
                                </a>

                                <form action="{{ route('dudi.destroy', $dudi->id_dudi) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data DUDI ini?')">
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
                        <td colspan="6" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-building text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-lg font-medium mb-1">Data DUDI belum tersedia</p>
                                <p class="text-sm">Tambahkan data DUDI untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($dudis->hasPages())
            <div class="mt-6 pt-6 border-t border-gray-200">
                {{ $dudis->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <div class="md:hidden space-y-4">
        @forelse($dudis as $dudi)
            <div class="bg-white rounded-2xl shadow-md p-5 animate-fade-in">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-building text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $dudi->nama }}</h3>
                            <p class="text-sm text-gray-600">Pimpinan: {{ $dudi->pimpinan ?? '-' }}</p>
                        </div>
                    </div>
                    @php
                        $percentage = ($dudi->siswas->count() / $dudi->daya_tampung) * 100;
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($percentage >= 100) bg-red-100 text-red-800
                        @elseif($percentage >= 80) bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ $dudi->siswas->count() }}/{{ $dudi->daya_tampung }}
                    </span>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center text-sm">
                        <div class="w-24 text-gray-500">Pembimbing</div>
                        <div class="flex-1">
                            <span class="font-medium">{{ $dudi->pembimbing_dudi }}</span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-24 text-gray-500">Jabatan</div>
                        <div class="flex-1">
                            <span class="text-gray-700">{{ $dudi->jabatan ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-24 text-gray-500">Alamat</div>
                        <div class="flex-1">
                            <p class="text-gray-700 text-xs">{{ Str::limit($dudi->alamat, 70) }}</p>
                        </div>
                    </div>

                    <div class="flex items-center text-sm">
                        <div class="w-24 text-gray-500">Kapasitas</div>
                        <div class="flex-1">
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full"
                                    style="width: {{ min(100, $percentage) }}%">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $dudi->siswas->count() }} dari {{ $dudi->daya_tampung }} siswa
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end gap-2">
                    <a href="{{ route('dudi.show', $dudi->id_dudi) }}"
                        class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-eye"></i>
                        Detail
                    </a>

                    <a href="{{ route('dudi.edit', $dudi->id_dudi) }}"
                        class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-building text-gray-400 text-3xl"></i>
                    </div>
                    <p class="text-lg font-medium text-gray-700 mb-2">Data DUDI belum tersedia</p>
                    <p class="text-gray-500 mb-4">Tambahkan data DUDI untuk memulai</p>
                    <a href="{{ route('dudi.create') }}"
                        class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl font-medium transition">
                        <i class="fas fa-plus"></i>
                        Tambah DUDI
                    </a>
                </div>
            </div>
        @endforelse

        @if($dudis->hasPages())
            <div class="mt-4">
                {{ $dudis->withQueryString()->links() }}
            </div>
        @endif
    </div>

@endsection
