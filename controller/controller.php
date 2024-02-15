<?php
require("model/model.php");

function home(){
    require("view/home.php");
}

function test(){
    try {
        $test = getAllPokemon();
        require("view/test.php");
    }catch(Exception $e){
        $errorMsg = "Une exception a été levée<br>".$e->getMessage();
        require("view/error.php");
    }catch(Error $e){
        $errorMsg = "Une erreur a été levée<br>".$e->getMessage();
        require("view/error.php");
    }
}


function modification(){
    if(isset($_POST['modifier'])) {
        $pokemon_id = intval($_POST['pokemon']);
        $taille = intval($_POST['height']);
        $poids = intval($_POST['weight']);
        try{
            update($pokemon_id, $taille, $poids);
            $success_message = "Le pokemon a été mis à jour avec succès.";
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
    $pokemons = getAllPokemon();
    require("view/modification.php");
}

function modifierPokemon($id){
    $pokemons = getAllPokemon();
    $pokemon = $pokemons[$id];

    if(isset($_POST['height']) && isset($_POST['weight'])){
        $taille = intval($_POST['height']);
        $poids = intval($_POST['weight']);
        update($id, $taille, $poids);
        $success_message = "Modification effectuée avec succès !";
    }

    require("view/modification.php");
}

function  historique()
{
    try {

        $xml = simplexml_load_file('./public/xml/histo.xml');
        require("view/historisation.php");
    }catch(Exception $e){
        $errorMsg = "Une exception a été levée<br>".$e->getMessage();
        require("view/error.php");
    }catch(Error $e){
        $errorMsg = "Une erreur a été levée<br>".$e->getMessage();
        require("view/error.php");
    }
}

?>