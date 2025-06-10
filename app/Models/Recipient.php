<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PositionDetail;

class Recipient extends Model
{
    use HasFactory;

    protected $table = 'recipient';

    protected $fillable = [
        'nama',
        'nik',
        'gender',
        'address',
        'bobot',
    ];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function evaluation()
    {
        return $this->hasMany(RecipientEvaluation::class, 'recipient_id', 'id');
    }
}
