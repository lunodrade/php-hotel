<?php

class Usuario {
    private $id = null;
    private $email = null;
    private $senha = null;
    private $tipo = null;
    private $cliente = null;
    
    public function getId() {
        return $this->id;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function getCliente() {
        return $this->cliente;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }
}

