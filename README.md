<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1 align:="center">Integración Laravel - Timbox Web Service API REST</h1>

<p> En el presente documento se encuentra la documentación correspondiente a los snippets de código desarrollados utilizando el framework Laravel v8.5 así como también las librerías externas utilizadas para realizar las solicitudes HTTP correspondientes a la API REST del proyecto de Web Service de Timbox.</p>

<p>Los métodos desarrollados son los siguientes:</p>
<ul>
    <li>timbrar_cfdi</li>
    <li>buscar_cfdi</li>
    <li>buscar_acuses</li>
    <li>recuperar_comprobante</li>
    <li>obtener_consumo</li>
    <li>consulta_lco</li>
    <li>consulta_lrfc</li>
</ul> 

<p> Para realizar las solicitudes HTTP en laravel debe agregarse la siguiente línea: </p>

```
use Illuminate\Support\Facades\Http;
```
<h4>Autenticación Básica:</h4>

<p>Se requiere generar una API-KEY para poder hacer peticiones al servicio, por lo que deben proporcionar las credenciales requeridas, usuario y contraseña del dashboard de Timbox.</p>

URL de autenticación: https://staging.ws.timbox.com.mx/api/auth

<p>LLamando la siguiente función regresará un objeto del cual se puede extraer la API KEY.</p>

```
private static function getApiKey($user, $password){
       try {
           return Http::withBasicAuth($user, $password)->get('https://staging.ws.timbox.com.mx/api/auth');
       } catch (\Throwable $th) {
           throw $th;
       }
   }
```

<p>Todos los métodos siguientes se encuentran en app/models/ApiRest.php</p>

<h4>Método Buscar_Acuse:</h4>

```
public static function buscarAcuse($user, $password){
       try {
           // Get Api Key
           $auth = ApiRest::getApiKey($user, $password);
           $APIKEY = $auth['api_key'];

           // Parámetros
           //  - Arreglo de UUIDs
           $uuid = "12345X12-0BEF-4919-9B44-7F8BFE44D451, 4455B22-56EF-4849-9B33-7F8GDR44F498";
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
```

<h4>Método Buscar_CFDI:</h4>

```
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
```

<h4>Método Obtener_Consumo:</h4>

```
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
```

<h4>Método Recuperar_Comprobante:</h4>

```
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
```

<h4>Método Consulta_RFC:</h4>

```
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
```

<h4>Método Consulta_LCO:</h4>

```
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
```
<h4>Método Timbrar_CFDI:</h4>

```
public static function timbrarCfdi($user, $password){
       try {
           // Get Api Key
           $auth = ApiRest::getApiKey($user, $password);
           $APIKEY = $auth['api_key'];
 
           // Leer archivo CFDI
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

```



