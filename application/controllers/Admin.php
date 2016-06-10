<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('layout');
		$this->layout->setFolder('admin');
	}

	public function index(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'dashboard';
		}
		$this->layout->view('index',$data);
	}

	public function secciones(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'secciones';
			
			$this->db->select('s.*, ss.name as status, u.username, t.name as template_name');
			$this->db->from('sections s');
			$this->db->join('users u', 's.user_id = u.id');
			$this->db->join('templates t', 's.template_id = t.id', 'left');
			$this->db->join('sections_status ss', 's.status_id = ss.id', 'left');
			$data['secciones'] = $this->db->get()->result();
		}
		$this->layout->view('secciones',$data);
	}

	public function products_get(){
		$rows = $this->product->list_productos();
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	public function get_product(){
		$id = $_POST['id'];
		
		if($_POST){
			
		//	$this->db->where('id',$id);
			$rs = $this->db->get_where('productos',array('id'=>$id));
			$products = $rs->row();
			echo json_encode($products);
			
		}

	}	
	public function agregar_seccion(){

		if($_POST){
			$url = $this->toAscii($_POST['name']);
			$insert['name'] = $_POST['name'];
			$insert['user_id'] = $this->tank_auth->get_user_id();
			$insert['url'] = $url;
			$insert['text'] = $_POST['text'];
			$insert['template_id'] = $_POST['template'];
			$insert['status_id'] = $_POST['status'];
			$this->db->insert('sections', $insert);
			redirect('admin/secciones');
		}

		$this->db->select('*');
		$this->db->from('templates');
		$data['templates'] = $this->db->get()->result();

		$this->db->select('*');
		$this->db->from('categorias');
		$data['categorias'] = $this->db->get()->result();

		$data['active_tab'] = 'secciones';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role'] = $this->tank_auth->get_role();
		$this->layout->view('agregar_seccion', $data, $return=false);
	}

	public function agregar_texto(){

		if($_POST){
			
			$insert['text'] = $_POST['descripcion'];
			$insert['section_id'] = $_POST['seccion_id'];
			$this->db->insert('texts', $insert);
			redirect('admin/textos');
		}
		$data['active_tab'] = 'textos';
		$this->db->select('*');
		$this->db->from('sections');
		$data['secciones'] = $this->db->get();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role'] = $this->tank_auth->get_role();
		$this->layout->view('agregar_texto', $data, $return=false);
	}	


	public function editar_seccion($id){

		if($_POST){
			$url = $this->toAscii($_POST['name']);
			$update['name'] = $_POST['name'];
			$update['user_id'] = $this->tank_auth->get_user_id();
			$update['url'] = $url;
			$update['text'] = $_POST['text'];
			$update['template_id'] = $_POST['template'];
			$update['status_id'] = $_POST['status'];

			$update['user_id'] = $this->tank_auth->get_user_id();


			$this->db->where('id',$id);
			$this->db->update('sections',$update);
			
			redirect('admin/secciones');
		
		}
		$data['active_tab'] = 'secciones';
		$this->db->select('*');
		$this->db->from('categorias');
		$data['categorias'] = $this->db->get()->result();

		$this->db->select('*');
		$this->db->from('templates');

		$data['templates'] = $this->db->get()->result();
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role'] = $this->tank_auth->get_role();

		$data['seccion'] = $this->db->get_where('sections',array('id'=>$id))->row();
		$this->layout->view('editar_seccion', $data);
	}
	
	
	public function caategoria_by_producto($product_id){
		$rs = $this->db->get_where('productos_categorias',array('producto_id'=>$product_id));
		
		$array = array();
		
		if($rs->num_rows() > 0){

			foreach($rs->result() as $categoria){ 
				$array[] = $categoria->categoria_id;
			}
			
		}
		return $array;
	}

	public function media(){
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'media';
		$this->db->select('m.*,u.username');
		$this->db->from('media m');
		$this->db->join('users u', 'm.user_id = u.id');
		$data['files'] = $this->db->get()->result();
		$this->layout->view('media', $data);
	}
	
	public function agregar_media(){
		if($_FILES){
			
			$this->upload();

		}
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['role'] = $this->tank_auth->get_role();
		$data['active_tab'] = 'media';
		$this->layout->view('agregar_media', $data);
	}



	public function upload(){

		if(!empty($_FILES['userfile']['name'])){
			
			$num_archivos = count($_FILES['userfile']['tmp_name']);
			$files = $_FILES;
			for ($i = 0; $i < $num_archivos; $i++) { 

				$fileName = $files['userfile']['name'][$i];
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$newFileName =  pathinfo($fileName, PATHINFO_FILENAME);
				$file = $this->toAscii($newFileName);
				$fecha = new DateTime();
				$finalName = $file.'_'.$fecha->getTimestamp().'.'.$ext;

				$config['file_name'] = $finalName; 
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|doc|xls|docx|xlsx|ppt|pptx';
				$config['max_size']	= '10000';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				$_FILES['userfile']['name'] = $finalName;
				$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
				$_FILES['userfile']['size'] = $files['userfile']['size'][$i]; 

				if ( ! $this->upload->do_upload('userfile')){
					$error = array('error' => $this->upload->display_errors());

					print_r($error);
					die();
				}else{
						$insert['name'] = $file;
						$insert['type'] = $ext;
						$insert['file'] = $finalName;
						$insert['user_id'] = $this->tank_auth->get_user_id();
						$this->db->insert('media', $insert);
					}
					
				}
			}
			
			

		

	}

	public function contactos(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'contactos';
		}
		$this->layout->view('contactos',$data);

	}

	public function usuarios(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'usuarios';
		}
		$this->layout->view('usuarios',$data);

	}

	public function textos(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'textos';
		}
		$this->layout->view('textos',$data);

	}

	public function get_contactos(){
		$rows = $this->db->get('contacts');
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	public function get_usuarios(){
		$this->db->select('u.*, r.role');
		$this->db->from('users u');
		$this->db->join('roles r', 'u.role_id = r.id');

		$rows = $this->db->get();
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	public function get_textos(){
		$this->db->select('t.*, s.name as sectionname');
		$this->db->from('texts t');
		$this->db->join('sections s', 't.section_id = s.id');
		$rows = $this->db->get();
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	public function get_contact(){
		$id = $_POST['id'];
		
		if($_POST){
			
		//	$this->db->where('id',$id);
			$rs = $this->db->get_where('contacts',array('id'=>$id));
			$products = $rs->row();
			echo json_encode($products);
			
		}

	}

	public function cvs(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'cvs';
		}
		$this->layout->view('cvs',$data);
	}

	public function get_cvs(){
		$rows = $this->db->get('teams');
		$array = array();
		foreach ($rows->result() as $row) {
			$array[] = $row;
		}
		echo json_encode($array);
	}

	public function cv_delete(){
		$id = $_POST['id'];
		$this->db->delete('teams',array('id'=>$id));
	}	

	public function user_delete(){
			$id = $_POST['id'];
			$this->db->delete('users',array('id'=>$id));
		}	

	public function contact_delete(){
		$id = $_POST['id'];
		$this->db->delete('contacts',array('id'=>$id));
	}

	public function delete_media(){
		$id = $_POST['id'];
		$this->db->delete('media',array('id'=>$id));
	}	

	public function producto_delete(){
		$id = $_POST['id'];
		$this->db->delete('productos',array('id'=>$id));
	}

	function toAscii($str, $replace=array(), $delimiter='-') {
		$str = strip_tags($str);
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}



	public function portfolio(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'portfolio';
			$this->db->select('*');
			$this->db->from('portfolio');
			$data['portfolios'] = $this->db->get()->result();
			$this->layout->view('portfolio', $data);
		}

	}
	public function borrar_portfolio($id){
		
		$this->db->delete('portfolio',array('id'=>$id));
		redirect('admin');
	}

	public function saveItem(){
		if($_POST){
				$insert['titulo'] = $this->input->post('titulo');
				$insert['subtitulo'] = $this->input->post('subtitulo');
				$insert['comentario'] = $this->input->post('comentario');
				$insert['ubicacion'] = $this->input->post('ubicacion');
				$insert['tiempo'] = $this->input->post('tiempo');
				$insert['ano'] = $this->input->post('ano');
				$insert['actividad'] = $this->input->post('actividad');
				$insert['modalidad'] = $this->input->post('modalidad');
				$insert['imagen'] = $this->input->post('imagenp');
				$insert['carousel'] = $this->input->post('imagenc');
				$insert['superficie'] = $this->input->post('superficie');
				$insert['categoria'] = $this->input->post('categoria');
				$insert['proyecto'] = $this->input->post('proyecto');
				$insert['url'] = $this->toAscii($this->input->post('titulo'));


				$this->db->insert('portfolio', $insert);
			}
	}
	
	public function editItem(){
		if($_POST){
				$id = $this->input->post('id');
				$update['titulo'] = $this->input->post('titulo');
				$update['subtitulo'] = $this->input->post('subtitulo');
				$update['comentario'] = $this->input->post('comentario');
				$update['ubicacion'] = $this->input->post('ubicacion');
				$update['tiempo'] = $this->input->post('tiempo');
				$update['ano'] = $this->input->post('ano');
				$update['actividad'] = $this->input->post('actividad');
				$update['modalidad'] = $this->input->post('modalidad');
				$update['imagen'] = $this->input->post('imagenp');
				$update['carousel'] = $this->input->post('imagenc');
				$update['superficie'] = $this->input->post('superficie');
				$update['categoria'] = $this->input->post('categoria');
				$update['proyecto'] = $this->input->post('proyecto');
				$update['url'] = $this->toAscii($this->input->post('titulo'));

				$this->db->where('id', $id);
				$this->db->update('portfolio', $update);
			}
	}



	public function agregar_portfolio(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$this->db->select('*');
			$this->db->from('templates');
			$data['templates'] = $this->db->get()->result();
			$this->db->select('*');
			$this->db->from('categorias');
			$data['categorias'] = $this->db->get()->result();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'portfolio';
			$this->db->select('*');
			$this->db->from('media');
			$this->db->where_in('type', array('jpg', 'png', 'jpeg'));
			$data['imagenes'] = $this->db->get()->result();
			$this->layout->view('agregar_seccion', $data);
		}

	}

	public function editar_portfolio($id){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['role'] = $this->tank_auth->get_role();
			$data['active_tab'] = 'portfolio';
			$this->db->select('*');
			$this->db->from('media');
			$this->db->where_in('type', array('jpg', 'png', 'jpeg'));
			$data['imagenes'] = $this->db->get()->result();
			$this->db->select('*');
			$this->db->from('portfolio');
			$this->db->where('id', $id);
			$data['item'] = $this->db->get()->row();
			$this->layout->view('editar_portfolio', $data);
		}

	}

	
}