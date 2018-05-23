<?php
/**
 * Created by IntelliJ IDEA.
 * unknownrogue0x
 * Date: 7/28/15
 * Time: 7:47 AM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-teacher'); ?>

    <div class="span9">
        <h2>Teachers</h2>
        <?php
        if (isset($tc_data)) { ?>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tc_data as $key => $data): ?>
                    <tr>
                        <td><?php echo $data['fname']; ?></td>
                        <td><?php echo $data['lname']; ?></td>
                        <td><?php echo $data['email_address']; ?></td>
                        <td><?php echo $data['mobile']; ?></td>
                        <td>
                            <?php
                            $status = $data['status'];
                            if ($status == '1') {
                                echo '<button class="btn btn-success btn-small">active</button>';
                            } elseif ($status == '2') {
                                echo '<button class="btn btn-warning btn-small">disabled</button>';
                            } else {
                                echo '<button class="btn btn-inverse btn-small">unknown</button>';
                            }
                            ?>

                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/manage_teacher/<?php echo $data['user_id'] ?>"
                               class="btn btn-small btn-inverse">manage</a>
                            <a href="<?php echo base_url(); ?>admin/single_report/<?php echo $data['user_id'] ?>"
                               class="btn btn-small btn-info">reports</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php }
        ?>
    </div>

<?php $this->load->view('includes/footer'); ?>