<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
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
        $carsDB = DB::table('cars')->where('status','=','Approved')->get();
        return view ('home', ['carsDB' => $carsDB]);
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
            'PhoneNumber' => 'required|digits:8',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required',
            'documents' => 'required',
            'carArea' => 'required',
            
        );
        $this->validate($request,$rules);
        $car = new Car();
        $car->carMake = $request->carMake;
        $car->carModel =  $request->carModel;
        $car->PhoneNumber = $request->PhoneNumber;
        $car->price = $request->price;
        $car->user_id = auth()->user()->id;
        $car->description = $request->description;
        $car->carArea = $request->carArea;
        //$car->photo = $request->photo;
        if ($request->hasFile('photo'))
        {
            $dest_path = 'public/images';
            $photo = $request->file('photo');
            $photo_name = $photo->getClientOriginalName();
            $path = $request->file('photo')->storeAs($dest_path,$photo_name);
            $car->photo = $photo_name;
        }
        if ($request->hasFile('documents'))
        {
            $dest_path = 'public/images';
            $doc = $request->file('documents');
            $doc_name = $doc->getClientOriginalName();
            $path = $request->file('documents')->storeAs($dest_path,$photo_name);
            $car->documents = $doc_name;
        }


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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $car)
    {
        $rules = array(
            'carMake' => 'required',
            'carModel' => 'required',
            'PhoneNumber' => 'required|digits:8',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required',
            'carArea' => 'required',
        );
        $this->validate($request,$rules);

        if ($request->hasFile('photo'))
        {
            $dest_path = 'public/images';
            $photo = $request->file('photo');
            $photo_name = $photo->getClientOriginalName();
            $path = $request->file('photo')->storeAs($dest_path,$photo_name);
            DB::table('cars')->where('id', $car)->update(['photo'=> $photo_name]);

        }

        // DB::table('cars')->where('id', $car)->update($request->all());

        DB::table('cars')
              ->where('id', $car)
              ->update(
                  [
                        'carMake'=> $request->carMake,
                        'carModel'=> $request->carModel,
                        'PhoneNumber' => $request->PhoneNumber,
                        'price' => $request->price,
                        // 'documents' => $request->documents,
                        'description' => $request->description,
                        'carArea' => $request->carArea,
                        'photo'=> $photo_name
                      ]
              );

       return redirect('mycar'); 

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
        $search= $request->search;

        if ($search != null) {
            $query=Car::query()
            ->where('status','=','Approved')
            ->where('carMake', 'LIKE', "%{$search}%")
            ->orWhere('carModel', 'LIKE', "%{$search}%")
            ->orWhere('PhoneNumber', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
            ->orWhere('user_id', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('carArea', 'LIKE', "%{$search}%")
            ->get();
        } 
        else
        {
            $query=Car::all()->where('status','=','Approved');
        }

        //return view('profile.edit');
        //$query = DB::table('cars')->get()->paginate(15);
        if ($request->carMake != null)
        {
            $query = $query->whereIn('carMake',$request->carMake);
        }
        if ($request->carModel != null)
        {
            $query = $query->whereIn('carModel',$request->carModel);
        }
        if ($request->priceFrom != null)
        {
            $query = $query->where('price','>=',$request->priceFrom);
        }
        if ($request->priceTo != null)
        {
            $query = $query->where('price','<=',$request->priceTo);
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
           //print_r($request->id);
            $car = Car::where('id', $request->id)->first();
            return view('pages.editCar', compact('car'));
        }
        else if($request->action == "Delete")
        {
            DB::table('cars')->where('id', $request->id)->delete();
        }        
        return redirect('home');
    }

    public function viewusers(Request $request)
    {
        if (auth()->user()->id == 1)
        {
            $users = User::get();
            return view('users', compact('users'));
        }
        else
        {
            return redirect('home');
        }
    }

    // public function rented()
    // {
    //     return view('pages.rented');
    // }
    // public function rent(Request $request)
    // {
    //     If ($request->action =="rent")
    //     {
    //         DB::table('cars')->where('id', $request->id)->update(['ifRented'=>'yes']);
    //     }
    //     else if ($request->action =="return")
    //     {
    //         DB::table('cars')->where('id', $request->id)->update(['ifRented'=>'no']);
    //     }
    //     $carsDB = DB::table('cars')->where('user_id', '=',auth()->user()->id)->where('ifRented','=','yes')->get();
    //     return view ('pages.rented', compact('carsDB'));
    // }

}
