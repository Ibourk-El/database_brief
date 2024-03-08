<?php
  require "./../db.php";
  $state="";
  $all_data=[];
  if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(!empty($_GET["dbname"])&&!empty($_GET["tbname"])){
      global $state;
      global $all_data;
      $db= new Database("root","",$_GET["dbname"]);
      $all_data=$db->select_where($_GET["tbname"],"id",$_GET["id"]);
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
  </style>
  <title>Document</title>
</head>
<body>
  <form action="<?php echo "./update.php?id='".$_GET["id"]."&&dbname=".$_GET["dbname"]."&&tbname=".$_GET["tbname"].""?>" method="POST">
    <hr>
    <input type="hidden" name="id" value="<?php echo $all_data[0]["id"] ?>">
    <input type="text" name="fname" placeholder="first name" value="<?php echo $all_data[0]["fname"] ?>">
    <input type="text" name="lname" placeholder="last name" value="<?php echo $all_data[0]["lname"] ?>">
    <input type="text" name="email" placeholder="email" value="<?php echo $all_data[0]["email"] ?>">
    <hr>
    <input type="submit" value="add user" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>