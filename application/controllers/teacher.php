<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/28/15
 * Time: 5:23 PM
 */
class Teacher extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
        $this->load->model('Teacher_Model');
        $this->load->model('Admin_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $this->load->view('teacher/home');
        } else {
            redirect('oauth');
        }
    }

    public function schedule()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $data['ta_schedule'] = $this->Teacher_Model->get_schedules();
            $this->load->view('teacher/schedules', $data);
        } else {
            redirect('oauth');
        }
    }

    public function schedule_create()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $data['ta_data'] = $this->Admin_Model->get_active_students();
            $this->load->view('teacher/schedule_create', $data);
        } else {
            redirect('oauth');
        }
    }

    public function schedule_save()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $this->form_validation->set_rules('start_time', 'Start time', 'required|trim');
            $this->form_validation->set_rules('end_time', 'End time', 'required|trim|callback_valid_dates');
            if ($this->form_validation->run()) {
                if (isset($_POST) && $_POST['update'] == 'Update') {
                    $this->Teacher_Model->schedule_cr();
                    redirect('teacher/schedule');
                } else {
                    redirect('teacher/schedule_create');
                }
            } else {
                $data['ta_data'] = $this->Admin_Model->get_active_students();
                $this->load->view('teacher/schedule_create', $data);
            }

        } else {
            redirect('oauth');
        }
    }

    public function valid_dates()
    {
        $start_d = new DateTime($this->input->post('start_time'));
        $end_d = new DateTime($this->input->post('end_time'));
        $diff = $end_d->diff($start_d);
        $diff->format('%h');
        if ($diff->format('%h') == 1) {
            return true;
        } else {
            $this->form_validation->set_message('valid_dates', 'Please ensure time schedule lasts 1(one) hour only.');
            return false;
        }
    }

    public function unavailable($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Teacher_Model->is_notavailable($id)) {
                    redirect('teacher/schedule');
                    return true;
                } else {
                    $this->load->view('teacher/schedules');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function remove_schedule($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Teacher_Model->remv_schedule($id)) {
                    redirect('teacher/schedule');
                    return true;
                } else {
                    $this->load->view('teacher/schedules');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function my_students()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $data['my_students'] = $this->Teacher_Model->get_my_students();
            $this->load->view('teacher/my_students', $data);
        } else {
            redirect('oauth');
        }
    }

    public function training_material()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '101') {
            $data['files'] = $this->Teacher_Model->get_files($this->session->userdata('usr_id'));
            $this->load->view('teacher/materials_view', $data);
        } else {
            redirect('oauth');
        }
    }
}