<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Payment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       //validate fields
          $attrs = $request->validate([
            'amount' => 'required|integer',
            'espected' => 'required|string',
            'reserve' => 'required|string',
            'profile_id'  => 'required|string',
        ]);

        //create user
        $payment = Payment::create([
            'amount' => $attrs['amount'],
            'espected' => $attrs['espected'],
            'reserve' => $attrs['reserve'],
            'profile_id'  => $attrs['profile_id']

        ]);

        //return user & token in response
        return response([
            'payment' => $payment,
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
