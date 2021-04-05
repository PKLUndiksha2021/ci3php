<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class All extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_all');
    }
    function index()
    {
        $this->load->view('index.html');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function commentTicket()
    {
        $result = $this->M_all->getUser();
        echo json_encode($result);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function readUser()
    {
        $result = $this->M_all->getUser();
        echo json_encode($result);
    }
    public function createUser()
    {
        $this->M_all->insertUser();
    }
    public function updateUser()
    {
        $this->M_all->updateUser();
    }
    public function deleteUser($userId)
    {
        $this->db->where('user_id', $userId)->delete('user');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function readTicket()
    {
        $result = $this->M_all->getTicket();
        echo json_encode($result);
    }
    public function createTicket()
    {
        $this->M_all->insertTicket();
    }
    public function updateTicket()
    {
        $this->M_all->updateTicket();
    }
    public function deleteTicket($ticketNumber)
    {
        $this->db->where('ticket_number', $ticketNumber)->delete('ticket');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function readCompany()
    {
        $result = $this->M_all->getCompany();
        echo json_encode($result);
    }
    public function createCompany()
    {
        $this->M_all->insertCompany();
    }
    public function updateCompany()
    {
        $this->M_all->updateCompany();
    }
    public function deleteCompany($companyCode)
    {
        $this->db->where('company_code', $companyCode)->delete('company');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function readComment()
    {
        $result = $this->M_all->getComment();
        echo json_encode($result);
    }
    public function createComment()
    {
        $this->M_all->insertComment();
    }
    public function updateComment()
    {
        $this->M_all->updateComment();
    }
    public function deleteComment($commentId)
    {
        $this->db->where('comment_id', $commentId)->delete('comment');
    }
}
