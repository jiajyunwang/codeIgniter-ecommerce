<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    protected $table = 'users'; 

    public function register_user($data) {
        if (empty($data['nickname']) || empty($data['email']) || empty($data['password'])) {
            return false;
        }

        $exists = $this->db->where('email', $data['email'])
                           ->get($this->table)
                           ->num_rows() > 0;

        if ($exists) {
            return false; 
        }

        $data['role'] = 'user';

        $inserted = $this->db->insert($this->table, $data);

        return $inserted ? $this->db->insert_id() : false;
    }

    public function get_admin_by_email($email) {
        $query = $this->db->where('email', $email)
                          ->where('role', 'admin') 
                          ->get($this->table);

        return $query->row(); 
    }

    public function get_user_by_email($email) {
        $query = $this->db->where('email', $email)
                          ->get($this->table);

        return $query->row(); 
    }
}