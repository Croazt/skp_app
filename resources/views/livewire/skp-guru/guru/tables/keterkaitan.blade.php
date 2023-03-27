<tbody>
    <tr>
        <td wire:model="data.deskripsi.{{ $rencanaKinerja->id }}" class="tw-w-4/12" >
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td  class="tw-w-4/12" >
            {!! nl2br($this->data['butir_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td  class="tw-w-3/12">
            {!! nl2br($this->data['output_kegiatan'][$rencanaKinerja->id]) !!}
        </td>
        <td class="text-center tw-align-middle"  class="tw-w-1/12">
            {{ $this->data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
