<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LawyerController extends Controller
{


    public function index(){
     return $profiles = Profile::paginate(200);

    }




    public function search(Request $request){

           //validate fields
           $attrs = $request->validate([
            'name' => 'required|string'

        ]);

         $profiles = Profile::where('name', 'like', '%'.$attrs['name'].'%')->paginate(20);

        return response()->json($profiles, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }


  /*  public function inputPasswords(){

        $profiles = Profile::all();

        foreach($profiles as $profile){
            $matricule = $profile->matricule;
            $matricule_hash  = bcrypt($matricule);
            Profile::where('matricule', $matricule)->update(array('password' => $matricule_hash));
        }

    }*/



    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'password' => 'required|string',
            'matricule' => 'required|string',

        ]);

       // Get profile with matricule
       $profile = Profile::where('matricule', $attrs['matricule'])->first();


       // If user found with this matricule

       if($profile != null){

        // Check if user already has a password
        if($profile->password != null){

        // If user has a password, attemp to login
            if(!Auth::guard('profile')->attempt([
                'matricule' => $request->matricule,
                'password' => $attrs['password']
            ])){
                return response([
                    'message' => 'Invalid Credentials'
                ], 403);

            }

            return $profile;

           }


            return $profile;

       }

       // If no user found with this matricule return this error

       return response([
        'message' => 'Invalid credentials.'
    ], 403);


    }



    public function lawyertown(Request $request){

        $attrs = $request->validate([
            'address'=> 'string|required',
        ]);

        return Profile::where('address', 'like', '%'.$attrs['address'].'%')->get();
    }


    public function contributions(Request $request){

        $attrs = $request->validate([
            'id'=> 'string|required',
        ]);

       return Payment::where('profile_id', '=', $attrs['id'])->get();
    }

    public function settled(){

        $profiles = Profile::orderBy('id')->withCount('payments')->paginate(10);
        $users = [];
        $payments = 0;

        return $profiles;


        foreach($profiles as $profile){


            if($profile['payments_count'] >= 0){

                $payments = Payment::where('profile_id' ,'=', $profile['id']);
                //$profile = Profile::with('payment', $payments);

                $lawyer = [
                    'id' => $profile['id'],
                    'name' => $profile['name'],
                    'matricule' => $profile['matricule'],
                    'slug' => $profile['slug'],
                    'address' => $profile['address'],
                    'phone' => $profile['phone'],
                    'email' => $profile['email'],
                    'payment_count' =>$profile['payments_count'],
                    'payment_sum' => $payments->sum('amount') - 0,
                    'prestationDate'  => $profile['prestationDate'],
                    'reserve_sum'  => 100000 - $payments->sum('amount')
                ];

                array_push($users, $lawyer);
            }


        }



    }


    public function store(Request $request)
    {
              //validate fields
              $attrs = $request->validate([
                'name'=> 'required|string',
                'address'=> 'required|string',
                'phone'=> 'required|string',
                'email'=> 'required|string',
                'matricule'=> 'required|string',
                'prestationDate'=> 'required|string',
                'slug'=> 'string'
            ]);

         //   $image = $this->saveImage($request->image, 'posts');

            $lawyer =Profile::create([
                'name'=>  $attrs['name'],
                'address'=> $attrs['address'],
                'phone'=> $attrs['phone'],
                'email'=> $attrs['email'],
                'matricule'=> $attrs['matricule'],
                'prestationDate'=> $attrs['prestationDate'],
                'slug'=> $attrs['slug'],
                'password' => ''
            ]);

            // for now skip for post image

            return response([
                'message' => 'Added Successfully!',
                'lawyer' => $lawyer,
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request){
        $var = $request->validate([
            'id'=> 'string|required',
        ]);

        return Profile::where('id', $var['id'])->first();

    }


        // Update lawyer image
        public function updateLawyerPhoto(Request $request)
        {
              //validate fields
              $attrs = $request->validate([
                'id'=> 'string',
            ]);

        $lawyer = Profile::find($attrs[ 'id']);

        $image = $this->saveImage($request->image, 'profile_images');

            if( !$lawyer)
            {
                return response([
                    'message' => 'Lawyer not found.'
                ], 403);
            }

                $lawyer->update([
                    'image'=>  $image,
                ]);

                return response([
                    'message' => 'Updated Successfully!',
                    'lawyer' => $lawyer,
                ], 200);
        }






    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
          //validate fields
          $attrs = $request->validate([
            'id'=> 'string',
        ]);


        $image = $this->saveImage($request->image, 'profile_images');


            $lawyer = Profile::find($attrs[ 'id']);


        if(! $lawyer)
        {
            return response([
                'message' => 'Lawyer not found.'
            ], 403);
        }


        if(strlen( $request->image) === 0){

            $lawyer->update([
                'address'=> $request->address,
                'name'=>   $request->name,
                'phone'=>  $request->phone,
                'email'=>  $request->email
            ]);
        }else{
            $lawyer->update([
                'address'=> $request->address,
                'name'=>   $request->name,
                'phone'=>  $request->phone,
                'email'=>  $request->email,
                'image' => $image
            ]);

        }

            return response([
                'message' => 'Updated Successfully!',
                'lawyer' => $lawyer,
            ], 200);
    }




    // Update lawyer phone
    public function updateLawyerPhone(Request $request)
    {
          //validate fields
          $attrs = $request->validate([
            'id'=> 'string',
        ]);

    $lawyer = Profile::find($attrs[ 'id']);
        if(! $lawyer)
        {
            return response([
                'message' => 'Lawyer not found.'
            ], 403);
        }

            $lawyer->update([
                'phone'=>  $request->phone,
            ]);

            return response([
                'message' => 'Updated Successfully!',
                'lawyer' => $lawyer,
            ], 200);
    }




    // Update lawyer phone
    public function updateLawyerEmail(Request $request)
    {
          //validate fields
          $attrs = $request->validate([
            'id'=> 'string',
        ]);

    $lawyer = Profile::find($attrs[ 'id']);
        if(! $lawyer)
        {
            return response([
                'message' => 'Lawyer not found.'
            ], 403);
        }

            $lawyer->update([
                'email'=>  $request->email,
            ]);

            return response([
                'message' => 'Updated Successfully!',
                'lawyer' => $lawyer,
            ], 200);
    }




    // Update lawyer phone
    public function updateLawyerAddress(Request $request)
    {
          //validate fields
          $attrs = $request->validate([
            'id'=> 'string',
        ]);

    $lawyer = Profile::find($attrs[ 'id']);
        if(! $lawyer)
        {
            return response([
                'message' => 'Lawyer not found.'
            ], 403);
        }

            $lawyer->update([
                'address'=>  $request->address,
            ]);

            return response([
                'message' => 'Updated Successfully!',
                'lawyer' => $lawyer,
            ], 200);
    }



    public function updatePassword(Request $request)
    {


        $attrs = $request->validate([
            'id'=> 'string',
            'password' => 'string'
        ]);



        $lawyer = Profile::find($attrs['id']);

        if(! $lawyer)
        {
            return response([
                'message' => 'Lawyer not found.'
            ], 403);
        }



        $hash = bcrypt( $attrs['password']);

            $lawyer->update([
                'password'=> $hash
            ]);



            return $lawyer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
