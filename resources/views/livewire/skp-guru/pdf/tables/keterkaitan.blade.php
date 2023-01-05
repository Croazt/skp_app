<tbody style="width: 100%;">
    <tr  style="width: 100%;">
        <td style="width: 2%;" rowspan="3"
            class="tw-align-top num-row-{{ $rencanaKinerja->detailKinerja->kinerja->kategori }}">
            {{ $i }}
        </td>
        <td style="width: 32%;" rowspan="3" class="tw-align-top">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 32%;" rowspan="3" class="tw-align-top">
            {{ $data['butir_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 24%;" rowspan="3" class="tw-align-top">
            {{ $data['output_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 10%;" rowspan="3" class="tw-align-middle tw-text-center">
            {{ $data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
