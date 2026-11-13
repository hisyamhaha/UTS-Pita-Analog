<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTindakanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_tindakan' => ['required', 'string', 'max:150', 'unique:tindakan_restorasis,nama_tindakan'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_tindakan.required' => 'Nama tindakan restorasi wajib diisi.',
            'nama_tindakan.unique' => 'Nama tindakan restorasi sudah terdaftar.',
            'nama_tindakan.max' => 'Nama tindakan maksimal 150 karakter.',
        ];
    }
}
