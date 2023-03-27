<tbody>
    <tr>
        <td rowspan="3" class="deskripsi" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $this->data['kinerja_desc'][$rencanaKinerja->id] }}
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
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['realisasi_kuantitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ $this->data['capaian_iki_kuantitas'][$rencanaKinerja->id] }}%
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_kuantitas'][$rencanaKinerja->id]) }}
        </td>
        <td class="tw-align-middle tw-text-center" rowspan="3">
            {{ str_replace('_', ' ', $this->data['kategori_crk'][$rencanaKinerja->id]) }}
        </td>
        <td class="tw-align-middle tw-text-center" rowspan="3">
            {{ $this->data['nilai_crk'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center" rowspan="3">
            {{ $this->data['cascading'][$rencanaKinerja->id] === 0 ? 'NON DIRECT' : 'DIRECT' }}
        </td>
        <td class="tw-align-middle tw-text-center" rowspan="3">
            {{ $this->data['nilai_tertimbang'][$rencanaKinerja->id] }}
        </td>
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
                <div class="tw-mx-2"> {{ $this->data['realisasi_kualitas'][$rencanaKinerja->id] ?? 0 }}%
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ $this->data['capaian_iki_kualitas'][$rencanaKinerja->id] }}%
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_kualitas'][$rencanaKinerja->id]) }}
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
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['realisasi_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ $this->data['capaian_iki_waktu'][$rencanaKinerja->id] }}%
        </td>
        <td class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_waktu'][$rencanaKinerja->id]) }}
        </td>
    </tr>
</tbody>
