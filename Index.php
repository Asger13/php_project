<html>
<head>
<title>Оформление заявки</title>
<style type="text/css">
   h1 { 
    font-size: 140%; 
    font-family: Arial; 
    color: #333366;
   }
    h2{
    font-size: 120%; 
    font-family: Times New Roman;
    color: blueviolet;
   }
   </style>
</head>
<body leftmargin="30" topmargin="20">
<form action="Index.php" method="post" enctype="multipart/form-data">
<p><h1>Бланк заполнения заявки</h1></p>
<p>Название заявки: <input type="text" name="appname" required /></p>
<p>Контактный телефон для связи: <input type="text" name="phone" required /></p>
<p>Краткое описание проблемы: <input name="description" pattern="[A-Za-z0-9_-]{10,}" required /></p>
<p>Файл(картинка) с неисправностью: <input type="file" name="filename" accept="image/*" /></p>
<p><input type="submit" name ="submitdata" value="Отправить" /></p>
<h2><a href="http://phpdevelop/AllAplication.php">Просмотр всех заявок</a></h2>
<p>&nbsp;</p>
</form>
</body>
</html>

<?php
if (isset($_REQUEST['submitdata']))
{
try {
    require 'config.php';
    $appname = $_POST['appname'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $filename = $_FILES['filename']['name'];

    $path = './photodefect/';
    $namenophoto='no_picture.jpg';
    $var = explode('.',$filename);
    $ext = array_pop($var);
    $new_name = time().'.'.$ext; 
    $full_path = $path.$new_name; 

    if($_FILES['filename']['error'] == 0)
        {
        if (substr($_FILES['filename']['type'],0,5)=='image')
            {
          if(move_uploaded_file($_FILES['filename']['tmp_name'], $full_path))
                 {
                  $stmt = $db->prepare("INSERT INTO sv_table (name, phone, description, file) VALUES (:appname, :phone, :description, :new_name)");
                  $stmt->bindParam(':appname', $appname);
                  $stmt->bindParam(':phone', $phone);
                  $stmt->bindParam(':description', $description);
                  $stmt->bindParam(':new_name', $new_name);
                  $stmt->execute();
                  echo "Ваши данные с файлом приняты";
                }
            else
                {
                  echo "Неудалось переместить файл.Сервис временно недоступен";
                }
            }
            else
            {
            echo "Выбранный файл недопустим!Заявка отклонена!";
            }
        }  
            
        elseif($_FILES['filename']['name']==0)
        {
          $stmt = $db->prepare("INSERT INTO sv_table (name, phone, description, file) VALUES (:appname, :phone, :description, :namenophoto)");
          $stmt->bindParam(':appname', $appname);
          $stmt->bindParam(':phone', $phone);
          $stmt->bindParam(':description', $description);
          $stmt->bindParam(':namenophoto', $namenophoto);
          $stmt->execute();
          echo "Ваши данные приняты";
        } 
       $db=null; 
       }
catch (PDOException $e)
{
   echo "Сервис временно недоступен"; 
}
}
?>
