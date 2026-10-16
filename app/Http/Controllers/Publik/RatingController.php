<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // $ip = $request->ip();

        // $cek = rating::where('ip',$ip)->first();

        // if($cek){
        //     return response()->json([
        //         'status'=>false
        //     ]);
        // }

        rating::create([
            'rating' => $request->rating,
            'ip' => $request->ip()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Rating berhasil disimpan'
        ],200);

    }
}
