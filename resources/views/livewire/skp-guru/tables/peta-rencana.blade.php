<tbody>
    <tr>
        <td rowspan="3" class="deskripsi" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $this->data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3">
            {!! nl2br($this->data['butir_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td rowspan="3">
            {!! nl2br($this->data['output_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.target1_kuantitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                    disabled 
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target1_kuantitas')">
                <div class="tw-mx-2 tw-self-center tw-font-extrabold">-</div>
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.target2_kuantitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                    disabled 
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target2_kuantitas')">
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="text-center tw-align-middle">
            {{ $this->data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
        {{-- @if ($this->skpGuru->status == 'draft'  && !(\Carbon\Carbon::parse($this->skpGuru->skp->perencanaan) < now()))
            <td rowspan="3" class="text-center tw-align-middle">
                <div class="tw-align-middle tw-flex tw-flex-col">
                    <button class="btn btn-xs btn-icon mb-1 btn-danger dt-delete-kinerja-guru"
                        data-key="{{ $rencanaKinerja->id }}">
                        <i class="fa fa-trash icon-nm"></i>
                    </button>
                </div>
            </td>
        @endif --}}
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="input-group tw-w-max">
                    <input
                        class="form-control tw-p-1 tw-w-9 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-l-md tw-shadow-sm"
                        wire:model="data.target1_kualitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                        disabled 
                        max="99"
                        wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target1_kualitas')"
                        aria-label="">
                    <div class="input-group-append tw-h-auto tw-rounded-r-md">
                        <span class="input-group-text tw-p-1 tw-w-6 tw-h-8 {{ !($this->skpGuru->status == 'draft') ? 'tw-bg-[#e9ecef]' : '' }}">%</span>
                    </div>
                </div>
                <div class="input-group tw-w-max">
                    <div class="tw-mx-2 tw-self-center tw-font-extrabold">-</div>
                    <input
                        class="form-control tw-p-1 tw-w-9 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-l-md tw-shadow-sm"
                        wire:model="data.target2_kualitas.{{ $rencanaKinerja->id }}" type="number" min="0"
                        disabled 
                        max="99"
                        wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target2_kualitas')">
                    <div class="input-group-append tw-h-auto tw-rounded-r-md">
                        <span class="input-group-text tw-p-1 tw-w-6 tw-h-8 {{ !($this->skpGuru->status == 'draft') ? 'tw-bg-[#e9ecef]' : '' }}">%</span>
                    </div>
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle">
            {{ $this->data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.target1_waktu.{{ $rencanaKinerja->id }}" type="number" min="0"
                    disabled 
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target1_waktu')">
                <div class="tw-mx-2 tw-self-center tw-font-extrabold">-</div>
                <input
                    class="form-control tw-p-1 tw-w-15 tw-h-8 tw-text-center focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:model="data.target2_waktu.{{ $rencanaKinerja->id }}" type="number" min="0"
                    disabled 
                    max="99"
                    wire:change="updateTargetCapaian({{ $rencanaKinerja->id }},$event.target.value,'target2_waktu')">
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
