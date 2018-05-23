<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/28/15
 * Time: 1:44 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-student'); ?>

    <div class="span9">
        <h2>Students</h2>
        <?php if (isset($st_data)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Mobile</th>
                    <th>Skype ID</th>
                    <th>Start Date</th>
                    <th>Total Hrs</th>
                    <th>Status</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($st_data as $key => $data): ?>
                    <tr>
                        <td><?php echo $data['fname']; ?></td>
                        <td><?php echo $data['lname']; ?></td>
                        <td><?php echo $data['email_address']; ?></td>
                        <td><?php echo $data['mobile']; ?></td>
                        <td><?php echo $data['skype_id']; ?></td>
                        <td><?php echo $data['start_date']; ?></td>
                        <td>
                            <?php
                            $hours = $data['hours'];
                            if ($hours < 1) {
                                $hours = '0';
                            }
                            echo $hours;
                            ?>
                        </td>
                        <td>
                            <?php
                            $status = $data['status'];
                            if ($status == '1') {
                                echo '<button class="btn btn-primary btn-small btn-small">active</button>';
                            } elseif ($status == '2') {
                                echo '<button class="btn btn-warning btn-small btn-small">disabled</button>';
                            } else {
                                echo '<button class="btn btn-inverse btn-small">unknown</button>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/purchase_hours/<?php echo $data['student_id'] ?>"
                               class="btn btn-small btn-success"><i class="fa fa-plus"></i> hours</a>
                            <?php
                            if ($status == 1) { ?>
                                <a href="<?php echo base_url(); ?>admin/student_details/<?php echo $data['student_id'] ?>"
                                   class="btn btn-small btn-info">info</a>
                                <a href="<?php echo base_url(); ?>admin/student_disable/<?php echo $data['student_id'] ?>"
                                   class="btn btn-small btn-inverse">deactivate</a>
                            <?php } else { ?>
                                <a href="<?php echo base_url(); ?>admin/student_details/<?php echo $data['student_id'] ?>"
                                   class="btn btn-small btn-info">info</a>
                                <a href="<?php echo base_url(); ?>admin/student_activate/<?php echo $data['student_id'] ?>"
                                   class="btn btn-small btn-primary">activate</a>
                            <?php }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else {
            echo 'No students found.';
        } ?>
        <hr>
        <h2>Active Students</h2>
        <?php if (isset($active)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile</th>
                    <th>Classes Scheduled</th>
                    <th>Postponed Classes</th>
                    <th>Hours Remaining</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($active as $key => $data): ?>
                    <tr>
                        <td><?php echo $data['student']['fname']; ?></td>
                        <td><?php echo $data['student']['lname']; ?></td>
                        <td><?php echo $data['student']['mobile']; ?></td>
                        <td><?php echo $data['student']['classes']; ?></td>
                        <td><?php echo $data['student']['postponed']; ?></td>
                        <td>
                            <?php
                            $result = 0;
                            $used = $data['student']['classes'];
                            $purchased = $data['student']['purchased_hours'];
                            $postponed = $data['student']['postponed'];
                            if($postponed == 3) {
                                $result = $used - 2;
                            }  elseif($postponed <= 2) {
                                $result = $used;
                            }
                            echo $purchased-$result;
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/purchase_hours/<?php echo $data['student']['student_id'] ?>"
                               class="btn btn-small btn-success"><i class="fa fa-plus"></i> hours</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else {
            echo 'No students found.';
        } ?>

    </div>

<?php $this->load->view('includes/footer'); ?>