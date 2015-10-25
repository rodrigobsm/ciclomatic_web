<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prova extends CI_Controller {

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
	
	function _remap($method){
	    $param_offset = 2;
	
	    // Default to index
	    if ( ! method_exists($this, $method))
	    {
	        // We need one more param
	        $param_offset = 1;
	        $method = 'index';
	    }
	
	    // Since all we get is $method, load up everything else in the URI
	    $params = array_slice($this->uri->rsegment_array(), $param_offset);
	
	    // Call the determined method with all params
	    call_user_func_array(array($this, $method), $params);
	} 
	
	function index($id_prova)
	{
		$prova = $this->db->get_where('provas', array('id_prova' => $id_prova))->row(0);
		//$prova->pontos = $this->decode($prova->trajeto);
		
		$data['prova'] = $prova;
		$data['conteudo'] = $this->load->view('prova', $data, true);
		$this->load->view('layout_base', $data);
	}
	
	private function decode($encoded)
	{	
		
		$length = strlen($encoded);
		$index = 0;
		$points = array();
		$lat = 0;
		$lng = 0;
	
		while ($index < $length)
		{
			// Temporary variable to hold each ASCII byte.
			$b = 0;
	
			// The encoded polyline consists of a latitude value followed by a
			// longitude value.  They should always come in pairs.  Read the
			// latitude value first.
			$shift = 0;
			$result = 0;
			do
			{
				// The `ord(substr($encoded, $index++))` statement returns the ASCII
				//  code for the character at $index.  Subtract 63 to get the original
				// value. (63 was added to ensure proper ASCII characters are displayed
				// in the encoded polyline string, which is `human` readable)
				$b = ord(substr($encoded, $index++)) - 63;
	
				// AND the bits of the byte with 0x1f to get the original 5-bit `chunk.
				// Then left shift the bits by the required amount, which increases
				// by 5 bits each time.
				// OR the value into $results, which sums up the individual 5-bit chunks
				// into the original value.  Since the 5-bit chunks were reversed in
				// order during encoding, reading them in this way ensures proper
				// summation.
				$result |= ($b & 0x1f) << $shift;
				$shift += 5;
			}
			// Continue while the read byte is >= 0x20 since the last `chunk`
			// was not OR'd with 0x20 during the conversion process. (Signals the end)
			while ($b >= 0x20);
	
			// Check if negative, and convert. (All negative values have the last bit
			// set)
			$dlat = (($result & 1) ? ~($result >> 1) : ($result >> 1));
	
			// Compute actual latitude since value is offset from previous value.
			$lat += $dlat;
	
			// The next values will correspond to the longitude for this point.
			$shift = 0;
			$result = 0;
			do
			{
				$b = ord(substr($encoded, $index++)) - 63;
				$result |= ($b & 0x1f) << $shift;
				$shift += 5;
			}
			while ($b >= 0x20);
	
			$dlng = (($result & 1) ? ~($result >> 1) : ($result >> 1));
			$lng += $dlng;
	
			// The actual latitude and longitude values were multiplied by
			// 1e5 before encoding so that they could be converted to a 32-bit
			// integer representation. (With a decimal accuracy of 5 places)
			// Convert back to original values.
			$points[] = array($lat * 1e-5, $lng * 1e-5);
		}
	
		return $points;
	}
	
	function get_bikers($id_prova) {
		
		
			$inscritos = $this->db->get_where("inscricoes", array("id_prova" => $id_prova))->result();
			$dados = array();
			
			foreach ($inscritos as $inscrito) {
				
				// obtem dados do ciclista
				$this->db->join('inscricoes', 'inscricoes.id_ciclista = ciclistas.id_ciclista');
				$ciclista = $this->db->get_where("ciclistas", array("ciclistas.id_ciclista" => $inscrito->id_ciclista, "ativo"=> true))->row(0);
				unset($ciclista->senha);
				unset($ciclista->ativo);
				
				// pega ultimas 3 coordenadas do ciclista na prova
				$this->db->order_by("id_dado", "DESC");
				$this->db->limit(1700);  // ultima posicao apenas. Pode-se exibir mais de 1 ultima
				$dados_ciclista = $this->db->get_where("dados", array("id_prova"=>$id_prova, "id_ciclista"=>$ciclista->id_ciclista))->result();
				foreach ($dados_ciclista as $dado) {
					$dado->data_hora = date("d/m/Y H:i:s", strtotime($dado->data_hora));
				}
				$ciclista->dados = $dados_ciclista;
				
				// pega ultima mensagem enviada
				$this->db->order_by("id_mensagem", "DESC");
				$this->db->limit(1);  // ultima posicao apenas. Pode-se exibir mais de 1 ultima
				$msg = $this->db->get_where("mensagens", array("id_prova"=>$id_prova, "id_ciclista"=>$ciclista->id_ciclista));
				if ($msg->num_rows()>0) {
					$msg = $msg->row(0);
					$msg->data_hora = date("d/m/Y H:i:s", strtotime($msg->data_hora));
				} else {
					$msg->data_hora = 'n/d';
					$msg->tipo = 'n/d';
					$msg->lat = 'n/d';
					$msg->lon = '';
					$msg->altitude = 'n/d';
				}
				$ciclista->msg = $msg;
				
				$dados['posicoes'][] = $ciclista;
			}
			
			
			// pega ultimos dados
			$this->db->order_by("id_dado", "DESC");
			$this->db->limit(10);  // ultima posicao apenas. Pode-se exibir mais de 1 ultima
			$this->db->join('ciclistas', 'ciclistas.id_ciclista = dados.id_ciclista');
			$data = $dados_ciclista = $this->db->get_where("dados", array("id_prova"=>$id_prova))->result();
			foreach ($data as $dado) {
				$dado->data_hora = date("d/m/Y H:i:s", strtotime($dado->data_hora));
			}
			$dados['dados'] = $data;
			
			// pega ultimas msgs
			$this->db->order_by("id_mensagem", "DESC");
			$this->db->limit(10);  // ultima posicao apenas. Pode-se exibir mais de 1 ultima
			$this->db->join('ciclistas', 'ciclistas.id_ciclista = mensagens.id_ciclista');
			$msgs = $dados_ciclista = $this->db->get_where("mensagens", array("id_prova"=>$id_prova))->result();
			foreach ($msgs as $dado) {
				$dado->data_hora = date("d/m/Y H:i:s", strtotime($dado->data_hora));
			}
			$dados['msgs'] = $msgs;
			
			header('Content-Type: application/json');
			echo json_encode($dados);
		
		
	}
	
}
