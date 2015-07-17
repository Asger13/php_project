<html>
<head>
<title>Список всех заявок</title>
<style type="text/css">
   h1 { 
    font-size: 120%; 
    font-family: Verdana, Arial, Helvetica, sans-serif; 
    color: #333366;
   }
   h2{
    font-size: 120%; 
    font-family: Times New Roman;
    color: blueviolet;
    text-align: center;
   }
   </style>
</head>
<body leftmargin="30" topmargin="20">
<?php
    try 
    {
    require 'config.php';

    $stmt = $db->prepare('SELECT name,phone,description,file FROM sv_table ORDER BY id DESC');
    $stmt -> execute();
    
    $path ='./photodefect/';
    echo "<center><table bordercolor=red border=2 width=100%><tr>";
    echo "\n<th><h1>Название заявки</h1></th>\n<th><h1>Контактный телефон</h1></th>\n<th><h1>Краткое описание</h1></th>\n<th><h1>Изображение с деффектом</h1></th>\n</tr>\n";
    while($row = $stmt->fetch())
    {
    $pat1=$row['file'];
    $link_img=$path.$pat1;
    echo "<tr>\n<th>" . $row['name'] . "</th>\n<th>" . $row['phone'] . "</th>\n<th>" . $row['description'] . "</th>\n<th>" ."<a href=".$link_img."><img src=".$link_img." width=70 height=50/>". "</th>\n</a></center></p>";
    }
    echo "</h1></table></center><br><br>";
    }
     catch (PDOException $e)
    {
    echo "Сервис временно не доступен";
    }
   
?>
<form action="AllAplication.php">
<h2><a href="http://phpdevelop/XML.php">Скачать в XML</a></h2>
</form>
</html>
