<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 9:23 AM
 */
class Teacher_Model extends CI_Model
{
    public function schedule_cr()
    {
        $teacher_id = $this->input->post('teacher_id');
        $s_time = $this->input->post('start_time');
        $e_time = $this->input->post('end_time');
        $student_id = $this->input->post('student_id');
        $notes = $this->input->post('notes');
        $this->db->trans_start();
        $this->db->query('INSERT INTO schedules(teacher_id,start_date,end_date) VALUES("' . $teacher_id . '","' . $s_time . '","' . $e_time . '")');
        $schedule_id = $this->db->insert_id();
        $this->db->query('INSERT INTO class_rooms(schedule_id,teacher_id,student_id,notes,created_by) VALUE("' . $schedule_id . '","' . $teacher_id . '","' . $student_id . '","' . $notes . '","' . $teacher_id . '")');
        $this->db->trans_complete();
    }

    public function get_schedules($schedule_id = null)
    {
        $teacher_id = $this->session->userdata('usr_id');
        $this->db->select('schedules.schedule_id,schedules.teacher_id,schedules.start_date,end_date,schedules.status,is_missed,fname,lname');
        $this->db->from('schedules');
        $this->db->join('class_rooms', 'class_rooms.schedule_id = schedules.schedule_id', 'left');
        $this->db->join('students', 'students.student_id = class_rooms.student_id', 'left');
        $this->db->where('schedules.teacher_id', $teacher_id);
        $this->db->order_by('start_date', 'desc');
        $query = $this->db->get();
        if ($schedule_id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_my_students()
    {
        $teacher_id = $this->session->userdata('usr_id');
        $this->db->select('students.student_id,fname,lname,mobile,email_address,skype_id');
        $this->db->from('students');
        $this->db->join('class_rooms', 'class_rooms.student_id = students.student_id', 'inner');
        $this->db->where('class_rooms.teacher_id', $teacher_id);
        $this->db->where('students.status !=', '5');
        $this->db->group_by('students.student_id');
        $query = $this->db->get();
        $result = $query->result_array();
        $students = null;
        $i = 0;
        foreach ($result as $student) {
            $students[$i]['student'] = $student;
            $i++;
        }
        return $students;
    }

    public function is_notavailable($id = null)
    {
        $data = array(
            'status' => '2'
        );
        $this->db->where('schedule_id', $id);
        $query = $this->db->update('schedules', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function remv_schedule($id = null)
    {
        if ($id != null) {
            $query = $this->db->delete('schedules', array('schedule_id' => $id));
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_files($teacher_id = null)
    {
        $where = "teacher_id = $teacher_id OR teacher_id = 0";
        $this->db->where($where);
        $query = $this->db->get('training_material');
        return $query->result();
    }
}