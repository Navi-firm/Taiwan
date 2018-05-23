<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/31/15
 * Time: 1:20 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin'); ?>

    <div class="span9">
        <h2>Purchase Hours</h2>

        <form action="<?php echo base_url(); ?>admin/is_purchase_update" method="POST" class="">

            <h4>Current hours: <?php echo $hrs_data['hours'] ?></h4>

            <div class="control-group">
                <label class="control-label">Hours</label>

                <div class="controls">
                    <input type="text" name="hours" placeholder="Purchased hours...">
                </div>
            </div>
            <input type="hidden" name="student_id" value="<?php echo $hrs_data['student_id'] ?>">
            <input type="hidden" name="purchase_id" value="<?php echo $hrs_data['purchase_id'] ?>">

            <div class="control-group">
                <?php echo form_submit('update', 'Update', 'class="btn btn-success" '); ?>
            </div>
        </form>
    </div>

<?php $this->load->view('includes/footer'); ?>