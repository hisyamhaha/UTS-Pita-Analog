<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriFormat extends Model
{
    use HasFactory;

    protected $table = 'kategori_formats';

    protected $fillable = [
        'nama_format',
        'deskripsi',
    ];

    /**
     * Relasi hasMany ke KoleksiPita.
     */
    public function koleksiPitas(): HasMany
    {
        return $this->hasMany(KoleksiPita::class, 'kategori_format_id');
    }
}
