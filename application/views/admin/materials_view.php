<?php $this->load->view('includes/header'); ?>
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
                        <li><a href="<?php echo base_url(); ?>admin/upload_material">Upload Material</a></li>
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
        <h2>Teaching Material</h2>
        <?php
        $i = 0;
        foreach ($files as $file):
            $i++;
            ?>
            <div class="control-group">
                <span style="font-weight: 400; font-size: 14px;"><?php echo $i . '. '; ?></span>
                <span style="font-weight: 500;font-size: 13px; font-weight: bold;"><?=$file->title?>
                    |&ensp; <?=$file->file?></span>

                <div style="margin-left: 10px;">
                    <a href="<?= base_url() ?>material/<?= $file->file ?>" class="btn btn-info btn-small"><i
                            class="fa fa-download"></i> Download</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?= site_url("admin/delete_material/" . $file->tm_id) ?>"
                       class="btn btn-warning btn-small"><i class="fa fa-remove"></i> Delete</a>
                </div>
            </div>
            <?php
        endforeach; ?>
    </div>

<?php $this->load->view('includes/footer'); ?>