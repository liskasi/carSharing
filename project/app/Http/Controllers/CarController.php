<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carsDB = Car::orderBy('id')->where('status','=','Approved')->get();
        return view('home',  compact('carsDB'));
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
        $rules = array(
            'carMake' => 'required',
            'carModel' => 'required',
            'PhoneNumber' => 'required|digits:11',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required',
            'carArea' => 'required',
            
        );
        $this->validate($request,$rules);
        $car = new Car();
        $car->carMake = $request->carMake;
        $car->carModel =  $request->carModel;
        $car->PhoneNumber = $request->PhoneNumber;
        $car->price = $request->price;
        $car->username = auth()->user()->id;
        $car->documents = auth()->user()->name;
        $car->description = $request->description;
        $car->carArea = $request->carArea;
        $car->photo = $request->photo;

        // Storage::put($car->photo,$contents);
        // Storage::put($car->photo,$resource);
        // print_r(Storage::url('IMG_3770.JPG'));

        //print_r($request->hasFile());
        // print_r("aaa");
        //$extension = $car->photo->getClientOriginalExtension();

        //Storage::disk('public')->put($car->photo->getFilename().'.'.$extension,  File::get($car->photo));
        $car->save();
        $carsDB = DB::table('cars')->where('status','=','Approved')->get();
        return redirect()->route('home', compact('carsDB')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('car', compact('car'));
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
    public function filter(Request $request)
    {
        //return view('profile.edit');
        $query=Car::get();
        //$query = DB::table('cars')->get()->paginate(15);
        if ($request->carMake != null)
        {
            $query = $query->whereIn('carMake',$request->carMake);
        }
        if ($request->carModel != null)
        {
            $query = $query->whereIn('carModel',$request->carModel);
        }
        if ($request->price != null)
        {
            $query = $query->whereIn('price',$request->price);
        }
        if ($request->carArea != null)
        {
            $query = $query->whereIn('carArea',$request->carArea);
        }
        $carsDB = $query;
        return view('home', compact('carsDB'));
    }

    public function guestfilter(Request $request)
    {
        //return view('profile.edit');
        $query=Car::get();
        //$query = DB::table('cars')->get()->paginate(15);
        if ($request->carMake != null)
        {
            $query = $query->whereIn('carMake',$request->carMake);
        }
        if ($request->carModel != null)
        {
            $query = $query->whereIn('carModel',$request->carModel);
        }
        if ($request->price != null)
        {
            $query = $query->whereIn('price',$request->price);
        }
        if ($request->carArea != null)
        {
            $query = $query->whereIn('carArea',$request->carArea);
        }
        $carsDB = $query;
        return view('homeguest', compact('carsDB'));
    }

    public function status(Request $request)
    {
        $car = DB::table('cars')->where('id', $request->id)->first();
        $st = $car->status;
        if($st == "Under consideration")
        {
            if ($request->status == "Approve")
            {
                DB::table('cars')->where('id', $request->id)->update(['status'=>'Approved']);
            }
            else if ($request->status == "Reject")
            {
                DB::table('cars')->where('id', $request->id)->update(['status'=>'Rejected']);
            }
        }
        else if($st == "Approved")
        {
            DB::table('cars')->where('id', $request->id)->delete();
        }
        return redirect('admin');
    }

    public function change(Request $request)
    {
        if($request->action == "Edit")
        {

        }
        else if($request->action == "Delete")
        {
            DB::table('cars')->where('id', $request->id)->delete();
        }        
        return redirect('myCars');
    }
}
