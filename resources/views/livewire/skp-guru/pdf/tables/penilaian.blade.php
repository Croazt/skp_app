<tbody style="width: 100%;">
    <tr>
        <td style="width: 2%;" rowspan="3"
            class="tw-align-top num-row-{{ $rencanaKinerja->detailKinerja->kinerja->kategori }}">
            {{ $i }}
        </td>
        <td style="width: 15.5%;" rowspan="3" class="deskripsi tw-align-top">
            {{ $data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 15.5%;" rowspan="3" class="tw-align-top">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%;" class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td style="width: 12.5%;" class="tw-align-middle">
            {{ $data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            {{ $data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}&nbsp;-&nbsp;{{ $data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            {{ $data['realisasi_kuantitas'][$rencanaKinerja->id] ?? 0 }}
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ $data['capaian_iki_kuantitas'][$rencanaKinerja->id] }}%
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_kuantitas'][$rencanaKinerja->id]) }}
        </td>
        <td style="width:6%;" class="tw-align-middle tw-text-center" rowspan="3">
            {{ str_replace('_', ' ', $data['kategori_crk'][$rencanaKinerja->id]) }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center" rowspan="3">
            {{ $data['nilai_crk'][$rencanaKinerja->id] }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center" rowspan="3">
            {{ $data['cascading'][$rencanaKinerja->id] === 0 ? 'NON DIRECT' : 'DIRECT' }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center" rowspan="3">
            {{ $data['nilai_tertimbang'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td style="width: 3%;" class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td style="width: 12.5%;" class="tw-align-middle">
            {{ $data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            {{ $data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}%&nbsp;-&nbsp;{{ $data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}%
        </td>
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['realisasi_kualitas'][$rencanaKinerja->id] ?? 0 }}%
                </div>
            </div>
        </td>
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ $data['capaian_iki_kualitas'][$rencanaKinerja->id] }}%
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_kualitas'][$rencanaKinerja->id]) }}
        </td>
    </tr>
    <tr>
        <td style="width: 3%;" class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td style="width: 12.5%;" class="tw-align-middle">
            {{ $data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            {{ $data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}&nbsp;-&nbsp;{{ $data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}
        </td>
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
        <td style="width: 3%" class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['realisasi_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td style="width:10%;" class="tw-align-middle">
            {{ $data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ $data['capaian_iki_waktu'][$rencanaKinerja->id] }}%
        </td>
        <td style="width:4%;" class="tw-align-middle tw-text-center">
            {{ str_replace('_', ' ', $data['kategori_capaian_iki_waktu'][$rencanaKinerja->id]) }}
        </td>
    </tr>
</tbody>
