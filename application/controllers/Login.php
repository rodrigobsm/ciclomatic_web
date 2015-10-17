<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login', '');
	}
	
	public function entrar() {
		
		$email = $this->input->post('email');
		$senha = md5($this->input->post('senha'));
		
		$usuario = $this->db->get_where('administradores', array('email'=>$email, 'senha'=>$senha));

		if ($usuario->num_rows() > 0) {
			$login = array("usuario" => $usuario->row(0));
			$this->session->set_userdata($login);
			header("Location: ".base_url()."home");
		} else {
			$this->session->set_userdata(array("msg"=>"E-mail ou senha inválido(s)!"));
			header("Location: ".base_url()."login");
		}
	}
	
	public function sair() {
		unset($_SESSION);
		session_destroy();
		header("Location: ".base_url()."login");
	}
}
