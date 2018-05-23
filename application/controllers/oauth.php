<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/27/15
 * Time: 6:24 PM
 */
class Oauth extends CI_Controller
{
    public function index()
    {
        $this->load->view('login_view');
    }

    public function register()
    {
        $this->load->view('register_view');
    }

    public function is_true()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_address', 'Email address',
            'required|trim|xss_clean|callback_validating');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if ($this->form_validation->run()) {
            $this->load->model('Model_Users');
            $username = $this->Model_Users->get_username($this->input->post('email_address'));
            $user_id = $this->Model_Users->get_userid($this->input->post('email_address'));
            $user_type = $this->Model_Users->get_usrtype($this->input->post('email_address'));
            $data = array(
                'email' => $this->input->post('email_address'),
                'username' => $username,
                'usr_id' => $user_id,
                'user_type' => $user_type,
                'logged' => 1
            );

            $this->session->set_userdata($data);
            switch ($user_type) {
                case 100:
                    redirect('admin');
                    break;

                case 101:
                    redirect('teacher');
                    break;

                case 102:
                    redirect('intern');
                    break;

                default:
                    redirect('oauth2');
                    break;
            }
        } else {
            $this->load->view('login_view');
        }
    }

    public function validating()
    {
        $this->load->model('Model_Users');
        if ($this->Model_Users->is_true()) {
            return true;
        } else {
            $this->form_validation->set_message('validating', 'Please enter the right Email/Password combination');
            return false;
        }
    }

    public function sign_out()
    {
        $this->session->sess_destroy();
        redirect('oauth');
    }
}