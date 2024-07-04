<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use api;

class animaginexl extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "quality_tags" => "Standard",
        "style_present" => "(None)",
        "width" => 1024,
        "height" => 1024,
        "strength" => 0.5,
        "upscale" => 1.5,
        "sampler" => "Euler a",
        "guidance_scale" => 7,
        "inference_steps" => 28
    ))
    {
        $payload = array(
            "prompt" => "",
            "data" => array(
                "prompt_negative" => "",
                "quality_tags" => "Standard",
                "style_present" => "(None)",
                "width" => 1024,
                "height" => 1024,
                "strength" => 0.5,
                "upscale" => 1.5,
                "sampler" => "Euler a",
                "guidance_scale" => 7,
                "inference_steps" => 28
            ),
            "model" => "animagine-xl"
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
                "model" => "animagine-xl"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "data" => array(
                    "prompt_negative" => "",
                    "quality_tags" => "Standard",
                    "style_present" => "(None)",
                    "width" => 1024,
                    "height" => 1024,
                    "strength" => 0.5,
                    "upscale" => 1.5,
                    "sampler" => "Euler a",
                    "guidance_scale" => 7,
                    "inference_steps" => 28
                ),
                "model" => "animagine-xl"
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