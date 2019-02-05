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
        if (is_numeric($this->input->post('username'))) {
            $row = $this->Login_model->login($username, $password)->row();
        } else {
            $row = $this->Login_model->login2($username, $password)->row();
        }
        



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

        public function forget_password()
        {
            $this->load->view('Settings/page_forget');


            $this->load->library('email');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $email = $this->input->post('email');

                $checkemail = $this->db->query('SELECT * FROM tbl_pegawai WHERE EMAIL_PEG = "'.$email.'"');

                if ($checkemail->num_rows() != 1) {
                    $this->session->set_flashdata('PesanError', 'Email Tidak Ditemukan');
                    redirect('Controller_login');
                }else {
                    $this->load->library('email');
                        $code1 = hash("crc32" , $email);
                        $code2 = hash("crc32b" , date('Ymdhis'));
                        $code = $code1.$code2;
                        $data = array('PASSWORD' => md5($code));

                        $this->db->update('tbl_pegawai', $data, array('EMAIL_PEG' => $email));
                        // echo md5($code);
                        // die();
                        $config = array();
                        $config['charset'] = 'utf-8';
                        $config['useragent'] = 'Codeigniter';
                        $config['protocol']= "smtp";
                        $config['mailtype']= "html";
                        $config['smtp_host']= "ssl://smtp.gmail.com";
                        $config['smtp_port']= 465;
                        $config['smtp_timeout']= "5";
                        $config['smtp_user']= "ainurrofiq1904@gmail.com";
                        $config['smtp_pass']= "rofick.1913";
                        $config['crlf']="\r\n";
                        $config['newline']="\r\n";

                        $config['wordwrap'] = TRUE;
                        $data['url'] = base_url()."Controller_login/forgetPasswordConfirm/".md5($code);
                        $this->email->initialize($config);
                        $this->email->from('NESCAFE');
                        $this->email->to($email);
                        $this->email->subject('Permintaan Reset Password');
                        $message=$this->load->view('settings/email_reset_password_template',$data,TRUE);
                        $this->email->message($data['url']);

                        if($this->email->send()){
                            $this->session->set_flashdata('PesanSukses', 'Konfirmasi Reset Password Berhasil. Silahkan Buka Email Untuk Melakukan Perubahan Password');
                            redirect('Controller_login');
                        }
                        else{
                            $this->session->set_flashdata('PesanError', 'Periksa Koneksi Jaringan dan Pengaturan Email');
                            redirect('Controller_login');
                        }
                }

            }

        }

        public function forgetPasswordConfirm($code)
        {
            $data['code'] = $code; 
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $password = $this->input->post('password');

                $data = array('PASSWORD' => md5($password));

                $this->db->update('tbl_pegawai', $data, array('PASSWORD' => $code));
                $this->session->set_flashdata('PesanSukses', 'Password Berhasil Dirubah');
                redirect('Controller_login');
            }

            $this->load->view('settings/page_reset' ,$data);
        }

}
