<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;

class emi extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="")
    {
        $payload = array(
            "prompt" => "",
            "model" => "emi"
        );

        try {
            $pro = "";

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            $payload = array(
                "prompt" => $pro,
                "model" => "emi"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "model" => "emi"
            );
        }

        $this->payld = $payload;
    }

    public function setAPI($user, $secret){
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
            $this->ex($this->user_, $this->secret_, $this->payld, "https://nexra.aryahcr.cc/api/image/complements");
            $this->result_ = $this->res();
            $this->error_ = $this->err();
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