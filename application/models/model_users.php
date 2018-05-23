<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/27/15
 * Time: 7:19 PM
 */
class Model_Users extends CI_Model
{
    public function is_true()
    {
        $this->db->where('email_address', $this->input->post('email_address'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('status', '1');
        $this->db->where('status !=', '5');
        $this->db->where('activation', '');

        $get_user = $this->db->get('users');
        
        if ($get_user->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_username($email = null)
    {
        if ($email != null) {
            $this->db->select('username');
            $this->db->where('email_address', $email);
            $query = $this->db->get('users');
            $result = $query->result_array();
            return $result[0]['username'];
        }
    }

    public function get_userid($email = null)
    {
        if ($email != null) {
            $this->db->select('user_id');
            $this->db->where('email_address', $email);
            $query = $this->db->get('users');
            $result = $query->result_array();
            return $result[0]['user_id'];
        }
    }

    public function get_usrtype($email = null)
    {
        if ($email != null) {
            $this->db->select('user_type');
            $this->db->where('email_address', $email);
            $query = $this->db->get('users');
            $result = $query->result_array();
            return $result[0]['user_type'];
        }
    }
}