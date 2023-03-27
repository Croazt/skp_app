<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class KinerjaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if (request()->has('deskripsi')) {
            $num = is_numeric(request()->deskripsi) ? intval(request()->deskripsi) : request()->deskripsi;
            request()->merge([
                'deskripsi' => $num,
            ]);
        }
        if (request()->has('is_default')) {
            request()->merge([
                'is_default' => filter_var(request()->is_default, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =  [
            'kategori' => 'required|string|in:utama,tambahan',
            'deskripsi' => 'required|string',
            'detail_rencana' => 'required|string|unique:detail_kinerja,deskripsi',
            'tipe_angka_kredit' => 'required|string',
            'angka_kredit' => 'required|integer',
            'iki_kualitas' => 'required|string',
            'iki_kuantitas' => 'required|string',
            'iki_waktu' => 'required|string',
            'butir_kegiatan' => 'required|string',
            'output_kegiatan' => 'required|string',
            'is_default' => ['required', 'boolean'],
            'jabatan' => 'required_if:is_default,==,true',
        ];
        if (is_numeric(request()->deskripsi)) {
            $rules['deskripsi'] = 'numeric|exists:kinerja,id';
        }
        $rules['deskripsi'] = 'required|string|unique:kinerja,deskripsi';

        return $rules;
    }
}
