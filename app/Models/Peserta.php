<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use HasFactory, SoftDeletes, HasUuid,Auditable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'peserta';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'alamat',
        'durasi_asuransi',
        'tanggal_mulai_asuransi',
        'tanggal_selesai_asuransi',
        'status_peserta',
        'approved_peserta_at',
        'approved_peserta_by',
        'status_dokumen',
        'approved_dokumen_at',
    ];

    protected $casts = [
        'created_by' => 'string',
        'updated_by' => 'string',
        'deleted_by' => 'string',
        'approved_peserta_by' => 'string',
        'approved_dokumen_by' => 'string',
    ];
    

    /**
     * Get all of the dokumenPeserta for the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokumenPesertas(): HasMany
    {
        return $this->hasMany(DokumenPeserta::class, 'id_peserta');
    }
}
