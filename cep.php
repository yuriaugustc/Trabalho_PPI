<?php
    class cep{
        public $cep;
        public $cidade;
        public $estado;

        function __construct($cep, $city, $state)
        {
            $this->cep = $cep;
            $this->cidade = $city;
            $this->estado = $state;
        }
    }
?>