<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/30/15
 * Time: 10:06 AM
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
                    <li><a href="<?php echo base_url(); ?>teacher">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>teacher/schedule_create">Update Timesheet</a></li>
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
                    <li><a href="<?php echo base_url(); ?>teacher/schedule">Timesheet</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>teacher/my_students">Students</a></li>
                    <li><a href="<?php echo base_url(); ?>teacher/training_material">Training Material</a></li>
                    <li><a href="#">Profile</a></li>
                </ul>
            </div>
        </div>

        <div class="span9">
            <h2>My Students</h2>
            <?php
            if (isset($my_students)) { ?>
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Skype ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($my_students as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['student']['fname'] ?></td>
                            <td><?php echo $value['student']['lname'] ?></td>
                            <td><?php echo $value['student']['mobile'] ?></td>
                            <td><?php echo $value['student']['email_address'] ?></td>
                            <td><?php echo $value['student']['skype_id'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php }
            ?>
        </div>

        <?php $this->load->view('includes/footer'); ?>
