<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 7:09 AM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-teacher'); ?>

    <div class="span9">
        <h2>Information</h2>
        <hr>
        <h4><?php echo $ta_data['fname'] . '&nbsp;' . $ta_data['lname']; ?></h4>

        <p><strong><?php echo $ta_data['mobile']; ?></strong> | <a
                href="mailto:<?php echo $ta_data['email_address']; ?>"
                target="_top"><?php echo $ta_data['email_address']; ?></a></p>
        <?php
        $status = $ta_data['status'];
        if ($status == '1') {
            echo '<button class="btn btn-success btn-small btn-small">active</button>';
        } elseif ($status == '2') {
            echo '<button class="btn btn-warning btn-small btn-small">disabled</button>';
        } else {
            echo '<button class="btn btn-inverse btn-small">unknown</button>';
        }
        ?>
        <hr>

        <h2>Schedule</h2>
        <?php
        if (isset($ta_shed)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Starts</th>
                    <th>Ends</th>
                    <th>Status</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ta_shed as $value):
                    $date = $value['schedule']['start_date'];
                    $s_date_only = date("M jS, Y", strtotime($date));
                    $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date);
                    $e_time_only = str_replace(' ', '', $e_time_only);
                    $e_time_only = date('H:i', strtotime($e_time_only));

                    $date2 = $value['schedule']['end_date'];
                    $s_date_only2 = date("M jS, Y", strtotime($date2));
                    $e_time_only2 = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date2);
                    $e_time_only2 = str_replace(' ', '', $e_time_only2);
                    $e_time_only2 = date('H:i', strtotime($e_time_only2));
                    ?>
                    <tr>
                        <td>
                            <?php echo $e_time_only . ':&nbsp;&nbsp;<strong>' . $s_date_only . '</strong>'; ?>
                        </td>
                        <td><?php echo $e_time_only2 . ':&nbsp;&nbsp;<strong>' . $s_date_only2 . '</strong>'; ?></td>
                        <td>
                            <?php
                            $status = $value['schedule']['status'];
                            $in_class = $value['schedule']['is_missed'];
                            if ($status == '1' && $in_class == null) {
                                echo '<button class="btn btn-success btn-small">available</button>';
                            } elseif ($status == '2' && $in_class == null) {
                                echo '<button class="btn btn-warning btn-small">away</button>';
                            } elseif ($in_class == 0) {
                                echo '<button class="btn btn-inverse btn-small">in class</button>';
                            } elseif ($in_class == 1) {
                                echo '<button class="btn btn-inverse btn-small">postponed</button>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($status == 1 && $in_class == null) { ?>
                                <a href="<?php echo base_url(); ?>admin/start_class/<?php echo $value['schedule']['schedule_id'] ?>"
                                   class="btn btn-small btn-primary">Book Class</a>
                            <?php } elseif ($status != 1 || $in_class != null) { ?>
                                <button class="btn btn-small btn-primary disabled disableClick">Book Class</button>
                            <?php }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php }
        ?>

        <hr>
        <form class="form-inline" action="<?php echo base_url(); ?>admin/reset_password" method="post">
            <input type="password" name="reset_pass" placeholder="New password" required autocomplete="off">
            <input type="hidden" name="teacher_id" value="<?php echo $ta_data['user_id']; ?>">
            <?php echo form_submit('reset', 'Reset Password', 'class="btn btn-inverse btn-sm" '); ?>
            &nbsp;&nbsp;&nbsp;
            <?php
            if ($status == '1') { ?>
                <a href="<?php echo base_url(); ?>admin/deactivate/<?php echo $ta_data['user_id'] ?>"
                   class="btn btn-warning btn-sm">De-Activate</a>
            <?php } elseif ($status == '2') { ?>
                <a href="<?php echo base_url(); ?>admin/activate/<?php echo $ta_data['user_id'] ?>"
                   class="btn btn-success btn-sm">Activate</a>
            <?php }
            ?>
            &nbsp;&nbsp;&nbsp;
            <a href="<?php echo base_url(); ?>admin/teacher_leave/<?php echo $ta_data['user_id'] ?>"
               class="btn btn-danger btn-sm">Leave</a>
        </form>


    </div>

<?php $this->load->view('includes/footer'); ?>