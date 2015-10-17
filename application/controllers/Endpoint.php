<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endpoint extends CI_Controller {

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
		echo '<h1>Ciclomatic Webservice Endpoint</h1><p>Up and running!</p>';
	}
	
	public function login() {
		
		$this->fix_origin();
		
		$email = $this->input->post('username');
		$senha = md5($this->input->post('password'));
		
		$ciclista = $this->db->get_where('ciclistas', array('email'=>$email, 'senha'=>$senha));

		if ($ciclista->num_rows() > 0) {
			echo $ciclista->row(0)->id_ciclista;
		} else {
			echo '-1';
		}
		
	}
	
	public function provas() {
		$this->fix_origin();
		
		$provas = $this->db->get('provas')->result();
		
		// formata datas em BRT
		foreach ($provas as $prova) {
			$prova->tempo_inicio = date("d/m/Y H\hi", strtotime($prova->tempo_inicio));
			$prova->tempo_fim = date("d/m/Y H\hi", strtotime($prova->tempo_fim));
		}
		
		echo json_encode($provas);
	}
	
	public function dados() {
		$this->fix_origin();
		
		$postdata = file_get_contents("php://input");
		$dados = json_decode($postdata, true);
		$dados['id_dado'] = NULL;
		
		$this->db->insert('dados', $dados);
		
		echo ($this->db->affected_rows() != 1) ? '0' : '1';
		
	}
	
	public function msg() {
		
		$this->fix_origin();
		
		$postdata = file_get_contents("php://input");
		$dados = json_decode($postdata, true);
		$dados['id_mensagem'] = NULL;
		
		$this->db->insert('mensagens', $dados);
		
		echo ($this->db->affected_rows() != 1) ? '0' : '1';
		
	}
	
	private function fix_origin() {
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}
	}
	
}
