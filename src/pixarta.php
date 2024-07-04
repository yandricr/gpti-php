<?php
namespace gpti;

require_once(__DIR__ . "/util.php");
use api;

class pixarta extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($prompt="", $data=array(
        "prompt_negative" => "",
        "sampler" => "",
        "image_style" => "",
        "width" => "",
        "height" => "",
        "dpm_guidance_scale" => "",
        "dpm_inference_steps" => "",
        "sa_guidance_scale" => "",
        "sa_inference_steps" => ""
    ))
    {
        $payload = array(
            "prompt" => "",
            "data" => array(
                "prompt_negative" => "",
                "sampler" => "DPM-Solver",
                "image_style" => "(No style)",
                "width" => 1024,
                "height" => 1024,
                "dpm_guidance_scale" => 4.5,
                "dpm_inference_steps" => 14,
                "sa_guidance_scale" => 3,
                "sa_inference_steps" => 25
            ),
            "model" => "pixart-a"
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
                    "sampler" => "DPM-Solver",
                    "image_style" => "(No style)",
                    "width" => 1024,
                    "height" => 1024,
                    "dpm_guidance_scale" => 4.5,
                    "dpm_inference_steps" => 14,
                    "sa_guidance_scale" => 3,
                    "sa_inference_steps" => 25
                );
            }

            $payload = array(
                "prompt" => $pro,
                "data" => $pdata,
                "model" => "pixart-a"
            );
        } catch (\Throwable $th) {
            $payload = array(
                "prompt" => "",
                "data" => array(
                    "prompt_negative" => "",
                    "sampler" => "DPM-Solver",
                    "image_style" => "(No style)",
                    "width" => 1024,
                    "height" => 1024,
                    "dpm_guidance_scale" => 4.5,
                    "dpm_inference_steps" => 14,
                    "sa_guidance_scale" => 3,
                    "sa_inference_steps" => 25
                ),
                "model" => "pixart-a"
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