<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ### Classe Aluno ###
 * Classe responsável pelo CRUD de alunos e
 * pela exibição de relatório em PDF dos alunos
 *
 * @author Leonardo
 */

class Aluno extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // deixa o model instanciado sempre que acessar a classe
        $this->load->model('Aluno_model');
        $this->model = new Aluno_model();
    }

    public function index() {
        $this->list_all();
    }

    public function list_all() {
        $data['list']   = $this->model->list_all();
        $data['title']  = 'Lista';
        $this->template('aluno/listar', $data);
    }

    // pesquisa por nome
    public function search() {
        $nome = $this->input->get('nome');
        $data['list']   = $this->model->search_name($nome);
        $data['title']  = 'Pesquisa';
        $this->template('aluno/listar', $data);
    }
    
    // relatório por idade em PDF
    public function list_pdf() {
        
        $idade = $this->input->post('idade');
        
        if ($idade > 0) {
            // Efetua pesquisa por idade e gera o PDF
            $data['list']  = $this->model->list_pdf($idade);
            $data['title'] = 'Relatório por idade - '.$idade.' anos';

            /**
             * instancia o MPDF com suas coinfigurações de orientação de página
             * carrega a view e escreve o PDF para exibir
             */
            $mpdf           = new \Mpdf\Mpdf(['orientation' => 'P']);
            $conteudoPDF    = $this->load->view('relatorio/idade', $data, true);
            $mpdf->WriteHTML($conteudoPDF);
            $mpdf->Output();
            
        } else {
            // Exibe a tela para informar a idade
            $data['list'] = $this->model->list_pdf($idade);
            $this->template('aluno/idade', $data);
        }
    }
    
    public function create() {
        $data = null;
        
        // verifica os campos obrigatórios
        if (isset($_POST['nome']) && isset($_POST['endereco']) 
                && isset($_POST['renda_familiar']) && isset($_POST['data_nascimento'])) {

            $this->model->nome              = $this->input->post('nome');
            $this->model->endereco          = $this->input->post('endereco');
            $this->model->renda_familiar    = $this->input->post('renda_familiar');
            $this->model->data_nascimento   = $this->input->post('data_nascimento');
            
            // trata a pontuação do valora da renda
            $this->model->renda_familiar = str_replace('.', '', $this->model->renda_familiar);
            $this->model->renda_familiar = str_replace(',', '.', $this->model->renda_familiar);
            
            // caso não seja enviado foto, ele atribui uma imagem como padrão
            if(strlen($this->input->post('foto')) < 5){
                $this->model->foto = 'uploads/avatar.png';
            }

            $this->load->library('upload');

            // definimos o path onde o arquivo será gravado
            $path = "./uploads/alunos";

            // verificamos se o diretório existe
            // se não existe criamos com permissão de leitura e escrita
            if (!is_dir($path)) {
                mkdir($path, 0777, $recursive = true);
            }

            // definimos as configurações para o upload
            // determinamos o path para gravar o arquivo
            $configUpload['upload_path'] = $path;
            // definimos - através da extensão -
            // os tipos de arquivos suportados
            $configUpload['allowed_types'] = 'jpg|jpeg|png';
            // definimos que o nome do arquivo
            // será alterado para um nome criptografado
            $configUpload['encrypt_name'] = TRUE;

            // passamos as configurações para a library upload
            $this->upload->initialize($configUpload);

            // Verifica o upload processado
            if (!$this->upload->do_upload('foto')) {
                // em caso de erro retornamos os mesmos para uma variável
                // e enviamos para a home
                $data['result'] = array('alert' => "alert-danger", 'message' => "Erro ao anexar foto.");
                $this->session->set_userdata($data['result']);
            } else {
                //se correu tudo bem, recuperamos os dados do arquivo
                $data['dadosArquivo'] = $this->upload->data();
                // definimos o path original do arquivo
                if (strlen('uploads/alunos/' . $data['dadosArquivo']['file_name']) > 10) {
                    $this->model->foto = 'uploads/alunos/' . $data['dadosArquivo']['file_name'];
                } else {
                    //caso ocorra algum erro ele atribui a imagem padrão
                    $this->model->foto = 'uploads/avatar.png';
                }
            }
            
            $result = $this->model->create();
            
            if ($result != FALSE) {
                $data['result'] = array('alert' => "alert-success", 'message' => "Aluno cadastrado com sucesso.");
                $this->session->set_userdata($data['result']);
            } else {
                $data['result'] = array('alert' => "alert-danger", 'message' => "Erro ao cadastrar aluno.");
                $this->session->set_userdata($data['result']);
            }
        }

        $data['title'] = 'Cadastro';
        $this->template('aluno/cadastrar', $data);
    }
    
    public function edit($id) {
        $data = null;
        // cerifica campos obrigatórios
        if (isset($_POST['nome']) && isset($_POST['endereco']) 
                && isset($_POST['renda_familiar']) && isset($_POST['data_nascimento'])) {

            $this->model->nome              = $this->input->post('nome');
            $this->model->endereco          = $this->input->post('endereco');
            $this->model->renda_familiar    = $this->input->post('renda_familiar');
            $this->model->data_nascimento   = $this->input->post('data_nascimento');
            
            // trata a pontuação do valor da renda
            $this->model->renda_familiar = str_replace('.', '', $this->model->renda_familiar);
            $this->model->renda_familiar = str_replace(',', '.', $this->model->renda_familiar);

            // caso não seja enviado foto, ele atribui um valor nulo
            if(strlen($this->input->post('foto')) < 5){
                $this->model->foto = null;
            }

            $this->load->library('upload');

            // definimos um nome aleatório para o diretório
            // definimos o path onde o arquivo será gravado
            $path = "./uploads/alunos";

            // verificamos se o diretório existe
            // se não existe criamos com permissão de leitura e escrita
            if (!is_dir($path)) {
                mkdir($path, 0777, $recursive = true);
            }

            // definimos as configurações para o upload
            // determinamos o path para gravar o arquivo
            $configUpload['upload_path'] = $path;
            // definimos - através da extensão -
            // os tipos de arquivos suportados
            $configUpload['allowed_types'] = 'jpg|jpeg|png';
            // definimos que o nome do arquivo
            // será alterado para um nome criptografado
            $configUpload['encrypt_name'] = TRUE;

            // passamos as configurações para a library upload
            $this->upload->initialize($configUpload);

            // Verifica o upload processado
            if (!$this->upload->do_upload('foto')) {
                // em caso de erro retornamos os mesmos para uma variável
                // e enviamos para a home
                $data['result'] = array('alert' => "alert-danger", 'message' => "Erro ao anexar foto.");
                $this->session->set_userdata($data['result']);
            } else {
                //se correu tudo bem, recuperamos os dados do arquivo
                $data['dadosArquivo'] = $this->upload->data();
                // definimos o path original do arquivo
                if (strlen('uploads/alunos/' . $data['dadosArquivo']['file_name']) > 10) {
                    $this->model->foto = 'uploads/alunos/' . $data['dadosArquivo']['file_name'];
                } else {
                    $this->model->foto = null;
                }
            }
            
            $result = $this->model->update($id);
            
            if ($result != FALSE) {
                $data['result'] = array('alert' => "alert-success", 'message' => "Aluno atualizado com sucesso.");
                $this->session->set_userdata($data['result']);
            } else {
                $data['result'] = array('alert' => "alert-danger", 'message' => "Erro ao atualizar aluno.");
                $this->session->set_userdata($data['result']);
            }
        }
        
        $data['aluno'] = $this->model->select($id);
        $data['title'] = 'Edição';
        $this->template('aluno/editar', $data);
    }
    
    public function delete($id) {
        
        $result = $this->model->delete($id);
            
        if ($result != FALSE) {
            $data['result'] = array('alert' => "alert-success", 'message' => "Aluno excluído com sucesso.");
            $this->session->set_userdata($data['result']);
        } else {
            $data['result'] = array('alert' => "alert-danger", 'message' => "Erro ao excluir aluno.");
            $this->session->set_userdata($data['result']);
        }
          
        redirect('/listar');
    }
    
    // monta a tela a ser exibida
    public function template($page, $data=null) {
        $this->load->view('template/header', $data);
        $this->load->view('template/nav', $data);
        $this->load->view($page, $data);
        $this->load->view('template/footer', $data);
        
    }
}
