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
    <form method="POST" action="{{ route('surat.penjajakan.preview') }}" class="space-y-6" id="suratForm">
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
                            value="{{ old('tanggal_surat') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal (Format: DD-MM-YYYY)">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Alamat DUDI (Jalan)
                        <span class="text-xs text-gray-500 font-normal">(tanpa kecamatan)</span>
                    </label>
                    <textarea id="alamat_jalan"
                                name="alamat_jalan"
                                rows="2"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                                readonly
                                placeholder="Alamat jalan akan terisi otomatis setelah memilih DUDI">{{ old('alamat_jalan') }}</textarea>
                    @error('alamat_jalan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
            </div>
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
                        <option value="XI">XI</option>
                        <option value="X">X</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-plus text-blue-500 mr-2"></i>
                        Tanggal Mulai PKL
                    </label>
                    <input type="text"
                            id="tanggal_mulai"
                            name="tanggal_mulai"
                            value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal mulai (Format: DD-MM-YYYY)">
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-check text-blue-500 mr-2"></i>
                        Tanggal Selesai PKL
                    </label>
                    <input type="text"
                            id="tanggal_selesai"
                            name="tanggal_selesai"
                            value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal selesai (Format: DD-MM-YYYY)">
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i>
                    Konsentrasi Keahlian (Jurusan)
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

        <div class="space-y-4 pt-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-dark">
                    <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                    Jadwal Pembekalan
                </h2>
                <button type="button" id="btnSyncPembekalan" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    <i class="fas fa-sync-alt"></i>
                    Sinkron dengan PKL
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-plus text-blue-500 mr-2"></i>
                        Tanggal Mulai Pembekalan
                    </label>
                    <input type="text"
                            id="m_pembekalan"
                            name="m_pembekalan"
                            value="{{ old('m_pembekalan') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal mulai (Format: DD-MM-YYYY)">
                    @error('m_pembekalan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-check text-blue-500 mr-2"></i>
                        Tanggal Selesai Pembekalan
                    </label>
                    <input type="text"
                            id="s_pembekalan"
                            name="s_pembekalan"
                            value="{{ old('s_pembekalan') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal selesai (Format: DD-MM-YYYY)">
                    @error('s_pembekalan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-dark">
                    <i class="fas fa-clipboard-check text-blue-500 mr-2"></i>
                    Jadwal Pengujian
                </h2>
                <button type="button" id="btnSyncPengujian" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    <i class="fas fa-sync-alt"></i>
                    Sinkron dengan Pembekalan
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-plus text-blue-500 mr-2"></i>
                        Tanggal Mulai Pengujian
                    </label>
                    <input type="text"
                            id="m_pengujian"
                            name="m_pengujian"
                            value="{{ old('m_pengujian') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal mulai (Format: DD-MM-YYYY)">
                    @error('m_pengujian')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        <i class="far fa-calendar-check text-blue-500 mr-2"></i>
                        Tanggal Selesai Pengujian
                    </label>
                    <input type="text"
                            id="s_pengujian"
                            name="s_pengujian"
                            value="{{ old('s_pengujian') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition flatpickr-input"
                            required
                            placeholder="Pilih tanggal selesai (Format: DD-MM-YYYY)">
                    @error('s_pengujian')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                <button type="button" id="btnResetForm"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-redo"></i>
                    Reset Form
                </button>

                <button type="submit" id="submitBtn"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition">
                    <i class="fas fa-eye"></i>
                    Lanjut ke Preview
                </button>
            </div>
        </div>
    </form>
</div>

<div id="loadingNotification" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

        <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6 md:p-8 animate-fade-in">
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="w-16 h-16 relative">
                    <div class="absolute inset-0 rounded-full border-4 border-blue-200"></div>
                    <div class="absolute inset-0 rounded-full border-4 border-blue-500 border-t-transparent animate-spin"></div>
                    <i class="fas fa-file-contract text-blue-500 text-2xl absolute inset-0 flex items-center justify-center"></i>
                </div>

                <div class="text-center space-y-2">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-cog animate-spin mr-2"></i>
                        Memproses Surat
                    </h3>
                    <p class="text-gray-600">
                        Sedang menyiapkan preview surat penjajakan...
                    </p>
                    <p class="text-sm text-gray-500 mt-4">
                        Harap tunggu sebentar
                    </p>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                    <div class="bg-blue-500 h-2.5 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>
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
    .flatpickr-calendar {
        font-family: 'Inter', sans-serif !important;
    }

    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
$(document).ready(function () {
    // Initialize Select2
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

    const dateConfig = {
        locale: "id",
        dateFormat: "d-m-Y",
        disableMobile: true,
        theme: "material_blue"
    };

    flatpickr("#tanggal_surat", {
        ...dateConfig,
        defaultDate: "today"
    });

    flatpickr("#tanggal_mulai", {
        ...dateConfig,
        minDate: "today"
    });

    flatpickr("#tanggal_selesai", {
        ...dateConfig,
        minDate: "today"
    });

    flatpickr("#m_pembekalan", {
        ...dateConfig,
        minDate: "today"
    });

    flatpickr("#s_pembekalan", {
        ...dateConfig,
        minDate: "today"
    });

    flatpickr("#m_pengujian", {
        ...dateConfig,
        minDate: "today"
    });

    flatpickr("#s_pengujian", {
        ...dateConfig,
        minDate: "today"
    });

    $('#dudi_select').on('change', function () {
        const selected = $(this).find(':selected');
        const alamat = selected.data('alamat') || '';
        const kecamatan = selected.data('kecamatan') || '';

        $('#alamat_jalan').val(alamat);
        $('#kecamatan_dudi').val(kecamatan);
    });

    $('#btnSyncPembekalan').on('click', function() {
        const mulaiPKL = $('#tanggal_mulai').val();
        const selesaiPKL = $('#tanggal_selesai').val();

        if (mulaiPKL && selesaiPKL) {
            $('#m_pembekalan').val(mulaiPKL);
            $('#s_pembekalan').val(selesaiPKL);

            showToast('Jadwal pembekalan disinkronkan dengan jadwal PKL', 'success');
        } else {
            showToast('Isi tanggal mulai dan selesai PKL terlebih dahulu', 'error');
        }
    });

    $('#btnSyncPengujian').on('click', function() {
        const mulaiPembekalan = $('#m_pembekalan').val();
        const selesaiPembekalan = $('#s_pembekalan').val();

        if (mulaiPembekalan && selesaiPembekalan) {
            $('#m_pengujian').val(mulaiPembekalan);
            $('#s_pengujian').val(selesaiPembekalan);

            showToast('Jadwal pengujian disinkronkan dengan jadwal pembekalan', 'success');
        } else {
            showToast('Isi tanggal mulai dan selesai pembekalan terlebih dahulu', 'error');
        }
    });

    $('#btnResetForm').on('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset semua data formulir?')) {
            document.getElementById('suratForm').reset();

            $('#dudi_select').val('').trigger('change');
            $('#jurusan_select').val('').trigger('change');

            $('#alamat_jalan').val('');
            $('#kecamatan_dudi').val('');

            $('.flatpickr-input').each(function() {
                if (this._flatpickr) {
                    this._flatpickr.clear();
                }
            });

            showToast('Formulir berhasil direset', 'success');
        }
    });

    $('#suratForm').on('submit', function(e) {
        let isValid = true;
        let errorMessage = '';

        const mPembekalan = $('#m_pembekalan').val();
        const sPembekalan = $('#s_pembekalan').val();

        if (mPembekalan && sPembekalan) {
            const mulaiPembekalan = parseDate(mPembekalan);
            const selesaiPembekalan = parseDate(sPembekalan);

            if (selesaiPembekalan < mulaiPembekalan) {
                isValid = false;
                errorMessage = 'Tanggal selesai pembekalan tidak boleh sebelum tanggal mulai';
                $('#s_pembekalan').focus();
            }
        }

        const mPengujian = $('#m_pengujian').val();
        const sPengujian = $('#s_pengujian').val();

        if (mPengujian && sPengujian) {
            const mulaiPengujian = parseDate(mPengujian);
            const selesaiPengujian = parseDate(sPengujian);

            if (selesaiPengujian < mulaiPengujian) {
                isValid = false;
                errorMessage = 'Tanggal selesai pengujian tidak boleh sebelum tanggal mulai';
                $('#s_pengujian').focus();
            }
        }

        const mulaiPKL = $('#tanggal_mulai').val();
        const selesaiPKL = $('#tanggal_selesai').val();

        if (mulaiPKL && selesaiPKL) {
            const tanggalMulai = parseDate(mulaiPKL);
            const tanggalSelesai = parseDate(selesaiPKL);

            if (tanggalSelesai < tanggalMulai) {
                isValid = false;
                errorMessage = 'Tanggal selesai PKL tidak boleh sebelum tanggal mulai';
                $('#tanggal_selesai').focus();
            }
        }

        if (!isValid) {
            e.preventDefault();
            showToast(errorMessage, 'error');
            return false;
        }

        e.preventDefault();

        $('#loadingNotification').removeClass('hidden');

        $('#submitBtn').prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');

        setTimeout(() => {
            $(this).off('submit').submit();
        }, 500);

        return false;
    });

    function parseDate(dateStr) {
        const parts = dateStr.split('-');
        if (parts.length === 3) {
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }
        return new Date();
    }

    @if(old('id_dudi'))
        $('#dudi_select').val('{{ old('id_dudi') }}').trigger('change');
        const selectedOption = $('#dudi_select').find('option:selected');
        $('#alamat_jalan').val(selectedOption.data('alamat') || '{{ old('alamat_jalan') }}');
    @endif

    @if(old('id_jurusan'))
        $('#jurusan_select').val('{{ old('id_jurusan') }}').trigger('change');
    @endif
});

function showToast(message, type = 'info') {
    $('.custom-toast').remove();

    const bgColor = type === 'success' ? 'bg-green-500' :
                    type === 'error' ? 'bg-red-500' :
                    'bg-blue-500';

    const icon = type === 'success' ? 'fa-check-circle' :
                type === 'error' ? 'fa-exclamation-circle' :
                'fa-info-circle';

    const toast = $(`
        <div class="custom-toast fixed top-4 right-4 z-50 max-w-sm animate-slide-in">
            <div class="${bgColor} text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
                <i class="fas ${icon} text-xl"></i>
                <div>
                    <p class="font-medium">${message}</p>
                </div>
            </div>
        </div>
    `);

    $('body').append(toast);

    setTimeout(() => {
        toast.animate({ opacity: 0, right: '-100%' }, 300, function() {
            $(this).remove();
        });
    }, 5000);
}

function hideLoading() {
    $('#loadingNotification').addClass('hidden');
    $('#submitBtn').prop('disabled', false)
        .html('<i class="fas fa-eye mr-2"></i>Lanjut ke Preview');
}
</script>

@endsection
