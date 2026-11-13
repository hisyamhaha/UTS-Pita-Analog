<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_format' => ['required', 'string', 'max:100', 'unique:kategori_formats,nama_format'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_format.required' => 'Nama format kategori wajib diisi.',
            'nama_format.unique' => 'Nama format kategori sudah terdaftar.',
            'nama_format.max' => 'Nama format maksimal 100 karakter.',
        ];
    }
}
