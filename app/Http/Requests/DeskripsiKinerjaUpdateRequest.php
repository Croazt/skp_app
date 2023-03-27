<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DeskripsiKinerjaUpdateRequest extends FormRequest
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
        ];
        $rules['deskripsi'] = [ 'required', 'string', Rule::unique('kinerja','deskripsi')->ignore(request()->deskripsi,'deskripsi')];

        return $rules;
    }
}
