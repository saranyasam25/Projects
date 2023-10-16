<?php

namespace App\Http\Controllers;

use App\CarDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CarDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $datas = CarDetails::get()->toArray();
            // dd($datas);
            return view('dashboard', compact('datas'));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=> $th,
            ], 500);
        }
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
        try {
            $validatedData = $request->validate([
                'year'      => "required",
                'model'     => 'required',
                'color'     => "required",
                'mileage'   => "required",
                'image'     => "required",
                'location'  => "required",
            ]);

            $year = $request->year;
            $model = $request->model;
            $color = $request->color;
            $mileage = $request->mileage;
            $location = $request->location;

            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileMimeType = $file->getClientMimeType();

            $file->storeAs('public', $fileName);

            $create = CarDetails::create([
                'year'      => $year,
                'model'     => $model,
                'color'     => $color,
                'mileage'   => $mileage,
                'image'     => $fileName,
                'location'  => $location,
            ]);

            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=> $th,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarDetails  $carDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CarDetails $carDetails, $id)
    {
        $results = CarDetails::where('id', $id)->get()->toArray();
        return view('car_view', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarDetails  $carDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CarDetails $carDetails, $id)
    {
        // try {
            $validatedData = $request->validate([
                'year'      => "required",
                'model'     => 'required',
                'color'     => "required",
                'mileage'   => "required",
                'image'     => "required",
                'location'  => "required",
            ]);

            // dd($id);
            $year = $request->year;
            $model = $request->model;
            $color = $request->color;
            $mileage = $request->mileage;
            $location = $request->location;

            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileMimeType = $file->getClientMimeType();

            $file->storeAs('public', $fileName);

            $create = CarDetails::where('id', $id)->update([
                'year'      => $year,
                'model'     => $model,
                'color'     => $color,
                'mileage'   => $mileage,
                'image'     => $fileName,
                'location'  => $location,
            ]);

            return redirect('/dashboard');
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message'=> $th,
        //     ], 500);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarDetails  $carDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarDetails $carDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarDetails  $carDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CarDetails $carDetails)
    {
        $id = $request->id;
        $results = CarDetails::where('id', $id)->delete();
        return true;
    }

    public function editForm(Request $request, CarDetails $carDetails, $id)
    {
        $results = CarDetails::where('id', $id)->get()->toArray();
        return view('edit_form', compact('results'));
    }
}
