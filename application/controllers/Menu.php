<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
    public function __construct()   
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model'); // Pastikan model ini di-load
    }
    
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
             
        if ($this->form_validation->run() == FALSE) {        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('Menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil ditambahkan!!
            </div>');
            redirect('menu');
            
        }            
    }

    public function deleteMenu($id)
    {
        $this->Menu_model->delete_data($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!
       </div>');
       redirect('menu'); 
        
    }

    public function uptadeMenu($id) //ini diambil dari url dn ini parameter
    {
        $data['menu'] = $this->Menu_model->getMenuById($id); //id didapat dari padameter methodnya

        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
             
        if ($this->form_validation->run() == FALSE) {        
            $this->index();
        } else {
            $this->Menu_model->ubahMenu(); //ubah menu disamakan pada view // dn dbuat dimodel
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            </div>');
            redirect('menu');
            
        }            
    }

    public function submenu()

    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
        
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
       

    
        if ($this->form_validation->run() ==  FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
           
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon')
                              
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sub menu baru berhasil ditambahkan!</div>');
            redirect('menu/submenu');
            
            
        }
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
    
        ];
    
    }
    
    public function deleteSubmenu($id) //benar
    {
        $this->Menu_model->deleteData($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!
       </div>');
       redirect('menu/submenu'); 
        
    }
    
    public function updateSubmenu($id)
    {

        $data['submenu'] = $this->Menu_model->getSubmenuById($id); //id didapat dari padameter methodnya


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        
        if ($this->form_validation->run() ==  FALSE) {
            $this->submenu();
        }else {
            
            $this->Menu_model->ubahSubmenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data berhasil diubah!
            </div>');
            redirect('menu/submenu');
            
        }
    }    
    
    
}