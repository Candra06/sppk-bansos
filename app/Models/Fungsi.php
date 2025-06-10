<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fungsi extends Model
{
    use HasFactory;
    protected $table='fungsi_keanggotaan';
    protected $fillable = ['himpunan_id', 'fungsi', 'bobot'];

    public function himpunan()
    {
        return $this->belongsTo(Himpunan::class, 'himpunan_id', 'id');
    }
}
