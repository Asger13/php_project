<?php
define (DB_DRIVER,  "mysql");
define (DB_CHARSET, "UTF8");
define (DB_HOST,    "127.0.0.1");
define (DB_USER,    "root");
define (DB_PASS,    "");
define (DB_NAME,    "Service");

try 
    {
    $db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    $path = 'http://phpdevelop/photodefect/'; 
    $stmt = $db->query('SELECT name,phone,description,file FROM sv_table');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);  

    $dom = new DomDocument('1.0'); 

    $apps = $dom->appendChild($dom->createElement('applications')); 

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
    ?><script>alert('Сервис временно не доступен')</script><?
    }
?>