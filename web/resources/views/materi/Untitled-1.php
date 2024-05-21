<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    // simpadadummy
    //bdasql
    public function test(){
        $url = 'https://fintech-dev.pactindo.com/api/v1/status/9360012900000000394';

        
        $auth = 'M-00004203';
        $content = 'application/json';
        $codeauth = 1;
        $now = new DateTime();
        
        $timestamp = $now->format('Y-m-d\TH:i:s.v+08:00');

        $pesan = "M-00004203|".$timestamp."|dNVYlJsj";
        $kode = "dNVYlJsj";
        $signature = hash_hmac('sha256', $pesan, $kode, true);

       
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("$auth"),
            'Content-Type' => $content,
            'Codeauth' => $codeauth,
            'Timestamp' => $timestamp,
            'Signature' => base64_encode("$signature")
        ];

        echo "<pre>";
        print_r($headers);
        echo "</pre>";

        
        $response = Http::withHeaders($headers)->get($url);

        return view('hasil', ['respondata' => json_decode($response->body(), true)]);
    }

    public function index(){
        return view('utama');
    }

    public function hasil(Request $req){
        $url = 'https://fintech-dev.pactindo.com/api/v1/charge';

        
        $auth = 'M-00004203';
        $content = 'application/json';
        $codeauth = 1;
        $now = new DateTime();
        
        $timestamp = $now->format('Y-m-d\TH:i:s.v+08:00');
        $amount = 100000;

        $pesan = "M-00004203|".$timestamp."|".$amount."|dNVYlJsj";
        $kode = "dNVYlJsj";
        $signature = hash_hmac('sha256', $pesan, $kode, true);
        $data = array(
            "orderId" => $req->nop,
            "terminalPac" => "MT-PAC4421",
            "grossAmount" => $amount,
            "paymentType" => "QRis",
            "acqCode" => "000",
            "customerDetail" => array(
                "phone" => "08000000000",
                "email" => "sample@sample.co",
                "name" => "Sample Doe"
            )
        );
        $json_data = json_encode($data);
       
        $headers = [
            'Authorization' => 'Basic ' . base64_encode("$auth"),
            'Content-Type' => $content,
            'Codeauth' => $codeauth,
            'Timestamp' => $timestamp,
            'Signature' => base64_encode("$signature")
        ];
        
        $response = Http::withHeaders($headers)->withBody($json_data, 'application/json')->post($url);

        return view('hasil', ['respondata' => json_decode($response->body())]);
    }
}
