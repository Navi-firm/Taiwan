<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 8/1/15
 * Time: 6:53 AM
 */
$this->load->view('includes/header'); ?>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Online School Management</a>

                <div class="nav-collapse collapse">
                    <p class="navbar-text pull-right">
                        Logged in as <a href="#"
                                        class="navbar-link"><strong><?php echo $this->session->userdata('username'); ?></strong></a>&nbsp;&nbsp;
                        |
                        <a href="<?php echo base_url(); ?>oauth/sign_out" class="navbar-link text-error"
                           style="color: orangered;">Logout</a>
                    </p>
                    <ul class="nav">
                    </ul>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid">
    <div class="row-fluid">
    <div class="span3">
        <div class="sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">MANAGEMENT</li>
                <li><a href="<?php echo base_url(); ?>admin/teachers">Teachers</a></li>
                <li><a href="<?php echo base_url(); ?>admin/students">Students</a></li>
                <li><a href="<?php echo base_url(); ?>admin/class_room">Class Room</a></li>
                <li><a href="<?php echo base_url(); ?>admin/time_reports">Time Reports</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>admin/training_material">Training Material</a></li>
            </ul>
        </div>
    </div>
    <!--    End of menu-->

    <div class="span9">
        <h2>Teacher Training Materials</h2>
        <span class="text-error"><?php echo $error['error'] ?></span>
        <?php echo form_open_multipart('admin/do_upload', 'class="form-inline" '); ?>
        <div class="control-group">
            <label class="control-label">Title</label>

            <div class="controls">
                <input type="text" name="title" placeholder="File title/description" required autocomplete="off">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="teacher_id">Teacher</label>

            <div class="controls">
                <select name="teacher_id" id="teacher_id" required>
                    <option value="">Select teacher</option>
                    <option value="0"><strong>ALL teachers</strong></option>
                    <?php foreach($teachers as $key => $value): ?>
                        <option value="<?php echo $value['user_id'] ?>"><?php echo $value['fname'] .' '.$value['lname'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="file" name="userfile"/>
            </div>
        </div>

        <input type="hidden" name="uploaded_by" value="<?php echo $this->session->userdata('usr_id'); ?>">

        <div class="control-group">
            <div class="controls">
                <button type="submit" name="btn-upload" class="btn btn-success">upload</button>
            </div>
        </div>
        </form>

    </div>

<?php $this->load->view('includes/footer'); ?>