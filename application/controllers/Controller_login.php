<?php
class Controller_login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('Login_model'));
		$this->load->helper(array('Form', 'Cookie', 'String'));
	}

	public function index()
    {
        $cookie = get_cookie('paulanacode');

        if ($this->session->userdata('logged')) {
					redirect('Controller_access');
        } else if($cookie <> '') {
            $row = $this->Login_model->get_by_cookie($cookie)->row();
            if ($row) {
                $this->_daftarkan_session($row);
            } else {
                $data = array(
                     'username' => set_value('username'),
                     'password' => set_value('password'),
                     'remember' => set_value('remember'),
                     'message' => $this->session->flashdata('message'),
                );
                $this->load->view('page_login', $data);
            }
        } else {
            $data = array(
                'username' => set_value('username'),
                'password' => set_value('password'),
                'remember' => set_value('remember'),
                'message' => $this->session->flashdata('message'),
            );

            $this->load->view('page_login', $data);
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');

        $row = $this->Login_model->login($username, $password)->row();


        if ($row) {

            if ($remember) {
                $key = random_string('alnum', 64);
                set_cookie('paulanacode', $key, 3600*24*30);
                $update_key = array(
                    'COOKIE' => $key
                );

                $this->Login_model->update($update_key, $row->NIP);
            }

            $this->_daftarkan_session($row);
        } else {

            $this->session->set_flashdata('message','Login Failed');
						$url=base_url('');
		        redirect($url);
        }

    }

    public function _daftarkan_session($row) {
        $sess = array(
            'logged' => TRUE,
            'nip' => $row->NIP,
						'nickname' => $row->NAMA_PEG,
						'level' => $row->LEVEL,
                        'gambar' => $row->FOTO_PEG
        );
        print_r($sess);

        $this->session->set_userdata($sess);


        redirect('Controller_access');
    }

    public function logout()
    {
	    delete_cookie('paulanacode');
        $this->session->sess_destroy();
				$url=base_url('');
        redirect($url);
    }
}
