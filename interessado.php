<?php
    class interessado {
        public $idInteresse;
        public $mensagem;
        public $dataHora;
        public $contato;
        public $idAnuncio;

        function __construct($idI, $msg, $data, $cont, $idA)
        {
            $this->idInteresse = $idI;
            $this->mensagem = $msg;
            $this->dataHora = $data;
            $this->contato = $cont;
            $this->idAnuncio = $idA;
        }
    }
?>