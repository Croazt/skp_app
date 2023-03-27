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
            @if ($this->data['terkait'][$rencanaKinerja->id] === null)
                <p class="tw-leading-5">
                    Kinerja belum diverifikasi
                </p>
            @elseif ($this->data['terkait'][$rencanaKinerja->id])
                <p class="tw-leading-5 tw-whitespace-nowrap">
                    Terkait / <del>Tidak Terkait</del> 
                </p>
                <p class="tw-leading-5">
                    (Coret Salah Satu)
                </p>
            @else
                <p class="tw-leading-5 tw-whitespace-nowrap">
                    <del>Terkait</del> / Tidak Terkait
                </p>
                <p class="tw-leading-5">
                    (Coret Salah Satu)
                </p>
            @endif
        </td>
    </tr>
</tbody>
