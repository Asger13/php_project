<form action="Registration.php" method="post" enctype="multipart/form-data">
<p>�������� ������: <input type="text" name="appname" required /></p>
<p>���������� ������� ��� �����: <input type="text" name="phone" required /></p>
<p>������� �������� ��������: <input name="description" pattern="[A-Za-z0-9_-]{10,}" required /></p>
<p>����(��������) � ��������������: <input type="file" name="filename" accept="image/*" /></p>
<p><input type="submit" name ="submitdata" value="���������" /></p>
<a href="http://phpdevelop/AllAplication.php">�������� ���� ������</a>
<p>&nbsp;</p>
</form>

<?php
if (isset($_REQUEST['submitdata']))
{
define (DB_DRIVER,  "mysql");
define (DB_CHARSET, "UTF8");
define (DB_HOST,    "127.0.0.1");
define (DB_USER,    "root");
define (DB_PASS,    "");
define (DB_NAME,    "Service");

try {
    $db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
    $appname = $_POST['appname'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $filename = $_FILES['filename']['name'];

    $path = './photodefect/';
    $namenophoto='no_picture.jpg';
    $var = explode('.',$filename);
    $ext = array_pop($var);
    if ($ext == "png"||$ext =="jpeg"||$ext =="bmp"||$ext =="gif"||$ext =="jpg"||$ext=="")
    {
    $new_name = time().'.'.$ext; 
    $full_path = $path.$new_name; 

    if($_FILES['filename']['error'] == 0)
        {
          move_uploaded_file($_FILES['filename']['tmp_name'], $full_path);
         
          $db->query("INSERT INTO sv_table (name, phone, description, file) VALUES ('$appname', '$phone', '$description', '$new_name')");
            ?>
            <script>alert('���� ������ � ������ �������')</script><?
         
        }  
        else
        {
            $db->query("INSERT INTO sv_table (name, phone, description,file) VALUES ('$appname', '$phone', '$description','$namenophoto')");
            ?>
             <script>alert('���� ������ �������')</script><?
            
        } 
         $db=null;   
    }
    else{echo "��������� ���� ����������!������ ���������!";}
    }
catch (PDOException $e){
    ?>
    <script>alert('������ �������� �� ��������')</script>
    <?
}
}
?>
