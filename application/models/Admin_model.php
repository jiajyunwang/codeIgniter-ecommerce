<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    protected $table = 'admin'; 

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 依 email 取得單一管理員資料
     *
     * @param string $email
     * @return object|null
     */
    public function get_admin_by_email($email)
    {
        // 查詢資料
        $query = $this->db->where('email', $email)
                          ->where('is_active', 1) // 若有啟用欄位可加
                          ->get($this->table);

        // 找到就回傳物件，找不到回傳 null
        return $query->row(); 
    }
}