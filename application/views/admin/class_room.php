<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 5:28 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-class'); ?>

    <div class="span9">
        <h2>Classes</h2>
        <?php
        if (isset($ta_data)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Student</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Postpone</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ta_data as $key => $value):
                    $s_date = $value['start_date'];
                    $s_date_only = date("M jS, Y", strtotime($s_date));
                    $s_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $s_date);
                    $s_time_only = str_replace(' ', '', $s_time_only);
                    $s_time_only = date('H:i', strtotime($s_time_only));

                    $e_date = $value['end_date'];
                    $e_date_only = date("M jS, Y", strtotime($e_date));
                    $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $e_date);
                    $e_time_only = str_replace(' ', '', $e_time_only);
                    $e_time_only = date('H:i', strtotime($e_time_only)); ?>
                    <tr>
                        <td><?php echo $value['fname'] . '&nbsp;&nbsp;' . $value['lname'] ?></td>
                        <td><?php echo $value['st_fname'] . '&nbsp;&nbsp;' . $value['st_lname'] ?></td>
                        <td><?php echo $s_date_only . '&nbsp;&nbsp; <strong>|</strong> &nbsp;&nbsp;' . $s_time_only . ' - ' . $e_time_only; ?></td>
                        <td>
                            <?php
                            $status = $value['is_missed'];
                            if ($status == 0) {
                                echo '<button class="btn btn-success btn-small">scheduled</button>';
                            } elseif ($status == 1) {
                                echo '<button class="btn btn-inverse btn-small">postponed</button>';
                            } else {
                                echo '<button class="btn btn-warning btn-small">unknown</button>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($status == 0) { ?>
                                <a href="<?php echo base_url(); ?>admin/class_postpone/<?php echo $value['class_room_id'] ?>"
                                   class="btn btn-small btn-info"><i class="fa fa-check fa-lg"></i></a>
                            <?php } else { ?>
                                <button class="btn btn-small btn-info disabled disableClick"><i
                                        class="fa fa-check fa-lg"></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

<?php $this->load->view('includes/footer'); ?>