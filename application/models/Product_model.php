<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    protected $table = 'products'; 

    public function get_all_products() {
        $query = $this->db->get($this->table);
        return $query->row();
    }
}