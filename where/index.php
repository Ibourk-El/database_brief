<?php
  require "./../db.php";
  $state="";
  $all_data=[];
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["dbname"])&&!empty($_POST["tbname"])&&!empty($_POST["key"])&&!empty($_POST["value"])){
      global $state;
      global $all_data;
      $db= new Database("root","",$_POST["dbname"]);
      $all_data=$db->select_where($_POST["tbname"],$_POST["key"],$_POST["value"]);
      
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
    <hr>
      <select name="key" id="key">
        <option value="">select the key</option>
        <option value="id">id</option>
        <option value="fname">First Name</option>
        <option value="lname">Last Name</option>
      </select>
      <label style="color:white" for=""> enter the value of the key</label>
      <input type="text" name="value">
    <hr>
    <table>
      <?php if(!empty($all_data)){?>
        
      <tr><th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Email</th></tr>
    <?php
      for($i=0;$i<count($all_data);$i++){
        echo "<tr> <th>".$all_data[$i]["id"]."</th> <th>".$all_data[$i]["fname"]."</th> <th>".$all_data[$i]["lname"]."</th> <th>".$all_data[$i]["email"]."</th></tr>";
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