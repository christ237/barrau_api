<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Payment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mail;
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
        'is_upToDate',
        'image'
    ];


    public function payments(){
        return $this->hasMany(Payment::class);
    }


    public  static function sendMail($employee, $pdf){


        $filename = $employee->name. time().'.pdf';

      $path =  \Storage::put('public/attestations/'.$filename,$pdf->output());
       \Storage::put($path,$pdf->output());


       $data['name'] = $employee->name;
       $data['email'] = $employee->email;


       Mail::send('pdf_view', $data, function ($message) use($employee, $pdf, $path){
           $message->from('georgefack237@gmail.com', env('APP_NAME'));
           $message->to([$employee->email, 'georgefack237@gmail.com'])->subject('Subject')
           ->attachData($pdf->output(), $path, [
              'mime' => 'application/pdf',
              'as' => $employee->name. '.'.'pdf'
           ]);
       });

      }
}
