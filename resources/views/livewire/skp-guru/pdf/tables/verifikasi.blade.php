<tbody style="width: 100%;">
    <tr  style="width: 100%;">
        <td style="width: 2%;" rowspan="3"
            class="tw-align-top num-row-{{ $rencanaKinerja->detailKinerja->kinerja->kategori }}">
            {{ $i }}
        </td>
        <td style="width: 26%;" rowspan="3" class="tw-align-top">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 26%;" rowspan="3" class="tw-align-top">
            {{ $data['butir_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 26%;" rowspan="3" class="tw-align-top">
            {{ $data['output_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 6%;" rowspan="3" class="tw-align-middle tw-text-center">
            {{ $data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 14%;" class="text-center tw-align-middle" >
            @if ($data['terkait'][$rencanaKinerja->id] === null)
                <p class="tw-leading-5">
                    Kinerja belum diverifikasi
                </p>
            @elseif ($data['terkait'][$rencanaKinerja->id])
                <p class="tw-leading-5 tw-whitespace-nowrap">
                    Terkait / <del>Tidak Terkait</del> 
                </p>
                <p class="tw-leading-5">
                    (Coret Salah Satu)
                </p>
            @else
                <p class="tw-leading-5 tw-whitespace-nowrap">
                    <del>Terkait</del> / Tidak Terkait
                </p>
                <p class="tw-leading-5">
                    (Coret Salah Satu)
                </p>
            @endif
        </td>
    </tr>
</tbody>
