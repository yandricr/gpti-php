<?php

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr,0, $errno, $errfile, $errline);
});

require "./vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class api {
    private $result_ = null;
    private $error_ = null;

    protected function ex($user=null, $secret=null, $data=array(), $api){
        try {
            if($data != null){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    "x-nexra-user: $user",
                    "x-nexra-secret: $secret"
                ));
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                
                $curl_data = curl_exec($ch);
                $ht_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $hd_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                
                $response = substr($curl_data, $hd_size);

                if (curl_errno($ch)) {
                    $this->error_ = array(
                        "code" => 500,
                        "status" => false,
                        "error" => "INTERNAL_SERVER_ERROR",
                        "message" => "general (unknown) error"
                    );
                    $this->result_ = null;
                } else {
                    if(intval($ht_code) === 200){
                        try {
                            $err = null;
                            $result = null;
    
                            $js = null;
                            $count = -1;
                            for($i = 0; $i < strlen($response); $i++){
                                if($count <= -1){
                                    if($response[$i] === "{"){
                                        $count = $i;
                                    }
                                } else {
                                    break;
                                }
                            }
    
                            if($count <= -1){
                                $this->error_ = array(
                                    "code" => 500,
                                    "status" => false,
                                    "error" => "INTERNAL_SERVER_ERROR",
                                    "message" => "general (unknown) error"
                                );
                                $this->result_ = null;
                            } else {
                                try {
                                    $js = substr($response, $count);
                                    $js = json_decode($js);
                                    if(is_object($js) && $js->code != null && $js->code === 200 && $js->status != null && $js->status === true){
                                        $err = null;
                                        $result = $js;
                                    } else {
                                        $err = $js;
                                        $result = null;
                                    }
                                } catch(\Throwable $th){
                                    $err = array(
                                        "code" => 500,
                                        "status" => false,
                                        "error" => "INTERNAL_SERVER_ERROR",
                                        "message" => "general (unknown) error"
                                    );
                                    $result = null;
                                }
                            }
    
                            if($result === null && $err != null){
                                $this->error_ = $err;
                                $this->result_ = null;
                            } else if($err === null && $result != null){
                                $this->result_ = $result;
                                $this->error_ = null;
                            } else {
                                $this->error_ = array(
                                    "code" => 500,
                                    "status" => false,
                                    "error" => "INTERNAL_SERVER_ERROR",
                                    "message" => "general (unknown) error"
                                );
                                $this->result_ = null;
                            }
                        } catch (\Throwable $th) {
                            $this->error_ = array(
                                "code" => 500,
                                "status" => false,
                                "error" => "INTERNAL_SERVER_ERROR",
                                "message" => "general (unknown) error"
                            );
                            $this->result_ = null;
                        }
                    } else {
                        try {
                            $js = json_decode($response);
                            if(json_last_error() === JSON_ERROR_NONE){
                                $this->error_ = $js;
                                $this->result_ = null;
                            } else {
                                throw new \ErrorException("error");
                            }
                        } catch (\Throwable $th) {
                            $this->error_ = array(
                                "code" => 500,
                                "status" => false,
                                "error" => "INTERNAL_SERVER_ERROR",
                                "message" => "general (unknown) error"
                            );
                            $this->result_ = null;
                        }
                    }
                }

                curl_close($ch);
            } else {
                $this->error_ = array(
                    "code" => 500,
                    "status" => false,
                    "error" => "INTERNAL_SERVER_ERROR",
                    "message" => "general (unknown) error"
                );
                $this->result_ = null;
            }
        } catch (\Throwable $th) {
            $this->error_ = array(
                "code" => 500,
                "status" => false,
                "error" => "INTERNAL_SERVER_ERROR",
                "message" => "general (unknown) error"
            );
            $this->result_ = null;
        }
    }

    protected function res(){
        return $this->result_;
    }

    protected function err(){
        return $this->error_;
    }
}


class apistrm {
    private $result_ = null;
    private $error_ = null;
    private $strm_ = null;

    protected function ex($user=null, $secret=null, $data=array(), $api, $stm=false){
        try {
            if($data != null){
                if($stm == false){
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $api);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        "x-nexra-user: $user",
                        "x-nexra-secret: $secret"
                    ));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    
                    $curl_data = curl_exec($ch);
                    $ht_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $hd_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                    
                    $response = substr($curl_data, $hd_size);

                    if (curl_errno($ch)) {
                        $this->error_ = array(
                            "code" => 500,
                            "status" => false,
                            "error" => "INTERNAL_SERVER_ERROR",
                            "message" => "general (unknown) error"
                        );
                        $this->result_ = null;
                    } else {
                        if(intval($ht_code) === 200){
                            try {
                                $err = null;
                                $result = null;
        
                                $js = null;
                                $count = -1;
                                for($i = 0; $i < strlen($response); $i++){
                                    if($count <= -1){
                                        if($response[$i] === "{"){
                                            $count = $i;
                                        }
                                    } else {
                                        break;
                                    }
                                }
        
                                if($count <= -1){
                                    $this->error_ = array(
                                        "code" => 500,
                                        "status" => false,
                                        "error" => "INTERNAL_SERVER_ERROR",
                                        "message" => "general (unknown) error"
                                    );
                                    $this->result_ = null;
                                } else {
                                    try {
                                        $js = substr($response, $count);
                                        $js = json_decode($js);
                                        if(is_object($js) && $js->code != null && $js->code === 200 && $js->status != null && $js->status === true){
                                            $err = null;
                                            $result = $js;
                                        } else {
                                            $err = $js;
                                            $result = null;
                                        }
                                    } catch(\Throwable $th){
                                        $err = array(
                                            "code" => 500,
                                            "status" => false,
                                            "error" => "INTERNAL_SERVER_ERROR",
                                            "message" => "general (unknown) error"
                                        );
                                        $result = null;
                                    }
                                }
        
                                if($result === null && $err != null){
                                    $this->error_ = $err;
                                    $this->result_ = null;
                                } else if($err === null && $result != null){
                                    $this->result_ = $result;
                                    $this->error_ = null;
                                } else {
                                    $this->error_ = array(
                                        "code" => 500,
                                        "status" => false,
                                        "error" => "INTERNAL_SERVER_ERROR",
                                        "message" => "general (unknown) error"
                                    );
                                    $this->result_ = null;
                                }
                            } catch (\Throwable $th) {
                                $this->error_ = array(
                                    "code" => 500,
                                    "status" => false,
                                    "error" => "INTERNAL_SERVER_ERROR",
                                    "message" => "general (unknown) error"
                                );
                                $this->result_ = null;
                            }
                        } else {
                            try {
                                $js = json_decode($response);
                                if(json_last_error() === JSON_ERROR_NONE){
                                    $this->error_ = $js;
                                    $this->result_ = null;
                                } else {
                                    throw new \ErrorException("error");
                                }
                            } catch (\Throwable $th) {
                                $this->error_ = array(
                                    "code" => 500,
                                    "status" => false,
                                    "error" => "INTERNAL_SERVER_ERROR",
                                    "message" => "general (unknown) error"
                                );
                                $this->result_ = null;
                            }
                        }
                    }

                    curl_close($ch);
                } else {
                    $client = new Client([
                        'base_uri' => 'https://nexra.aryahcr.cc/',
                    ]);
                    
                    $body = [
                        'json' => $data,
                        'stream' => true
                    ];
                    
                    $response = $client->request('POST', 'api/chat/complements', $body);

                    if($response->getStatusCode() == 200){
                        $bodyStream = $response->getBody();
        
                        $this->error_ = null;
                        $this->result_ = null;
                        $this->strm_ = $bodyStream;
                    } else {
                        $bodyStream = $response->getBody()->getContents();
                        $jserr = array();
                        try {
                            $jserr = json_decode($bodyStream);
                            if(!is_object($jserr)){
                                $jserr = array(
                                    "code" => 500,
                                    "status" => false,
                                    "error" => "INTERNAL_SERVER_ERROR",
                                    "message" => "general (unknown) error"
                                );
                            };
                        } catch (\Throwable $th) {
                            $jserr = array(
                                "code" => 500,
                                "status" => false,
                                "error" => "INTERNAL_SERVER_ERROR",
                                "message" => "general (unknown) error"
                            );
                        }
        
                        $this->result_ = null;
                        $this->strm_ = null;
                        $this->error_ = $jserr;
                    }
                }
            } else {
                $this->error_ = array(
                    "code" => 500,
                    "status" => false,
                    "error" => "INTERNAL_SERVER_ERROR",
                    "message" => "general (unknown) error"
                );
                $this->result_ = null;
            }
        } catch (\Throwable $th) {
            $this->error_ = array(
                "code" => 500,
                "status" => false,
                "error" => "INTERNAL_SERVER_ERROR",
                "message" => "general (unknown) error"
            );
            $this->result_ = null;
        }
    }
    
    protected function strm(){
        try {
            if($this->error_ === null && $this->strm_ != null){
                $text = null;
                $tmp = null;
                $convert = "";
                $err = null;

                while (!$this->strm_->eof()) {
                    $chunk = $this->strm_->read(1024);
                
                    $chunk = explode("", $chunk);
                
                    foreach($chunk as $data){
                        try {
                            if($err === null){
                                $result = null;
                                $convert = json_decode($data);
                                if(is_object($convert)){
                                    $result = $data;
                                    $tmp = null;
                                } else {
                                    if($tmp == null){
                                        $tmp .= $data;
                                    } else {
                                        $convert = json_decode($tmp);
                                        if(is_object($convert)){
                                            $result = $tmp;
                                            $tmp = null;
                                        } else {
                                            $tmp .= $data;
                                            $convert = json_decode($tmp);
                                            if(is_object($convert)){
                                                $result = $tmp;
                                                $tmp = null;
                                            } else {
                                                $tmp = $tmp;
                                            }
                                        }
                                    }
                                }
                    
                                if($result != null){
                                    $result = json_decode($result);
                                    if(!isset($result->code) && !isset($result->status)){
                                        $text = $result;
                                        yield $text;
                                    } else {
                                        $err = $result;
                                        yield $err;
                                    }
                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }

                if($text == null){
                    $data_ = array(
                        "message" => null,
                        "original" => null,
                        "finish" => true,
                        "error" => true
                    );
                    $data_ = json_decode(json_encode($data_));

                    yield $data_;
                }
            } else {
                yield null;
            }
        } catch (\Throwable $th) {
            yield null;
        }
    }

    protected function res(){
        return $this->result_;
    }

    protected function err(){
        return $this->error_;
    }
}

?>