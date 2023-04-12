<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;


class Contribution extends Model
{
    use HasFactory;


    protected $fillable = [
        'yearly_contribution',
        'total_contribution',
        'amount_paid',
        'balance',
        'profile_id',
        'year'
    ];




    public function user()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
