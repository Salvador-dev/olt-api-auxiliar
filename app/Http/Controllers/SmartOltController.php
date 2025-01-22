<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SmartOltController extends Controller
{
    public function getOlts()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/get_olts');
        
            $data = json_decode(json_decode($response)[0]);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);   

        } catch (\Throwable $th) {

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }
    }

    public function getTemperatureAndUptime()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/get_olts_uptime_and_env_temperature');
        
            $data = json_decode(json_decode($response)[0]);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);   

        } catch (\Throwable $th) {

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }
    }

    public function getOnuTypes()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_onu_types_by_pon_type/gpon');
            
            $data = json_decode(json_decode($response)[0]);

            $array1 = $data->response;

            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_onu_types_by_pon_type/epon');
            
            $data = json_decode(json_decode($response)[0]);

            $array2 = $data->response;

            $array = array_merge($array1, $array2);
        
            return response()->json([
                'data' => $array,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getSpeedProfiles()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/get_speed_profiles');
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);   

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getUnconfiguredOnusByOlt($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/unconfigured_onus_for_olt/' . $id);
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getConfiguredOnusByOlt($id, $board = null, $port = null)
    {

        try {

            $url = env('SMART_OLT_API');

            $boardQuery = $board != null ? '/' . $board : '';
            $portQuery = $port != null ? '/' . $port : '';
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt3/get_all_onus_details/' . $id . $boardQuery . $portQuery);
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->onus);
        
            return response()->json([
                'data' => $data->onus,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            \Illuminate\Support\Facades\Log::debug($th);


            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getUnconfiguredOnus()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/unconfigured_onus/');
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($response);
        
            return response()->json([
                'data' => $data->onu_details,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            \Illuminate\Support\Facades\Log::debug($th);


            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOnuDetails($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_onu_details/' . $id);
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($response);
        
            return response()->json([
                'data' => $data->onu_details,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            \Illuminate\Support\Facades\Log::debug($th);


            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getZones()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/get_zones');
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOdbs()
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt/get_zones');
        
            $data = json_decode(json_decode($response)[0]);

            $zones = $data->response;

            $odbs = [];

            foreach ($zones as $data) {

                $url = env('SMART_OLT_API');
     
                $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_odbs/' . $data->id);
            
                $data = json_decode(json_decode($response)[0]);

                foreach ($data->response as $odb) {
                    array_push($odbs, $odb);
                }
            }

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $odbs,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOltPonPorts($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_olt_pon_ports_details/' . $id);
        
            $data = json_decode(json_decode($response)[0]);

            // $zones = $data->response;

            // $odbs = [];

            // foreach ($zones as $data) {

            //     $url = env('SMART_OLT_API');
     
            //     $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_odbs/' . $data->id);
            
            //     $data = json_decode(json_decode($response)[0]);

            //     foreach ($data->response as $odb) {
            //         array_push($odbs, $odb);
            //     }
            // }

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOltCardsById($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_olt_cards_details/' . $id);
        
            $data = json_decode(json_decode($response)[0]);

            // $zones = $data->response;

            // $odbs = [];

            // foreach ($zones as $data) {

            //     $url = env('SMART_OLT_API');
     
            //     $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_odbs/' . $data->id);
            
            //     $data = json_decode(json_decode($response)[0]);

            //     foreach ($data->response as $odb) {
            //         array_push($odbs, $odb);
            //     }
            // }

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOltUplinksById($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_olt_uplink_ports_details/' . $id);
        
            $data = json_decode(json_decode($response)[0]);

            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }

    public function getOltVlansById($id)
    {

        try {

            $url = env('SMART_OLT_API');
     
            $response = Http::retry(3, 500)->timeout(60)->get($url . '/olt2/get_vlans/' . $id);
        
            $data = json_decode(json_decode($response)[0]);


            \Illuminate\Support\Facades\Log::debug($data->response);
        
            return response()->json([
                'data' => $data->response,
                'status' => true
            ]);  

        } catch (\Throwable $th) {

            // VALIDAR CUANDO MANDA STRING CMAPO DE STATUS FALSE

            return response()->json([
                'data' => 'No se pudo conectar con Smart Olt...',
                'status' => false
            ]);           
        }

    }
}
