<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;

class ContributionController extends Controller
{

    public function index()
    {
        return Contribution::all();
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
            'yearly_contribution' => 'required|integer',
            'total_contribution' => 'required|integer',
            'amount_paid' => 'required|string',
            'profile_id'  => 'required|string',
            'balance'  => 'required|string',
            'year'  => 'required|string',

        ]);

        //create user
        $contribution = Contribution::create([
            'yearly_contribution' => $attrs['yearly_contribution'],
            'total_contribution' => $attrs['total_contribution'],
            'amount_paid' => $attrs['amount_paid'],
            'profile_id'  => $attrs['profile_id'],
            'balance'  => $attrs['balance'],
            'year'  => $attrs['year']

        ]);

        //return user & token in response
        return response([
            'payment' => $contribution,
        ], 200);

    }

}
