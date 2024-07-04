<?php
namespace gpti;
require "./vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

use Exception;
error_reporting(0);

class llama2 {
    private $error = null;
    private $result = null;
    private $stream_data = null;

    public function __construct($messages=[], $data=array(
        "system_message" => "",
        "temperature" => 0.9,
        "max_tokens" => 4096,
        "top_p" => 0.6,
        "repetition_penalty" => 1.2
    ), $markdown=false, $stream=false)
    {
        $payload = array(
            "messages" => [],
            "model" => "llama2",
            "data" => array(
                "system_message" => "",
                "temperature" => 0.9,
                "max_tokens" => 4096,
                "top_p" => 0.6,
                "repetition_penalty" => 1.2
            ),
            "markdown" => false,
            "stream" => false
        );

        $str = false;
        try {
            $mess = [];
            $system_message = "";
            $temperature = 0.9;
            $max_tokens = 4096;
            $top_p = 0.6;
            $repetition_penalty = 1.2;
            $mark = false;

            if(isset($messages)){
                $mess = $messages;
            } else {
                $mess = [];
            }

            if(isset($data) && isset($data["system_message"])){
                $system_message = $data["system_message"];
            } else {
                $system_message = "";
            }

            if(isset($data) && isset($data["temperature"])){
                $temperature = $data["temperature"];
            } else {
                $temperature = 0.9;
            }

            if(isset($data) && isset($data["max_tokens"])){
                $max_tokens = $data["max_tokens"];
            } else {
                $max_tokens = 4096;
            }

            if(isset($data) && isset($data["top_p"])){
                $top_p = $data["top_p"];
            } else {
                $top_p = 0.6;
            }

            if(isset($data) && isset($data["repetition_penalty"])){
                $repetition_penalty = $data["repetition_penalty"];
            } else {
                $repetition_penalty = 1.2;
            }

            if(isset($data) && isset($data["repetition_penalty"])){
                $repetition_penalty = $data["repetition_penalty"];
            } else {
                $repetition_penalty = 1.2;
            }

            if(isset($markdown)){
                $mark = $markdown;
            } else {
                $mark = false;
            }

            if(isset($stream)){
                if($stream == true){
                    $str = true;
                } else {
                    $str = false;
                }
            } else {
                $str = false;
            }

            $payload = array(
                "messages" => $mess,
                "model" => "llama2",
                "data" => array(
                    "system_message" => $system_message,
                    "temperature" => $temperature,
                    "max_tokens" => $max_tokens,
                    "top_p" => $top_p,
                    "repetition_penalty" => $repetition_penalty
                ),
                "markdown" => $mark,
                "stream" => $str
            );
        } catch(Exception $e){
            $payload = array(
                "messages" => [],
                "model" => "llama2",
                "data" => array(
                    "system_message" => "",
                    "temperature" => 0.9,
                    "max_tokens" => 4096,
                    "top_p" => 0.6,
                    "repetition_penalty" => 1.2
                ),
                "markdown" => false,
                "stream" => false
            );
        }

        if($str != true){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://nexra.aryahcr.cc/api/chat/complements');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            $response = curl_exec($ch);

            if ($response === false) {
                $this->error = array(
                    "code" => 500,
                    "status" => false,
                    "error" => "INTERNAL_SERVER_ERROR",
                    "message" => "general (unknown) error"
                );
                $this->result = null;
            } else {
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
                    $this->error = array(
                        "code" => 500,
                        "status" => false,
                        "error" => "INTERNAL_SERVER_ERROR",
                        "message" => "general (unknown) error"
                    );
                    $this->result = null;
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
                    } catch(Exception $e){
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
                    $this->error = $err;
                    $this->result = null;
                } else {
                    $this->result = $result;
                    $this->error = null;
                }
            }

            curl_close($ch);
        } else {
            $client = new Client([
                'base_uri' => 'https://nexra.aryahcr.cc/',
            ]);
            
            $body = [
                'json' => $payload,
                'stream' => true
            ];
            
            $response = $client->request('POST', 'api/chat/complements', $body);

            if($response->getStatusCode() == 200){
                $bodyStream = $response->getBody();

                $this->error = null;
                $this->result = null;
                $this->stream_data = $bodyStream;
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
                } catch(Exception $e){
                    $jserr = array(
                        "code" => 500,
                        "status" => false,
                        "error" => "INTERNAL_SERVER_ERROR",
                        "message" => "general (unknown) error"
                    );
                }

                $this->result = null;
                $this->stream_data = null;
                $this->error = $jserr;
            }
        }
    }

    public function stream()
    {
        if($this->error == null && $this->stream_data != null){
            $tmp = null;
            $convert = "";
            $err = null;
            while (!$this->stream_data->eof()) {
                $chunk = $this->stream_data->read(1024);
            
                $chunk = explode("", $chunk);
            
                foreach($chunk as $data){
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
                                yield $result;
                            } else {
                                $err = $result;
                                yield $err;
                            }
                        }
                    }
                }
            }
        } else {
            yield json_decode('{"message":null,"original":null,"finish":true,"error":false}');
        }
    }

    public function result()
    {
        if($this->stream_data != null){
            return null;
        } else {
            return $this->result;
        }
    }

    public function error()
    {
        if($this->error == null){
            return $this->error;
        } else {
            if(is_array($this->error)){
                return json_decode(json_encode($this->error));
            } else {
                return $this->error;
            }
        }
    }
}
?>