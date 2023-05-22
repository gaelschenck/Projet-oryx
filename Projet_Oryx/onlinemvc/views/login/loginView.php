<!DOCTYPE html>
<html lang="FR">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Gestion de bibliotheque en ligne</title>
	<!-- BOOTSTRAP CORE STYLE  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- FONT AWESOME STYLE  -->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLE  -->
	<link href="../../css/style.css" rel="stylesheet" />
</head>

<body>


	<!-- On insere le titre de la page (LOGIN UTILISATEUR) -->

	<div class="container">
		<div class="row">
			<div class="col">
				<h3>LOGIN UTILISATEUR</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
				<form method="post" action="loginIndex">
                    <div class="form-group">
						<label>Entrez votre pseudo</label>
						<input type="text" name="pseudo" required pattern="^[-0-9a-zA-Z.+_@]{3,}$" maxlength="50">
					</div>
					<div class="form-group">
						<label>Entrez votre mot de passe</label>
						<input type="password" name="password" required pattern="^[-0-9a-zA-Z.+_@]{3,}$" maxlength="150">
						<p><a href="login/changePassword">Mot de passe oublié ?</a></p>
					</div>

					<!-- <div class="form-group">
						<label>Code de vérification</label>
						<input type="text" name="vercode" required style="height:25px;">&nbsp;&nbsp;&nbsp;<img src="captcha.php">
					</div> -->

					<button type="submit" name="login" class="btn btn-info">LOGIN</button>&nbsp;&nbsp;&nbsp;<a href="login/signup">Créer un compte</a>
					
				</form>
			</div>
		</div>
	</div>
    
    
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/chat.js"></script>
</body>

</html>