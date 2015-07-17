<?php
try 
    {
    require 'config.php';
    $path = 'http://phpdevelop/photodefect/'; 
    
    $dom = new DomDocument('1.0'); 

    $apps = $dom->appendChild($dom->createElement('applications')); 

    $stmt = $db->prepare('SELECT name,phone,description,file FROM sv_table');
    $stmt -> execute();
    while ($row = $stmt->fetch()) 
    {   
        $appl = $apps->appendChild($dom->createElement('application')); 

        $name = $appl->appendChild($dom->createElement('name'));
        $name->appendChild($dom->createTextNode($row['name'])); 

        $phone = $appl->appendChild($dom->createElement('phone'));
        $phone->appendChild($dom->createTextNode($row['phone']));

        $description = $appl->appendChild($dom->createElement('description'));
        $description->appendChild($dom->createTextNode($row['description']));

        $img = $appl->appendChild($dom->createElement('file'));
        $img->appendChild($dom->createTextNode($path.$row['file']));
    } 
    $dom->formatOutput = true; 

    $xmlString = $dom->saveXML();

    $fileName = "result.xml";

    header('Content-type: application/xml');
    header('Content-Disposition: attachment; filename="result.xml"');
    header('Content-Length: ' . strlen($xmlString));
    echo $xmlString;
    }
catch (PDOException $e)
    {
    echo"Сервис временно недоступен";
    }
?>
