<tbody>
    <tr>
        <td rowspan="3" class="deskripsi tw-w-2/12" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $this->data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="tw-w-3/12" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $this->data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="text-center tw-w-2/12">
            <div class="tw-w-max tw-mx-auto tw-text-left tw-h-full">
                <p class="tw-font-semibold">Pilih Metode Cascading:</p> 
                <div class="tw-mb-1 tw-pr-1">
                    <div><input type="radio" wire:model="data.cascading.{{ $rencanaKinerja->id }}"
                            wire:change="updateCascading({{ $rencanaKinerja->id }})" value="1"
                            id="cascading" />Direct Cascading</div>
                    <div><input type="radio" wire:model="data.cascading.{{ $rencanaKinerja->id }}"
                            wire:change="updateCascading({{ $rencanaKinerja->id }})" value="0"
                            id="cascading" />Non Direct Cascading</div>
                </div>
                <p class="tw-font-semibold">Catatan:</p> 
                <div class="tw-text-left tw-h-full">
                    <textarea placeholder="Masukkan catatan untuk kinerja" wire:change="updateCatatan({{ $rencanaKinerja->id }})"
                        class="tw-h-full tw-text-sm focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        type="text" wire:model="data.catatan.{{ $rencanaKinerja->id }}" name="catatan" id="catatan"></textarea>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Kualitas
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}%</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}%</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center ">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $this->data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}%</div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $this->data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}%</div>
            </div>
        </td>
        <td class="tw-align-middle tw-w-2/12">
            {{ $this->data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
