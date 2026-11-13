<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TindakanRestorasi extends Model
{
    use HasFactory;

    protected $table = 'tindakan_restorasis';

    protected $fillable = [
        'nama_tindakan',
        'deskripsi',
    ];

    /**
     * Relasi belongsToMany ke KoleksiPita via pivot koleksi_tindakan.
     */
    public function koleksiPitas(): BelongsToMany
    {
        return $this->belongsToMany(KoleksiPita::class, 'koleksi_tindakan', 'tindakan_restorasi_id', 'koleksi_pita_id')
            ->withPivot(['id', 'status', 'tanggal_mulai', 'tanggal_selesai', 'catatan'])
            ->withTimestamps();
    }
}
