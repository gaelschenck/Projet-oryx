<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body>
	<h1>RECHERCHE DANS LE CHAT</h1>
    <h2>Vous êtes connectés en tant que <?php echo !empty($_SESSION['user_name']) ? $_SESSION['user_name'] : "Pas d'utilisateur"; ?></h2>
    <a href="../../chat/chatIndex/1">Retour</a><br><br>

    <form method="post" action="chatSearch">
        <input type="text" name="search" id="search" placeholder="Saisir un mot-clé (4 lettres min)" maxlength="50"/>
        <button id="send-search">Envoyer</button>
        </form>
        <div class="response"><br><br>
            <?php if(!empty($yahou)){
            for ($i=0 ; $i<count($yahou) ; $i++){?>
			<?php echo $yahou[$i]->user_name;?> @ &nbsp
            <?php echo $yahou[$i]->room_name;?> le &nbsp
			<?php echo $yahou[$i]->msg_date;?> a écrit:&nbsp<br>
			<?php echo $yahou[$i]->msg_text;?> <br> <?php }
            } else { echo "Recherche non aboutie";
            } ?>
        </div>
        

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/chat.js"></script>
</body>

</html>