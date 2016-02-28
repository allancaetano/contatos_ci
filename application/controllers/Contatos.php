<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contatos extends CI_Controller {
    
    private $contatos;

    public function __construct() {
        parent::__construct();
        $this->load->model('contatos_model', 'modelcontatos');
        $this->contatos = $this->modelcontatos->listar_contatos();
    }

    public function index() {
        $data['contatos'] = $this->contatos;
        $this->load->view('html-header');
        $this->load->view('novo_contato', $data);
        $this->load->view('tabela', $data);
        $this->load->view('html-footer');
    }
    
    public function adicionar_contato() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[contatos.email]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $dados['nome'] = $this->input->post('nome');
            $dados['telefone'] = $this->input->post('telefone');
            $dados['email'] = $this->input->post('email');
            $dados['nascimento'] = dataBr_to_dataMySQL($this->input->post('nascimento'));
            $dados['favorito'] = $this->input->post('favorito');
            $this->modelcontatos->adicionar_contato($dados);
            if ($this->input->post('lembrete') == 1) {
                $this->enviar_email($dados);
            }
            redirect(base_url('contatos'));
        }
    }
    
    public function alterar_contato($id) {
        $data['contato'] = $this->modelcontatos->alterar_contato($id);
        $this->load->view('html-header');
        $this->load->view('alterar_contato', $data);
        $this->load->view('html-footer');
    }
    
    public function salvar_alteracao() {
        if ($this->input->post('cancelar')) {
            redirect(base_url('contatos'));
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
            $this->form_validation->set_rules('telefone', 'Telefone', 'required');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->alterar_contato($this->input->post('id'));
            } else {
                $dados['id'] = $this->input->post('id');
                $dados['nome'] = $this->input->post('nome');
                $dados['telefone'] = $this->input->post('telefone');
                $dados['email'] = $this->input->post('email');
                $dados['nascimento'] = dataBr_to_dataMySQL($this->input->post('nascimento'));
                $dados['favorito'] = $this->input->post('favorito');
                $this->modelcontatos->salvar_alteracao($dados);
                
                $anexos = $this->modelcontatos->listar_anexos($dados['id']);
                        
                if ($this->input->post('lembrete') == 1) {
                    $this->enviar_email($dados, $anexos);
                }
                redirect(base_url('contatos'));
            }
        }
    }
    
    public function duplicar_contato($id) {
        $this->modelcontatos->duplicar_contato($id);
        redirect(base_url('contatos'));
    }
    
    public function excluir_contato($id) {
        $this->modelcontatos->excluir_contato($id);
        redirect(base_url('contatos'));
    }
    
    public function listar_anexos($id) {
        $data['contato'] = $this->modelcontatos->alterar_contato($id);
        $data['anexos'] = $this->modelcontatos->listar_anexos($id);
        $this->load->view('template_anexos', $data);
    }

    public function enviar_email($dados, $anexos = array()) {
        $mensagem = $this->load->view('email/template_email.php', $dados, TRUE);
        $this->load->library('my_phpmailer');
        $obj_email = new PHPMailer();
        $obj_email->isSMTP();              
        $obj_email->Host = "smtp.gmail.com";
        $obj_email->Port = 587;
        $obj_email->SMTPSecure = 'tls';
        $obj_email->SMTPAuth = TRUE;
        $obj_email->Username = "allansantoscaetano@gmail.com";
        $obj_email->Password = "22917553478";
        $obj_email->setFrom("allansantoscaetano@gmail.com", "Lembrete de Contato");
        $obj_email->addAddress("allansantos_caetano@hotmail.com");
        $obj_email->CharSet = "utf-8";
        $obj_email->Subject = "Lembrete de Contato";
        $obj_email->msgHTML($mensagem);
        foreach ($anexos as $anexo) {
            $obj_email->addAttachment("uploads/" . $anexo->arquivo);
        }
        $obj_email->send();
    }
    
    public function adicionar_anexos() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $_FILES['userfile']['name'];
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            $anexos['contato_id'] = $this->input->post('contato_id');
            $anexos['nome'] = $_FILES['userfile']['name'];
            $anexos['arquivo'] = $_FILES['userfile']['name']; 
            $this->modelcontatos->adicionar_anexos($anexos);
        }
        $this->listar_anexos($this->input->post('contato_id'));
    }
}
