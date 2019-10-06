<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function index_post()
    {
        $this->load->model('M_user', 'user');
        $this->load->model('M_online', 'online');
        
        $user = $this->post('username');
        $pass = md5($this->post('password'));
        $where = array(
			'username' => $user,
			'password' => $pass
        );
        
        $query_login = $this->user->lihat2($where);
        $cek_login = $query_login->num_rows();

        $data_user = [];
        if($cek_login == 1){

            $this->load->library('Uuid');

            $sesi = $this->uuid->v4();
            $query_row = $query_login->row();

            $data_user['username'] = $query_row->username;
            $data_user['fullname'] = $query_row->user_fullname;
            $data_user['instansi'] = $query_row->company;
            $data_user['desc_instansi'] = $query_row->desc_company;
            $data_user['privilages'] = $query_row->privilages_user;
            $data_user['flag_user'] = $query_row->flag;
            $data_user['desc_flag_user'] = $query_row->desc_user_status;
            $data_user['allow_to_login'] = $query_row->allow_to_login;
            if($query_row->allow_to_login == 0){
                $data_user['desc_allow_to_login'] = 'YA';
            }
            else{
                $data_user['desc_allow_to_login'] = 'NO';
            }
            $data_user['sesion'] = $sesi;
            // $data_user[''] = $query_row->;
            $data = array(
                'id_user' => $query_row->id_user,
                'session_api' => $sesi
                // 'date_time' => date('Y-m-d H:i:s')
            );
            $this->online->online_api($data);

            $this->response($data_user, 200);
        }
        else{
            $this->set_response([
                'status' => false,
                'message' => 'Usernname atau Password Salah'
            ], 404); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function session_post()
    {
        $this->load->model('M_user', 'user');
        $this->load->model('M_online', 'online');
        
        $session = $this->post('session');
        $where = array(
			'session_api' => $session
        );
        
        $query_login = $this->user->lihat_api($where);
        $cek_login = $query_login->num_rows();

        $data_user = [];
        if($cek_login == 1){

            $query_row = $query_login->row();

            $data_user['username'] = $query_row->username;
            $data_user['fullname'] = $query_row->user_fullname;
            $data_user['instansi'] = $query_row->company;
            $data_user['desc_instansi'] = $query_row->desc_company;
            $data_user['privilages'] = $query_row->privilages_user;
            $data_user['flag_user'] = $query_row->flag;
            $data_user['desc_flag_user'] = $query_row->desc_user_status;
            $data_user['allow_to_login'] = $query_row->allow_to_login;
            if($query_row->allow_to_login == 0){
                $data_user['desc_allow_to_login'] = 'YA';
            }
            else{
                $data_user['desc_allow_to_login'] = 'NO';
            }
            $data_user['sesion'] = $query_row->session_api;

            $this->response($data_user, 200);
        }
        else{
            $this->set_response([
                'status' => false,
                'message' => 'Session Tidak Berlaku'
            ], 404); // NOT_FOUND (404) being the HTTP response code
        }
    }

}

/* End of file Login.php */
