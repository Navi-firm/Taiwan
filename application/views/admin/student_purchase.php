<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 3:20 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin'); ?>

    <div class="span9">
        <h2>Purchase Hours</h2>

        <form action="<?php echo base_url(); ?>admin/purchase_true" method="POST" class="form-horizontal">
            <h4><?php echo $hrs_data['fname'] . '&nbsp;&nbsp;' . $hrs_data['lname'] ?></h4>

            <div class="control-group">
                <input type="text" name="hours" placeholder="Purchased hours...">
            </div>

            <input type="hidden" name="student_id" value="<?php echo $hrs_data['student_id']; ?>">

            <div class="control-group">
                <?php echo form_submit('buy', 'Buy', 'class="btn btn-success" '); ?>
            </div>
        </form>
    </div>

<?php $this->load->view('includes/footer'); ?>