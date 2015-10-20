<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provas extends CI_Controller {

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
	
	function __construct()
	{
	    parent::__construct();
	    if (!isset($_SESSION['usuario']))
	    { 
	    	header("Location: ".base_url()."login");
	    }
	}
	
	public function index()
	{
		$data['provas'] = $this->db->get('provas')->result();
		$this->load->vars($data);
		$data['conteudo'] = $this->load->view('provas', '', true);
		$this->load->vars($data);
		$this->load->view('layout_base', '');
	}
}
