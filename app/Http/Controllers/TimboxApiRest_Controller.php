<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\ApiRest;

class TimboxApiRest_Controller extends Controller
{

    public function buscarAcuse(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::buscarAcuse('user','password');

            // Buscar Acuse
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function buscarCfdi(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::buscarCfdi('user','password');
            
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function consultaLco(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::consultaLco('user','password');
            
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function consultaRfc(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::consultaRfc('user','password');
            
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function obtenerConsumo(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::obtenerConsumo('user','password');
            
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function timbrarCfdi(){
        try {
            
            // Get Api Key
            // ( user, password )
            $response = ApiRest::timbrarCfdi('user','password');
            
            echo $response;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
