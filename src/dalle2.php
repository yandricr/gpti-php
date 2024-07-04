<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;

class dalle2 extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "width" => 1024,
        "height" => 1024,
        "guidance_scale" => 6
    ))
    {
        $payload = array(
            "prompt" => "",
            "model" => "dalle2",
            "data" => array()
        );

        try {
            $pro = "";
            $data_ = "";

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            if(isset($data)){
                $data_ = $data;
            } else {
                $data_ = array();
            }

            $payload = array(
                "prompt" => $pro,
                "model" => "dalle2",
                "data" => $data_
            );
        } catch(\Throwable $th){
            $payload = array(
                "prompt" => "",
                "model" => "dalle2",
                "data" => array()
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

    public function execute()
    {
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