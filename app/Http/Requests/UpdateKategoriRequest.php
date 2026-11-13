<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kategoriId = $this->route('kategori') instanceof \App\Models\KategoriFormat
            ? $this->route('kategori')->id
            : $this->route('kategori');

        return [
            'nama_format' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_formats', 'nama_format')->ignore($kategoriId),
            ],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_format.required' => 'Nama format kategori wajib diisi.',
            'nama_format.unique' => 'Nama format kategori sudah digunakan data lain.',
            'nama_format.max' => 'Nama format maksimal 100 karakter.',
        ];
    }
}
