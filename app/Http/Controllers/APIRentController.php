<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use App\Models\Rent;

class APIRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRent=Rent::orderBy('created_at', 'desc')->get();
        $rooms=Room::all();
        return response()->json([
            'status'=>true,
            'message'=>'Get Data Sukses',
            'data'=>[
                $userRent
            ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'room_id' => 'required',
        'user_id' => 'required',
        'time_start_use' => 'required|date',
        'time_end_use' => 'required|date',
        'purpose' => 'required|max:250',
        ]);
        $validatedData['transaction_start'] = now();
        $validatedData['status'] = 'pending';
        $validatedData['transaction_end'] = null; 

        $rent = Rent::create($validatedData);
        return response()->json([
            'status'=>true,
            'message'=>'Create Data Sukses',
            'data'=>$rent    
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showRent = Rent::find($id);
        if($showRent){
            return response()->json([
            'status'=>true,
            'message'=>'Get Detail Data Sukses',
            'data'=>$showRent
        ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Get Detail Data Gagal'
            ]);
        }
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
        $findRent = Rent::find($id);
        if (empty($findRent)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
        $validatedData = $request->validate([
            'room_id' => 'required',
            'user_id' => 'required',
            'time_start_use' => 'required|date',
            'time_end_use' => 'required|date',
            'purpose' => 'required|max:250',
        ]);

        $validatedData['transaction_start'] = now();
        $validatedData['status'] = 'pending';
        $validatedData['transaction_end'] = null;

        $findRent->update($validatedData);
        return response()->json([
            'status' => true,
            'message' => 'Update Data Sukses',
            'data' => $findRent
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findRent = Rent::find($id);
        if (empty($findRent)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
        
        $findRent->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete Data Sukses'
        ]);
    }
}
