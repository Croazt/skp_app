<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RencanaKinerjaGuruCreateRequest extends FormRequest
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
        if(request()->has('detail_kinerja_id')){
            $num = is_numeric(request()->detail_kinerja_id) ? intval(request()->detail_kinerja_id): request()->detail_kinerja_id;
            request()->merge([
                'detail_kinerja_id' => $num,
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
            'detail_kinerja_id' => 'required|integer|exists:detail_kinerja,id',
        ];
        Log::debug('Message.', [
            'req' => request(),
            'rules' => $rules,
        ]);
        return $rules;
    }
}
