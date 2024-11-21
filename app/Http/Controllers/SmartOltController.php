<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmartOltController extends Controller
{
    public function getOlts()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::get($url . '/olt/get_olts');
        
            $data = json_decode(json_decode($response)[0]);
        
            return response()->json([
                'data' => $data->response
            ]);   

        } catch (\Throwable $th) {

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...'
            ]);           
        }
    }

    public function getSpeedProfiles()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::get($url . '/olt/get_speed_profiles');
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response
            ]);   

        } catch (\Throwable $th) {

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...'
            ]);           
        }

    }
}
