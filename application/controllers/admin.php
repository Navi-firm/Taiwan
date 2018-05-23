<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/27/15
 * Time: 6:42 PM
 */
class Admin extends CI_Controller
{

    public function  __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Admin_Model');
        $this->load->library('email');
        $this->load->library('upload', $config = array(
            'upload_path' => './material/',
            'upload_url' => base_url() . 'material',
            'allowed_types' => 'jpg|png|jpeg|pdf|doc|docx|xml|mp3',
            'max_size' => '500000',
        ));
    }

    public function index()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['ta_total'] = $this->Admin_Model->total_teachers();
            $data['st_total'] = $this->Admin_Model->total_students();
            $data['hr_total'] = $this->Admin_Model->total_hours();
            $data['hr_alert'] = $this->Admin_Model->hours_alert();
            $this->load->view('admin/admin_view', $data);
        } else {
            redirect('oauth');
        }
    }

    public function teachers()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['tc_data'] = $this->Admin_Model->get_teachers();
            $this->load->view('admin/teachers_view', $data);
        } else {
            redirect('oauth');
        }
    }

    public function teacher_create()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $this->load->view('admin/create_teacher_view');
        } else {
            redirect('oauth');
        }
    }

    public function teacher_save()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['create'] == 'Create') {
                $data['username'] = $this->input->post('username');
                $data['fname'] = $this->input->post('fname');
                $data['lname'] = $this->input->post('lname');
                $data['email_address'] = $this->input->post('email_address');
                $data['mobile'] = $this->input->post('mobile');
                $data['password'] = md5($this->input->post('password'));
                $data['user_type'] = $this->input->post('user_type');
                $data['status'] = $this->input->post('status');
                $data['created_by'] = $this->input->post('created_by');

                $this->email->from('admin@gmail.com', 'Online School');
                $this->email->to($this->input->post('email_address'));
                $this->email->subject("New Teacher");
                $pass = $this->input->post('password');

                $message = '<p>Thankyou for joining us. Your password is: ' . $pass . '</p>';
                $message .= "<p>To access you account, <a href='" . base_url() . "' >Click here </a>.</p>";
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->Admin_Model->cr_teacher($data);
                    redirect('admin/teachers');
                } else {
//                    redirect('admin/teacher_create');
                    echo $this->email->print_debugger();
                }

            } else {
                redirect('admin/teacher_create');
            }
        } else {
            redirect('oauth');
        }
    }

    public function manage_teacher($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['ta_data'] = $this->Admin_Model->manage_teacher($id);
                $data['ta_shed'] = $this->Admin_Model->get_schedules($id);
                $this->load->view('admin/teacher_manage', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function teacher_schedule($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['ta_data'] = $this->Admin_Model->get_schedules($id);
                $this->load->view('admin/teacher_schedule', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function reset_password()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['reset'] == 'Reset Password') {
                $data['password'] = md5($this->input->post('reset_pass'));
                $this->Admin_Model->reset_pass($data);
                redirect('admin/teachers');
            } else {
                $this->load->view('admin/teacher_manage');
            }
        } else {
            redirect('oauth');
        }
    }

    public function deactivate($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Admin_Model->deactivate($id)) {
                    redirect('admin/teachers');
                    return true;
                } else {
                    $this->load->view('admin/teacher_manage');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function activate($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Admin_Model->is_activate($id)) {
                    redirect('admin/teachers');
                    return true;
                } else {
                    $this->load->view('admin/teacher_manage');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function teacher_leave($id = null) {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Admin_Model->is_leave($id)) {
                    redirect('admin/teachers');
                    return true;
                } else {
                    $this->load->view('admin/teacher_manage');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function students()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['st_data'] = $this->Admin_Model->get_students();
            $data['active'] = $this->Admin_Model->get_active_students();
            $this->load->view('admin/students_view', $data);
        } else {
            redirect('oauth');
        }
    }

    public function student_create()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $this->load->view('admin/create_student');
        } else {
            redirect('oauth');
        }
    }

    public function student_save()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['create'] == 'Create') {
                $data['fname'] = $this->input->post('fname');
                $data['lname'] = $this->input->post('lname');
                $data['email_address'] = $this->input->post('email_address');
                $data['skype_id'] = $this->input->post('skype_id');
                $data['mobile'] = $this->input->post('mobile');
                $data['start_date'] = $this->input->post('start_date');
                $data['status'] = $this->input->post('status');
                $data['created_by'] = $this->input->post('created_by');

                $this->Admin_Model->cr_student($data);
                redirect('admin/students');
            } else {
                redirect('admin/student_create');
            }
        } else {
            redirect('oauth');
        }
    }

    public function student_disable($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($this->Admin_Model->dis_student($id)) {
                redirect('admin/students');
            } else {
                $this->load->view('admin/students_view');
            }
        } else {
            redirect('oauth');
        }
    }

    public function student_activate($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($this->Admin_Model->act_student($id)) {
                redirect('admin/students');
            } else {
                $this->load->view('admin/students_view');
            }
        } else {
            redirect('oauth');
        }
    }

    public function student_details($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['ta_data'] = $this->Admin_Model->student_details($id);
                $data['pc_data'] = $this->Admin_Model->purchase_history($id);
                $this->load->view('admin/student_details', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function student_leave($id = null) {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                if ($this->Admin_Model->is_student_leave($id)) {
                    redirect('admin/students');
                    return true;
                } else {
                    $this->load->view('admin/student_details');
                    return false;
                }
            }
        } else {
            redirect('oauth');
        }
    }

    public function purchase_hours($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['hrs_data'] = $this->Admin_Model->student_hours($id);
                $this->load->view('admin/student_purchase', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function purchase_true()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['buy'] == 'Buy') {
                $data['student_id'] = $this->input->post('student_id');
                $data['hours'] = $this->input->post('hours');

                $this->Admin_Model->purchase_hours($data);
                redirect('admin/students');
            } else {
                redirect('admin/student_create');
            }
        } else {
            redirect('oauth');
        }
    }

    public function is_purchase_update()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['update'] == 'Update') {
                $data['purchase_id'] = $this->input->post('purchase_id');
                $data['student_id'] = $this->input->post('student_id');
                $data['hours'] = $this->input->post('hours');

                $this->Admin_Model->purchase_hours($data);
                redirect('admin/students');
            } else {
                redirect('admin/student_create');
            }
        } else {
            redirect('oauth');
        }
    }

    public function purchase_update($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['hrs_data'] = $this->Admin_Model->purchase_update($id);
                $this->load->view('admin/purchase_update', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function class_room()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['ta_data'] = $this->Admin_Model->get_classes();
            $this->load->view('admin/class_room', $data);
        } else {
            redirect('oauth');
        }
    }

    public function start_class($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['ad_data'] = $this->Admin_Model->start_class($id);
            $data['ta_data'] = $this->Admin_Model->active_students();
            $this->load->view('admin/class_start', $data);
        } else {
            redirect('oauth');
        }
    }

    public function class_confirm()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if (isset($_POST) && $_POST['start'] == 'Start') {
                $data['student_id'] = $this->input->post('student_id');
                $data['teacher_id'] = $this->input->post('teacher_id');
                $data['schedule_id'] = $this->input->post('schedule_id');
                $data['created_by'] = $this->input->post('created_by');

                $this->Admin_Model->save_class($data);
                redirect('admin/class_room');
            } else {
                $this->load->view('admin/class_start');
            }
        } else {
            redirect('oauth');
        }
    }

    public function class_postpone($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($this->Admin_Model->postpone_class($id)) {
                redirect('admin/class_room');
            } else {
                $this->load->view('admin/class_room');
            }
        } else {
            redirect('oauth');
        }
    }

    public function time_reports()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['ta_week'] = $this->Admin_Model->repo_weekly();
            $data['ta_month'] = $this->Admin_Model->repo_monthly();
            $this->load->view('admin/reports', $data);
        } else {
            redirect('oauth');
        }
    }

    public function single_report($id = null)
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            if ($id == null) {
                show_error('No identifier provided', 500);
            } else {
                $data['ta_data'] = $this->Admin_Model->manage_teacher($id);
                $data['total_week'] = $this->Admin_Model->w_total_rs($id);
                $data['total_month'] = $this->Admin_Model->m_total_rs($id);
                $data['ta_week'] = $this->Admin_Model->single_repo_weekly($id);
                $data['ta_month'] = $this->Admin_Model->single_repo_monthly($id);
                $this->load->view('admin/single_report', $data);
            }
        } else {
            redirect('oauth');
        }
    }

    public function training_material()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['files'] = $this->Admin_Model->get_files();
            $this->load->view('admin/materials_view', $data);
        } else {
            redirect('oauth');
        }
    }

    public function do_upload()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {

            if (!$this->upload->do_upload()) {
                $data['teachers'] = $this->Admin_Model->get_teachers();
                $data['error'] = array('error' => $this->upload->display_errors());
                $this->load->view('admin/t_materials', $data);
            } else {
                $upload_data = $this->upload->data();
                $data_ary = array(
                    'title' => $this->input->post('title'),
                    'teacher_id' => $this->input->post('teacher_id'),
                    'uploaded_by' => $this->input->post('uploaded_by'),
                    'file' => $upload_data['file_name'],
                    'file_type' => $upload_data['file_type'],
                    'file_size' => $upload_data['file_size'],
                );

                $this->load->database();
                $this->db->insert('training_material', $data_ary);
                redirect('admin/training_material');
            }
        } else {
            redirect('oauth');
        }
    }

    public function upload_material()
    {
        $is_logged = $this->session->userdata('logged');
        $u_type = $this->session->userdata('user_type');
        if ($is_logged && $u_type == '100') {
            $data['teachers'] = $this->Admin_Model->get_teachers();
            $data['error'] = array('error' => ' ');
            $this->load->view('admin/t_materials', $data);
        } else {
            redirect('oauth');
        }
    }

    public function delete_material($id)
    {
        $name = $this->Admin_Model->file_delete($id);
        unlink('material/' . $name);
        redirect('admin/training_material');
    }

}