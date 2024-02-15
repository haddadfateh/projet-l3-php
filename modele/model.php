<?php
require("connexpdo.inc.php");
require_once("Pokemon.php");
require_once("Type.php");

function getAllPokemon(){
    $pdo = connexpdo("pokemon");
    $pdostt_pokemonWithTypes = $pdo->query("SELECT pt.pok_id, p.pok_height, p.pok_weight, p.pok_name, t.type_id, t.type_name FROM pokemon_types pt JOIN pokemon p ON p.pok_id=pt.pok_id JOIN types t ON t.type_id=pt.type_id ORDER BY pt.pok_id");
    $pokemonWithTypes = [];
    while($pWt = $pdostt_pokemonWithTypes->fetch(PDO::FETCH_ASSOC)){
        if(isset($pokemonWithTypes[$pWt['pok_id']])){
            $pokemonWithTypes[$pWt['pok_id']]->addType(new Type($pWt['type_id'], $pWt['type_name']));
        }else{
            $p = new Pokemon(intval($pWt['pok_id']), $pWt['pok_name'], $pWt['pok_height'], $pWt['pok_weight']);
            $pokemonWithTypes[$pWt['pok_id']] = $p;
            $pokemonWithTypes[$pWt['pok_id']]->addType(new Type($pWt['type_id'], $pWt['type_name']));
        }
    }
    return $pokemonWithTypes;
}


function update($Id, $taille, $poids)
{
    $pdo = connexpdo("pokemon");

    $requete = $pdo->query("SELECT * FROM pokemon where pok_id = $Id");
    $requete = $requete->fetch();
    $h=$requete['pok_height'] ;
    $w=$requete['pok_weight'] ;  
    $n=$requete['pok_name'] ;

    $stmt =$pdo->prepare("UPDATE pokemon SET pok_height = :height, pok_weight = :weight WHERE pok_id = :id");
    $stmt->execute(array(":id" => $Id, ":height" => $taille, ":weight" => $poids));

    $xml_file = './public/xml/histo.xml';
    
    $description = " La taille ($h-> $taille ) et le poids ($w->$poids) de $n [ id = $Id ] ont été modifiés";

 $doc = new DOMDocument();
 $doc->load($xml_file);
 $operations = $doc->getElementsByTagName('operations')->item(0);
 
 $operation = $doc->createElement('operation');
 
 $typeElem = $doc->createElement('type', 'modifications_pokemon');
 $operation->appendChild($typeElem);
 
 $horodateElem = $doc->createElement('horodate', date('Y-m-d H:i:s'));
 $operation->appendChild($horodateElem);
 
 $descElem = $doc->createElement('desc', $description);
 $operation->appendChild($descElem);
 
 $operations->appendChild($operation);
 $doc->save($xml_file);
}
   
?>