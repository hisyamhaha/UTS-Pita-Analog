<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKoleksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Data Utama Koleksi Pita
            'kode_koleksi' => ['required', 'string', 'max:50', 'unique:koleksi_pitas,kode_koleksi'],
            'nama_koleksi' => ['required', 'string', 'max:255'],
            'kategori_format_id' => ['required', 'exists:kategori_formats,id'],
            'tahun' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'deskripsi' => ['nullable', 'string', 'max:2000'],

            // Detail Kondisi (1-to-1)
            'kondisi_awal' => ['required', 'string', 'max:2000'],
            'tingkat_kerusakan' => ['required', 'in:ringan,sedang,berat'],
            'catatan_kondisi' => ['nullable', 'string', 'max:2000'],

            // Tindakan Restorasi (Pivot Many-to-Many)
            'tindakan' => ['nullable', 'array'],
            'tindakan.*.tindakan_id' => ['required_with:tindakan.*', 'exists:tindakan_restorasis,id'],
            'tindakan.*.status' => ['nullable', 'in:rencana,proses,selesai'],
            'tindakan.*.tanggal_mulai' => ['nullable', 'date'],
            'tindakan.*.tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tindakan.*.tanggal_mulai'],
            'tindakan.*.catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_koleksi.required' => 'Kode koleksi wajib diisi.',
            'kode_koleksi.unique' => 'Kode koleksi sudah terdaftar, gunakan kode unik lain.',
            'nama_koleksi.required' => 'Nama atau judul rekaman koleksi wajib diisi.',
            'kategori_format_id.required' => 'Kategori format pita wajib dipilih.',
            'kategori_format_id.exists' => 'Kategori format yang dipilih tidak valid.',
            'tahun.required' => 'Tahun rekaman atau produksi wajib diisi.',
            'tahun.integer' => 'Tahun harus berupa bilangan bulat.',
            'tahun.min' => 'Tahun minimal 1900.',
            'tahun.max' => 'Tahun tidak boleh melebihi tahun sekarang.',
            'kondisi_awal.required' => 'Kondisi awal pita fisik wajib diisi.',
            'tingkat_kerusakan.required' => 'Tingkat kerusakan wajib dipilih.',
            'tingkat_kerusakan.in' => 'Tingkat kerusakan harus salah satu dari: ringan, sedang, berat.',
            'tindakan.*.tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ];
    }
}
