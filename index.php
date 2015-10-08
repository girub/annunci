<?php
// Report all errors
error_reporting(E_ALL);

require_once 'config.php';

$servername = DB_SERVERNAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die("no connection");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$url = FILE_XML_WEB;

if (isset($url)) {
    $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
    $xml = file_get_contents($url, false, $context);
    $xml = simplexml_load_string($xml);
} else {
    $file = FILE_XML;
    $xml = simplexml_load_file($file);
}
//die();

//primo insert che dovra includere piu file xml.. forse
//Now, insert/update - USE MySQL's "INSERT ... ON DUPLICATE UPDATE" feature
//foreach ($xml->annuncio as $an) {
//    $sql = 'INSERT INTO `annunci` (rif,comune, descrizione, tipologia, indirizzo, provincia) VALUES '
//            . '("'.$an->riferimento.'", "'.$an->comune.'", "'.$an->descrizione.'", "'.$an->tipologia.'", "'.$an->indirizzo.'", "'.$an->provincia.'") '
//            . 'ON DUPLICATE KEY UPDATE comune="'.$an->comune.'", descrizione ="' . $an->descrizione .'", tipologia ="' . $an->tipologia .'", indirizzo ="' . $an->indirizzo .'", provincia ="' . $an->provincia .'"';
//                
//    echo $sql . "<br>";
//    $result = $conn->query($sql);
//}
////print_r($xml);
//die();


$rife = array();
foreach ($xml->annuncio as $an) {
    $rife[(string) $an->riferimento] = (string) $an->riferimento;
}
// delete all entries from table where the table entries are not in the xml
$sql = "DELETE FROM `annunci` WHERE rif NOT IN ('" . implode("',  '", array_keys($rife)) . "')";
$result = $conn->query($sql);


//Now, insert/update - USE MySQL's "INSERT ... ON DUPLICATE UPDATE" feature
foreach ($xml->annuncio as $an) {


    $immag = array();
    foreach ($an->immagini->immagine as $imm) {

        //echo "<img src=\"$imm\" width=\"70\">";
        $immag[(string) $imm] = (string) $imm;
    }

    //che figata sto ON DUPLICATE KEY UPDATE non lo conoscevo
    $sql = 'INSERT INTO `annunci` '
            . '(`rif`, '
            . '`provincia`, '
            . '`comune`, '
            . '`cap`, '
            . '`indirizzo`, '
            . '`contratto`, '
            . '`categoria`, '
            . '`tipologia`, '
            . '`descrizione`, '
            . '`prezzo`, '
            . '`spesecondominialianno`, '
            . '`spesecondominialimese`, '
            . '`trattativariservata`, '
            . '`riscaldamento`, '
            . '`giardinoprivato`, '
            . '`giardinocondominiale`, '
            . '`numerobagni`, '
            . '`annocostruzione`, '
            . '`condizioni`, '
            . '`garage`, '
            . '`piano`, '
            . '`classe_energetica`, '
            . '`ipe`, '
            . '`latitudine`, '
            . '`longitudine`, '
            . '`scroll`, '
            . '`inevidenza`, '
            . '`notepubbliche`, '
            . '`immagini`) VALUES '
            . '("'. $an->riferimento . '", '
            . '"' . $an->provincia . '", '
            . '"' . $an->comune . '", '
            . '"' . $an->cap . '", '
            . '"' . $an->indirizzo . '", '
            . '"' . $an->contratto . '", '
            . '"' . $an->categoria . '", '
            . '"' . $an->tipologia . '", '
            . '"' . $an->descrizione . '", '
            . '"' . $an->prezzo . '", '
            . '"' . $an->spesecondominialianno . '", '
            . '"' . $an->spesecondominialimese . '", '
            . '"' . $an->trattativariservata . '", '
            . '"' . $an->riscaldamento . '", '
            . '"' . $an->giardinoprivato . '", '
            . '"' . $an->giardinocondominiale . '", '
            . '"' . $an->numerobagni . '", '
            . '"' . $an->annocostruzione . '", '
            . '"' . $an->condizioni . '", '
            . '"' . $an->garage . '", '
            . '"' . $an->piano . '", '
            . '"' . $an->classe_energetica . '", '
            . '"' . $an->ipe . '",'
            . '"' . $an->latitudine . '", '
            . '"' . $an->longitudine . '", '
            . '"' . $an->scroll . '", '
            . '"' . $an->inevidenza . '", '
            . '"' . $an->notepubbliche . '", '
            . '"' . $an->immagini . '") '
            . 'ON DUPLICATE KEY UPDATE provincia="' . $an->provincia . '", comune ="' . $an->comune . '",cap="' . $an->cap . '", indirizzo ="' . $an->indirizzo . '",contratto="' . $an->contratto . '", categoria ="' . $an->categoria . '",tipologia="' . $an->tipologia . '", descrizione ="' . $an->descrizione . '",prezzo="' . $an->prezzo . '", spesecondominialianno ="' . $an->spesecondominialianno . '", spesecondominialimese ="' . $an->spesecondominialimese . '", trattativariservata ="' . $an->trattativariservata . '", '
            . 'riscaldamento ="' . $an->riscaldamento . '", giardinoprivato ="' . $an->giardinoprivato . '", giardinocondominiale ="' . $an->giardinocondominiale . '", numerobagni ="' . $an->numerobagni . '", annocostruzione ="' . $an->annocostruzione . '", condizioni ="' . $an->condizioni . '", garage ="' . $an->garage . '", piano ="' . $an->piano . '", classe_energetica ="' . $an->classe_energetica . '", ipe ="' . $an->ipe . '", latitudine ="' . $an->latitudine . '", longitudine ="' . $an->longitudine . '", scroll ="' . $an->scroll . '",'
            . ' inevidenza ="' . $an->inevidenza . '", notepubbliche ="' . $an->notepubbliche . '", immagini ="' . implode("#", array_keys($immag)) . '"';

    echo $sql . "<hr>";
    
    $result = $conn->query($sql);
}



/*
  $sql = "SELECT rif, comune, descrizione FROM annunci";
  $result = $conn->query($sql);

  echo $result->num_rows . "<br>";
  $arr = array();
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

  //echo "rif: " . $row["rif"];

  $arr[]=$row["rif"];

  //del
  foreach ($xml->annuncio as $an) {
  if(in_array($an->riferimento, $row)){
  echo "<br>xxxx"  . $row[rif];
  }else{
  echo "<br>@@@@";
  }
  }


  // - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";

  }
  } else {
  echo "0 results";
  }
 */



/*

  if(in_array($an->riferimento, $arr)){
  echo "presente<br>";
  }else{
  echo "nooo". $an->riferimento . "<br>";

  //insert
  $sql = "INSERT INTO annunci (rif, comune, descrizione) VALUES (\"$an->riferimento\", \"$an->comune\", \"$an->descrizione\")";
  if ($conn->query($sql) === TRUE) {
  echo "New record created successfully <br>";
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  }

  }

 */

//}
//$conn->close();






/*
  $file="file.xml";
  $xml =  simplexml_load_file($file);

  foreach ($xml->annuncio as $an) {

  echo '<h2>' . $an->riferimento . '</h2>';
  echo  $an->contratto .', ' . $an->categoria . "<br>";

  echo  $an->indirizzo .', ' . $an->comune . ' (' . $an->provincia .')<br> ';
  echo  $an->descrizione;

  echo '<p>' . $an->data . '</p>';

  // $categories = $an->regions->region->categories->categorie;


  foreach ($an->immagini->immagine as $imm) {

  echo "<img src=\"$imm\" width=\"70\">";

  }


  }
 */
?>
