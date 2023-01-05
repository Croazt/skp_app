<tbody style="width: 100%;">
    <tr  style="width: 100%;">
        <td style="width: 2%;" rowspan="3"
            class="tw-align-top num-row-{{ $rencanaKinerja->detailKinerja->kinerja->kategori }}">
            {{ $i }}
        </td>
        <td style="width: 20%;" rowspan="3" class="deskripsi tw-align-top">
            {{ $data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 22%;" rowspan="3" class="tw-align-top">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 6%;" class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td style="width: 20%;" class="tw-align-middle">
            {{ $data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center" style="width: 6%">
            {{ $data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}&nbsp;-&nbsp;{{ $data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}
        <td style="width:24%;" class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr  style="width: 100%;">
        <td style="width: 6%;" class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td style="width: 20%;" class="tw-align-middle">
            {{ $data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center" style="width: 6%">
            {{ $data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}%&nbsp;-&nbsp;{{ $data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}%
        </td>
        <td style="width:24%;" class="tw-align-middle">
            {{ $data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr  style="width: 100%;">
        <td style="width: 6%;" class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td style="width: 20%;" class="tw-align-middle">
            {{ $data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center" style="width: 6%">
            {{ $data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}&nbsp;-&nbsp;{{ $data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}
        </td>
        <td style="width:24%;" class="tw-align-middle">
            {{ $data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
