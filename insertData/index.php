<?php
  require "./../db.php";
  $state="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["dbname"])&&!empty($_POST["tbname"])&&
        !empty($_POST["fname"])&&!empty($_POST["lname"])&&
        !empty($_POST["email"])&&!empty($_POST["pwd"])){
      global $state;
      $db= new Database("root","",$_POST["dbname"]);
      $data=[":fname"=>$_POST["fname"],
          ":lname"=>$_POST["lname"],
          ":email"=>$_POST["email"],
          ":pwd"=>$_POST["pwd"]];
      $state=$db->insert($_POST["tbname"],$data);
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
    <input type="text" name="fname" placeholder="first name">
    <input type="text" name="lname" placeholder="last name">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="pwd" placeholder="password">
    <hr>
    <input type="submit" value="add user" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>