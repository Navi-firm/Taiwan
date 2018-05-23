<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/31/15
 * Time: 12:34 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-student'); ?>

<div class="span9">
    <h2>Student Info.</h2>
    <h4><?php echo $ta_data['fname'] . '&nbsp;' . $ta_data['lname']; ?></h4>

    <p><strong><?php echo $ta_data['mobile']; ?></strong> | <a
            href="mailto:<?php echo $ta_data['email_address']; ?>"
            target="_top"><?php echo $ta_data['email_address']; ?></a> |
        <strong>skype:</strong> <?php echo $ta_data['skype_id']; ?>
    </p>
    <a href="<?php echo base_url(); ?>admin/student_leave/<?php echo $ta_data['student_id'] ?>"
       class="btn btn-danger btn-sm">Leave</a>
    <hr>
    <h2>Hour Purchase History</h2>
    <?php
    if (isset($pc_data)) { ?>
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th>Time of Purchase</th>
                <th>Hours</th>
                <th>Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php
            function humanTiming($time)
            {
                $time = time() - $time; // to get the time since that moment
                $tokens = array(
                    31536000 => 'year',
                    2592000 => 'month',
                    604800 => 'week',
                    86400 => 'day',
                    3600 => 'hour',
                    60 => 'minute',
                    1 => 'second'
                );
                foreach ($tokens as $unit => $text) {
                    if ($time < $unit) continue;
                    $numberOfUnits = floor($time / $unit);
                    return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
                }
            }
            foreach ($pc_data as $key => $value):
                ?>
                <tr>
                    <td>
                        <?php
                        $time = strtotime($value['purchase']['time_created']);
                        echo humanTiming($time) . ' ago';
                        ?>
                    </td>
                    <td><?php echo $value['purchase']['hours'] ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>admin/purchase_update/<?php echo $value['purchase']['purchase_id'] ?>"
                           class="btn btn-small btn-info">edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php }
    ?>
</div>

<?php $this->load->view('includes/footer'); ?>
