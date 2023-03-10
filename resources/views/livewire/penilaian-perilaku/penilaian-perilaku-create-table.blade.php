<div class="tw-bg-white tw-overflow-hidden sm:tw-rounded-lg">
    <div class="card-body tw-p-5">
        <div class="tw-self-center tw-px-5 tw-py-1 tw-text-center tw-rounded-t-md  tw-bg-slate-600 tw-text-white">
            Definisi
        </div>
        <div class="tw-p-5 tw-mb-5 tw-rounded-b-md tw-bg-slate-400 tw-text-white">
            {{ $data[$item->nama]['definisi'] }}
        </div>
        <div class="tw-px-5">
            <form class="form" wire:submit.prevent='save'>
                @foreach ($data[$item->nama]['situasiKerja'] as $situasi)
                    <div class="mb-3 tw-w-full">
                        <div class="tw-flex tw-w-full tw-justify-between">
                            <x-jet-label for="nama" value="{{ $situasi['situasi'] }}" />
                            <div>Level :
                                {{ $data[$item->nama]['indikatorKerja'][ $data[$item->nama]['indikator_penilaian_perilaku'][$situasi['id']]]['level'] ?? '' }}
                            </div>
                        </div>
                        <select
                            class="tw-text-sm tw-w-full tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                            wire:model="data.{{ $item->nama }}.indikator_penilaian_perilaku.{{ $situasi['id'] }}">
                            <option value=""></option>
                            @foreach ($data[$item->nama]['indikatorKerja'] as $indikator)
                                <option value="{{ $indikator['id']  }}">{{ $indikator['indikator'] }}</option>

                            @endforeach
                        </select>
                        @error("data.indikator_penilaian_perilaku.".$situasi['id'])
                            <div class="invalid-feedback  d-block" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </form>
            @php
                $total = 0;
                foreach ($data[$item->nama]['indikator_penilaian_perilaku'] as $key => $indikator) {
                    $total += $data[$item->nama]['indikatorKerja'][$indikator]['level'] ?? 0;
                }
                $average = $total / count($data[$item->nama]['indikator_penilaian_perilaku']);
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
