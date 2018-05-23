<?php

/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/28/15
 * Time: 8:44 AM
 */
class Admin_Model extends CI_Model
{
    public function total_teachers()
    {
        $query = $this->db->query("SELECT COUNT(*) as teachers FROM users WHERE user_type='101' AND status != '5'");
        if ($query) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function total_students()
    {
        $query = $this->db->query("SELECT COUNT(*) as students FROM students WHERE status != '5'");
        if ($query) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function total_hours()
    {
        $query = $this->db->query("SELECT COUNT(*) as hours FROM class_rooms WHERE is_missed='0'");
        if ($query) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function cr_teacher($data)
    {
        if (isset($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users', $data);
        } else {
            $this->db->insert('users', $data);
        }
    }

    public function get_teachers($user_id = null)
    {
        $this->db->select('user_id,fname,lname,email_address,mobile,status');
        $this->db->where('user_type', '101');
        $this->db->where('status !=', '5');
        $query = $this->db->get('users');
        if ($user_id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_students($user_id = null)
    {
        $this->db->select('students.student_id,fname,lname,email_address,skype_id,mobile,start_date,status,sum(hours) as hours');
        $this->db->from('students');
        $this->db->join('hours_purchase', 'hours_purchase.student_id = students.student_id', 'left');
        $this->db->where('students.status !=', '5');
        $this->db->group_by('students.student_id');
        $query = $this->db->get();
        if ($user_id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_active_students()
    {
        $query = $this->db->query('SELECT
  students.student_id,
  fname,
  lname,
  email_address,
  skype_id,
  mobile,
  count(class_rooms.student_id)                              AS classes,
  (select count(is_missed) from class_rooms WHERE is_missed=1 and class_rooms.student_id=students.student_id) as postponed,
  (SELECT sum(hours)
   FROM hours_purchase
   WHERE hours_purchase.student_id = students.student_id) AS purchased_hours
FROM class_rooms
  RIGHT JOIN students
    ON students.student_id = class_rooms.student_id
  WHERE students.status != 5
GROUP BY students.student_id;');
        $result = $query->result_array();
        $students = null;
        $i = 0;
        foreach ($result as $student) {
            $students[$i]['student'] = $student;
            $i++;
        }
        return $students;
    }

    public function student_details($id = null)
    {
        $this->db->select('student_id,fname,lname,skype_id,mobile,email_address');
        $this->db->where('student_id', $id);
        $this->db->where('status !=', '5');
        $query = $this->db->get('students');
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function purchase_history($id = null)
    {
        $this->db->select('*');
        $this->db->where('student_id', $id);
        $this->db->order_by('time_created', 'desc');
        $query = $this->db->get('hours_purchase');
        $result = $query->result_array();
        $purchases = null;
        $i = 0;
        foreach ($result as $purchase) {
            $purchases[$i]['purchase'] = $purchase;
            $i++;
        }
        return $purchases;
    }

    public function purchase_update($id = null)
    {
        $this->db->select('*');
        $this->db->where('purchase_id', $id);
        $query = $this->db->get('hours_purchase');
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function cr_student($data)
    {
        if (isset($data['student_id'])) {
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('students', $data);
        } else {
            $this->db->insert('students', $data);
        }
    }

    public function manage_teacher($id = null)
    {
        $this->db->select('user_id,fname,lname,email_address,mobile,status');
        $this->db->where('user_type', '101');
        $this->db->where('status !=', '5');
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function get_schedules($id = null)
    {
        if ($id != null) {
            $this->db->select('schedules.schedule_id,schedules.teacher_id,start_date,end_date,status,is_missed');
            $this->db->from('schedules');
            $this->db->join('class_rooms', 'class_rooms.schedule_id = schedules.schedule_id', 'left');
            $this->db->where('schedules.teacher_id', $id);
//            $this->db->where('class_rooms.schedule_id', null);
            $this->db->order_by('start_date', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
            $schedules = null;
            $i = 0;
            foreach ($result as $schedule) {
                $schedules[$i]['schedule'] = $schedule;
                $i++;
            }
            return $schedules;
        }
    }

    public function reset_pass($data = null)
    {
        $teacher_id = $this->input->post('teacher_id');
        $this->db->where('user_id', $teacher_id);
        $this->db->where('status !=', '5');
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivate($id = null)
    {
        $data = array(
            'status' => '2'
        );
        $this->db->where('user_id', $id);
        $this->db->where('user_type', '101');
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function is_activate($id = null)
    {
        $data = array(
            'status' => '1'
        );
        $this->db->where('user_id', $id);
        $this->db->where('user_type', '101');
        $this->db->where('status !=', '5');
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function is_leave($id = null)
    {
        $data = array(
            'status' => '5'
        );
        $this->db->where('user_id', $id);
        $this->db->where('user_type', '101');
        $this->db->where('status !=', '5');
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function is_student_leave($id = null)
    {
        $data = array(
            'status' => '5'
        );
        $this->db->where('student_id', $id);
        $this->db->where('status !=', '5');
        $query = $this->db->update('students', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function student_hours($id = null)
    {
        $this->db->select('student_id,fname,lname');
        $this->db->where('student_id', $id);
        $this->db->where('status !=', '5');
        $query = $this->db->get('students');
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function purchase_hours($data)
    {
        if (isset($data['purchase_id'])) {
            $this->db->where('purchase_id', $data['purchase_id']);
            $this->db->update('hours_purchase', $data);
        } else {
            $this->db->insert('hours_purchase', $data);
        }
    }

    public function dis_student($id = null)
    {
        $data = array(
            'status' => '2'
        );
        $this->db->where('student_id', $id);
        $this->db->where('status !=', '5');
        $query = $this->db->update('students', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function act_student($id = null)
    {
        $data = array(
            'status' => '1'
        );
        $this->db->where('student_id', $id);
        $this->db->where('status !=', '5');
        $query = $this->db->update('students', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function start_class($id = null)
    {
        $this->db->select('schedule_id,teacher_id,start_date,end_date,fname,lname');
        $this->db->from('schedules');
        $this->db->join('users', 'users.user_id = schedules.teacher_id', 'inner');
        $this->db->where('schedule_id', $id);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function active_students($student_id = null)
    {
        $this->db->select('students.student_id,fname,lname,sum(hours) as hours');
        $this->db->from('students');
        $this->db->join('hours_purchase', 'hours_purchase.student_id = students.student_id', 'left');
        $this->db->where('status', 1);
        $this->db->where('hours >', 0);
        $this->db->group_by('students.student_id');
        $query = $this->db->get();
        if ($student_id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function save_class($data)
    {
        if (isset($data['class_room_id'])) {
            $this->db->where('class_room_id', $data['class_room_id']);
            $this->db->update('class_rooms', $data);
        } else {
            $this->db->insert('class_rooms', $data);
        }
    }

    public function get_classes($class_id = null)
    {
        $this->db->select('class_room_id,class_rooms.teacher_id,class_rooms.student_id,is_missed,users.fname,users.lname, students.fname as st_fname, students.lname as st_lname, schedules.start_date, end_date');
        $this->db->from('class_rooms');
        $this->db->join('users', 'users.user_id = class_rooms.teacher_id', 'left');
        $this->db->join('students', 'students.student_id = class_rooms.student_id', 'left');
        $this->db->join('schedules', 'schedules.schedule_id = class_rooms.schedule_id', 'left');
//        $this->db->where('users.status !=', '5');
//        $this->db->where('students.status !=', '5');
        $query = $this->db->get();
        if ($class_id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function postpone_class($id = null)
    {
        $data = array(
            'is_missed' => '1'
        );
        $this->db->where('class_room_id', $id);
        $query = $this->db->update('class_rooms', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function repo_weekly()
    {
        $query = $this->db->query("SELECT
  fname,
  lname,
  mobile,
  count(*) AS hours
FROM class_rooms
  LEFT JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
  INNER JOIN users
    ON users.user_id = schedules.teacher_id
WHERE is_missed = 0
      AND WEEKOFYEAR(end_date) = WEEKOFYEAR(NOW())
      GROUP BY schedules.teacher_id");
        $result = $query->result_array();
        $teachs = null;
        $i = 0;
        foreach ($result as $teach) {
            $teachs[$i]['teach'] = $teach;
            $i++;
        }
        return $teachs;
    }

    public function repo_monthly()
    {
        $query = $this->db->query("SELECT
  fname,
  lname,
  mobile,
  count(*) AS hours
FROM class_rooms
  LEFT JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
  INNER JOIN users
    ON users.user_id = schedules.teacher_id
WHERE is_missed = 0
      AND year(end_date) = year(NOW()) AND MONTH(end_date) = MONTH(NOW())
      GROUP BY schedules.teacher_id");
        $result = $query->result_array();
        $teachs = null;
        $i = 0;
        foreach ($result as $teach) {
            $teachs[$i]['teach'] = $teach;
            $i++;
        }
        return $teachs;
    }

    public function w_total_rs($id = null)
    {
        $query = $this->db->query("SELECT
  count(*) AS hours
FROM class_rooms
  LEFT JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
  INNER JOIN users
    ON users.user_id = schedules.teacher_id
WHERE is_missed = 0 AND schedules.teacher_id = '$id'
      AND WEEKOFYEAR(end_date) = WEEKOFYEAR(NOW())");
        if ($query) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function m_total_rs($id = null)
    {
        $query = $this->db->query("SELECT
  count(*) AS hours
FROM class_rooms
  LEFT JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
  INNER JOIN users
    ON users.user_id = schedules.teacher_id
WHERE is_missed = 0 AND schedules.teacher_id = '$id'
      AND year(end_date) = year(NOW()) AND MONTH(end_date) = MONTH(NOW())");
        if ($query) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function single_repo_weekly($id = null)
    {
        $query = $this->db->query("
        SELECT
  users.fname,
  users.lname,
  students.mobile,
  students.fname AS student_f,
  students.lname AS student_l,
  schedules.start_date as s_date,
  end_date as e_date,
  notes,
  is_missed
FROM users
  INNER JOIN class_rooms
    ON class_rooms.teacher_id = users.user_id
  INNER JOIN students
    ON students.student_id = class_rooms.student_id
  INNER JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
WHERE user_type = '101'
      AND WEEKOFYEAR(end_date) = WEEKOFYEAR(NOW())
      AND class_rooms.teacher_id = '$id'
        ");
        $result = $query->result_array();
        $teachs = null;
        $i = 0;
        foreach ($result as $teach) {
            $teachs[$i]['teach'] = $teach;
            $i++;
        }
        return $teachs;
    }

    public function single_repo_monthly($id = null)
    {
        $query = $this->db->query("
        SELECT
  users.fname,
  users.lname,
  students.mobile,
  students.fname AS student_f,
  students.lname AS student_l,
  schedules.start_date as s_date,
  end_date as e_date,
  notes,
  is_missed
FROM users
  INNER JOIN class_rooms
    ON class_rooms.teacher_id = users.user_id
  INNER JOIN students
    ON students.student_id = class_rooms.student_id
  INNER JOIN schedules
    ON schedules.schedule_id = class_rooms.schedule_id
WHERE user_type = '101'
      AND year(end_date) = year(NOW()) AND MONTH(end_date) = MONTH(NOW())
      AND class_rooms.teacher_id = '$id'
        ");
        $result = $query->result_array();
        $teachs = null;
        $i = 0;
        foreach ($result as $teach) {
            $teachs[$i]['teach'] = $teach;
            $i++;
        }
        return $teachs;
    }

    public function get_files()
    {
        $query = $this->db->get('training_material');
        return $query->result();
    }

    public function file_delete($fileid)
    {
        $query = $this->db->get_where('training_material', array('tm_id' => $fileid));
        $result = $query->result();
        $query = $this->db->delete('training_material', array('tm_id' => $fileid));
        return $result[0]->file;
    }

    public function hours_alert()
    {

    }
}