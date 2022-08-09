<?php
    class anunciante {
        public $idAnunciante;
        public $nome;
        public $cpf;
        public $email;
        public $senhaHash;
        public $telefone;

        function __construct($idA, $nome, $cpf, $email, $senhaHash, $telefone){
            $this->idAnunciante = $idA;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->email = $email;
            $this->senhaHash = $senhaHash;
            $this->telefone = $telefone;
        }
    }
?>