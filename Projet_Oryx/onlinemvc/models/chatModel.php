<?php 
class chatModel extends Model{

    protected $dbh;

    public function __construct() {
        parent::__construct();
            $this->dbh = $this->getConnexion();
            }
        
    public function getLastMessage($actualroom)
    {
        $query = $this->dbh->prepare(
            "SELECT * FROM 
            (SELECT messages.msg_text,messages.msg_date,messages.msg_user_id,messages.msg_color,messages.msg_room_id, users.user_name
            FROM messages 
            JOIN users
            ON messages.msg_user_id = users.user_id
            WHERE messages.msg_room_id = $actualroom
            ORDER BY msg_date 
            DESC LIMIT 10)
            AS subquery 
            ORDER BY msg_date ASC");
        $query->execute();
        $result= $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
        // var_dump($result);
            
    }
    
    public function getRoom($actualroom)
    {
        
        // var_dump($room);

        $query = $this->dbh->prepare("SELECT * FROM rooms WHERE room_id=$actualroom");        
        $query->execute();
        $result= $query->fetch(PDO::FETCH_OBJ);

        if(!empty ($result)){
           return $result;
        }
    }

    public function storeMessage($message, $name,$color,$room,$date)
        {   
            // error_log($message);
            // error_log($name);
            // error_log($color);
            // error_log($room);
            // error_log($date);
            $query = $this->dbh->prepare("INSERT INTO messages (msg_text, msg_user_id, msg_date, msg_room_id, msg_color) VALUES (:msg_text, :msg_user_id, :msg_date,  :msg_room_id, :msg_color)");
            // On éxecute la requete
            $query->bindParam(':msg_text', $message, PDO::PARAM_STR);
            $query->bindParam(':msg_user_id', $name, PDO::PARAM_INT);
            $query->bindParam(':msg_date', $date, PDO::PARAM_STR);
            $query->bindParam(':msg_room_id', $room, PDO::PARAM_INT);
            $query->bindParam(':msg_color', $color, PDO::PARAM_STR);
            $query->execute(); 
            
        }

    public function search($recherche)
    {
        

            // $query = $this->dbh->prepare("SELECT * FROM 
            // (SELECT messages.msg_text,messages.msg_date,messages.msg_user_id,messages.msg_color,messages.msg_room_id, users.user_name, rooms.room_name
            // FROM messages 
            // JOIN users
            // ON messages.msg_user_id = users.user_id
            // JOIN rooms
            // ON messages.msg_room_id = rooms.room_id
            // WHERE messages.msg_room_id = $actualroom
            // ORDER BY msg_date 
            // DESC LIMIT 10)");  

            $query = $this->dbh->prepare("SELECT messages.msg_text,messages.msg_date,messages.msg_user_id,messages.msg_color,messages.msg_room_id, users.user_name, rooms.room_name
            FROM messages 
            JOIN users
            ON messages.msg_user_id = users.user_id
            JOIN rooms
            ON messages.msg_room_id = rooms.room_id
            WHERE MATCH (msg_text) AGAINST('$recherche')
            ORDER BY msg_date DESC");
            $query->execute();
            $result1= $query->fetchAll(PDO::FETCH_OBJ);
            // var_dump($result);
            return $result1;
        
    }
    }
?>