<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('layout');
		
		$this->layout->setLayout('layout-web');
		
	}

	public function index($url = null){
		if(isset($url)){
			$this->layout->setFolder('web/templates');
			$this->db->select('s.name as page_title,s.text as page_content, t.*, s.status_id as status');
			$this->db->from('sections s');
			$this->db->join('templates t', 's.template_id = t.id');
			$this->db->where('url', $url);
			$data['section'] = $this->db->get()->row();
			
			//si no existe la url o esta en draft muestro 404
			if($data['section'] == '' || $data['section']->status == STATUS_DRAFT){
				echo 'Página no encontrada.';
				die();
			}else{
				$template = $data['section']->template;
				$this->layout->view($template, $data);
			}
			
		}else{
			$this->layout->setFolder('web');
			$this->layout->view('index');
		}
		
	}

	

}