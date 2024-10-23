<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    
    
    public function __construct() 
        {
            parent::__construct();
            $this->load->library('form_validation');
            
       
        }

    public function index()
        {
            if ($this->session->userdata('email')) {
                redirect('user');
            }
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            
            if ($this->form_validation->run() == false){ //run adalah sebuah method                
                $data['title'] = 'Login Page';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                //validasiny success
                $this->_login();
                
            }
        }


        private function _login()
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //mncri user dn email yg sesuai yg ditulis tadi
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            
            //jika usermya ada
            if ($user) {
                //jika usernya aktif
                if($user['is_active'] == 1) {
                    //cek pass
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        $this->session->set_userdata($data);
                        if($user['role_id'] == 1) {
                            redirect('admin');
                        }else{
                            redirect('user');
                        }
                        
                        
                        
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Wrong Password!
                        </div>');
                        redirect(auth);
                    }
                    
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This Email has not been activated!
                </div>');
                redirect(auth);
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered !
                </div>');
                redirect(auth);
                
            }
        }
        
        public function registration()
        {
            if ($this->session->userdata('email')) {
                redirect('user');
            }
            
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]',[ 
                'is_unique' => 'This email has already registered!'
                //is_unique adalah rule jd kita mmbuat pesan untuk rule
                
            ]); 
            //tidak perlu pengecekan manual,siku untuk memasukan nm tabel dan nm field di db -> sudh ad blm di databaase
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            
            
            if( $this->form_validation->run() == false){
                
                $this->load->library('form_validation');
                $data['title'] = 'Registration Page';
                $this->load->view('templates/auth_header');
                $this->load->view('auth/registration');
                $this->load->view('templates/auth_footer');
            }else {
                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)), //true untuk menghindari cross side scripting dan htmlspcal untuk mensanitasi input kita-> untuk membungkus input kita
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 1,
                    'date_created' => time()                                     
                ];

                $this->db->insert('user',$data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Congratulation your account has been created. Please Login!
                    </div>');
                
                redirect(auth);
            }
            
        }

        public function logout()
        {
            
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
               You have been logout!
                </div>');
                
                redirect('auth');                
          
        }

        public function blocked()
        {
            $this->load->view('auth/blocked');
        }
    
}