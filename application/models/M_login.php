<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{
    function cek_login($email, $password)
    {
        $this->db->where('email', $email)->where('password', $password);
        return $this->db->get('user')->row_array();
    }
}
