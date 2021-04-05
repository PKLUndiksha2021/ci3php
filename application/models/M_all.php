<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_all extends CI_Model
{

    function commentGroup()
    {
        $this->db->where('ticket.ticket_number=comment.ticket');
        $this->db->group_by('ticket.ticket_number ASC');
        $this->db->join('user', 'user.user_id=comment.comment_by');
        $this->db->join('ticket', 'ticket.ticket_number=comment.ticket');
        $result = $this->db->get('comment')->result_array();
        echo json_encode($result);
    }

    function moreDetail()
    {
        $this->db->where('ser.user_id=ticket.report_by');
        $this->db->group_by('ticket.ticket_number ASC');
        $this->db->join('user', 'user.user_id=ticket.report_by');
        $result = $this->db->get('ticket')->result_array();
        echo json_encode($result);
    }


    function searchTicket()
    {
        $data = $this->db->where('ticket_number', $_POST['ticket_number'])->get('ticket')->row_array();
        return $data;
    }
    function searchCompany($company)
    {
        $this->db->where('company_code', $company);
        return $this->db->get('commpany')->row_array();
    }

    // function notificationRead()
    // {
    // }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function countDoneTicket()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS done WHERE ticket_status=Done FROM ticket');
        return $sql->result();
    }
    function countInprogressTicket()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS inprogress WHERE ticket_status=InProgress FROM ticket');
        return $sql->result();
    }
    function countWaitingTicket()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS waiting WHERE ticket_status=Waiting FROM ticket');
        return $sql->result();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function categoryBugs()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS bugs WHERE report_type=Bugs FROM ticket');
        return $sql->result();
    }
    function categoryProblem()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS problem WHERE report_type=Bugs FROM ticket');
        return $sql->result();
    }
    function categoryRequest()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS request WHERE report_type=Bugs FROM ticket');
        return $sql->result();
    }
    function categorySupport()
    {
        $sql = $this->db->query('SELECT COUNT(*) AS support WHERE report_type=Bugs FROM ticket');
        return $sql->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function listDone()
    {
        $data = $this->db->get('ticket')->where('ticket_status=Done')->result_array();
        return $data;
    }

    function listInprogress()
    {
        $data = $this->db->get('ticket')->where('ticket_status=InProgress')->result_array();
        return $data;
    }

    function listWaiting()
    {
        $data = $this->db->get('ticket')->where('ticket_status=Waiting')->result_array();
        return $data;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function listBugs()
    {
        $data = $this->db->get('ticket')->where('report_type=Bugs')->result_array();
        return $data;
    }
    function listProblem()
    {
        $data = $this->db->get('ticket')->where('report_type=Problem')->result_array();
        return $data;
    }
    function listRequest()
    {
        $data = $this->db->get('ticket')->where('report_type=Request')->result_array();
        return $data;
    }
    function listSupport()
    {
        $data = $this->db->get('ticket')->where('report_type=Support')->result_array();
        return $data;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    function getUser()
    {
        $data = $this->db->get('user')->result_array();
        return $data;
    }
    function insertUser()
    {
        $data = array(
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'company' => $_POST['company'],
            'password' => $_POST['password'],
            'position' => $_POST['position'],
            'type' => 2,
            'profile' => 'profile.jpg',
        );
        $this->db->insert('user', $data);
    }
    function updatetUser()
    {
        $data = array(
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'company' => $_POST['company'],
            'password' => $_POST['password'],
            'position' => $_POST['position'],
        );
        $this->db->where('user_id', $_POST['code_company'])->update('user', $data);
    }
    function updatetUserPicture()
    {
        $data = array(
            'profile' => $_POST['profile'],
        );
        $this->db->where('user_id', $_POST['user_id'])->update('user', $data);
    }
    function deletetUser($userId)
    {
        $this->db->where('user_id', $userId)->delete('user');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function getCompany()
    {
        $data = $this->db->get('company')->result_array();
        return $data;
    }
    function insertCompany()
    {
        $data = array(
            'company_code' => $_POST['company_code'],
            'name_company' => $_POST['name_company'],
            'description' => $_POST['description']
        );
        $this->db->insert('company', $data);
    }

    function updateCompany()
    {
        $data = array(
            'company_code' => $_POST['company_code'],
            'name_company' => $_POST['name_company'],
            'description' => $_POST['description']
        );
        $this->db->where('company_code', $_POST['company_code'])->update('company', $data);
    }
    function deleteCompany($companyCode)
    {
        $this->db->where('company_code', $companyCode)->delete('company');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function getTicket()
    {
        $data = $this->db->get('ticket')->result_array();
        return $data;
    }
    function insertTicket()
    {
        $data = array(
            'log_description' => $_POST['log_description'],
            'report_type' => $_POST['report_type'],
            'cc_to' => $_POST['cc_to'],
            'ticket_status' => "Waiting",
            'report_by' => $_GET['user_id'],
            'report_date' => Date('Y-m-d h:i:s'),
        );
        $this->db->insert('ticket', $data);
    }
    function updateTicketUser()
    {
        $data = array(
            'log_description' => $_POST['log_description'],
        );
        $this->db->where('company_code', $_POST['company_code'])->update('ticket', $data);
    }
    function updateTicketInProgress()
    {
        $data = array(
            'ticket_status' => "InProgress",
        );
        $this->db->where('company_code', $_POST['company_code'])->update('ticket', $data);
    }
    function updateTicketDone()
    {
        $data = array(
            'ticket_status' => "Done",
        );
        $this->db->where('company_code', $_POST['company_code'])->update('ticket', $data);
    }
    function deleteTicket($companyCode)
    {
        $this->db->where('company_dode', $companyCode)->delete('ticket');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function getComment()
    {
        $data = $this->db->get('comment')->result_array();
        return $data;
    }
    function insertComment()
    {
        $data = array(
            'ticket' => $_GET['ticket_number'],
            'comment' => $_POST['comment'],
            'comment_by' => $_GET['user_id'],
            'comment_date' => Date('Y-m-d h:i:s'),
        );
        $this->db->insert('comment', $data);
    }
    function updateComment()
    {
        $data = array(
            'ticket' => $_GET['ticket_number'],
            'comment' => $_POST['comment'],
        );
        $this->db->where('comment_id', $_POST['comment_id'])->update('comment', $data);
    }
    function deleteComment($commentId)
    {
        $this->db->where('comment_id', $commentId)->delete('comment');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // function aktif()
    // {
    //     $this->db->where('status=1');
    //     return $this->db->get('users')->row_array();
    // }




}
