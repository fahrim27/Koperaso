<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMember extends FormRequest
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
            'nik' => 'required|unique:anggota|max:16',
            // 'image' => 'required|mimes:jpg|max:2048',
            'nama' => 'required',
            'no_rekening_bca' => 'required',
            'email' => 'nullable|email|unique:anggota|max:35',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|unique:anggota|max:20',
            'no_ktp' => 'required',
            'jenkel' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ];
    }
}
