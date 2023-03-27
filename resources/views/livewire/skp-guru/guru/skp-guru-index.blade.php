<x-slot name="header_content">
    <h1>{{ __('Detail SKP') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('skp.show', ['skp' => $this->skp]) }}">SKP</a></div>
        <div class="breadcrumb-item"><a href="{{ route('guru.skp-guru.index', ['skp' => $this->skp]) }}">SKP Guru</a>
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
            {{ format_periode($this->skp->periode_awal,$this->skp->periode_akhir) }}
        </h1> --}}
    </div>
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
            <p class="bg-info tw-text-white">Skp telah direviu oleh Pengelola Kinerja, menunggu proses verifikasi SKP
                oleh Tim Angka Kredit!</p>
        </div>
    @elseif($this->skpGuru->status === 'verifikasi')
        <div class="tw-w-full tw-text-center">
            <p class="badge tw-bg-green-600 tw-text-white">Terverifikasi</p>
            <br>
            <br>
            <p class="bg-warning tw-text-white">
                @if (\Carbon\Carbon::parse($this->skpGuru->skp->penilaian) >= now())
                    SKP Telah diverifikasi, realisasi rencana akan dibuka pada tanggal {{ $this->skpGuru->skp->penilaian }}
                @else
                    Silahkan upload dan konfirmasi dokumen bukti 
                    kinerja anda!
                @endif
            </p>
        </div>
    @elseif($this->skpGuru->status === 'bukti')
        <div class="tw-w-full tw-text-center">
            <p class="badge tw-bg-yellow-200">Menunggu Verifikasi Bukti</p>
            <br>
            <br>
            <p class="bg-info tw-text-white">Menunggu proses verifikasi bukti dan realisasi kinerja SKP!</p>
        </div>
    @elseif($this->skpGuru->status === 'ditolak')
        <div class="tw-w-full tw-text-center">
            <p class="badge tw-bg-red-500 tw-text-white">Bukti Ditolak</p>
            <br>
            <br>
            <p class="bg-warning tw-text-white">Dokumen bukti kinerja anda ditolak, Agar SKP dapat dinilai silahkan
                unggah ulang dokumen bukti kinerja Anda!</p>
        </div>
    @elseif($this->skpGuru->status === 'dinilai')
        <div class="tw-w-full tw-text-center">
            <p class="badge tw-bg-green-800 tw-text-white">Telah Dinilai</p>
        </div>
    @endif
    <div>
        {{-- @include('livewire.skp-guru.partials.user-detail') --}}
    </div>
    <div class="tw-w-full tw-flex tw-justify-center tw-py-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- {{ $this->tab == "kinerja" ? 'true' : 'false' }} --}}
            @if ($this->skpGuru->status == 'draft')
                <li class="nav-item">
                    <a class="nav-link @if ($this->skpGuru->status == 'draft') active @endif" id="peta-rencana-tab"
                        data-toggle="tab" href="#peta-rencana" role="tab" aria-controls="peta-rencana"
                        aria-selected="true">Peta Rencana</a>
                </li>
            @endif
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
                    <a class="nav-link @if (in_array($this->skpGuru->status, ['verifikasi']) && \Carbon\Carbon::parse($this->skpGuru->skp->penilaian) >= now()) active @endif" id="penetapan-tab"
                        data-toggle="tab" href="#penetapan" role="tab" aria-controls="penetapan"
                        aria-selected="false">Penetapan</a>
                </li>
            @else
                <li class="nav-item" data-toggle="tooltip" data-placement="top"
                    data-title="SKP Belum diverifikasi oleh Tim Angka Kredit">
                    <a class="nav-link disabled text-secondary" aria-disabled="true" id="penetapan-tab"
                        data-toggle="tab" href="#penetapan" role="tab" aria-controls="penetapan"
                        aria-selected="false">Penetapan</a>
                </li>
            @endif
            @if (in_array($this->skpGuru->status, ['verifikasi', 'bukti', 'ditolak']) &&
                    \Carbon\Carbon::parse($this->skpGuru->skp->penilaian) <= now())
                <li class="nav-item">
                    <a class="nav-link @if (in_array($this->skpGuru->status, ['verifikasi', 'bukti', 'ditolak'])) active @endif" id="realisasi-tab"
                        data-toggle="tab" href="#realisasi" role="tab" aria-controls="realisasi"
                        aria-selected="false">Realisasi Rencana</a>
                </li>
            @elseif(!in_array($this->skpGuru->status, ['dinilai']))
                <li class="nav-item" data-toggle="tooltip" data-placement="top"
                    data-title="
                    @if (\Carbon\Carbon::parse($this->skpGuru->skp->penilaian) >= now())
                        Menunggu jadwal penilaian
                    @else
                        SKP Belum diverifikasi oleh Tim Angka Kredit
                    @endif">
                    <a class="nav-link disabled text-secondary" aria-disabled="true" id="realisasi-tab"
                        data-toggle="tab" href="#realisasi" role="tab" aria-controls="realisasi"
                        aria-selected="false">Realisasi Rencana</a>
                </li>
            @endif
            @if (in_array($this->skpGuru->status, ['dinilai']))
                <li class="nav-item">
                    <a class="nav-link  @if (in_array($this->skpGuru->status, ['dinilai'])) active @endif" cid="penilaian-tab"
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
            <li wire:click='downloadAllPdf' id="download_all" aria-controls="sampul"
                class="nav-item tw-cursor-pointer tw-text-center tw-text-white tw-bg-transparent tw-rounded-xl">
                <p class="nav-link tw-text-blue-600"><span class="fas fa-download"></span>&nbsp;Dokumen SKP</p>
            </li>
            <li wire:click='downloadSampul' id="download_sampul" aria-controls="sampul"
                class="nav-item tw-cursor-pointer tw-text-center tw-text-white tw-bg-transparent tw-rounded-xl">
                <p class="nav-link tw-text-blue-600"><span class="fas fa-download"></span>&nbsp;Sampul</p>
            </li>
        </ul>
    </div>
    <div class="tab-content tw-w-full tw-shadow-inner" id="myTabContent">
        <div class="tab-pane fade @if ($this->skpGuru->status == 'draft') show active @endif tw-w-full" id="peta-rencana"
            role="tabpanel" aria-labelledby="peta-rencana-tab">
            <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                :wire:key="'petarencana'.$this->skp->id" viewType='draft'>
        </div>
        <div class="tab-pane fade tw-w-full" id="rencana" role="tabpanel" aria-labelledby="rencana-tab">
            <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                :wire:key="'rencana'.$this->skp->id" viewType='rencana'>

        </div>
        <div class="tab-pane fade tw-w-full" id="keterkaitan" role="tabpanel" aria-labelledby="keterkaitan-tab">
            <div class="card tw-px-0">
                <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                    :wire:key="'keterkaitan'.$this->skp->id" viewType='keterkaitan'>
            </div>
        </div>
        <div class="tab-pane fade @if ($this->skpGuru->status == 'konfirmasi') show active @endif tw-w-full" id="reviu"
            role="tabpanel" aria-labelledby="reviu-tab">
            <div class="card tw-px-0">
                <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                    :wire:key="'reviu'.$this->skp->id" viewType='reviu'>
            </div>
        </div>
        <div class="tab-pane fade @if ($this->skpGuru->status == 'reviu') show active @endif  tw-w-full" id="verifikasi"
            role="tabpanel" aria-labelledby="verifikasi-tab">
            <div class="card tw-px-0">
                <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                    :wire:key="'verifikasi'.$this->skp->id" viewType='verifikasi'>
            </div>
        </div>
        <div class="tab-pane fade tw-w-full @if (in_array($this->skpGuru->status, ['verifikasi']) && \Carbon\Carbon::parse($this->skpGuru->skp->penilaian) >= now()) show active @endif" id="penetapan"
            role="tabpanel" aria-labelledby="penetapan-tab">
            <div class="card tw-px-0">
                <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                    :wire:key="'penetapan'.$this->skp->id" viewType='penetapan'>
            </div>
        </div>
        @if ($this->skpGuru->status != 'dinilai')
            <div class="tab-pane fade @if (in_array($this->skpGuru->status, ['verifikasi', 'bukti', 'ditolak']) &&
                    \Carbon\Carbon::parse($this->skpGuru->skp->penilaian) <= now()) show active @endif tw-w-full" id="realisasi"
                role="tabpanel" aria-labelledby="realisasi-tab">
                <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                    :wire:key="'realisasi'.$this->skp->id" viewType='realisasi'>
            </div>
        @endif
        <div class="tab-pane fade tw-w-full  @if (in_array($this->skpGuru->status, ['dinilai'])) show active @endif" id="penilaian"
            role="tabpanel" aria-labelledby="penilaian-tab">
            <livewire:skp-guru.guru.skp-guru-peta :rencanaKinerjaGuru="$this->rencanaKinerjaGuru" :skpGuru="$this->skpGuru"
                :wire:key="'penilaian'.$this->skp->id" viewType='penilaian'>
        </div>
    </div>
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
