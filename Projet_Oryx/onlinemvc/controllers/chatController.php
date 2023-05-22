<?php
class chatController {

    protected $oChatModel;

    public function __construct()
	{
        $this->oChatModel = new chatModel;
		
		
    }
	public function chatIndex()
	{
		$params = explode('/',$_GET['action']);
        // $controller = $params[0];
        // $method = $params[1];
        $actualroom=$params[2];
		$conv = $this->oChatModel->getLastMessage($actualroom);
			// var_dump($conv); 
		$title = $this->oChatModel->getRoom($actualroom);
		// var_dump($title);
		
		if(isset($_POST['message'])){
			
			$message = $_POST['message'];
			$name = ($_SESSION['user_id']);
			$color = $_POST['color'];
			$room = ($_POST['room']);
			$date = date("Y-m-d h:i:s");
			error_log(print_r($_POST,1));
		$this->oChatModel->storeMessage($message, $name,$color,$room, $date);
		}
		require_once (ROOT . 'views/chat/chatView.php');
	}
	public function chatSearch()
	{
		if(isset($_POST['search'])){
			$recherche = $_POST['search'];
			$yahou = $this->oChatModel->search($recherche);
			// var_dump($yahou);
		}

		require_once (ROOT . 'views/chat/search.php');
	}
}
?>