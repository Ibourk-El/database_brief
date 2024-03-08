<?php
  require "./../db.php";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_GET["dbname"])&&!empty($_GET["tbname"])){
      global $state;
      $db= new Database("root","",$_GET["dbname"]);
      $db->update($_GET["tbname"],$_POST);
      print_r($_POST);
      print_r($_GET);

      header("location:./?dbname=".$_GET["dbname"]."&&tbname=".$_GET["tbname"]);
    }
  }
?>