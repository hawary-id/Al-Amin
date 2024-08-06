<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokumenPeserta extends Model
{
    use HasFactory, SoftDeletes, HasUuid,Auditable;
    
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'dokumen_peserta';

    protected $fillable = [
        'id_peserta',
        'file_ktp',
        'file_kk',
        'file_keterangan_sehat',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'id_peserta' => 'string',
        'created_by' => 'string',
        'updated_by' => 'string',
        'deleted_by' => 'string',
    ];


    /**
     * Get the peserta that owns the DokumenPeserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class);
    }
}
