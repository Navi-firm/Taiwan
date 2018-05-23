<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/28/15
 * Time: 2:02 PM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-student'); ?>

<div class="span9">
    <h2>Create student</h2>

    <form action="<?php echo base_url(); ?>admin/student_save" method="POST" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="fname">First Name</label>

            <div class="controls">
                <input type="text" id="fname" name="fname" placeholder="John..." onkeyup="create_uname();" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="lname">Last Name</label>

            <div class="controls">
                <input type="text" id="lname" name="lname" placeholder="Doe..." onkeyup="create_uname();" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email_address">Email Address</label>

            <div class="controls">
                <input type="text" id="email_address" name="email_address" placeholder="johndoe@example.com ..."
                       required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="skype_id">Skype ID</label>

            <div class="controls">
                <input type="text" id="skype_id" name="skype_id" placeholder="Eg. student.skype" autocomplete="off"
                       required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mobile">Phone</label>

            <div class="controls">
                <input type="text" id="mobile" name="mobile" placeholder="Phone number ..." required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="start_date">Start Date</label>

            <div class="controls">
                <input type="text" id="start_date" name="start_date" placeholder="Starting date ..." required>
            </div>
        </div>
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('usr_id'); ?>">

        <div class="control-group">
            <?php echo form_submit('create', 'Create', 'class="btn btn-success" '); ?>
        </div>
    </form>
    <script>
        $(function () {
            $("#start_date").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</div>

<?php $this->load->view('includes/footer'); ?>
