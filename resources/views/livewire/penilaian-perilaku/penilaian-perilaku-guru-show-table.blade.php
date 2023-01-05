<x-slot name="header_content">
    <h1>{{ __('Buat Penilaian') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('skp.index') }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('skp.create') }}">Tambah</a></div>
    </div>
</x-slot>

<div class="tw-bg-white tw-overflow-hidden sm:tw-rounded-lg">
    <style>
        select[disabled] {
            color: black !important;
        }
    </style>
    <div class="card-body tw-p-5">
        <div class="tw-self-center tw-px-5 tw-py-1 tw-text-center tw-rounded-t-md  tw-bg-slate-600 tw-text-white">
            Definisi
        </div>
        <div class="tw-p-5 tw-mb-5 tw-rounded-b-md tw-bg-slate-400 tw-text-white">
            Sikap dan perilaku kerja pegawai dalam memberikan pelayanan terbaik kepada yang dilayani antara lain
            meliputi masyarakat, atasan, rekan kerja, unit kerja terkait, dan/atau instansi lain.
        </div>
        <div class="tw-px-5">
            <form class="form" wire:submit.prevent='save'>
                @foreach ($situasiKerja as $item)
                    <div class="mb-3 tw-w-full">
                        <div class="tw-flex tw-w-full tw-justify-between">
                            <x-jet-label for="nama" value="{{ $item->situasi }}" />
                            <div>Level :
                                {{ $indikatorKerja->where('id', $data['indikator_penilaian_perilaku'][$item->id])->first()->level ?? '' }}
                            </div>
                        </div>
                        <select disabled
                            class="tw-text-sm tw-w-full tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                            wire:model="data.indikator_penilaian_perilaku.{{ $item->id }}">
                            <option value=""></option>
                            @foreach ($indikatorKerja as $item)
                                <option value="{{ $item->id }}">{{ $item->indikator }}</option>
                            @endforeach
                        </select>
                        @error('data.indikator_penilaian_perilaku.{{ $item->id }}')
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </form>
            @php
                $total = 0;
                foreach ($data['indikator_penilaian_perilaku'] as $key => $item) {
                    $total += $indikatorKerja->where('id', $item)->first()?->level ?? 0;
                }
                $average = $total / count($data['indikator_penilaian_perilaku']);
            @endphp
            <div>
                TOTAL : {{ $total }}
            </div>
            <div>
                RATA-RATA (Total/Jumlah Situasi) : {{ $average }}
            </div>
            <div>
                Kesimpulan : Berdasarkan hasil pengamatan pejabat penilai Kinerja, perilaku kerja pejabat Fungsional
                aspek ORIENTASI PELAYANAN
                ({{ $average <= $level[1] ? 'dibawah standar' : ($average > $level[2] ? 'melewati standar' : 'sesuai standar') }})
                {{ $average }}
            </div>
        </div>
    </div>
</div>
