<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function login() {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // 假設有一個 Admin_model 用於管理員驗證
                $this->load->model('Admin_model');
                $admin = $this->Admin_model->get_admin_by_email($email);

                if ($admin && password_verify($password, $admin->password)) {
                    // 登入成功，設定 session
                    $this->session->set_userdata('admin', $admin->nickname);
                    redirect('admin/dashboard');
                } else {
                    // 登入失敗
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                    redirect('admin/login');
                }
            }
        }
        $this->load->view('auth/login');
    }

    public function index() {
        $data['content'] = 'backend/product/index';
        $this->load->view('backend/layouts/master', $data);
    }
}