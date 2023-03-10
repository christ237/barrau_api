<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Payment extends Model
{
    use HasFactory;


    protected $fillable = [
        'amount',
        'espected',
        'reserve',
        'profile_id'
    ];



    public function user()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
