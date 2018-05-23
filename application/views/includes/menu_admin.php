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
                    <li><a href="<?php echo base_url(); ?>admin">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/student_create"><i class="fa fa-plus-circle"></i> Student</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/teacher_create"><i class="fa fa-plus-circle"></i> Teacher</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/upload_material"><i class="fa fa-plus-circle"></i> Material</a></li>
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
                    <li><a href="<?php echo base_url(); ?>admin/training_material">Training Material</a></li>
                </ul>
            </div>
        </div>

