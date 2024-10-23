<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

   
    public function __construct()   
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
    }
        
    
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();
        
       

        $data['tb_kas'] = $this->Admin_model->getKasUmum();
        $data['jumlah_transaksi'] = $this->Admin_model->getJumlahTransaksi();
        $data['kas_masuk'] = $this->Admin_model->getTotalKasMasuk();
        $data['kas_keluar'] = $this->Admin_model->getTotalKasKeluar();

        // Hitung saldo
        $data['saldo'] = $data['kas_masuk'] - $data['kas_keluar'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Admin/role', $data);
        $this->load->view('templates/footer');
    }
    
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id'=> $role_id ])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array(); 
        // diambil dari data menu
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access berubah!
            </div>');
           
    }

    public function deleteRole($id)
    {
        $this->Admin_model->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!
       </div>');
       redirect('admin/role'); 
        
    }

    public function uptadeRole($id) //ini diambil dari url dn ini parameter
    {
        $data['role'] = $this->Admin_model->getRoleById($id); //id didapat dari padameter methodnya

        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');
             
        if ($this->form_validation->run() == FALSE) {        
            $this->load->view('Admin/role', $data);
        } else {
            $this->Admin_model->ubahRole(); //ubah menu disamakan pada view // dn dbuat dimodel
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            </div>');
            redirect('admin/role');
            
        }            
    }

    public function tambahRole() //ini diambil dari url dn ini parameter
    {
        $this->form_validation->set_rules('role', 'Role', 'required');
             
        if ($this->form_validation->run() == FALSE) {        
            $this->role();
        } else {
            $this->Admin_model->addRole(); //ubah menu disamakan pada view // dn dbuat dimodel
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil ditambah!
            </div>');
            redirect('admin/role');
            
        }            
    }

    
    

    
}