<?php

class Aluno {
    private $matricula;
    private $nome;
    private $datadenascimento;
    private $datadematricula;
    private $status;
    private $curso;

    public function __construct($matricula, $nome, $datadenascimento, $datadematricula, $status, $curso) {
        $this->matricula = $matricula;
        $this->nome = $nome;
        $this->datadenascimento = $datadenascimento;
        $this->datadematricula = $datadematricula;
        $this->status = $status;
        $this->curso = $curso;
    }

    // Getters e Set
    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataDeNascimento() {
        return $this->datadenascimento;
    }

    public function setDataDeNascimento($datadenascimento) {
        $this->datadenascimento = $datadenascimento;
    }

    public function getDataDeMatricula() {
        return $this->datadematricula;
    }

    public function setDataDeMatricula($datadematricula) {
        $this->datadematricula = $datadematricula;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }
}