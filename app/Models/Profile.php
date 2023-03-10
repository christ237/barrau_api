<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Payment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profile extends  Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'matricule',
        'slug',
        'prestationDate',
        'password',
        'image'
    ];


    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
