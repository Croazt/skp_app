<x-slot name="header_content">
    <h1>{{ __('Buat Penilaian') }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('penilaian-perilaku.index') }}">Penilaian Perilaku</a></div>
        <div class="breadcrumb-item"><a
                href="{{ route('penilaian-perilaku.guru.show', ['skp' => $skp->id, 'user' => $user->nip]) }}">{{ auth()->user()->nip }}</a>
        </div>
    </div>
</x-slot>

<div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
    <style>
        .nav-item .nav-link.active {
            color: var(--primary) !important;
            font-weight: 900;
        }
    </style>
    <div class="tw-px-6 tw-pt-8 tw-pb-4 tw-text-center">
        <h1 class="h5 tw-font-black">
            PENILAIAN PERILAKU GURU
        </h1>
        <h1 class="h5 tw-font-bold"> {{ format_periode($this->skp->periode_awal, $this->skp->periode_akhir) }}
        </h1>
    </div>
    @if ($penilaianPerilakuGuru === null)
        <div class="tw-p-20 text-center">
            PENILAIAN PERILAKU BELUM DIBUAT
        </div>
    @else
        <div class="tw-w-full tw-flex tw-justify-center tw-py-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($aspekPerilaku as $item)
                    <li class="nav-item">
                        <a class="nav-link @if ($loop->first) active @endif"
                            id="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab" data-toggle="tab"
                            href="#{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tab">
                            {{ $item->nama }}
                        </a>
                    </li>
                @endforeach
                <li wire:click="downloadPdf('perilaku')"
                    class="nav-item tw-ml-1 tw-cursor-pointer tw-text-center tw-text-white bg-primary tw-rounded-xl">
                    <p class="nav-link  tw-text-white"><span class="fas fa-download"></span>&nbsp;Perilaku</p>
                </li>
                <li wire:click="downloadPdf('prestasi')"
                    class="nav-item tw-ml-1 tw-cursor-pointer tw-text-center tw-text-white bg-primary tw-rounded-xl">
                    <p class="nav-link  tw-text-white"><span class="fas fa-download"></span>&nbsp;Prestasi</p>
                </li>
                <li wire:click="downloadPdf('penilaian-kerja')"
                    class="nav-item tw-ml-1 tw-cursor-pointer tw-text-center tw-text-white bg-primary tw-rounded-xl">
                    <p class="nav-link  tw-text-white"><span class="fas fa-download"></span>&nbsp;Dokumen Prestasi
                        Kinerja</p>
                </li>
            </ul>
        </div>
        <div class="tab-content tw-w-full" id="myTabContent">
            @foreach ($aspekPerilaku as $key => $item)
                <div class="tab-pane fade @if ($loop->first) show active @endif tw-w-full"
                    id="{{ strtolower(explode(' ', $item->nama)[0]) }}" role="tabpanel"
                    aria-labelledby="{{ strtolower(explode(' ', $item->nama)[0]) }}-tab">
                    <div>
                        <livewire:penilaian-perilaku.penilaian-perilaku-guru-show-table :skp="$skp"
                            :wire:key=" strtolower(explode(' ', $item->nama)[0]).$skp->id.$user->nip" :user="$user"
                            :tableType="$item->nama">
                    </div>
                    <div class=" tw-w-full tw-text-center tw-flex tw-justify-between px-5 tw-mb-5">
                        <div>
                            <button wire:click="back" class="btn btn-secondary">Kembali</button>
                        </div>
                        <div>
                            @if (!$loop->first)
                                <button class="btn-nav btn btn-warning"
                                    id="{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}-tab"
                                    href="#{{ strtolower(explode(' ', $aspekPerilaku[$key - 1]->nama)[0]) }}">Sebelumnya</button>
                            @endif
                            @if (!$loop->last)
                                <button class="btn-nav btn btn-primary"
                                    id="{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}-tab"
                                    href="#{{ strtolower(explode(' ', $aspekPerilaku[$key + 1]->nama)[0]) }}">Selanjutnya</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('livewire.partials.change_script')

        <script>
            $(document).ready(function() {
                $(".btn-nav").click(function() {
                    $('.nav a[href="' + $(this).attr("href") + '"]').tab('show');
                });
            });
        </script>
    @endif
</div>
