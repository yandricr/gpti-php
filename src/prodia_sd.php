<?php
namespace gpti;

require_once(__DIR__ . "/util.php");
use api;

class prodia_sd extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "model" => "",
        "sampling_method" => "",
        "sampling_steps" => "",
        "width" => "",
        "height"=> "",
        "cfg_scale" => ""
    ))
    {
        $payload = array(
            "prompt" => "",
            "data" => array(
                "prompt_negative" => "",
                "model" => "absolutereality_v181.safetensors [3d9d4d2b]",
                "sampling_method" => "DPM++ 2M Karras",
                "sampling_steps" => 25,
                "width" => 512,
                "height"=> 512,
                "cfg_scale" => 7
            ),
            "model" => "prodia-stablediffusion"
        );

        try {
            $pro = "";
            $pdata = array();

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            if(isset($data) && is_array($data)){
                $pdata = $data;
            } else {
                $pdata = array(
                    "prompt_negative" => "",
                    "model" => "absolutereality_v181.safetensors [3d9d4d2b]",
                    "sampling_method" => "DPM++ 2M Karras",
                    "sampling_steps" => 25,
                    "width" => 512,
                    "height"=> 512,
                    "cfg_scale" => 7
                );
            }

            $payload = array(
                "prompt" => $pro,
                "data" => $pdata,
                "model" => "prodia-stablediffusion"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "data" => array(
                    "prompt_negative" => "",
                    "model" => "absolutereality_v181.safetensors [3d9d4d2b]",
                    "sampling_method" => "DPM++ 2M Karras",
                    "sampling_steps" => 25,
                    "width" => 512,
                    "height"=> 512,
                    "cfg_scale" => 7
                ),
                "model" => "prodia-stablediffusion"
            );
        }

        $this->payld = $payload;
    }

    public function setAPI($user="", $secret=""){
        try {
            if(gettype($user) === "string" && strlen(trim($user)) > 0){
                $this->user_ = $user;
            } else {
                $this->user_ = null;
            }

            if(gettype($secret) === "string" && strlen(trim($secret)) > 0){
                $this->secret_ = $secret;
            } else {
                $this->secret_ = null;
            }
        } catch (\Throwable $th) {
            $this->user_ = null;
            $this->secret_ = null;
        }
    }

    public function execute(){
        try {
            $this->ex($this->user_, $this->secret_, $this->payld, 'https://nexra.aryahcr.cc/api/image/complements');
            $this->error_ = $this->err();
            $this->result_ = $this->res();
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

    public function result()
    {
        return $this->result_;
    }

    public function error()
    {
        return $this->error_;
    }
}

?>