<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

    
        return $this->db->query($query)->result_array();

    }

    public function getSubmenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array(); //where=select * from //field id didalam tabel sama deBBBBngan id yg dlkirm di parameter //result array hasilnya array //row hanya sebaris/satu elemen

    }

    public function ubahSubmenu()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon')
            
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);          
        
    }
    
    public function deleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        
    }

    
    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array(); //where=select * from //field id didalam tabel sama dengan id yg dlkirm di parameter //result array hasilnya array //row hanya sebaris/satu elemen
    }

    public function ubahMenu()
    {
        $data = [
            'menu' => $this->input->post('menu'),
        ];

        $this->db->where('id', $this->input->post('id')); //ini bukan $id tp ngambil dr input hidden
        $this->db->update('user_menu', $data);
          
    }
    
    
    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        
    }
    
    
    
    



}


?>