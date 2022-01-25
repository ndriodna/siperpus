<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'judul' => 'required|string',
            'isbn' => 'nullable|string',
            'pengarang' => 'nullable|string',
            'penerbit' => 'nullable|string',
            'tahun_terbit' => 'nullable|string',
            'stok' => 'required|integer',
            'cover' => 'nullable', // dimensions:width=1280,height=720 atur sendiri co
            'kategori_id' => 'required|integer',
        ];
    }
}
