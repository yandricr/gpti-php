<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;
class pixartlcm extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "image_style" => "",
        "width" => "",
        "height" => "",
        "lcm_inference_steps" => ""
    ))
    {
        $payload = array(
            "prompt" => "",
            "data" => array(
                "prompt_negative" => "",
                "image_style" => "(No style)",
                "width" => 1024,
                "height" => 1024,
                "lcm_inference_steps" => 9
            ),
            "model" => "pixart-lcm"
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
                    "image_style" => "(No style)",
                    "width" => 1024,
                    "height" => 1024,
                    "lcm_inference_steps" => 9
                );
            }

            $payload = array(
                "prompt" => $pro,
                "data" => $pdata,
                "model" => "pixart-lcm"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "data" => array(
                    "prompt_negative" => "",
                    "image_style" => "(No style)",
                    "width" => 1024,
                    "height" => 1024,
                    "lcm_inference_steps" => 9
                ),
                "model" => "pixart-lcm"
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
            $this->ex($this->user_, $this->secret_, $this->payld, "https://nexra.aryahcr.cc/api/image/complements");
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