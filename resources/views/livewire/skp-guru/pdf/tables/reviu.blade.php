<tbody style="width: 100%;">
    <tr style="width: 100%;">
        <td style="width: 2%;" rowspan="3"
            class="tw-align-top num-row-{{ $rencanaKinerja->detailKinerja->kinerja->kategori }}">
            {{ $i }}
        </td>
        <td style="width: 18%;" rowspan="3" class="deskripsi tw-align-top">
            {{ $data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 19%;" rowspan="3" class="tw-align-top">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 6%;" class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td style="width: 17%;" class="tw-align-middle">
            {{ $data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center" style="width: 6%">
            {{ $data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}&nbsp;-&nbsp;{{ $data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}
        <td style="width:22%;" class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width:16%;" rowspan="3" class="tw-align-top tw-text-center">
            <div class="tw-w-full">
                @if ($data['cascading'][$rencanaKinerja->id] === null)
                    <p class="tw-leading-5">
                        Kinerja belum direviu
                    </p>
                @else
                    @if ($rencanaKinerja->detailKinerja->kinerja->kategori == 'utama')

                        @if ($data['cascading'][$rencanaKinerja->id])
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
                        {{ $data['catatan'][$rencanaKinerja->id] }}
                    </p>
                @endif
            </div>
        </td>
    </tr>
    <tr style="width: 100%;">
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
    <tr style="width: 100%;">
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
