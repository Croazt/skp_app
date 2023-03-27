<div class="tw-w-full tw-flex tw-flex-wrap tw-mb-0">
    <div class="sm:tw-w-3/12 tw-w-full tw-flex">
        <div class="tw-w-11/12 sm:tw-text-sm md:tw-text-base tw-text-xs tw-font-bold">
            {{ $title }}
        </div>
        <span class="tw-font-bold tw-hidden sm:tw-block">:</span>
    </div>
    <div class="sm:tw-w-9/12 tw-w-full tw-card tw-shadow-none tw-border tw-border-gray-400 tw-rounded  tw-mb-3">
        <div class="card-body tw-w-full">
            <x-responsive-data title="Nama" value="{{ $data->nama }}" />
            <x-responsive-data title="NIP" value="{{ $data->nip }}" />
            <x-responsive-data title="Pangkat" value="{{ $data->getPangkatJabatanName() }}" />
            <x-responsive-data title="Jabatan" value="{{ $data->pekerjaan }}" />
            <x-responsive-data title="Unit Kerja" value="{{ $data->unit_kerja }}" />
        </div>
    </div>
</div>
