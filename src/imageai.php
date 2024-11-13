<?php
namespace gpti;

require_once(__DIR__ . "/util.php");
use api;

class imageai extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $model="", $response="url", $data=[])
    {
        $payload = array(
            "prompt" => "",
            "model" => "",
            "response" => "url",
            "data" => []
        );

        try {
            $pro = "";
            $mod = "";
            $dat = [];
            $res_ = array();

            if(isset($model)){
                $mod = $model;
            } else {
                $mod = "";
            }

            if(isset($response)){
                $res_ = $response;
            } else {
                $res_ = "";
            }

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            if(isset($model)){
                $mod = $model;
            } else {
                $mod = "";
            }

            if(isset($data)){
                $dat = $data;
            } else {
                $dat = [];
            }

            $payload = array(
                "prompt" => $pro,
                "response" => $res_,
                "model" => $mod,
                "data" => $dat
            );
        } catch(\Throwable $e){
            $payload = array(
                "prompt" => "",
                "response" => "url",
                "data" => [],
                "model" => ""
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
            $this->ex($this->user_, $this->secret_, $this->payld, 'https://nexra.aryahcr.cc/api/image/complements', true);
            $this->error_ = $this->err();
            $this->result_ = $this->res();
        } catch (\Throwable $th) {
            $this->error_ = array(
                "code" => 500,
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