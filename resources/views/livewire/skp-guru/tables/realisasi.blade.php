<tbody>
    <tr>
        <td rowspan="3" class="deskripsi" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $this->data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="dokumen-bukti tw-text-center">
            <a href="{{ $data['dokumen_bukti'][$rencanaKinerja->id] }}" class="btn btn-info tw-mb-4"
                style="white-space: nowrap;">Unduh Dokumen</a>
            <div class="tw-mb-1 tw-pr-1 tw-mx-auto">
                @if ($skpGuru->status == 'bukti')
                    <input type="radio" wire:model="data.dokumen_diterima.{{ $rencanaKinerja->id }}"
                        wire:change="updateDokumenStatus({{ $rencanaKinerja->id }})" value="1"
                        id="dokumen_diterima" />Terima
                    <input type="radio" wire:model="data.dokumen_diterima.{{ $rencanaKinerja->id }}"
                        wire:change="updateDokumenStatus({{ $rencanaKinerja->id }})" value="0"
                        id="dokumen_diterima" />Tolak
                @else
                    @if ($rencanaKinerja->dokumen_diterima === 1)
                        Dokumen Bukti Diterima
                    @elseif ($rencanaKinerja->dokumen_diterima == null)
                        Menunggu Verifikasi Dokumen
                    @else
                        Dokumen Bukti Ditolak
                    @endif
                @endif
            </div>
            <div class="@if ($data['dokumen_diterima'][$rencanaKinerja->id] === 1 || $data['dokumen_diterima'][$rencanaKinerja->id] === null) tw-hidden @endif">
                <p class="tw-font-semibold">Catatan Penolakan:</p>
                <div class="tw-text-left tw-h-full">
                    <textarea placeholder="Masukkan alasan penolakan" wire:change="updateCatatanDokumen({{ $rencanaKinerja->id }})"
                        class="tw-h-full tw-text-sm focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        type="text" wire:model="data.catatan_dokumen.{{ $rencanaKinerja->id }}" name="catatan_dokumen"
                        id="catatan_dokumen"></textarea>
                </div>
            </div>
        </td>
        <td rowspan="3" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3">
            {!! nl2br($this->data['butir_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td rowspan="3">
            {!! nl2br($this->data['output_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.realisasi_kuantitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                    {{ !$data['dokumen_diterima'][$rencanaKinerja->id] || $skpGuru->status != 'bukti' ? 'disabled' : '' }}
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'realisasi_kuantitas')">
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        @if ($data['kategori'][$rencanaKinerja->id] != 'utama')
            <td rowspan="3" class="text-center tw-align-middle">
                <select @if (!$data['dokumen_diterima'][$rencanaKinerja->id] || $skpGuru->status != 'bukti') disabled @endif
                    wire:change="updateLingkup({{ $rencanaKinerja->id }})"wire:model="data.lingkup.{{ $rencanaKinerja->id }}"
                    data-placeholder="Pilih lingkup kinerja" name="lingkup" id="lingkup"
                    class="tw-text-sm tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm">
                    <option value="" @if ($data['lingkup'][$rencanaKinerja->id]) disabled @endif>Pilih lingkup kinerja
                    </option>
                    <option value="1">Dalam satu perangkat daerah</option>
                    <option value="2">Antar perangkat daerah dalam satu daerah</option>
                    <option value="3">Antar daerah (Daerah-Daerah/Daerah-Pusat)</option>
                </select>
            </td>
        @endif
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}%
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}%
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="input-group tw-w-max">
                    <input
                        class="form-control tw-p-1 tw-w-9 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-l-md tw-shadow-sm"
                        wire:model="data.realisasi_kualitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                        {{ !$data['dokumen_diterima'][$rencanaKinerja->id] || $skpGuru->status != 'bukti' ? 'disabled' : '' }}
                        max="99"
                        wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'realisasi_kualitas')"
                        aria-label="">
                    <div class="input-group-append tw-h-auto tw-rounded-r-md">
                        <span
                            class="input-group-text tw-p-1 tw-w-6 tw-h-8 {{ !($this->skpGuru->status == 'verifikasi') ? 'tw-bg-[#e9ecef]' : '' }}">%</span>
                    </div>
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.realisasi_waktu.{{ $rencanaKinerja->id }}" type="number" min="0"
                    {{ !$data['dokumen_diterima'][$rencanaKinerja->id] || $skpGuru->status != 'bukti' ? 'disabled' : '' }}
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'realisasi_waktu')">
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
