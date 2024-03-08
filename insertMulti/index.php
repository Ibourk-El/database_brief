<?php
  require "./../db.php";
  $state=[];
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["dbname"])&&!empty($_POST["tbname"])&&
        !empty($_POST["fname1"])&&!empty($_POST["lname1"])&&
        !empty($_POST["email1"])&&!empty($_POST["pwd1"])){
      global $state;
      $db= new Database("root","",$_POST["dbname"]);
      for($i=1;$i<=$_POST["num1"];$i++)
      {
        $data=[":fname"=>$_POST["fname$i"],
          ":lname"=>$_POST["lname$i"],
          ":email"=>$_POST["email$i"],
          ":pwd"=>$_POST["pwd$i"]];
        $state=$db->insert($_POST["tbname"],$data);
      }
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
    <input type="text" name="dbname" placeholder="Enter db name" value="<?php if(!empty($_POST["dbname"])) echo  $_POST["dbname"]; else  "";?>">
    <input type="text" name="tbname" placeholder="Enter tb name" value="<?php if(!empty($_POST["dbname"]) )echo  $_POST["tbname"]; else  "";?>">
    <hr>
    <div>
      <?php 
        if(!empty($_POST["num"])) 
          {
            for($i=1;$i<=$_POST["num"];$i++){
            echo "
                <div>
                  <p style='color:white;'>user $i </p>
                  <input type=text name=fname$i placeholder='first name'>
                  <input type=text name=lname$i placeholder='last name'>
                  <input type=text name=email$i placeholder='email'>
                  <input type=text name=pwd$i placeholder='password'> <hr>
                </div>";
            }
            echo "<input type=hidden name=num1 value=".$_POST['num'].";>";
          }
        else echo "<hr>
        <div style='color:white;'>
          Enter how many user you want to add <input type=text name=num>
          <input type=submit value=create>
        </div>"
      ?>
    </div>
    <input type="submit" value="add user" >
  </form>
  <?php if(!empty($state))echo $state;?>
</body>
</html>