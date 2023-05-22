<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>MVC - Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../../css/style.css" rel="stylesheet" />
    
</head>

<body>
    
    <div class="container">
		<div class="row">
			<div class="col">
				<h3>CREER UN COMPTE</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
				<form method="post" action="signup" >
                    <div class="form-group">
						<label>Entrez votre nom</label>
						<input type="text" name="pseudo" required pattern ="^[-0-9a-zA-Z.+_@]{3,}$" maxlength="50">
					</div>
					<div class="form-group">
						<label>Entrez votre email</label>
						<input type="text" name="email" id ="mail"required pattern="^[-0-9a-zA-Z.+_]{2,}+@[-0-9a-zA-Z.+_]{2,}+.[a-zA-Z]{2,4}$" maxlength="255" onblur="availability(mail)">
                        <span id="answer"></span>
					</div>
					<div class="form-group">
						<label>Entrez votre mot de passe</label>
						<input type="password" name="password" id="password" required pattern ="^[-0-9a-zA-Z.+_@]{3,}$" maxlength="150">
					</div>
                    <div class="form-group">
						<label>Veuillez vérifier votre mot de passe</label>
						<input type="password" name="password2" id="password2" required pattern ="^[-0-9a-zA-Z.+_@]{3,}$" maxlength="150">
					</div>
					<!-- <div class="form-group">
						<label>Code de vérification</label>
						<input type="text" name="vercode" required style="height:25px;">&nbsp;&nbsp;&nbsp;<img src="../../captcha.php">
					</div> -->

					<button type="submit" name="submit" class="btn btn-info" <?php $status ?>>VALIDER</button>
					<p><a href="../login/changePassword">Mot de passe oublié ?</a></p>
					<p><a href="../loginIndex">Retour page d'accueil</a></p>
				</form>
			</div>
		</div>
	</div>
       
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/chat.js">

    </script>
</body>

</html>