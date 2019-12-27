
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/Icheck/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>Inventory</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="logForm">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div id="responseDiv" class="alert text-center" style="margin-top:20px; display:none;">
				<button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
				<span id="message"></span>
			</div>	
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#logText').html('Login');
		$('#logForm').submit(function(e){
			e.preventDefault();
			$('#logText').html('Checking...');
			var url = '<?php echo base_url(); ?>';
			var user = $('#logForm').serialize();
			var login = function(){
				$.ajax({
					type: 'POST',
					url: url + 'index.php/user/act_login',
					dataType: 'json',
					data: user,
					success:function(response){
						$('#message').html(response.message);
						$('#logText').html('Login');
						if(response.error){
							$('#responseDiv').removeClass('alert-success').addClass('alert-danger').show();
						}
						else{
							$('#responseDiv').removeClass('alert-danger').addClass('alert-success').show();
							$('#logForm')[0].reset();
							setTimeout(function(){
								location.reload();
							}, 3000);
						}
					}
				});
			};
			setTimeout(login, 3000);
		});

		$(document).on('click', '#clearMsg', function(){
			$('#responseDiv').hide();
		});
	});
</script>
</body>
</html>
