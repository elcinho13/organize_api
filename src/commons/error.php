<?php

class custonError {
    
    private $success;
    private $type;
    private $code;
    private $message;
    private $return; 
    
    const NETWORK = 0;
    const VALIDATE = 1;
    const INSERT = 2;
    const SELECT = 3;
    const UPDATE = 4;
    const LOADING = 5;
    const SUCESS = 99;
    
    function __construct($type, $code, $message) {
                    
        $this->type = $type;
        $this->code = $code;
        $this->message = $message;
        
        switch ($type){
            case custonError::NETWORK:
                $this->success = false;
                $this->return = "Ocorreu um erro de REDE. Verifique sua internet e tente novamente.";
                break;
            case custonError::VALIDATE:
                $this->success = false;
                $this->return = "Ocorreu um erro de VALIDAÇÃO. Verifique os campos informados e tente novamente.";
                break;
            case custonError::INSERT:
                $this->success = false;
                $this->return = "Não foi possível inserir os dados.";
                break;
            case custonError::SELECT:
                $this->success = false;
                $this->return = "Nenhum dado pôde ser retornado";
                break;
            case custonError::UPDATE:
                $this->success = false;
                $this->return = "Não foi possível atualizar os dados.";
                break;
            case custonError::LOADING:
                $this->success = false;
                $this->return = "Ocorreu um erro ao carregar os dados.";
                break;
            case custonError::SUCESS:
                $this->success = true;
                $this->return = "";
                break;
        }
    }
    
    public function parse_error(){
        $error = array(
            'success' => $this->success,
            'code' => $this->code,
            'return' => $this->return,
            'message' => $this->message
        );
        
        return $error;
    }
}


