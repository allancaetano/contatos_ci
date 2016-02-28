<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contatos_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function listar_contatos() {
        $this->db->select();
        $this->db->from('contatos');
        return $this->db->get()->result();
    }
    
    public function adicionar_contato($dados) {
        return $this->db->insert('contatos', $dados);
    }
    
    public function alterar_contato($id) {
        $this->db->where('id', $id);
        return $this->db->get('contatos')->result();
    }
    
    public function salvar_alteracao($dados) {
        $this->db->where('id', $dados['id']);
        return $this->db->update('contatos', $dados);
    }

    public function duplicar_contato($id) {
        $this->db->select('nome, telefone, email, nascimento, favorito');
        $this->db->from('contatos');
        $this->db->where('id', $id);
        $duplicar = $this->db->get();
        $this->db->insert_batch("contatos", $duplicar->result());
    }
    
    public function excluir_contato($id) {
        $this->db->where('id', $id);
        return $this->db->delete('contatos');
    }
    
    public function listar_anexos($id) {
        $this->db->where('contato_id', $id);
        return $this->db->get('anexos_contatos')->result();
    }
    
    public function adicionar_anexos($anexos) {
        return $this->db->insert('anexos_contatos', $anexos);
    }
}