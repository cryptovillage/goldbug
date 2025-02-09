<?php
session_start();

$name = $_POST["entity-name"];


if ( strtolower($name) === "gateshead" ) {

echo '{"msg":"Gateshead seems to be the correct name! You can feel the room fill with a ghostly presence...","redirect":"A_Message_From_Beyond.php"}';
$_SESSION["status"] = "solved";

}else{
echo '{"msg":"You see no active response from the Ouija Board. Try again later."}';
}


?>
