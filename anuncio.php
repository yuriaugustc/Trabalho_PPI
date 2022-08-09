<?php
    class anuncio {
        public $idAnuncio;
        public $titulo;
        public $descricao;
        public $preco;
        public $dataHora;
        public $cep;
        public $bairro;
        public $cidade;
        public $estado;
        public $idAnunciante;
        public $idCategoria;

        function __construct($idA, $tit, $desc, $prec, $data, $cep, $bairro, $cid, $est, $idAnu, $idC){
            $this->idAnuncio = $idA;
            $this->titulo = $tit;
            $this->descricao = $desc;
            $this->preco = $prec;
            $this->dataHora = $data;
            $this->cep = $cep;
            $this->bairro = $bairro;
            $this->cidade = $cid;
            $this->estado = $est;
            $this->idAnunciante = $idAnu;
            $this->idCategoria = $idC;
        }
    }
?>