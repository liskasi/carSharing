<?php

namespace App\Http\Controllers;

use App\Models\rentedCar;
use App\Models\Car;
use Illuminate\Http\Request;

class RentedCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rentedCar = new rentedCar();
        $rentedCar->rentedStatus = "yes";
        $rentedCar->user_id = auth()->id();
        $rentedCar->car_id = $request->id;
        $rentedCar->save();
        $carsDB = rentedCar::where('user_id', '=',auth()->user()->id)->get();
        Car::where('id', $request->id)
        ->update(
            [
                'ifRented'=> "yes",
            ]
        );

        return view ('pages.rented', compact('carsDB'));
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        rentedCar::where('id', $request->id)
        ->update(
            [
                'rentedStatus'=> "no",
            ]
        );
        Car::where('id', $request->id)
        ->update(
            [
                'ifRented'=> "no",
            ]
        );
        return redirect('rented');
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
