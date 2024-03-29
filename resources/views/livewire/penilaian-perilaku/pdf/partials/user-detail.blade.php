<div style="width: 100%;  padding-right: 1px;">
    <div style="width: 100%" class="tw-flex tw-justify-between">
        <div class=" tw-font-bold">
            <p>SMA NEGERI 1 SIDRAP</p>
        </div>
        <div class="">
            <div class="tw-ml-auto tw-mr-0">
                <p class="tw-font-bold">
                    Periode Penilaian:
                </p>
                <p>
                    {{ $skp->periode_awal . ' s.d. ' . $skp->periode_akhir }}
                </p>

            </div>
        </div>
    </div>
    <table class="table-border" style="width: 100%">
        <thead>
            <tr>
                <th style="width: 50%;" colspan="2" class="tw-text-center">
                    PEGAWAI YANG DINILAI
                </th>
                <th style="width: 50%;" colspan="2" class="tw-text-center">
                    PEJABAT PENILAI KINERJA
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 15%;">
                    NAMA
                </td>
                <td style="width:35%;">
                    {{ $penilaianPerilakuGuru->user->nama }}
                </td>
                <td style="width: 15%;">
                    NAMA
                </td>
                <td style="width: 35%;">
                    {{ $penilaianPerilakuGuru->konfirmasiOleh->nama }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    NIP
                </td>
                <td style="width:35%;">
                    {{ $penilaianPerilakuGuru->user->nip }}
                </td>
                <td style="width: 15%;">
                    NIP
                </td>
                <td style="width: 35%;">
                    {{ $penilaianPerilakuGuru->konfirmasiOleh->nip }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    PANGKAT
                </td>
                <td style="width:35%;">
                    {{ $penilaianPerilakuGuru->user->getPangkatJabatanName() }}
                </td>
                <td style="width: 15%;">
                    PANGKAT
                </td>
                <td style="width: 35%;">
                    {{ $penilaianPerilakuGuru->konfirmasiOleh->getPangkatJabatanName() }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    PEKERJAAN
                </td>
                <td style="width:35%;">
                    {{ $penilaianPerilakuGuru->user->pekerjaan }}
                </td>
                <td style="width: 15%;">
                    PEKERJAAN
                </td>
                <td style="width: 35%;">
                    {{ $penilaianPerilakuGuru->konfirmasiOleh->pekerjaan }}
                </td>
            </tr>
            <tr>
                <td style="width: 15%;">
                    UNIT KERJA
                </td>
                <td style="width:35%;">
                    {{ $penilaianPerilakuGuru->user->unit_kerja }}
                </td>
                <td style="width: 15%;">
                    UNIT KERJA
                </td>
                <td style="width: 35%;">
                    {{ $penilaianPerilakuGuru->konfirmasiOleh->unit_kerja }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
