<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ApiRest extends Model
{
    use HasFactory;

    private static function getApiKey($user, $password){
        try {
            return Http::withBasicAuth($user, $password)->get('https://staging.ws.timbox.com.mx/api/auth');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function buscarAcuse($user, $password){
        try {
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];

            // Parámetros
            //  - Arreglo de UUIDs 
            $uuid = "44235C12-0BEF-4919-9B44-7F8BFE44D451, 4455B22-56EF-4849-9B33-7F8GDR44F498";
            $params = "?parametros_acuse[uuids][uuid][]=".$uuid;

            // Buscar Acuse
            $res = Http::withHeaders([
                'x-api-key' => $APIKEY
            ])->get('https://staging.ws.timbox.com.mx/api/buscar_acuse_recepcion'.$params);
            
            // Respuesta
            echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function buscarCfdi($user, $password){
        try {
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];

            // Parámetros 
            $uuid = "44235C12-0BEF-4919-9B44-7F8BFE44D451";
            $params = "?parametros_cfdis[uuid]=".$uuid;

            // Buscar Acuse
            $res = Http::withHeaders([
                'x-api-key' => $APIKEY
            ])->get('https://staging.ws.timbox.com.mx/api/buscar_cfdi'.$params);
            
            // Respuesta
            echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function consultaLco($user, $password){
        try {    
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];
 
            // Parámetros 
            $rfc = "?rfc=ROPS670907FU1";
	    	$n_cert = "no_certificado=00001000000407219892";

            $params = $rfc."&".$n_cert;
 
             // Buscar Acuse
             $res = Http::withHeaders([
                 'x-api-key' => $APIKEY
             ])->get('https://staging.ws.timbox.com.mx/api/consulta_lco'.$params);
             
             // Respuesta
             echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function consultaRfc($user, $password){
        try {    
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];
 
            // Parámetros 
            $rfc = "?rfc=ROPS670907FU1";

            $params = $rfc;
 
             // Buscar Acuse
             $res = Http::withHeaders([
                 'x-api-key' => $APIKEY
             ])->get('https://staging.ws.timbox.com.mx/api/consulta_rfc'.$params);
             
             // Respuesta
             echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function obtenerConsumo($user, $password){
        try {    
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];
 
            // Buscar Acuse
            $res = Http::withHeaders([
                'x-api-key' => $APIKEY,
                'Content-Type' => "application/json"
            ])->get('https://staging.ws.timbox.com.mx/api/obtener_consumo');
             
            // Respuesta
            echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function recuperarComprobante($user, $password){
        try {    
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];
 
            // Buscar Acuse
            $res = Http::withHeaders([
                'x-api-key' => $APIKEY,
                'Content-Type' => "application/json"
            ])->get('https://staging.ws.timbox.com.mx/api/recuperar_comprobante');
             
            // Respuesta
            echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function timbrarCfdi($user, $password){
        try {
            // Get Api Key
            $auth = ApiRest::getApiKey($user, $password);
            $APIKEY = $auth['api_key'];

            // Leer CFDI
            $file = Storage::disk('Files')->get('cfdi_33.xml');
            
            // Convertir Cfdi a Base64
            $file_64 = base64_encode($file);
           

            // Buscar Acuse
            $res = Http::withHeaders([
                'x-api-key' => $APIKEY,
                'Content-Type' => "application/json"
            ])->post('https://staging.ws.timbox.com.mx/api/timbrar_cfdi',[
                'sxml' => $file_64
            ]);
             
            // Respuesta
            echo $res;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}