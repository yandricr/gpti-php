<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;
class sdv1 extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="")
    {
        $payload = array(
            "prompt" => "",
            "model" => "stablediffusion-1.5"
        );

        try {
            $pro = "";
            $mark = false;

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            $payload = array(
                "prompt" => $pro,
                "model" => "stablediffusion-1.5"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => $pro,
                "model" => "stablediffusion-1.5"
            );
        }

        $this->payld = $payload;
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