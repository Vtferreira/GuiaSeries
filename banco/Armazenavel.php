<?php
/* 
 * Interface para persistência de dados CRUD. Todas as classes DAO devem implementar
 */
interface Armazenavel{
    public function inserir($objeto);
    public function listar();
    public function consultar($id);
    public function alterar($objeto);
    public function deletar($id);
    public function listarJSON();
}
