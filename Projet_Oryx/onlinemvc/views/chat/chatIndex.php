<?php
$colors = array('#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00');
$color_pick = array_rand($colors);
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body>
	<div class="rooms">
		<ul><a href="../../chat/chatIndex/1">Bienvenue</a></ul>
		<ul><a href="../../chat/chatIndex/2">Veille technologique</a></ul>
		<ul><a href="../../chat/chatIndex/3">Divers</a></ul>
		<ul><a href="../../chat/chatIndex/4">Room 1</a></ul>
		<ul><a href="../../chat/chatIndex/5">Room 2</a></ul>

		<ul><a href="../../chat/chatSearch">Rechercher</a></ul>
	</div>
	<div class="title">Vous êtes dans la room <?php echo $title->room_name;?></div>
	<div class="chat-wrapper">

		<div id="message-box">
			<?php for ($i=0 ; $i<count($conv) ; $i++){?>
			<span style="color:<?php echo $conv[$i]->msg_color;?>"><?php echo $conv[$i]->user_name;?>&nbsp
			<?php echo $conv[$i]->msg_date;?></span>&nbsp
			<?php echo $conv[$i]->msg_text;?> <br> <?php }?></div>
		<div class="user-panel">
			<input type="text" name="name" id="name" placeholder="Your Name" maxlength="50" value="<?php echo !empty($_SESSION['user_name']) ? $_SESSION['user_name'] : "Pas d'utilisateur"; ?>"/>
			<input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" />
			<button id="send-message">Send</button>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/chat.js"></script>
</body>

</html>