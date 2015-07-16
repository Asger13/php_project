<form action="AllAplication.php">
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
    
    $stmt = $db->query('SELECT name,phone,description,file FROM sv_table ORDER BY id DESC');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    $path ='./photodefect/';
    echo "<table><tr>";
    echo "\n<th>Название заявки</th>\n<th>Контактный телефон</th>\n<th>Краткое описание</th>\n<th>Изображение с деффектом</th>\n</tr>\n";
    while($row = $stmt->fetch())
    {
    $pat1=$row['file'];
    $link_img=$path.$pat1;
    echo "<tr>\n<th>" . $row['name'] . "</th>\n<th>" . $row['phone'] . "</th>\n<th>" . $row['description'] . "</th>\n<th>" ."<a href=".$link_img."><img src=".$link_img." width=70 height=50/>". "</th>\n</a></center></p>";
    }
    echo "</table>";
    }
     catch (PDOException $e)
    {
    ?><script>alert('Сервис временно недоступен')</script><?
    }
   
?>
<a href="http://phpdevelop/XML.php">Скачать в XML</a>
</form>



