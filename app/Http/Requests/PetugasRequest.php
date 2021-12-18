<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string',
            'jk' => 'required|in:L,P',
            'jabatan' => 'nullable|string',
            'telp' => 'nullable|integer',
            'alamat' => 'nullable|max:1000',
        ];
    }
}
