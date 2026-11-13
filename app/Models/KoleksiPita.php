<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KoleksiPita extends Model
{
    use HasFactory;

    protected $table = 'koleksi_pitas';

    protected $fillable = [
        'kode_koleksi',
        'nama_koleksi',
        'kategori_format_id',
        'tahun',
        'deskripsi',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    /**
     * Relasi belongsTo ke KategoriFormat.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriFormat::class, 'kategori_format_id');
    }

    /**
     * Relasi hasOne ke DetailKondisi.
     */
    public function detailKondisi(): HasOne
    {
        return $this->hasOne(DetailKondisi::class, 'koleksi_pita_id');
    }

    /**
     * Relasi belongsToMany ke TindakanRestorasi via pivot koleksi_tindakan.
     */
    public function tindakanRestorasis(): BelongsToMany
    {
        return $this->belongsToMany(TindakanRestorasi::class, 'koleksi_tindakan', 'koleksi_pita_id', 'tindakan_restorasi_id')
            ->withPivot(['id', 'status', 'tanggal_mulai', 'tanggal_selesai', 'catatan'])
            ->withTimestamps();
    }
}
