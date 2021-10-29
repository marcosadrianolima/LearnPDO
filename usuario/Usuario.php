<?php

class Usuario {

    private int $id;
    private string $nome;
    private string $idade;

    private function construct(){}
    /**
     * @access public
     * @author Marcos Lima, cria um usuário espelho do BD
     * @param  ID = Identificador único
     * @param  Nome = Nome do usuario
     * @param  Idade = Idade do usuario
     */
    function Usuario(int $id, string $nome, string $idade){
        var_dump($nome);
        die("aqui");
        $this->$id = $id;
        $this->$nome = $nome;
        $this->$idade = $idade;
    }
    // GET
    public function getID(){
        return $this->$id;
    }
    public function getNome(){
        return $this->$nome;
    }
    public function getIdade(){
        return $this->$idade;
    }

    // SET
    public function setID($id){
        $this->$id = $id;
    }
    public function setNome($nome){
        $this->$nome = $nome;
    }
    public function setIdade($idade){
        $this->$idade = $idade;
    }

}

?>