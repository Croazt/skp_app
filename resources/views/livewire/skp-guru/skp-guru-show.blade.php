<x-slot name="header_content">
    <h1>{{ __('Detail SKP') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('skp.show', ['skp' => $this->skp]) }}">SKP</a></div>
        <div class="breadcrumb-item"><a
                href="{{ route('skp-guru.show', ['skp' => $this->skp, 'skpGuru' => $this->skpGuru->id]) }}">SKP Guru</a>
        </div>
        <div class="breadcrumb-item"><a
                href="{{ route('guru.skp-guru.index', ['skp' => $this->skp]) }}">{{ $this->skpGuru->user_nip }}</a></div>
    </div>
</x-slot>

@push('styles')
    <style>
        .nav-item .nav-link.active {
            color: var(--primary) !important;
            font-weight: 900;
        }
    </style>
@endpush


<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg tw-pb-10">
    @include('livewire.partials.alert')
    <div class="tw-px-6 tw-pt-8 tw-pb-2 tw-text-center">
        <h1 class="h5 tw-font-black">
            SKP GURU
        </h1>
        {{-- <h1 class="h5 tw-font-bold">
            {{ $this->skp->periode_awal . ' s.d. ' . $this->skp->periode_akhir }}
        </h1> --}}
    </div>

    @if (auth()->user()->can('Pengelola Kinerja'))
        @if ($this->skpGuru->status === 'konfirmasi')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-300">Terkonfirmasi</p>
                <br>
                <br>
                <p class="bg-info tw-text-white">Menunggu anda untuk mereviu SKP!</p>
            </div>
        @else
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-500 tw-text-white">Telah Direviu</p>
                <br>
                <br>
                <p class="bg-info tw-text-white">SKP telah direviu!</p>
            </div>
        @endif
    @elseif(auth()->user()->can('Tim Angka Kredit'))
        @if ($this->skpGuru->status === 'reviu')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-500 tw-text-white">Telah Direviu</p>
                <br>
                <br>
                <p class="bg-info tw-text-white">SKP telah direviu oleh Pengelola Kinerja, menunggu anda untuk melakukan
                    verifikasi SKP!</p>
            </div>
        @elseif($this->skpGuru->status === 'verifikasi')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-600 tw-text-white">Terverifikasi</p>
                <br>
                <br>
                <p class="bg-info tw-text-white"> SKP telah diverifikasi!
                </p>
            </div>
        @else
        @endif
    @elseif(auth()->user()->canany(['Operator', 'Kepala Sekolah']))
        @if ($this->skpGuru->status === 'draft')
            <div class="tw-w-full tw-text-center">
                <p class="badge bg-secondary">Draft</p>
            </div>
        @elseif($this->skpGuru->status === 'konfirmasi')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-300">Terkonfirmasi</p>
                <br>
                <br>
                <p class="bg-info tw-text-white">Menunggu proses reviu SKP oleh Pengelola Kinerja!</p>
            </div>
        @elseif($this->skpGuru->status === 'reviu')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-500 tw-text-white">Telah Direviu</p>
                <br>
                <br>
                <p class="bg-info tw-text-white">Skp telah direviu oleh Pengelola Kinerja, menunggu proses verifikasi
                    SKP
                    oleh Tim Angka Kredit!</p>
            </div>
        @elseif($this->skpGuru->status === 'verifikasi')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-600 tw-text-white">Terverifikasi</p>
                <br>
                <br>
                <p class="bg-warning tw-text-white">
                    @if (\Carbon\Carbon::parse($this->skpGuru->skp->penilaian) >= now())
                        SKP Telah diverifikasi, menunggu realiasasi rencana oleh yang bersangkutan pada
                        {{ $this->skpGuru->skp->penilaian }}
                    @else
                        @if (auth()->user()->can('Operator'))
                            Menunggu proses unggah dokumen bukti oleh yang bersangkutan!
                        @else
                            SKP dalam proses realisasi dan penilaian rencana!
                        @endif
                    @endif
                </p>
            </div>
        @elseif($this->skpGuru->status === 'bukti')
            <div class="tw-w-full tw-text-center">
                @if (auth()->user()->can('Operator'))
                    <p class="badge tw-bg-yellow-200">Menunggu Verifikasi Bukti</p>
                    <br>
                    <br>
                    <p class="bg-warning tw-text-white">Menunggu proses verifikasi bukti dan realisasi kinerja SKP!</p>
                @else
                    <p class="badge tw-bg-green-600 tw-text-white">Terverifikasi</p>
                    <br>
                    <br>
                    <p class="bg-info tw-text-white"> SKP dalam proses realisasi dan penilaian rencana!</p>
                @endif
            </div>
        @elseif($this->skpGuru->status === 'ditolak')
            <div class="tw-w-full tw-text-center">
                @if (auth()->user()->can('Operator'))
                    <div class="tw-w-full tw-text-center">
                        <p class="badge tw-bg-red-500 tw-text-white">Bukti Ditolak</p>
                        <br>
                        <br>
                        <p class="bg-warning tw-text-white">Dokumen bukti kinerja telah ditolak, menunggu yang
                            bersangkutan
                            untuk mengunggah ulang dokumen bukti!</p>
                    @else
                        <p class="badge tw-bg-green-600 tw-text-white">Terverifikasi</p>
                        <br>
                        <br>
                        <p class="bg-info tw-text-white"> SKP dalam proses realisasi dan penilaian rencana!</p>
                @endif
            </div>
        @elseif($this->skpGuru->status === 'dinilai')
            <div class="tw-w-full tw-text-center">
                <p class="badge tw-bg-green-800 tw-text-white">Telah Dinilai</p>
            </div>
        @endif
    @endif
    @canany(['Operator', 'Kepala Sekolah'])
        <div class="tw-w-full tw-flex tw-justify-center tw-py-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if ($this->skpGuru->status == 'draft') active @endif" id="peta-rencana-tab"
                        data-toggle="tab" href="#peta-rencana" role="tab" aria-controls="peta-rencana"
                        aria-selected="true">Peta Rencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="rencana-tab" data-toggle="tab" href="#rencana" role="tab"
                        aria-controls="rencana" aria-selected="true">Rencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="keterkaitan-tab" data-toggle="tab" href="#keterkaitan" role="tab"
                        aria-controls="keterkaitan" aria-selected="false">Keterkaitan</a>
                </li>
                @if (in_array($this->skpGuru->status, ['konfirmasi', 'reviu', 'verifikasi', 'dinilai', 'bukti', 'ditolak']))
                    <li class="nav-item">
                        <a class="nav-link @if ($this->skpGuru->status == 'konfirmasi') active @endif" id="reviu-tab"
                            data-toggle="tab" href="#reviu" role="tab" aria-controls="reviu"
                            aria-selected="false">Reviu</a>
                    </li>
                @else
                    <li class="nav-item" data-toggle="tooltip" data-placement="top" data-title="SKP Belum dikonfirmasi">
                        <a class="nav-link disabled text-secondary" aria-disabled="true" id="reviu-tab" data-toggle="tab"
                            href="#reviu" role="tab" aria-controls="reviu" aria-selected="false">Reviu</a>
                    </li>
                @endif
                @if (in_array($this->skpGuru->status, ['reviu', 'verifikasi', 'dinilai', 'bukti', 'ditolak']))
                    <li class="nav-item">
                        <a class="nav-link @if ($this->skpGuru->status == 'reviu') active @endif" id="verifikasi-tab"
                            data-toggle="tab" href="#verifikasi" role="tab" aria-controls="verifikasi"
                            aria-selected="false">Verifikasi</a>
                    </li>
                @else
                    <li class="nav-item" data-toggle="tooltip" data-placement="top"
                        data-title="SKP Belum direviu oleh Pengelola Kinerja">
                        <a class="nav-link disabled text-secondary" aria-disabled="true" id="verifikasi-tab"
                            data-toggle="tab" href="#verifikasi" role="tab" aria-controls="verifikasi"
                            aria-selected="false">Verifikasi</a>
                    </li>
                @endif
                </li>
                @if (in_array($this->skpGuru->status, ['verifikasi', 'dinilai', 'bukti', 'ditolak']))
                    <li class="nav-item">
                        <a class="nav-link  @if (in_array($this->skpGuru->status, ['verifikasi']) && (auth()->user()->can('Kepala Sekolah') || $this->skpGuru->skp->penilaian > now())) active @endif" id="penetapan-tab" data-toggle="tab" href="#penetapan" role="tab"
                            aria-controls="penetapan" aria-selected="false">Penetapan</a>
                    </li>
                @else
                    <li class="nav-item" data-toggle="tooltip" data-placement="top"
                        data-title="SKP Belum diverifikasi oleh Tim Angka Kredit">
                        <a class="nav-link disabled text-secondary" aria-disabled="true" id="penetapan-tab"
                            data-toggle="tab" href="#penetapan" role="tab" aria-controls="penetapan"
                            aria-selected="false">Penetapan</a>
                    </li>
                @endif
                @can('Operator')
                    @if (in_array($this->skpGuru->status, ['bukti', 'ditolak']))
                        <li class="nav-item">
                            <a class="nav-link @if (in_array($this->skpGuru->status, ['bukti', 'ditolak'])) active @endif" id="realisasi-tab"
                                data-toggle="tab" href="#realisasi" role="tab" aria-controls="realisasi"
                                aria-selected="false">Realisasi Rencana</a>
                        </li>
                    @else
                        <li class="nav-item" data-toggle="tooltip" data-placement="top"
                            data-title="@if (in_array($this->skpGuru->status, ['dinilai'])) SKP telah dinilai @elseif($this->skpGuru->skp->penilaian > now()) Menunggu waktu penilaian @else Bukti SKP belum diunggah @endif">
                            <a class="nav-link disabled text-secondary" aria-disabled="true" id="realisasi-tab"
                                data-toggle="tab" href="#realisasi" role="tab" aria-controls="realisasi"
                                aria-selected="false">Realisasi Rencana</a>
                        </li>
                    @endif
                @endcan
                @if (in_array($this->skpGuru->status, ['dinilai']))
                    <li class="nav-item">
                        <a class="nav-link @if (in_array($this->skpGuru->status, ['dinilai'])) active @endif" id="penilaian-tab"
                            data-toggle="tab" href="#penilaian" role="tab" aria-controls="penilaian"
                            aria-selected="false">Penilaian</a>
                    </li>
                @else
                    <li class="nav-item" data-toggle="tooltip" data-placement="top"
                        data-title="Capaian skp belum diisi/dinilai">
                        <a class="nav-link disabled text-secondary" aria-disabled="true" id="penilaian-tab"
                            data-toggle="tab" href="#penilaian" role="tab" aria-controls="penilaian"
                            aria-selected="false">Penilaian</a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="tab-content tw-w-full tw-shadow-inner" id="myTabContent">
            <div class="tab-pane fade @if ($this->skpGuru->status == 'draft') show active @endif tw-w-full" id="peta-rencana"
                role="tabpanel" aria-labelledby="peta-rencana-tab">
                <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                    viewType='draft'>
            </div>
            <div class="tab-pane fade tw-w-full" id="rencana" role="tabpanel" aria-labelledby="rencana-tab">
                <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                    viewType='rencana'>
            </div>
            <div class="tab-pane fade tw-w-full" id="keterkaitan" role="tabpanel" aria-labelledby="keterkaitan-tab">
                <div class="card tw-px-0">
                    <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                        viewType='keterkaitan'>
                </div>
            </div>
            <div class="tab-pane fade @if ($this->skpGuru->status == 'konfirmasi') show active @endif tw-w-full" id="reviu"
                role="tabpanel" aria-labelledby="reviu-tab">
                <div class="card tw-px-0">
                    <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                        viewType='reviu'>
                </div>
            </div>
            <div class="tab-pane fade @if (in_array($this->skpGuru->status, ['reviu'])) show active @endif  tw-w-full" id="verifikasi"
                role="tabpanel" aria-labelledby="verifikasi-tab">
                <div class="card tw-px-0">
                    <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                        viewType='verifikasi'>
                </div>
            </div>
            <div class="tab-pane fade @if (in_array($this->skpGuru->status, ['verifikasi']) && (auth()->user()->can('Kepala Sekolah') || $this->skpGuru->skp->penilaian > now())) show active @endif tw-w-full" id="penetapan" role="tabpanel" aria-labelledby="penetapan-tab">
                <div class="card tw-px-0">
                    <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                        viewType='penetapan'>
                </div>
            </div>
            <div class="tab-pane fade @if (in_array($this->skpGuru->status, ['bukti', 'ditolak'])) show active @endif tw-w-full" id="realisasi"
                role="tabpanel" aria-labelledby="realisasi-tab">
                <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                    viewType='realisasi'>
            </div>
            <div class="tab-pane fade tw-w-full  @if (in_array($this->skpGuru->status, ['dinilai'])) show active @endif" id="penilaian"
                role="tabpanel" aria-labelledby="penilaian-tab">
                <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                    viewType='penilaian'>
            </div>
        </div>
    @endcanany
    @can('Pengelola Kinerja')
        @if ($this->skpGuru->status == 'konfirmasi')
            <div class="tw-w-full active show" id="reviu" role="tabpanel" aria-labelledby="reviu-tab">
                <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                    viewType='reviu'>
            </div>
        @else
            <div class="tw-w-full" id="penetapan" role="tabpanel" aria-labelledby="penetapan-tab">
                <div class="card tw-px-0">
                    <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                        viewType='reviu'>
                </div>
            </div>
        @endif
    @endcan
    @can('Tim Angka Kredit')
        <div class="tab-content tw-w-full tw-shadow-inner" id="myTabContent">
            @if ($this->skpGuru->status == 'reviu')
                <div class="tw-w-full active show" id="verifikasi" role="tabpanel" aria-labelledby="verifikasi-tab">
                    <div class="card tw-px-0">
                        <livewire:skp-guru.skp-guru-table :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru" :wire:key="$this->skp->id"
                            viewType='verifikasi'>
                    </div>
                </div>
            @else
                <div class="tw-w-full" id="penetapan" role="tabpanel" aria-labelledby="penetapan-tab">
                    <div class="card tw-px-0">
                        <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                            :wire:key="$this->skp->id" viewType='verifikasi'>
                    </div>
                </div>
            @endif
        </div>
    @endcan

    <script>
        var ele = document.querySelectorAll('.table-scroll');
        ele.forEach(ele => {

            ele.style.cursor = 'grab';
            let pos = {
                top: 0,
                left: 0,
                x: 0,
                y: 0
            };
            const mouseDownHandler = function(e) {

                ele.style.cursor = 'grabbing';
                ele.style.userSelect = 'none';
                pos = {
                    // The current scroll
                    left: ele.scrollLeft,
                    top: ele.scrollTop,
                    // Get the current mouse position
                    x: e.clientX,
                    y: e.clientY,
                };

                document.addEventListener('mousemove', mouseMoveHandler);
                document.addEventListener('mouseup', mouseUpHandler);
            };
            const mouseMoveHandler = function(e) {
                // How far the mouse has been moved
                const dx = e.clientX - pos.x;
                const dy = e.clientY - pos.y;
                // Scroll the element
                ele.scrollTop = pos.top - dy;
                ele.scrollLeft = pos.left - dx;
            };
            const mouseUpHandler = function() {
                document.removeEventListener('mousemove', mouseMoveHandler);
                document.removeEventListener('mouseup', mouseUpHandler);

                ele.style.cursor = 'grab';
                ele.style.removeProperty('user-select');
            };
            ele.addEventListener('mousedown', mouseDownHandler);
            ele.addEventListener('mouseup', mouseUpHandler);
        });

        function refreshPeta() {
            console.log('test')
        }
    </script>
</div>
