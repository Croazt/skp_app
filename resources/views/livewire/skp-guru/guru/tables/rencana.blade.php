<tbody>
    <tr>
        <td rowspan="3" class="deskripsi" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle">
            {{ $data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">

            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_kuantitas'][$rencanaKinerja->id] ?? 0}}</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_kuantitas'][$rencanaKinerja->id] ?? 0}}</div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        @if ($skpGuru->status == 'draft')
            <td rowspan="3" class="text-center tw-align-middle">
                <div class="tw-align-middle tw-flex tw-flex-col">
                    <button class="btn btn-xs btn-icon mb-1 btn-danger dt-delete-kinerja-guru"
                        data-key="{{ $rencanaKinerja->id }}">
                        <i class="fa fa-trash icon-nm"></i>
                    </button>
                </div>
            </td>
        @endif
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td class="tw-align-middle">
            {{ $data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_kualitas'][$rencanaKinerja->id] ?? 0}}%</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_kualitas'][$rencanaKinerja->id] ?? 0}}%</div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle">
            {{ $data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
