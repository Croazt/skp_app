<tbody>
    <tr>
        <td rowspan="3" class="deskripsi tw-w-2/12" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $this->data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="tw-w-3/12" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="text-center tw-w-2/12">
            @if ($this->data['cascading'][$rencanaKinerja->id] === null && $this->data['kategori'][$rencanaKinerja->id] === 'utama')
                <p class="tw-leading-5">
                    Kinerja belum direviu
                </p>
            @else
                @if ($this->data['kategori'][$rencanaKinerja->id] == 'utama')

                    @if ($this->data['cascading'][$rencanaKinerja->id])
                        <p class="tw-leading-5">
                            <del>Direct Cascading</del>/
                        </p>
                        <p class="tw-leading-5 tw-whitespace-nowrap">
                            Non Direct Cascading
                        </p>
                    @else
                        <p class="tw-leading-5">
                            Direct Cascading/
                        </p>
                        <p class="tw-leading-5 tw-whitespace-nowrap">
                            <del>Non Direct Cascading</del>
                        </p>
                    @endif
                    <p class="tw-leading-5  tw-whitespace-nowrap">
                        (Coret salah satu)
                    </p>
                @endif
                <p class="tw-leading-5">
                    Catatan Perbaikan
                </p>
                <p class="tw-leading-5">
                    {{ $this->data['catatan'][$rencanaKinerja->id] }}
                </p>
            @endif
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}%</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}%</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}%</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}%</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
