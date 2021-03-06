<?php
/**
* 
*/
class Template
{
	private $CI;
	private $_js = array();
	private $_css = array();
	private $_meta = array();
	private $_canonical = array();
	private $_js_view = 'layouts/js_view';
	private $template_data = array();
	private $sidebar_data = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function set($content_area, $value)
	{
		$this->template_data[$content_area] = $value;
	}

	public function section($name='', $view = '',$view_data = array())
	{
		$this->set($name, $this->CI->load->view($view, $view_data, TRUE));
	}

	public function css()
	{
		$css_files = func_get_args();
		foreach ($css_files as $value) {
			$this->_css[] = $value;
		}
		return;
	}

	public function js()
	{
		$js_files = func_get_args();
		foreach ($js_files as $value) {
			$this->_js[] = $value;
		}
		return;
	}

	public function set_meta($name, $content){
		$this->_meta[$name] = $content;
		return true;
	}

	public function set_canonical($url)
    {
       $this->_canonical = $url;
    }

	public function load($template = '', $name='', $view = '',$view_data = array(),$return = FALSE)
	{
		$this->template_data['js'] = $this->_js;
		$this->template_data['css'] = $this->_css;
		$this->template_data['meta'] = $this->_meta;
		$this->set($name, $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view('layouts/'.$template , $this->template_data); 
	}

	// take your custom template setting in here

	public function adminlte($content, $data= array(),$js_view=NULL, $return= FALSE)
	{
		if ($js_view != NULL) {
			$this->_js_view = $js_view;
		}
		$this->section('sidebar','layouts/sidebar', $this->sidebar_data);
		// $this->section('control_sidebar','layouts/control_sidebar');
		$this->section('js_view',$this->_js_view);
		$this->load('default','content',$content, $data);
	}

	private function auth($where,$kd=NULL,$mn=NULL, $ajax = NULL)
	{
		$CI =& get_instance();
		$CI->load->helper('cookie');
		$CI->input->set_cookie('key', $CI->security->get_csrf_token_name(),600);
		$CI->input->set_cookie('value_key', $CI->security->get_csrf_hash(), 600);
		$CI->load->model('M_user');
		$CI->load->model('M_online');
		$CI->load->model('M_nav_menu');
		$CI->load->model('M_permission');
		$create = '';
		$update = '';
		$delete = '';
		$upload = '';
		$query = $CI->M_user->lihat($where);
		$cek = $query->row();
		if($query->num_rows() != 1){
			redirect(base_url("login"));
		}
		else{
			$data= array(
				'id_user' => $cek->id_user,
				'session' => $CI->session->userdata('session'),
				'date_time' => date('Y-m-d H:i:s')
				);
			$CI->M_online->online($data);
			$data_session = array(
				'id' => $cek->id_user,
				'session' => $CI->session->userdata('session'),
				'username' => $cek->username,
				'company' => $cek->company,
				'level' => $cek->privilages_user
			);
			$CI->session->set_userdata($data_session);
			$cek_permission = '';
			if ($cek->privilages_user != 1 and $kd != NULL) {
				$cek_permissions = $CI->M_permission->check_permission(array('priv_permissions'=>$cek->privilages_user,'nav_permissions'=>$mn));
				if ($cek_permissions->num_rows() != 1) {
					redirect(base_url('hmmm/not_found'));
				}
				else{
					$cek_permissions_row = $cek_permissions->row();
					if ($kd == 'r' and $mn != NULL) {
						if ($cek_permissions_row->read_permissions != 1) {
							redirect(base_url('hmmm/not_found'));
						}
					}
					if ($kd == 'u' and $mn != NULL){
						if ($cek_permissions_row->update_permissions != 1) {
							redirect(base_url('hmmm/not_found'));
						}	
					}
					if ($kd == 'c' and $mn != NULL){
						if ($cek_permissions_row->create_permissions != 1) {
							redirect(base_url('hmmm/not_found'));
						}	
					}
					if ($kd == 'd' and $mn != NULL){
						if ($cek_permissions_row->delete_permissions != 1) {
							redirect(base_url('hmmm/not_found'));
						}	
					}
					if ($kd == 'y' and $mn != NULL){
						if ($cek_permissions_row->upload_permissions != 1) {
							redirect(base_url('hmmm/not_found'));
						}	
					}
					$create = $cek_permissions_row->create_permissions;
					$update = $cek_permissions_row->update_permissions;
					$delete = $cek_permissions_row->delete_permissions;
					$upload = $cek_permissions_row->upload_permissions;
				}
			}
			if ($cek->privilages_user == 1) {
				$create = 1;
				$update = 1;
				$delete = 1;
				$upload = 1;
			}
			if ($ajax == NULL or $ajax != 'Y') {
				# code...
				$menu = $CI->M_nav_menu->show()->result();
				$data_menu = array();
		        foreach ($menu as $k) {
		        	$tmp = new stdClass;
		            if ($cek->privilages_user == 1) {
			            $tmp->desc_nav = $k->desc_nav;
			            $tmp->fa = $k->fa;
		            	$tmp->nav_content = $CI->M_nav_menu->nav_content_show(array('fk_id_nav'=>$k->id_nav))->result();
		            }else{
		            	$q_menu = $CI->M_permission->show_permissions_menu(array('fk_id_nav'=>$k->id_nav,'read_permissions'=> 1,'priv_permissions'=>$cek->privilages_user));
		            	if ($q_menu->num_rows() >= 1) {
		            		$tmp->desc_nav = $k->desc_nav;
			            	$tmp->fa = $k->fa;
		            		$tmp->nav_content = $q_menu->result();
		            	}
		            	else{
		            		// break;
		            		$tmp->desc_nav = $k->desc_nav;
			            	$tmp->fa = $k->fa;
		            		$tmp->nav_content = '';
		            	}
		            }
		            $data_menu[] = $tmp;
		        }
				$this->sidebar_data['menu'] = $data_menu;
			}
			$this->template_data['name'] = $CI->session->userdata('username');
			$this->sidebar_data['priv'] = $cek->privilages_user;
			// $this->template_data['fullname'] = $cek->user_fullname;
			$this->sidebar_data['fullname'] = $cek->user_fullname;
			// $this->template_data['photo'] = base_url().'assets/image/profil/'.$cek->photo;
			$this->sidebar_data['photo'] = base_url().'assets/image/profil/'.$cek->photo;
			$this->sidebar_data['update'] = $update;
			$this->sidebar_data['create'] = $create;
			$this->sidebar_data['delete'] = $delete;
			$this->sidebar_data['upload'] = $upload;
			$this->sidebar_data['company'] = $cek->desc_company;
			return;
		}
	}

	public function authlogin($kd=NULL,$mn=NULL,$just_ajax = NULL)
	{
		$CI =& get_instance();
		$where = array(
			'b.session' => $CI->session->userdata('session'),
			'd.allow_to_login'=> 0
			);
		$this->auth($where,$kd,$mn,$just_ajax);
	}

	public function if_admin()
	{
		$CI =& get_instance();
		$where = array(
			'b.session' => $CI->session->userdata('session'),
			'a.privilages_user' => 1,
			'd.allow_to_login'=> 0
			);
		$this->auth($where);
	}

	public function authlogin_ajax($kd=NULL,$mn=NULL)
	{
		$CI =& get_instance();
		$where = array(
			'b.session' => $CI->session->userdata('session'),
			'd.allow_to_login'=> 0
			);
		$CI->load->helper('cookie');
		$CI->input->set_cookie('key', $CI->security->get_csrf_token_name(),600);
		$CI->input->set_cookie('value_key', $CI->security->get_csrf_hash(), 600);
		$CI->load->model('M_user');
		$CI->load->model('M_online');
		$CI->load->model('M_permission');
		$create = '';
		$update = '';
		$delete = '';
		$upload = '';
		$query = $CI->M_user->lihat($where);
		$cek = $query->row();
		$message = array();
		if($query->num_rows() != 1){
			$message['log'] = 0;
			$message['detail'] = "user tidak ada";
		}
		else{
			$data= array(
				'id_user' => $cek->id_user,
				'session' => $CI->session->userdata('session'),
				'date_time' => date('Y-m-d H:i:s')
				);
			$CI->M_online->online($data);
			$data_session = array(
				'id' => $cek->id_user,
				'session' => $CI->session->userdata('session'),
				'username' => $cek->username,
				'company' => $cek->company,
				'level' => $cek->privilages_user
			);
			$CI->session->set_userdata($data_session);
			$cek_permission = '';
			if ($cek->privilages_user != 1 and $kd != NULL) {

				$where_permission = array('priv_permissions'=>$cek->privilages_user,'nav_permissions'=>$mn);
				if ($kd == 'r') {
					$where_permission['read_permissions'] = 1;
				}elseif ($kd == 'c') {
					$where_permission['create_permissions'] = 1;
				}elseif ($kd == 'u') {
					$where_permission['update_permissions'] = 1;
				}elseif ($kd == 'd') {
					$where_permission['delete_permissions'] = 1;
				}elseif ($kd == 'y') {
					$where_permission['upload_permissions'] = 1;
				}else{
					echo "error code";
				}

				$cek_permissions = $CI->M_permission->check_permission($where_permission);
				if ($cek_permissions->num_rows() != 1) {
					$message['log'] = 0;
					$message['detail'] = "Tidak Boleh Akses Halaman";
				}
				else{
					$message['log'] = 1;
					$message['detail'] = "auth sukses";

					$cek_permissions_row = $cek_permissions->row();
					$create = $cek_permissions_row->create_permissions;
					$update = $cek_permissions_row->update_permissions;
					$delete = $cek_permissions_row->delete_permissions;
					$upload = $cek_permissions_row->upload_permissions;
				}
			}else{
				$message['log'] = 1;
				$message['detail'] = "auth sukses";
				
				$create = 1;
				$update = 1;
				$delete = 1;
				$upload = 1;
			}
			$this->sidebar_data['update'] = $update;
			$this->sidebar_data['create'] = $create;
			$this->sidebar_data['delete'] = $delete;
			$this->sidebar_data['upload'] = $upload;
			$this->sidebar_data['company'] = $cek->desc_company;
			$this->sidebar_data['priv'] = $cek->privilages_user;
			$this->template_data['name'] = $CI->session->userdata('username');
		}
		return $message;
	}

	public function get_sidebar_data()
	{
		$data = array(
			'priv' => $this->sidebar_data['priv'],
			'delete' => $this->sidebar_data['delete'],
			'update' => $this->sidebar_data['update'],
			'create' => $this->sidebar_data['create'],
			'upload' => $this->sidebar_data['upload'],
			'user' => $this->template_data['name']
			);
		return $data;
	}
}
?>