<?php
  require "./../db.php";
  $state="";
  $all_data=[];
  $tbname="";
  $dbname="";
  if($_SERVER["REQUEST_METHOD"]=="POST" ||$_SERVER["REQUEST_METHOD"]=="GET"){
    if((!empty($_POST["dbname"])&&!empty($_POST["tbname"]))){
      global $state;
      global $all_data;
      global $tbname;
      global $dbname;
      $tbname=$_POST["tbname"];
      $dbname=$_POST["dbname"];
      $db= new Database("root","",$dbname);
      $all_data=$db->select($tbname);
      
    }
    else if(!empty($_GET["dbname"])&&!empty($_GET["tbname"])){
      global $tbname;
      global $dbname;
      $tbname=$_GET["tbname"];
      $dbname=$_GET["dbname"];
      $db= new Database("root","",$dbname);
      $all_data=$db->select($tbname);
    }
    else{
      $state="<p style='color:red'>some inputs is empty</p>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{
      box-sizing: border-box;
    }
    body{
      width: 100%;
      height: 100vh;
      background-color: #121212;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }
    input{
      padding: 10px 5px;
      outline: none;
      border: none;
    }
    tr{
      background-color: #fff;
    }
    tr:nth-child(2n+1){
      background-color: #eee;
    }
    th{
      padding: 10px;
    }
    
  </style>
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
  <input type="text" name="dbname" placeholder="Enter db name" value="<?php if(!empty($_POST["dbname"])) echo  $_POST["dbname"]; else  "";?>">
    <input type="text" name="tbname" placeholder="Enter tb name" value="<?php if(!empty($_POST["dbname"]) )echo  $_POST["tbname"]; else  "";?>">
    <table>
      <?php if(!empty($all_data)){?>
        
      <tr><th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Email</th></tr>
    <?php
      for($i=0;$i<count($all_data);$i++){
        $editQ="./edit.php?id=".$all_data[$i]["id"]."&&dbname=".$dbname."&&tbname=".$tbname;
        $deleteQ="./delete.php?id=".$all_data[$i]["id"]."&&dbname=".$dbname."&&tbname=".$tbname;
        echo "<tr> <th>".$all_data[$i]["id"]."</th> <th>".$all_data[$i]["fname"]."</th> <th>".$all_data[$i]["lname"]."</th> <th>".$all_data[$i]["email"]."</th> <th><a href='$editQ' method=GET>Edit</a></th><th><a href='$deleteQ'>Delete</a></th></tr>";
      }
    }

    ?>
    </table>
    <hr>
    <input type="submit" value="get All Data" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>