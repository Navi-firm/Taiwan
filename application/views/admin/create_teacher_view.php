<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/28/15
 * Time: 8:01 AM
 */
$this->load->view('includes/header');
$this->load->view('includes/menu_admin-teacher'); ?>

    <div class="span9">
        <h2>Create teacher</h2>

        <form action="<?php echo base_url(); ?>admin/teacher_save" class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="username">Username</label>

                <div class="controls">
                    <input type="text" id="username" name="username" placeholder="john.doe ..." readonly>
                </div>
            </div>
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
                <label class="control-label" for="mobile">Phone</label>

                <div class="controls">
                    <input type="tel" id="mobile" name="mobile" placeholder="Phone number ..." required
                           autocomplete="off">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">Password</label>

                <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Password..."
                           value="<?php echo random_string('alnum', 5); ?>" required>
                </div>
            </div>
            <input type="hidden" name="user_type" value="101">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="created_by" value="<?php echo $this->session->userdata('usr_id'); ?>">

            <div class="control-group">
                <?php echo form_submit('create', 'Create', 'class="btn btn-success" '); ?>
            </div>
        </form>
        <script>
            function create_uname() {
                var txtFname = document.getElementById('fname').value;
                var txtLname = document.getElementById('lname').value;
                var username = txtFname.toLowerCase() + '.' + txtLname.toLowerCase();
                if (username != null) {
                    document.getElementById('username').value = username;
                }
            }
        </script>
    </div>

<?php $this->load->view('includes/footer'); ?>