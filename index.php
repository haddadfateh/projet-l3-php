<?php
require("controller/controller.php");


if(isset($_GET['action'])){
    if($_GET['action']==="test") {
        test();
    }
    else if($_GET['action']==="modifyPokemon") {
        modification();
    }
    else if($_GET['action']==="historique"){
        historique();
    }
    else {
        home();
    }
}
else {
    home();
}


?>



