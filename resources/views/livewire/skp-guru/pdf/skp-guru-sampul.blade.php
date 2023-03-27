<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">

    @vite(['resources/css/app.css'])

    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
        }

        * {
            font-family: "Bookman Old Style", Georgia, serif !important;
        }

        thead {
            display: table-row-group
        }

        .table-leading {
            border-bottom: 0px none !important;
        }

        .table-following {
            border-top: none !important;
            border-bottom: none !important;
        }

        .table-ending {
            border-top: none !important;
        }

        .table-border table,
        .table-border th,
        .table-border td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
        }

        body,
        table {
            font-size: 12px;
            margin: 0px;
        }

        .wrapping-div {
            display: block;
        }

        @media print {

            html,
            body {
                margin: 0;
                width: 100%;
                height: 100%;
            }

            tr {
                page-break-inside: avoid !important;
                -webkit-column-break-inside: avoid;
                break-inside: avoid;
                -webkit-region-break-inside: avoid;
            }
        }

        .wrapping-div tbody,
        .wrapping-div tr,
        .wrapping-div td,
        .wrapping-div th {
                page-break-inside: avoid !important;
                -webkit-column-break-inside: avoid;
                break-inside: avoid;
                -webkit-region-break-inside: avoid;
        }

        table {
            width: 100%;
        }
    </style>

</head>

<body class="tw-py-16 tw-px-20">
    <div class="tw-h-full tw-w-full  tw-border-8 tw-border-separate tw-border-double tw-border-black">
        <div class="tw-mx-auto tw-block  tw-w-1/4 tw-mt-20">
            <img src="{{ asset('images/pancasila.svg') }}" class="tw-mx-auto tw-scale-90">
        </div>
        <div class="tw-text-center tw-font-bold tw-text-xl tw-mt-28">
            PENILAIAN PRESTASI KERJA
            <br>
            PEGAWAI NEGERI SIPIL
        </div>
        <div class="tw-text-center tw-font-bold  tw-text-xl  tw-mt-28">
            Jangka Waktu Penilaian
        </div>
        <div class="tw-text-center tw-font-bold tw-w-full tw-bg-yellow-200 tw-text-2xl">
            {{ format_periode($skpGuru->skp->periode_awal, $skpGuru->skp->periode_akhir)  }}
        </div>
        <table class="tw-w-10/12 tw-mx-auto tw-text-xl  tw-mt-28" cellspacing="0" cellpadding="0">
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Nama Pegawai</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    : <span class="tw-font-bold tw-uppercase">{{ $skpGuru->user->nama }}</span>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>NIP</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="tw-font-bold tw-uppercase">{{ $skpGuru->user->nip }}</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Pangkat Gol.Ruang</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->user->getPangkatName() }}</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Jabatan/Pekerjaan</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->user->pangkat->jabatan.'/'.$skpGuru->user->pekerjaan}}</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Unit Kerja</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="tw-font-bold">SMA NEGERI 2 SIDRAP</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Target AK PKG Pembl.</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->target_pkg }}%</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Capaian AK PKG Pembl.</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->capaian_pkg }}%</span></p>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td class="tw-w-1/2">
                    <p>Jumlah Jam Pelajaran</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->capaian_jam_pelajaran == 24? '24-40' : $skpGuru->capaian_jam_pelajaran }}</span></p>
                </td>
            </tr>
            <tr>
                <td class="tw-w-1/2">
                    <p>Capaian AK PKG T.Tbhn.</p>
                </td>
                <td class="tw-w-1/2 tw-whitespace-nowrap">
                    <p>: <span class="">{{ $skpGuru->capaian_pkg_tambahan?? '-' }}%</span></p>
                </td>
            </tr>
        </table>
        
        <div class="tw-text-center tw-font-bold  tw-text-xl tw-mt-52">
            DINAS PENDIDIKAN DAN KEBUDAYAAN KAB. SIDRAP
            <br>
            SMA NEGERI 2 SIDRAP
            <br>
            TAHUN {{ \Carbon\Carbon::parse($skpGuru->skp->periode_akhir)->year }}
        </div>
    </div>
</body>

</html>
