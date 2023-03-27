<tbody>
    <tr>
        <td wire:model="data.deskripsi.{{ $rencanaKinerja->id }}" class="tw-w-4/12">
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-w-4/12">
            {!! nl2br($this->data['butir_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td class="tw-w-2/12">
            {!! nl2br($this->data['output_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td class="text-center tw-align-middle" class="tw-w-1/12">
            {{ $this->data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
        <td class="text-center tw-align-middle" class="tw-w-2/12">
            Centang Apabila Terkait
            <div>
                <x-jet-input wire:model="data.terkait.{{ $rencanaKinerja->id }}"  wire:change="updateTerkait({{ $rencanaKinerja->id }})" type="checkbox" name="terkait" id="terkait"/>
            </div>
        </td>
    </tr>
</tbody>
