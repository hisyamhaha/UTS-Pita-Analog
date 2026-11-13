<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKondisi extends Model
{
    use HasFactory;

    protected $table = 'detail_kondisis';

    protected $fillable = [
        'koleksi_pita_id',
        'kondisi_awal',
        'tingkat_kerusakan',
        'catatan',
    ];

    /**
     * Relasi belongsTo ke KoleksiPita.
     */
    public function koleksiPita(): BelongsTo
    {
        return $this->belongsTo(KoleksiPita::class, 'koleksi_pita_id');
    }
}
