<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $allowed = ['login'];

        $currentMethod = $this->router->fetch_method();

        if (!in_array($currentMethod, $allowed)) {
            if (!$this->session->userdata('admin')) {
                redirect('admin/login');
            }
        }
    }

    public function login() {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // 假設有一個 Admin_model 用於管理員驗證
                $this->load->model('User_model');
                $admin = $this->User_model->get_admin_by_email($email);

                if ($admin && password_verify($password, $admin->password)) {
                    // 登入成功，設定 session
                    $this->session->set_userdata('admin', $admin->nickname);
                    redirect('admin');
                } else {
                    // 登入失敗
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                    redirect('admin/login');
                }
            }
        }
        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function index() {
        $products = Product::all();
        $type = $request->query('type');
        $productCol = $unlistedCol = $unhandledCol = $shippingCol = $completedCol = $cancelCol = 'col';
        if ($type==null || $type=='listed' || $type=='unlisted'){
            if ($type==null || $type=='listed'){
                $products =  $products->where('status', 'active');
                $type = 'listed';
                $productCol = 'border';
            }
            elseif ($type == 'unlisted'){
                $products =  $products->where('status', 'inactive');
                $unlistedCol = 'border';
            }

            return view('backend.product.index')
                ->with('productCol', $productCol)
                ->with('unlistedCol', $unlistedCol)
                ->with('unhandledCol', $unhandledCol)
                ->with('shippingCol', $shippingCol)
                ->with('completedCol', $completedCol)
                ->with('cancelCol', $cancelCol)
                ->with('type', $type)
                ->with('products', $products);
        }
        elseif ($type=='unhandled' || $type=='shipping' || $type=='completed' || $type == 'cancel'){
            if ($type == 'unhandled'){
                $orders = Order::with('order_details')
                    ->where('status', 'unhandled')
                    ->paginate(10);
                $unhandledCol = 'border';
            }
            elseif ($type == 'shipping'){
                $orders = Order::with('order_details')
                    ->where('status', 'shipping')
                    ->paginate(10);
                $shippingCol = 'border';
            }
            elseif ($type == 'completed'){
                $orders = Order::with('order_details')
                    ->where('status', 'completed')
                    ->paginate(10);
                $completedCol = 'border';
            }
            elseif ($type == 'cancel'){
                $orders = Order::with('order_details')
                    ->where('status', 'cancel')
                    ->paginate(10);
                $cancelCol = 'border';
            }

            return view('backend.order.index')
                ->with('productCol', $productCol)
                ->with('unlistedCol', $unlistedCol)
                ->with('unhandledCol', $unhandledCol)
                ->with('shippingCol', $shippingCol)
                ->with('completedCol', $completedCol)
                ->with('cancelCol', $cancelCol)
                ->with('type', $type)
                ->with('orders', $orders);
        }
        
        $data['content'] = 'backend/product/index';
        $this->load->view('backend/layouts/master', $data);
    }

    public function createProduct() {
        $this->load->view('');
    }
}