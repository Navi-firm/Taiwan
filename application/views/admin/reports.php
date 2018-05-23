<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/31/15
 * Time: 8:04 AM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-reports'); ?>

<div class="span9">
    <h2>Teachers:<span style="font-size: 18px; font-weight: 400;color: #51AEFF;"> this week</span></h2>
    <?php
    if (isset($ta_week)) { ?>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hours Taught</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ta_week as $key => $value): ?>
                <tr>
                    <td><?php echo $value['teach']['fname']; ?></td>
                    <td><?php echo $value['teach']['lname']; ?></td>
                    <td><?php echo $value['teach']['mobile']; ?></td>
                    <td>
                        <?php
                        $teacher = $value['teach']['fname'];
                        if (!empty($teacher)) {
                            echo $value['teach']['hours'];
                        } else {
                            echo '';
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php }
    ?>

    <h2>Teachers:<span style="font-size: 18px; font-weight: 400;color: #51AEFF;"> this month</span></h2>
    <?php
    if (isset($ta_month)) { ?>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hours Taught</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ta_month as $key => $value): ?>
                <tr>
                    <td><?php echo $value['teach']['fname']; ?></td>
                    <td><?php echo $value['teach']['lname']; ?></td>
                    <td><?php echo $value['teach']['mobile']; ?></td>
                    <td>
                        <?php
                        $teacher = $value['teach']['fname'];
                        if (!empty($teacher)) {
                            echo $value['teach']['hours'];
                        } else {
                            echo '';
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php }
    ?>
</div>

<?php $this->load->view('includes/footer'); ?>
