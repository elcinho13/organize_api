<?php

class custonError {

    private $is_new;
    private $has_error;
    private $type;
    private $code;
    private $message;
    private $exception;
    private $error = [];

    const SUCCESS = 0;
    const GENERIC = 1;
    const GETDATA = 2;
    const INSERT = 3;
    const UPDATE = 4;
    const DELETE = 5;
    const UPLOAD = 6;
    const LOGIN = 7;
    const AUTHENTICATE = 8;
    const SUCCESS_MESSAGE = 'Dados retornados com sucesso.';
    const GENERIC_MESSAGE = 'Ocorreu um erro genérico no servidor.';
    const GETDATA_MESSAGE = 'Ocorreu um erro ao buscar os dados.';
    const INSERT_MESSAGE = 'Ocorreu um erro ao inserir os dados.';
    const UPDATE_MESSAGE = 'Ocorreu um erro ao atualizar os dados.';
    const DELETE_MESSAGE = 'Ocorreu um erro ao deletar os dados.';
    const UPLOAD_MESSAGE = 'Ocorreu um erro ao carregar o arquivo.';
    const LOGIN_MESSAGE = 'Usuário ou senha inválidos.';
    const AUTHENTICATE_MESSAGE = 'Acesso não autorizado.';

    function __construct($has_error, $type, $code = null, $exception = null) {
        $this->has_error = $has_error;
        $this->type = $type;
        $this->code = $code;
        $this->exception = $exception;
    }

    function parse_error() {
        $this->error = array(
            'has_error' => $this->has_error,
            'type' => $this->type,
            'code' => $this->code,
            'message' => '',
            'exception' => $this->exception,
        );

        if (is_null($this->error['code'])) {
            $this->error['code'] = $this->type;
        }
        switch ($this->type) {
            case custonError::SUCCESS:
                $this->error['message'] = custonError::SUCCESS_MESSAGE;
                break;
            case custonError::GENERIC:
                $this->error['message'] = custonError::GENERIC_MESSAGE;
                break;
            case custonError::GETDATA:
                $this->error['message'] = custonError::GETDATA_MESSAGE;
                break;
            case custonError::INSERT:
                $this->error['message'] = custonError::INSERT_MESSAGE;
                break;
            case custonError::UPDATE:
                $this->error['message'] = custonError::UPDATE_MESSAGE;
                break;
            case custonError::DELETE:
                $this->error['message'] = custonError::DELETE_MESSAGE;
                break;
            case custonError::UPLOAD:
                $this->error['message'] = custonError::UPLOAD_MESSAGE;
                break;
            case custonError::LOGIN:
                $this->error['message'] = custonError::LOGIN_MESSAGE;
                break;
            case custonError::AUTHENTICATE:
                $this->error['message'] = custonError::AUTHENTICATE_MESSAGE;
                break;
        }

        return $this->error;
    }
}
