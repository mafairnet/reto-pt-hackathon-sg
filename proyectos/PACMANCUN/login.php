<!DOCTYPE HTML>

<html>
	<head>
		<?php include 'header.php'; ?>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">
				<?php include 'menu.php'; ?>

				<div class="content">
				      <form method="post" action="acceso.php" id="formAcceso">
				      	<div class="row" >
			        
			          <div class="col-md-4 col-md-offset-4">
			            <div class="login-panel panel panel-default">
			              <div class="panel-heading">
			                <h3 class="panel-title">Iniciar sesión</h3>
			              </div>
			              <div class="col-md-12">
			                <form role="form">
			                  <fieldset>
			                    <div class="form-group">
			                      <input class="form-control" placeholder="Usuario" id="usuario"  name="usuario" type="text" autofocus required="">
			                    </div>
			                    <div class="form-group">
			                      <input class="form-control" placeholder="Contrase&ntilde;a" id="password" name="password" type="password" value="" required="">
			                    </div>
			                    <div class="checkbox">
			                      <label>
			                        <input name="remember" type="checkbox" value="Remember Me">Mantener sesión abierta
			                      </label>
			                    </div>
			                    <!-- Change this to a button or input when using this as a form -->
			                    <button type="submit" class="btn btn-lg btn-success btn-block">Iniciar sesión</button>
			                  </fieldset>
			                </form>
			              </div>
			            </div>
			          </div>
			       
			      </div>
 </form>
				</div>
				

				<?php include 'footer.php'; ?>

			</div>
	</div>
	<?php include 'head.php'; ?>

	</body>
</html>