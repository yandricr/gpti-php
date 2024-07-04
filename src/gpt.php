<?php
namespace gpti;

require_once(__DIR__ . "/util.php");
use api;

class gpt extends api {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;

    public function __construct($messages=[], $prompt="", $model="", $markdown=false)
    {
        $payload = array(
            "messages" => [],
            "prompt" => "",
            "model" => "GPT-4",
            "markdown" => false
        );

        try {
            $msg = [];
            $pro = "";
            $mod = "GPT-4";
            $mark = false;

            if(is_array($messages)){
                $msg = $messages;
            } else {
                $msg = [];
            }

            if(isset($prompt)){
                $pro = $prompt;
            } else {
                $pro = "";
            }

            if(isset($model)){
                $mod = $model;
            } else {
                $mod = "GPT-4";
            }

            if(is_bool($markdown)){
                $mark = $markdown;
            } else {
                $mark = false;
            }

            $payload = array(
                "messages" => $msg,
                "prompt" => $pro,
                "model" => $mod,
                "markdown" => $mark
            );
        } catch(\Throwable $e){
            $payload = array(
                "messages" => [],
                "prompt" => "",
                "model" => "GPT-4",
                "markdown" => false
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
            $this->ex($this->user_, $this->secret_, $this->payld, 'https://nexra.aryahcr.cc/api/chat/gpt');
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