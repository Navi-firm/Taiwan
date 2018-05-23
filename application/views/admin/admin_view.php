<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/27/15
 * Time: 7:49 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin'); ?>

<div class="span9">
    <div class="big-button"><span style="font-size: 30px;"><?php echo $st_total['students']; ?></span> STUDENTS</div>
    <div class="big-button"><span style="font-size: 30px;"><?php echo $ta_total['teachers']; ?></span> TEACHERS</div>
    <div class="big-button"><span style="font-size: 30px;"><?php echo $hr_total['hours']; ?></span> HOUR<span>(s)</span>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
