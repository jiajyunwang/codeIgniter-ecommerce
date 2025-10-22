<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function index() {
        $data['content'] = 'frontend/index';
        $this->load->view('frontend/layouts/master', $data);
    }

    public function register() {
        $this->load->helper('form');
        $this->load->helper('url');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nickname', 'Nickname', 'required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirmation', 'Password_confirmation', 'required|matches[password]');

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'nickname' => $this->input->post('nickname'),
                    'email'    => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $insert = $this->db->insert('users', $data);

                if ($insert) {
                    // 註冊成功 → 設 Session 並導向首頁
                    $this->session->set_userdata('user', $data['email']);
                    $this->session->set_flashdata('success', 'Successfully registered');
                    redirect('/');
                } else {
                    // 寫入失敗 → 顯示錯誤
                    $this->session->set_flashdata('error', 'Please try again!');
                }
            }
        }
        $data['content'] = 'frontend/pages/register';
        $this->load->view('frontend/layouts/master', $data);
    }

    public function login() {
        $this->load->helper('form');
        $this->load->helper('url');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                $query = $this->db->get_where('users', array('email' => $email));
                $user = $query->row();

                if ($user && password_verify($password, $user->password)) {
                    // 登入成功 → 設 Session 並導向首頁
                    $this->session->set_userdata('user', $user->email);
                    $this->session->set_flashdata('success', 'Successfully logged in');
                    redirect('/');
                } else {
                    // 登入失敗 → 顯示錯誤
                    $this->session->set_flashdata('error', 'Invalid email or password');
                }
            }
        }
        $data['content'] = 'frontend/pages/login';
        $this->load->view('frontend/layouts/master', $data);
    }

    // public function test() {
    //     $this->load->database(); // 載入資料庫

    //     $tables = $this->db->list_tables();

    //     echo "<pre>";
    //     print_r($tables);
    //     echo "</pre>";
    //         }
}