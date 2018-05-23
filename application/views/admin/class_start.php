<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 5:42 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-class'); ?>

    <div class="span9">
        <h2>Start Class</h2>
        <hr>
        <form action="<?php echo base_url(); ?>admin/class_confirm" method="post">
            <h4><strong>Teacher:&nbsp;&nbsp;</strong><?php echo $ad_data['fname'] . '&nbsp;' . $ad_data['lname']; ?>
            </h4>
            <h5><strong>Class Time:&nbsp;&nbsp;</strong>
                <?php
                $s_date = $ad_data['start_date'];
                $s_date_only = date("M jS, Y", strtotime($s_date));
                $s_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $s_date);
                $s_time_only = str_replace(' ', '', $s_time_only);
                $s_time_only = date('H:i', strtotime($s_time_only));

                $e_date = $ad_data['end_date'];
                $e_date_only = date("M jS, Y", strtotime($e_date));
                $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $e_date);
                $e_time_only = str_replace(' ', '', $e_time_only);
                $e_time_only = date('H:i', strtotime($e_time_only));

                echo $s_date_only . '&nbsp;&nbsp; <strong>|</strong> &nbsp;&nbsp;' . $s_time_only . '-' . $e_time_only;
                ?>
            </h5>

            <div class="control-group">
                <label class="control-label">Students</label>

                <div class="controls">
                    <select name="student_id" required>
                        <option value="">Select student</option>
                        <?php foreach ($ta_data as $key => $value):
                            $hours = $value['hours'];
                            if ($hours < 1) {
                                $hours = '0 hours';
                            } else {
                                $hours .= ' hours';
                            }
                            ?>
                            <option
                                value="<?php echo $value['student_id'] ?>"><?php echo $value['fname'] . ' ' . $value['lname'] . '- <strong>' . $hours . '</strong>'; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="teacher_id" value="<?php echo $ad_data['teacher_id']; ?>">
            <input type="hidden" name="schedule_id" value="<?php echo $ad_data['schedule_id']; ?>">
            <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('usr_id'); ?>">

            <div class="control-group">
                <?php echo form_submit('start', 'Start', 'class="btn btn-success" '); ?>
            </div>
        </form>

    </div>

<?php $this->load->view('includes/footer'); ?>