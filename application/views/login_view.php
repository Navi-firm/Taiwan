<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign in &middot; School</title>
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/bootplus.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootplus-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome-ie7.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-image: url(<?php echo base_url(); ?>assets/img/bg.jpg);

            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: top center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed;
        }

        .form-signin {
            /*border: 1px solid #D8D8D8;*/
            /*background-color: #FFF;*/
            max-width: 350px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            /*background-color: #fff;*/
            /*border: 1px solid #F5F5F5;*/
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            opacity: 0.9;
        }
        .form-signin .form-signin-heading {
            font-size: 24px;
            font-weight: 300;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

</head>

<body>
<div class="container">

    <h2 style="text-align: center;"><strong>Nghe Noi Tot - Online School Management</strong></h2>
    <form class="form-signin" method="POST" action="<?php echo base_url(); ?>oauth/is_true">

        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
        $msg = validation_errors();
        if (!empty($msg)) { ?>
            <span class="error err has-error" style="color: orangered;"><?php echo $msg; ?></span>
        <?php } ?>
        <input type="text" name="email_address" class="input-block-level" placeholder="Email address" autocomplete="on" required>
        <input type="password" name="password" class="input-block-level" placeholder="Password" required>
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-primary" type="submit">
            Sign in
            <i class="icon-circle-arrow-right"></i>
        </button>
    </form>

</div> <!-- /container -->

<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>
</html>
