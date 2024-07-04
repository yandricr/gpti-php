<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;
class playground extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "width" => 1024,
        "height" => 1024,
        "guidance_scale" => 3
    ))
    {
        $payload = array(
            "prompt" => "",
            "data" => array(
                "prompt_negative" => "",
                "width" => 1024,
                "height" => 1024,
                "guidance_scale" => 3
            ),
            "model" => "playground"
        );

        try {
            $pro = "";
            $pdata = array();

            if(isset($prompt)){
                $pro = $prompt;
            }
            if(isset($data) && is_array($data)){
                $pdata = $data;
            }

            $payload = array(
                "prompt" => $pro,
                "data" => $pdata,
                "model" => "playground"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "data" => array(
                    "prompt_negative" => "",
                    "width" => 1024,
                    "height" => 1024,
                    "guidance_scale" => 3
                ),
                "model" => "playground"
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