<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Admin</title>
    <link href="<?php echo base_url() ?>admin_asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin_asset/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin_asset/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin_asset/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-bold">Welcome to Inside of Admin Panel</h2>
                <p>
                    <img src="<?php echo base_url() ?>admin_asset/images/logo.png" style="height:100px;" >
                </p>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="<?php echo base_url('Admin/login') ?>" method="post">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter your email " required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <input type="submit" class="btn btn-primary block full-width m-b"  name="login" value="Login Inside"> 
						<br><br><br>
                    </form>
                    <p class="m-t">
                        <small>
                            <?php echo $this->session->flashdata('msg') ?>
                        </small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Shikhalo
            </div>
            <div class="col-md-6 text-right">
               <small>© 2021-25</small>
            </div>
        </div>
    </div>
</body>
</html>
