<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Himpunan extends Model
{
    use HasFactory;
    protected $table= "himpunan_fuzzy";
    protected $fillable = ['variabel_id', 'himpunan'];

    public function variabel()
    {
        return $this->belongsTo(Variabel::class, 'variabel_id', 'id');
    }

    public function fungsi()
    {
        return $this->hasMany(Fungsi::class, 'himpunan_id', 'id');
    }

}
