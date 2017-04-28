<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('m_login');
  }

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

    $this->load->view('admin/adm_login');
	}

  public function aksi_login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $where = array(
      'username' => $username,
      'password' => md5($password)
    );
    // print_r($where);
    $cek = $this->m_login->cek_login("admin",$where)->num_rows();
    print_r($cek);
    if($cek > 0){
      $data_session = array(
        'nama' => $username,
        'status' => "login"
      );

      $this->session->set_userdata($data_session);
      redirect(base_url("admin/home"));
    }else{
      $data['message'] = "username dan password salah";
      $this->load->view('admin/adm_login',$data);
    }
  }

  public function logout(){
    $this->session->sess_destroy();
    redirect(base_url('admin'));
  }

  public function home(){
    $this->load->view('admin/adm_home');
  }

  public function category_article(){
    $data['tampil'] = "berhasil";
    $this->load->view('admin/adm_category_article',$data);
  }
  public function proses_login(){
    echo "berhasil";
  }

}
