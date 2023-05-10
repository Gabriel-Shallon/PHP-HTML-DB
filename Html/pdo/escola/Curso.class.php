<?php

class Curso {
    private $codigo;
    private $nome;
    private $perfil;

    public function __construct($codigo, $nome, $perfil) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->perfil = $perfil;
    }

    // Getters e Setters

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
}
