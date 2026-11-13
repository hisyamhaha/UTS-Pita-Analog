<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTindakanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tindakanId = $this->route('tindakan') instanceof \App\Models\TindakanRestorasi
            ? $this->route('tindakan')->id
            : $this->route('tindakan');

        return [
            'nama_tindakan' => [
                'required',
                'string',
                'max:150',
                Rule::unique('tindakan_restorasis', 'nama_tindakan')->ignore($tindakanId),
            ],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_tindakan.required' => 'Nama tindakan restorasi wajib diisi.',
            'nama_tindakan.unique' => 'Nama tindakan restorasi sudah digunakan data lain.',
            'nama_tindakan.max' => 'Nama tindakan maksimal 150 karakter.',
        ];
    }
}
