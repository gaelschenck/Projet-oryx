const colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
const color_pick = Math.floor(Math.random() * colors.length);
const color = colors[color_pick];

const url = window.location.href;
var split = url.split('/');
var actualroom = split[split.length -1];
console.log(actualroom);


//create a new WebSocket object.
var msgBox = $('#message-box');
var wsUri = "ws://localhost:9000/server.php";
websocket = new WebSocket(wsUri);

websocket.onopen = function(ev) { // connection is open 
    msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Demo WebSocket Chat box"!</div>'); //notify user
}
// Message received from server
websocket.onmessage = function(ev) {
    var response = JSON.parse(ev.data); //PHP sends Json data

    var res_type = response.type; //message type
    var user_message = response.message; //message text
    var user_name = response.name; //user name
    var user_color = response.color; //color

    switch (res_type) {
        case 'usermsg':
            msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
            break;
        case 'system':
            msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
            break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message 

};

websocket.onerror = function(ev) {
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
};
websocket.onclose = function(ev) {
    msgBox.append('<div class="system_msg">Connection Closed</div>');
};

//Message send button
$('#send-message').click(function() {
    send_message();
});

//User hits enter key 
$("#message").on("keydown", function(event) {
    if (event.which == 13) {
        send_message();
    }
});

//Send message
function send_message() {
    var message_input = $('#message'); //user message text
    var name_input = $('#name'); //user name

    if (message_input.val() == "") { //empty name?
        alert("Enter your Name please!");
        return;
    }
    if (message_input.val() == "") { //emtpy message?
        alert("Enter Some message Please!");
        return;
    }

    //prepare json data
    var msg = {
        message: message_input.val(),
        name: name_input.val(),
        color: color,
        room: actualroom,
    };
    store_message(msg);
    // Envoyer les données du message à la base de données
    //convert and send data to server
    websocket.send(JSON.stringify(msg));
    
    message_input.val(''); //reset message input
}
function store_message(msg) {
    var message = msg.message; //user message text
    var name = msg.name; //user name
    var color = msg.color;
    var room = msg.room;

    $.ajax({
        type : 'POST',
        url : window.location.href,
        data : {message: message, name: name, color: color, room: room},
    })
    console.log($.ajax.data);
    
}

//fonctions de validation des champs de formulaire
window.addEventListener("load", () =>{
    

   
    valid(); 

    function valid(){
        confirm.addEventListener("keyup" ,() => {
            let password = document.getElementById("password");
            let confirm = document.getElementById("password2");
            let button = document.querySelector("button[name='submit']");
        if (password.value != confirm.value){
            button.disabled = true;
           
        } else {
            button.disabled = false;
            alert ("Mot de passe concordant");
        }})
    }})
    
    function availability(mail){
        let span = document.getElementById("answer");
            console.log(mail);
            console.log(mail.value);
        fetch('check_availability.php?mail='+mail.value)
        .then(rep => rep.json())
        .then(data => {
            console.log(data)

            switch(data){
                case 1 :
                    span.innerHTML = "Est un mail déjà pris.";
                    break;
                case 2:
                    span.innerHTML = "Est une adresse disponible.";
                    break;
                case 3:
                    span.innerHTML = "N'est pas une adresse valide.";
                    break;
                default:
                    break;
            }
   })  
   
   
    
}
