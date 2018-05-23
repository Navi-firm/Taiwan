<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 6:58 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-teacher'); ?>

<div class="span9">
    <h2>Teacher Schedule</h2>
    <hr>

    <?php
    if (isset($ta_data)) { ?>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th>Starts</th>
                <th>End Time</th>
                <th>Teacher ID</th>
                <th>Status</th>
                <th>Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ta_data as $key => $value):
                $date = $value['start_date'];
                $s_date_only = date("M jS, Y", strtotime($date));
                $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date);
                $e_time_only = str_replace(' ', '', $e_time_only);
                $e_time_only = date('H:i', strtotime($e_time_only));

                $date2 = $value['end_date'];
                $s_date_only2 = date("M jS, Y", strtotime($date2));
                $e_time_only2 = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date2);
                $e_time_only2 = str_replace(' ', '', $e_time_only2);
                $e_time_only2 = date('H:i', strtotime($e_time_only2));
                ?>
                <tr>
                    <td>
                        <?php echo $e_time_only . ':&nbsp;&nbsp;' . $s_date_only; ?>
                    </td>
                    <td><?php echo $e_time_only2 . ':&nbsp;&nbsp;' . $s_date_only2; ?></td>
                    <td><?php
                        $ta = $value['teacher_id'];
                        if ($ta == 3) {
                            echo 'yes';
                        } else {
                            echo 'no';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $status = $value['status'];
                        if ($status == '1') {
                            echo '<button class="btn btn-success btn-small">available</button>';
                        } elseif ($status == '2') {
                            echo '<button class="btn btn-warning btn-small">busy</button>';
                        } else {
                            echo '<button class="btn btn-inverse btn-small">unknown</button>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $status = $value['status'];
                        if ($status == '1') { ?>
                            <a href="<?php echo base_url(); ?>teacher/unavailable/<?php echo $value['schedule_id']; ?>"
                               class="btn btn-inverse"
                               onclick="return confirm('You are going to be unavailable during this time?');">n/a</a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url(); ?>teacher/remove_schedule/<?php echo $value['schedule_id']; ?>"
                               class="btn btn-warning"
                               onclick="return confirm('Are you sure you want to remove this schedule?');">remove</a>
                        <?php } else { ?>
                            <a href="<?php echo base_url(); ?>teacher/remove_schedule/<?php echo $value['schedule_id']; ?>"
                               class="btn btn-inverse"
                               onclick="return confirm('Are you sure you want to remove this schedule?');">remove</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php }
    ?>
</div>

<?php $this->load->view('includes/footer'); ?>
