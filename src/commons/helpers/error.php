<?php

class custonError {
    
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
    
    function __construct($type, $code, $message) {
                    
        $this->type = $type;
        $this->code = $code;
        $this->message = $message;
        
        switch ($type){
            case CustonError::NETWORK:
                $this->return = "Ocorreu um erro de REDE. \n Verifique sua internet e tente novamente.";
                break;
            case CustonError::VALIDATE:
                $this->return = "Ocorreu um erro de VALIDAÇÃO. \n Verifique os campos informados e tente novamente.";
                break;
            case CustonError::INSERT:
                $this->return = "Não foi possível inserir os dados.";
                break;
            case CustonError::SELECT:
                $this->return = "Nenhum dado pôde ser retornado";
                break;
            case CustonError::UPDATE:
                $this->return = "Não foi possível atualizar os dados.";
                break;
            case CustonError::LOADING:
                $this->return = "Ocorreu um erro ao carregar os dados.";
                break;
        }
    }
    
    public function parse_error(){
        $error = array(
            'success' => false,
            'code' => $this->code,
            'return' => $this->return,
            'message' => $this->message //DEVELOPER MODE.
        );
        
        return $error;
    }
}


