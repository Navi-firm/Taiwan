<?php
/**
 * Created by IntelliJ IDEA.
 * User: rogue0x
 * Date: 7/29/15
 * Time: 8:45 AM
 */
?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="utf-8">
    <title>Online School Management</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="John Muteti">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/bootplus.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootplus-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .hero-unit {
            padding: 60px;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.js"></script>

</head>


<?php $this->load->view('includes/menu_teacher_schedule'); ?>

<div class="span9">
    <h2>Update Timesheet</h2>

    <form class="form-inline" method="POST" action="<?php echo base_url(); ?>teacher/schedule_save">
        <?php
        $msg = validation_errors();
        if (!empty($msg)) { ?>
            <span class="error err has-error" style="color: red; text-transform: capitalize;"><?php echo $msg; ?></span>
        <?php } ?>
        <div class="control-group">
            <label class="control-label" for="start_time">Start Time</label>

            <div class="controls">
                <input type="text" id="start_time" name="start_time" required>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="end_time">End Time</label>

            <div class="controls">
                <input type="text" id="end_time" name="end_time" required>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="student_id">Student</label>

            <div class="controls">
                <select name="student_id" required>
                    <option value="">Select student</option>
                    <?php foreach ($ta_data as $key => $value):
                        $result = 0;
                        $used = $value['student']['classes'];
                        $purchased = $value['student']['purchased_hours'];
                        $postponed = $value['student']['postponed'];
                        if($postponed >= 3) {
                            $result = $used - 2;
                        }  elseif($postponed <= 2) {
                            $result = $used;
                        }
                        $diff = $purchased-$result;
                        if ($diff > 1) { ?>
                            <option
                                value="<?php echo $value['student']['student_id'] ?>"><?php echo $value['student']['fname'] . ' ' . $value['student']['lname']; ?></option>
                            <?php
                        }
                    endforeach; ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Notes</label>

            <div class="controls">
                <textarea name="notes" id="notes" rows="4"></textarea>
            </div>
        </div>

        <input type="hidden" name="teacher_id" value="<?php echo $this->session->userdata('usr_id'); ?>">

        <div class="control-group">
            <?php echo form_submit('update', 'Update', 'class="btn btn-success" '); ?>
        </div>
    </form>
    <script>
        jQuery(function () {
            jQuery('#start_time').datetimepicker({
                format: 'Y-m-d H:i',
                timepicker: true
            });
            jQuery('#end_time').datetimepicker({
                format: 'Y-m-d H:i',
                maxDate: '+1970/01/02',
                timepicker: true
            });
        });

        function check(input) {
            var e_time = input.value;
            var s_time = document.getElementById('start_time').value;
            if (e_time != s_time) {
                input.setCustomValidity('Ensure both match');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
</div>

<?php $this->load->view('includes/footer'); ?>