<?php
namespace gpti;

require_once __DIR__ ."/util.php";
use apistrm;

class llama extends apistrm {
    private $result_ = null;
    private $error_ = null;
    private $user_ = null;
    private $secret_ = null;
    private $payld = null;
    private $stm_ = false;

    public function __construct($messages=[], $markdown=false, $stream=false) {
        $payload = array(
            "messages" => array(),
            "model" => "llama-3.1",
            "stream" => false,
            "markdown" => false
        );

        try {
            $mess = [];
            $mark = false;
            $stm = false;
            
            if(isset($messages)){
                $mess = $messages;
            }

            if(isset($markdown)){
                if($markdown == true){
                    $mark = true;
                } else {
                    $mark = false;
                }
            }

            if(isset($stream)){
                if($stream == true){
                    $stm = true;
                    $this->stm_ = true;
                } else {
                    $stm = false;
                }
            }

            $payload = array(
                "messages" => $mess,
                "model" => "llama-3.1",
                "stream" => $stm,
                "markdown" => $mark
            );
        } catch (\Throwable $th) {
            $payload = array(
                "messages" => [],
                "model" => "llama-3.1",
                "stream" => false,
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
            $this->ex($this->user_, $this->secret_, $this->payld, 'https://nexra.aryahcr.cc/api/chat/complements', $this->stm_);
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

    public function stream(){
        try {
            if($this->err() == null && $this->stm_ == true){
                $text = null;
                
                foreach($this->strm() as $data){
                    $text = $data;
                    if($text != null){
                        yield $text;
                    }
                }

                if($text == null){
                    $data_ = array(
                        "message" => null,
                        "original" => null,
                        "finish" => true,
                        "error" => true
                    );
                    $data_ = json_decode(json_encode($data_));

                    yield $data_;
                }
            } else {
                yield null;
            }
        } catch (\Throwable $th) {
            yield null;
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