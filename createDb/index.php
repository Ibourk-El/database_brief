<?php
  require "./../db.php";
  $state="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["dbname"])){
      global $state;
      $db= new Database("root","",$_POST["dbname"]);
      $state=$db->createDB();
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
  </style>
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <input type="text" name="dbname" placeholder="Enter db name">
    <input type="submit" value="Create" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>