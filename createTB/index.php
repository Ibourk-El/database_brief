<?php
  require "./../db.php";
  $state="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["dbname"])&&!empty($_POST["tbname"])&&!empty($_POST["col4"])&&!empty($_POST["col3"])&&!empty($_POST["col2"])&&!empty($_POST["col1"])){
      global $state;
      $db= new Database("root","",$_POST["dbname"]);

      $state=$db->createTB($_POST["tbname"],$_POST["col1"],$_POST["col2"],$_POST["col3"],$_POST["col4"]);
    }
    else{
      $state="<p style='color=white'>some inputs is empty</p>";
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
    <input type="text" name="tbname" placeholder="Enter tb name">
    <hr>
    <input type="text" name="col1" placeholder="col 1">
    <input type="text" name="col2" placeholder="col 2">
    <input type="text" name="col3" placeholder="col 3">
    <input type="text" name="col4" placeholder="col 4">
    <hr>
    <input type="submit" value="Create table" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>