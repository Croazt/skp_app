<tbody>
    <tr>
        <td rowspan="3" class="deskripsi" wire:model="data.kinerja_desc.{{ $rencanaKinerja->id }}">
            {{ $data['kinerja_desc'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" wire:model="data.deskripsi.{{ $rencanaKinerja->id }}">
            {{ $data['deskripsi'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-font-extrabold tw-align-middle">
            Kuantitas
        </td>
        <td class="tw-align-middle">
            {{ $data['indikator_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3">
            {{ $data['butir_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3">
            {{ $data['output_kegiatan'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_kuantitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_kuantitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_kuantitas'][$rencanaKinerja->id] }}
        </td>
        <td rowspan="3" class="tw-align-middle tw-text-center ">
            @if ($skpGuru->status === 'bukti')
                @if ($rencanaKinerja->dokumen_diterima === 1)
                    Dokumen Bukti Diterima
                @else
                    Menunggu Verifikasi Dokumen
                @endif
                <a href="{{ $data['dokumen_bukti'][$rencanaKinerja->id] }}" class="btn btn-info tw-mb-4"
                    style="white-space: nowrap;">Unduh Dokumen</a>
            @elseif ($skpGuru->status === 'ditolak')
                @if ($data['dokumen_diterima'][$rencanaKinerja->id] === 0)
                    Dokumen Anda Ditolak
                @endif
                @if ($data['dokumen_bukti'][$rencanaKinerja->id] != null)
                    <a href="{{ $data['dokumen_bukti'][$rencanaKinerja->id] }}" class="btn btn-info tw-mb-4"
                        style="white-space: nowrap;">Unduh Dokumen</a>
                @endif
                @if (!$data['dokumen_diterima'][$rencanaKinerja->id])
                    @if ($data['dokumen_diterima'][$rencanaKinerja->id] === 0)
                        <p>
                            Hapus Rencana
                        </p>
                        <button type="button" class="btn btn-danger tw-mb-4"
                            wire:click='deleteRencana({{ $rencanaKinerja->id }})'>
                            <p class="fa fa-trash"></p>
                        </button>
                    @endif
                    <p>Dokumen Baru :</p>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <button type="button"
                            class="btn btn-sm @if ($data['dokumen_bukti'][$rencanaKinerja->id] == null) btn-info @else btn-warning @endif"
                            onclick="document.getElementById('dokumen-{{ $rencanaKinerja->id }}').click()">Unggah</button>
                        <input type="file" wire:model="dokumen.{{ $rencanaKinerja->id }}"
                            id="dokumen-{{ $rencanaKinerja->id }}" accept="application/pdf" style="display: none;"
                            class="tw-w-44">
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @error('dokumen.' . $rencanaKinerja->id)
                        <span class="error">{{ $message }}</span>
                    @enderror
                @endif
            @else
                @if ($data['dokumen_bukti'][$rencanaKinerja->id] != null)
                    <a href="{{ $data['dokumen_bukti'][$rencanaKinerja->id] }}" class="btn btn-info tw-mb-4"
                        style="white-space: nowrap;">Unduh Dokumen</a>
                    <p>Dokumen Baru :</p>
                @endif
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <button type="button"
                        class="btn btn-sm @if ($data['dokumen_bukti'][$rencanaKinerja->id] == null) btn-info @else btn-warning @endif"
                        onclick="document.getElementById('dokumen-{{ $rencanaKinerja->id }}').click()">Unggah</button>
                    <input type="file" wire:model="dokumen.{{ $rencanaKinerja->id }}"
                        id="dokumen-{{ $rencanaKinerja->id }}" accept="application/pdf" style="display: none;"
                        class="tw-w-44">
                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                @error('dokumen.' . $rencanaKinerja->id)
                    <span class="error">{{ $message }}</span>
                @enderror
            @endif
        </td>
        {{-- <td rowspan="3" class="text-center tw-align-middle">
            {{ $data['angka_kredit'][$rencanaKinerja->id] }}
        </td>
        @if ($skpGuru->status == 'verifikasi')
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
            {{ $data['indikator_kualitas'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_kualitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_kualitas'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_kualitas'][$rencanaKinerja->id] }}
        </td>
    </tr>
    <tr>
        <td class="tw-font-extrabold tw-align-middle">
            Waktu
        </td>
        <td class="tw-align-middle">
            {{ $data['indikator_waktu'][$rencanaKinerja->id] }}
        </td>
        <td class="tw-align-middle tw-text-center">
            <div class="tw-w-max tw-flex tw-mx-auto">
                <div class="tw-mx-2"> {{ $data['target1_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
                <div class="tw-mx-2tw-font-extrabold">-</div>
                <div class="tw-mx-2"> {{ $data['target2_waktu'][$rencanaKinerja->id] ?? 0 }}
                </div>
            </div>
        </td>
        <td class="tw-align-middle">
            {{ $data['detail_output_waktu'][$rencanaKinerja->id] }}
        </td>
    </tr>
</tbody>
