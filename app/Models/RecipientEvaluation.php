<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientEvaluation extends Model
{
    use HasFactory;
    protected $table = 'recipient_evaluation';
    protected $fillable = ['recipient_id', 'variabel_id', 'himpunan_id', 'bobot'];

    public function variabel()
    {
        return $this->belongsTo(Variabel::class, 'variabel_id', 'id');
    }

    public function himpunan()
    {
        return $this->belongsTo(Himpunan::class, 'himpunan_id', 'id');
    }
}
