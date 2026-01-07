@extends('layouts.app')

@section('title', 'Buat Surat Penjajakan')

@section('content')

<div class="mb-6">
    <div class="greeting-card rounded-2xl shadow-lg p-6 md:p-8 bg-linear-to-r from-blue-500 to-blue-600 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    <i class="fas fa-file-contract mr-3"></i>
                    Buat Surat Penjajakan
                </h1>
                <p class="text-blue-100 text-lg leading-relaxed">
                    Isi formulir untuk membuat surat penjajakan PKL
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
                    Form Surat Penjajakan
                </p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-md p-6 md:p-8 animate-fade-in">
    <form method="POST" action="{{ route('surat.penjajakan.preview') }}" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <h2 class="text-xl font-bold text-dark">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Informasi Surat
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                        Tanggal Surat
                    </label>
                    <input type="text"
                            id="tanggal_surat"
                            name="tanggal_surat"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal">
                    @error('tanggal_surat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-hashtag text-blue-500 mr-2"></i>
                        Nomor Surat
                    </label>
                    <input type="text"
                            name="nomor_surat"
                            value="{{ old('nomor_surat') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Contoh: 123/PKL/2025"
                            required>
                    @error('nomor_surat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-gray-200">
            <h2 class="text-xl font-bold text-dark">
                <i class="fas fa-building text-blue-500 mr-2"></i>
                Informasi DUDI
            </h2>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-industry text-blue-500 mr-2"></i>
                    Nama DUDI
                </label>
                <select id="dudi_select"
                        name="id_dudi"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition select2"
                        required>
                    <option value="">Pilih DUDI</option>
                    @foreach ($dudis as $dudi)
                        <option value="{{ $dudi->id_dudi }}"
                                data-alamat="{{ $dudi->alamat }}"
                                data-kecamatan="{{ $dudi->kecamatan }}"
                                @selected(old('id_dudi') == $dudi->id_dudi)>
                            {{ $dudi->nama }}
                        </option>

                    @endforeach
                </select>
                @error('id_dudi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                    Alamat DUDI
                </label>
                <textarea id="alamat_dudi"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                            readonly
                            placeholder="Alamat akan terisi otomatis setelah memilih DUDI"></textarea>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                <i class="fas fa-map text-blue-500 mr-2"></i>
                Kecamatan
            </label>
            <input type="text"
                id="kecamatan_dudi"
                name="alamat_kecamatan"
                value="{{ old('alamat_kecamatan') }}"
                readonly
                class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Kecamatan akan terisi otomatis">
            @error('alamat_kecamatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-4 pt-4 border-t border-gray-200">
            <h2 class="text-xl font-bold text-dark">
                <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                Informasi PKL
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-clock text-blue-500 mr-2"></i>
                        Lama PKL
                    </label>
                    <input type="text"
                            name="lama_pkl"
                            value="{{ old('lama_pkl') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Contoh: 6 Bulan"
                            required>
                    @error('lama_pkl')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-layer-group text-blue-500 mr-2"></i>
                        Tingkat
                    </label>
                    <select name="tingkat"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="XII" selected>XII</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-plus text-blue-500 mr-2"></i>
                        Tanggal Mulai
                    </label>
                    <input type="text"
                            id="tanggal_mulai"
                            name="tanggal_mulai"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal mulai">
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-check text-blue-500 mr-2"></i>
                        Tanggal Selesai
                    </label>
                    <input type="text"
                            id="tanggal_selesai"
                            name="tanggal_selesai"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal selesai">
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                    Jurusan
                </label>
                <select id="jurusan_select"
                        name="id_jurusan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition select2"
                        required>
                    <option value="">Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id_jurusan }}"
                                @selected(old('id_jurusan') == $jurusan->id_jurusan)>
                            {{ $jurusan->jurusan }}
                        </option>
                    @endforeach
                </select>
                @error('id_jurusan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- ================= PEMBEKALAN ================= --}}
        <div class="space-y-4 pt-4 border-t border-gray-200">
            <h2 class="text-xl font-bold text-dark">
                <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                Jadwal Pembekalan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Mulai Pembekalan
                    </label>
                    <input type="text"
                        id="m_pembekalan"
                        name="m_pembekalan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                        placeholder="Pilih tanggal">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Selesai Pembekalan
                    </label>
                    <input type="text"
                        id="s_pembekalan"
                        name="s_pembekalan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                        placeholder="Pilih tanggal">
                </div>
            </div>
        </div>

        {{-- ================= PENGUJIAN ================= --}}
        <div class="space-y-4 pt-4 border-t border-gray-200">
            <h2 class="text-xl font-bold text-dark">
                <i class="fas fa-clipboard-check text-blue-500 mr-2"></i>
                Jadwal Pengujian
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Mulai Pengujian
                    </label>
                    <input type="text"
                        id="m_pengujian"
                        name="m_pengujian"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                        placeholder="Pilih tanggal">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Selesai Pengujian
                    </label>
                    <input type="text"
                        id="s_pengujian"
                        name="s_pengujian"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                        placeholder="Pilih tanggal">
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('surat.index') }}"
                class="w-full md:w-auto flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Data Surat
            </a>

            <div class="flex gap-3 w-full md:w-auto">
                <button type="reset"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-redo"></i>
                    Reset Form
                </button>

                <button type="submit"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-eye"></i>
                    Lanjut ke Preview
                </button>
            </div>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single {
        height: 48px !important;
        border: 2px solid #e5e7eb !important;
        border-radius: 0.75rem !important;
        padding: 0.5rem !important;
    }
    .select2-selection__rendered {
        line-height: 34px !important;
        padding-left: 0 !important;
    }
    .select2-selection__arrow {
        height: 46px !important;
    }
    .flatpickr-input {
        background-color: white;
        cursor: pointer;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
$(document).ready(function () {
    $('#dudi_select').select2({
        width: '100%',
        placeholder: "Pilih DUDI",
        allowClear: true
    });

    $('#jurusan_select').select2({
        width: '100%',
        placeholder: "Pilih Jurusan",
        allowClear: true
    });

    flatpickr("#tanggal_surat", {
        locale: "id",
        dateFormat: "Y-m-d",
        defaultDate: "today"
    });

    flatpickr("#tanggal_mulai", {
        locale: "id",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    flatpickr("#tanggal_selesai", {
        locale: "id",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    $('#dudi_select').on('change', function () {
        const selected = $(this).find(':selected');

        const alamat = selected.data('alamat') || '';
        const kecamatan = selected.data('kecamatan') || '';

        $('#alamat_dudi').val(alamat);
        $('#kecamatan_dudi').val(kecamatan);
    });

    @if(old('id_dudi'))
        $('#dudi_select').val('{{ old('id_dudi') }}').trigger('change');
        const selectedOption = $('#dudi_select').find('option:selected');
        $('#alamat_dudi').val(selectedOption.data('alamat') || '');
    @endif

    @if(old('id_jurusan'))
        $('#jurusan_select').val('{{ old('id_jurusan') }}').trigger('change');
    @endif
});
</script>
@endsection
