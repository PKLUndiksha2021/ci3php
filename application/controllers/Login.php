<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    function index()
    {
        $this->load->view('login');
    }
    function login()
    {
        $result['error'] = TRUE;
        $user = $this->M_login->cek_login($_POST['email'], $_POST['password']);
        if ($user != null) {
            $result = $user;
            $result['error'] = false;
            $result['value'] = 1;
            $result['message'] = "Hello! " . $user['email'];
        } else {
            $result['value'] = 0;
            $result['message'] = "Username do not Registered!";
        }
        echo json_encode($result);
    }
}
