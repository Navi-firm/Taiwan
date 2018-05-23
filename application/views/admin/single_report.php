<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/31/15
 * Time: 9:35 AM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-reports'); ?>

    <div class="span9">
        <h2>Reports</h2>
        <h4><?php echo $ta_data['fname'] . '&nbsp;' . $ta_data['lname']; ?></h4>

        <p><strong><?php echo $ta_data['mobile']; ?></strong> | <a
                href="mailto:<?php echo $ta_data['email_address']; ?>"
                target="_top"><?php echo $ta_data['email_address']; ?></a></p>
        <hr>
        <h2>Weekly: <span style="font-size: 18px; font-weight: 400;color: #51AEFF;"><?php echo $total_week['hours']; ?>
                hours</span></h2>
        <?php
        if (isset($ta_week)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Mobile</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ta_week as $key => $value):
                    $date = $value['teach']['s_date'];
                    $s_date_only = date("M jS, Y", strtotime($date));
                    $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date);
                    $e_time_only = str_replace(' ', '', $e_time_only);
                    $e_time_only = date('H:i', strtotime($e_time_only));

                    $date2 = $value['teach']['e_date'];
                    $s_date_only2 = date("M jS, Y", strtotime($date2));
                    $e_time_only2 = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date2);
                    $e_time_only2 = str_replace(' ', '', $e_time_only2);
                    $e_time_only2 = date('H:i', strtotime($e_time_only2));
                    ?>
                    <tr>
                        <td><?php echo $value['teach']['student_f'] . ' ' . $value['teach']['student_l']; ?></td>
                        <td><?php echo $value['teach']['mobile']; ?></td>
                        <td><?php echo $value['teach']['notes']; ?></td>
                        <td><?php echo $s_date_only; ?></td>
                        <td><?php echo '<strong>' . $e_time_only . '</strong>'; ?></td>
                        <td><?php echo '<strong>' . $e_time_only2 . '</strong>'; ?></td>
                        <td><?php
                            $missed = $value['teach']['is_missed'];
                            if($missed == 0) {
                                echo '<button class="btn btn-small btn-success">attended</button>';
                            } else {
                                echo '<button class="btn btn-small btn-warning">postponed</button>';
                            }
                            ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php }
        ?>
        <hr>
        <h2>Monthly: <span
                style="font-size: 18px; font-weight: 400;color: #ff9436;"><?php echo $total_month['hours']; ?>
                hours</span></h2>
        <?php
        if (isset($ta_month)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Mobile</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ta_month as $key => $value):
                    $date = $value['teach']['s_date'];
                    $s_date_only = date("M jS, Y", strtotime($date));
                    $e_time_only = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date);
                    $e_time_only = str_replace(' ', '', $e_time_only);
                    $e_time_only = date('H:i', strtotime($e_time_only));

                    $date2 = $value['teach']['e_date'];
                    $s_date_only2 = date("M jS, Y", strtotime($date2));
                    $e_time_only2 = preg_replace('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])?/', null, $date2);
                    $e_time_only2 = str_replace(' ', '', $e_time_only2);
                    $e_time_only2 = date('H:i', strtotime($e_time_only2));
                    ?>
                    <tr>
                        <td><?php echo $value['teach']['student_f'] . ' ' . $value['teach']['student_l']; ?></td>
                        <td><?php echo $value['teach']['mobile']; ?></td>
                        <td><?php echo $value['teach']['notes']; ?></td>
                        <td><?php echo $s_date_only; ?></td>
                        <td><?php echo '<strong>' . $e_time_only . '</strong>'; ?></td>
                        <td><?php echo '<strong>' . $e_time_only2 . '</strong>'; ?></td>
                        <td><?php
                            $missed = $value['teach']['is_missed'];
                            if($missed == 0) {
                                echo '<button class="btn btn-small btn-success">attended</button>';
                            } else {
                                echo '<button class="btn btn-small btn-warning">postponed</button>';
                            }
                            ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php }
        ?>
    </div>

<?php $this->load->view('includes/footer'); ?>