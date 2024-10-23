<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller 
{
    public function __construct()   
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('format'); // Memuat helper 'format'
        $this->load->model('User_model'); 

    }

    
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();
            
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        

        if ($this->form_validation->run() ==  FALSE) {
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data); //edit itu view
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            
            //cek jika ada gambar yang akan diupload

            $upload_image= $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) { //dr input yg namanya image
                $old_image = $data['user']['image'];
                if($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('user');
            }

        }
    
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              Profil Anda telah diperbarui!
                </div>');
            redirect('user');
            
            
        }
        
    }
    
    public function datakasumum()
    {
        $data['title'] = 'Data Kas Umum';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['dataKas'] = $this->db->get('tb_kas')->result_array();
        $this->load->model('User_model');

        // Load pagination library
        $this->load->library('pagination');
        
        // Konfigurasi pagination
        $config['base_url'] = base_url('user/datakasumum'); // Sesuaikan dengan URL controller Anda
        $config['total_rows'] = $this->db->count_all('tb_kas'); // Jumlah total data
        $config['per_page'] = 10; // Jumlah data per halaman
        $config['uri_segment'] = 3; // Posisi segmen di URL untuk pagination
        
        // Konfigurasi pagination
        $config['base_url'] = base_url('user/report'); // Sesuaikan dengan URL controller Anda
        $config['total_rows'] = $this->db->count_all('tb_kas'); // Jumlah total data
        $config['per_page'] = 10; // Jumlah data per halaman
        $config['uri_segment'] = 3; // Posisi segmen di URL untuk pagination

        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&raquo;'; //right arrow quotation 
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo;'; //left arrow
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item ">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        
        // Initialize pagination
        $this->pagination->initialize($config);

        // Ambil data dari model dengan limit sesuai pagination
        $start = $this->uri->segment(3); // Ambil segmen ke-3 dari URL sebagai nilai awal
        $data['start'] = $start;
        $data['dataKas'] = $this->User_model->getdataKas($config['per_page'], $start);

        // Buat pagination link
        $data['pagination'] = $this->pagination->create_links();

        
        
         // Inisialisasi variabel
        $kas_keluar = 0;
        $kas_keluar = 0;
        $saldo = 0;

        // Menghitung nilai untuk setiap row
        foreach ($data['dataKas'] as $i => $row) {
            if ($i == 0) {
                $kas_masuk = $row['kas_masuk'];
                $saldo = $row['kas_masuk'];
            } else {
                if ($row['kas_masuk'] != 0) {
                    $kas_masuk += $row['kas_masuk'];
                    $saldo += $row['kas_masuk'];
                } else {
                    $kas_keluar += $row['kas_keluar'];
                    $saldo -= $row['kas_keluar'];
                }
            }
            // Menyimpan hasil perhitungan ke dalam array untuk ditampilkan di view
            $row['saldo'] = $saldo; // Menambahkan saldo ke row
            $data['dataKas'][$i] = $row; // Memperbarui row
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/datakasumum', $data); 
        $this->load->view('templates/footer');               
        
    }

    public function add_kasmasuk(){
       
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_bukti', 'No Bukti', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('kas_masuk', 'Kas Masuk', 'required');

        $kodeKas = $this->User_model->generateKasCode('KS'); // Menghasilkan id_kas baru

        if ($this->form_validation->run() == FALSE) {  
            $this->datakasumum();
        }else{
            // Generate kode kas dan nomor bukti
            $noBukti = $this->User_model->generateNoBuktiKasMasuk(); // MSK untuk no bukti kas masuk
                   
            $dataInsert = [ 
                'id_kas' => $kodeKas, // Menyimpan id_kas yang baru                
                'tanggal' => $this->input->post('tanggal'),   
                'no_bukti' => $this->input->post('no_bukti'),
                'uraian' => $this->input->post('uraian'),
                'kas_masuk' => $this->input->post('kas_masuk')
            ];
            // Load view dengan data
            $this->User_model->insert_kas($dataInsert); //
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data kas masuk berhasil ditambahkan!
            </div>');
            redirect('user/datakasumum');  
        } 
    }

    public function add_kaskeluar(){
        
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_bukti', 'No Bukti', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('kas_keluar', 'Kas Keluar', 'required');

        $kodeKas = $this->User_model->generateKasCode('KS'); // Menghasilkan id_kas baru

        if ($this->form_validation->run() == FALSE) {  
            $this->datakasumum();
        }else{
            // Generate kode kas dan nomor bukti
            $noBukti = $this->User_model->generateNoBuktiKasKeluar(); // MSK untuk no bukti kas keluar
                   
            $dataInsert = [ 
                'id_kas' => $kodeKas, // Menyimpan id_kas yang baru                
                'tanggal' => $this->input->post('tanggal'),   
                'no_bukti' => $this->input->post('no_bukti'),
                'uraian' => $this->input->post('uraian'),
                'kas_keluar' => $this->input->post('kas_keluar')
            ];
            // Load view dengan data
            $this->User_model->insert_kas($dataInsert); //
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data kas keluar berhasil ditambahkan!
            </div>');
            redirect('user/datakasumum');  
        } 
    }
    
    
    
    
    public function report($action = null)
    {
        require_once APPPATH . 'Classes/PHPExcel.php';
        require_once APPPATH . 'Classes/PHPExcel/IOFactory.php';
        $data['title'] = 'Report';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['dataKas'] = $this->db->get('tb_kas')->result_array();

        // Load pagination library
        $this->load->library('pagination');
        
        // Konfigurasi pagination
        $config['base_url'] = base_url('user/report'); // Sesuaikan dengan URL controller Anda
        $config['total_rows'] = $this->db->count_all('tb_kas'); // Jumlah total data
        $config['per_page'] = 10; // Jumlah data per halaman
        $config['uri_segment'] = 3; // Posisi segmen di URL untuk pagination

        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&raquo;'; //right arrow quotation 
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo;'; //left arrow
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item ">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        
        // Initialize pagination
        $this->pagination->initialize($config);
        

        // Ambil data dari model dengan limit sesuai pagination
        $start = intval($this->uri->segment(3));
        $data['start'] = $start; // Ambil segmen ke-3 dari URL sebagai nilai awal
        $data['dataKas'] = $this->User_model->getdataKas($config['per_page'], $start);

        // Buat pagination link
        $data['pagination'] = $this->pagination->create_links();


         // Inisialisasi variabel
        $kas_masuk = 0;
        $kas_keluar = 0;
        $saldo = 0;

        // Menghitung nilai untuk setiap row
        foreach ($data['dataKas'] as $i => $row) {
            if ($i == 0) {
                $kas_masuk = $row['kas_masuk'];
                $saldo = $row['kas_masuk'];
            } else {
                if ($row['kas_masuk'] != 0) {
                    $kas_masuk += $row['kas_masuk'];
                    $saldo += $row['kas_masuk'];
                } else {
                    $kas_keluar += $row['kas_keluar'];
                    $saldo -= $row['kas_keluar'];
                }
            }
            // Menyimpan hasil perhitungan ke dalam array untuk ditampilkan di view
            $row['saldo'] = $saldo; // Menambahkan saldo ke row
            $data['dataKas'][$i] = $row; // Memperbarui row
        }
        // Kirim variabel ke view
        $data['kas_masuk'] = $kas_masuk;
        $data['kas_keluar'] = $kas_keluar;
        $data['saldo'] = $saldo;

        if ($action == 'print') {
            $this->load->view('user/print_kas', $data);
        }else if ($action === 'export') {
            //memanggil fungsi untuk mengekspor ke excel
            $this->exportToExcel($data['dataKas']);      
        }else{
            
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('no_bukti', 'No Bukti', 'required');
            $this->form_validation->set_rules('uraian', 'Uraian', 'required');
            $this->form_validation->set_rules('kas_masuk', 'Kas masuk', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/report', $data); 
                $this->load->view('templates/footer');
            }else{
                $data = [
                    'tanggal' => $this->input->post('tanggal'),   
                    'no_bukti' => $this->input->post('no_bukti'),
                    'uraian' => $this->input->post('uraian'),
                    'kas_masuk' => $this->input->post('kas_masuk')
                ];
    
                $this->db->insert('tb_kas', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    data kas berhasil ditambahkan!
                    </div>');
                    redirect('user/report');       
            }
        }

        

        
        }
        // Fungsi untuk mengekspor data ke Excel
    private function exportToExcel($dataKas)
    {
        $objPHPExcel = new PHPExcel();
        
        // Menggabungkan sel A1 sampai H1 untuk judul
        $objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
        $objPHPExcel->getActiveSheet()->setCellvalue('A1','Laporan Kas Umum');

         // Mengatur format judul
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Menambahkan header tabel di baris kedua
        $objPHPExcel->getActiveSheet()
                    ->setCellValue('A2', 'No')
                    ->setCellValue('B2', 'Id Kas')
                    ->setCellValue('C2', 'Tanggal')
                    ->setCellValue('D2', 'No Bukti')
                    ->setCellValue('E2', 'Uraian')
                    ->setCellValue('F2', 'Kas Masuk')
                    ->setCellValue('G2', 'Kas Keluar')
                    ->setCellValue('H2', 'Saldo');

        $rowNumber = 3; // Mulai dari baris ketiga untuk data
        foreach ($dataKas as $key => $row) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $key + 1);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $row['id_kas']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $row['tanggal']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $row['no_bukti']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $row['uraian']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $row['kas_masuk']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $row['kas_keluar']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $row['saldo']);
            $rowNumber++;
        }

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan_kas.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); // Kirim file ke browser
    }
        
    
    
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[4]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confrim Password', 'required|trim|min_length[4]|matches[new_password1]');
             
        if ($this->form_validation->run() == FALSE) {        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if(!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password!
                </div>');
                redirect('user/changepassword');       
            }else{
                if($current_password == $new_password){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                New password cannot be the same as current password!
                </div>');
                redirect('user/changepassword'); 
                }else{
                    //password sdh bner
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                 Password changed!
                </div>');
                redirect('user/changepassword'); 
                }
            }

            
        }            
    }

    public function delete($id_kas)
    {
        $this->User_model->delete_data($id_kas);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data berhasil dihapus!
       </div>');
       redirect('user/datakasumum'); 
        
    }

    public function update_kasMasuk($id_kas) //ini diambil dari url dn ini parameter
    {
        $data['kas'] = $this->User_model->getKasById($id_kas); //id didapat dari padameter methodnya

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_bukti', 'No Bukti', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('kas_masuk', 'Kas Masuk', 'required');

        if ($this->form_validation->run() == FALSE) {        
            $this->datakasumum();
        } else {
            $this->User_model->ubahKas(); //ubah menu disamakan pada view // dn dbuat dimodel
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            </div>');
            redirect('user/datakasumum');
            
        }            
    }

    public function update_kasKeluar($id_kas) //ini diambil dari url dn ini parameter
    {
        $data['kas'] = $this->User_model->getKasById($id_kas); //id didapat dari padameter methodnya

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('no_bukti', 'No Bukti', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('kas_keluar', 'Kas Keluar', 'required');

        if ($this->form_validation->run() == FALSE) {        
            $this->datakasumum();
        } else {
            $this->User_model->ubah(); //ubah menu disamakan pada view // dn dbuat dimodel
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            </div>');
            redirect('user/datakasumum');
            
        }            
    }


     



}