<?php

/**
 * Classe modelo de Aluno
 *
 * @author Leonardo
 */
class Aluno_model extends CI_Model {

    private $database = "aluno";
    public $id = "";
    public $nome            = "";
    public $endereco        = "";
    public $renda_familiar  = "";
    public $data_nascimento = "";
    public $foto            = "";

    public function index() {
        $this->list_all();
    }
    
    public function list_all() {
        $this->db->select('id')
                 ->select('nome')
                 ->select('endereco')
                 ->select('renda_familiar')
                 ->select('data_nascimento')
                 ->select('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) as idade ')
                
                 ->order_by('nome');
        
        $result = $this->db->get($this->database)->result();

        if (count($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }
    
    // pesquisa para o relatório em PDF
    public function list_pdf($idade) {
        $this->db->select('id')
                 ->select('nome')
                 ->select('endereco')
                 ->select('renda_familiar')
                 ->select('data_nascimento')
                 ->select('foto')
                 ->select('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) as idade ')
                
                 ->order_by('nome')
                
                 ->where('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) = ' . $idade);
        
        $result = $this->db->get($this->database)->result();

        if (count($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }
    
    public function search_name($nome) {
        $this->db->select('id')
                 ->select('nome')
                 ->select('endereco')
                 ->select('renda_familiar')
                 ->select('data_nascimento')
                 ->select('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) as idade ')
                
                 ->order_by('nome')
                
                 ->like('nome', $nome);
        
        $result = $this->db->get($this->database)->result();

        if (count($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }
    
    public function select($id) {
        $this->db->select('id')
                 ->select('nome')
                 ->select('endereco')
                 ->select('renda_familiar')
                 ->select('data_nascimento')
                 ->select('foto')
                 ->select('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) as idade ')
                
                 ->where('id', $id);
        
        $result = $this->db->get($this->database)->result();

        if (count($result) == 1) {
            return $result[0];
        } else {
            return null;
        }
    }
    
    public function create() {
        
        $aluno = array(
            'nome'              => $this->nome,
            'endereco'          => $this->endereco,
            'renda_familiar'    => $this->renda_familiar,
            'data_nascimento'   => $this->data_nascimento,
            'foto'              => $this->foto
        );

        if ($this->db->insert($this->database, $aluno)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update($id) {
        
        if($this->foto == null){
            $aluno = array(
                'nome'              => $this->nome,
                'endereco'          => $this->endereco,
                'renda_familiar'    => $this->renda_familiar,
                'data_nascimento'   => $this->data_nascimento
            );
        } else {
            $aluno = array(
                'nome'              => $this->nome,
                'endereco'          => $this->endereco,
                'renda_familiar'    => $this->renda_familiar,
                'data_nascimento'   => $this->data_nascimento,
                'foto'              => $this->foto
            );
        }
        
        $this->db->where('id', $id);

        if ($this->db->update($this->database, $aluno)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function delete($id) {

        $this->db->where('id', $id);

        if ($this->db->delete($this->database)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
