<?php

class Response {
    private string $responseType = 'JSON'; //XML or JSON (¿More ideas?) HTML
    private array $allowedTypes = ['JSON'];
    private string $language;
    private array $dictionary;
    
    //region RESPONSE-BODY properties
    private bool $status;
    private int $code;
    private string $msg;
    private array $data=[];
    private array $meta=[];
    //endregion

    //region RESPONSE-HEADER properties
    private int $headerCode;
    private array $extraHeaders=[];
    //endregion

    function __construct() {

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    ////S> RESPONSE OPERATIVE FUNCTIONS
    public function addWarning(string $msg) : void {
        $this->meta['warnings'][] = $msg;
    }

    //You are going to need a dictionary to use this
    public function addWarningByCode() : bool {
        return false;
    }
    
    public function addError(string $msg, int $headerCode=400) : void {
        $this->headerCode=$headerCode;
        $this->status=false;
        
        $this->meta['errors'][] = $msg;
    }

    public function addErrorByCode(int $code, int $headerCode, string $msg=null) : void {
        if(isset($msg)){
            $msg = str_replace('%msg%', 'AÑADIR AQUÍ EL VALOR DEL MAPA SI ES POSIBLE',$msg);
        }
        $this->addError($msg);
    }

    public function setPagination(int $actualPage, int $totalPage) : bool {
        return false;
    }
    
    public function show() : void {
        $this->code = $this->code ?? ($this->code % 2 == 0 || $this->code==0);
        
        switch ($this->responseType){
            case 'JSON':
                //region SET HEADERS
                    http_response_code($this->headerCode ?? 200);
                    foreach ($this->extraHeaders as $key => $value) {
                        header("$key: $value");
                    }
                //endregion
                
                //region PRINT BODY
                    $response = [
                        "success"=> $this->status ?? ($this->code % 2 == 0 || $this->code==0), //Code errors are odd
                        "code"=>$this->code,
                        "data"=>$this->data,
                        "meta"=>$this->meta
                    ];
                    if(isset($this->msg) && !empty($this->msg)) $response['msg']=$this->msg;
                    echo json_encode($response);
                //endregion
                break;
            }
    }
    ////E> RESPONSE OPERATIVE FUNCTIONS
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    ////S> SETTERS & GETTERS
    public function setResponseType(string $type) : bool {
        if(in_array($type,$this->allowedTypes)){
    
        } else {
            $this->meta;
        }
        return false;
    }
    
    public function setStatus(bool $status) : void {
        
    }
    
    public function setDictionary(string $path, bool $external=false) : bool {
        if($external) {
            try {
                $this->dictionary = json_decode(file_get_contents($path));
            } catch(Error|Exception $e){
                $this->addWarning('Dictionary for message responses not found in the external URL');
            }
        } else {
    
        }
        return false;
    }
    ////E> SETTERS & GETTERS
    /////////////////////////////////////////////////////////////////////////////////////////////////////
}

class DictionaryResponse {
    static function send(int $code, array $data=[], array $meta_data=[], string $lng='es') : void {
        

        $response_template = [
            "success"=>($code % 2 == 0 || $code==0), //Code errors are odd
            "code"=>$code,
        ];

        //Check if we have a message
        $dictionaryPath="dictionary\\";
        $fileName="msg.$lng.json";
        $msg=false;
        if(file_exists($dictionaryPath.$fileName)) {
            $map = json_decode(file_get_contents("dictionary\\msg.$lng.json"),true);
            if (isset($map[$code])) $msg=$map[$code];
        }
        if(!$msg && file_exists($dictionaryPath.'msg.en.json')){
            $map = json_decode(file_get_contents("dictionary\\msg.en.json"),true);
            if (isset($map[$code])) $msg=$map[$code];
        }
        if($msg) $response_template['msg']=$msg;

        if(isset($data)) $response_template['data']=$data;
        if(isset($meta_data)) $response_template['meta']=$meta_data;

        echo json_encode($response_template);
        die;


        echo json_encode([
            "success"=>($code % 2 == 0 || $code==0), //Code errors are odd
            "code"=>$code,
            "msg"=>$map[$code],
            "data"=>$data,
            "meta"=>$meta_data
        ]);
    }
}