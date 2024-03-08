<?php
  require "./../db.php";
  if($_SERVER["REQUEST_METHOD"]=="GET"){
    if(!empty($_GET["dbname"])&&!empty($_GET["tbname"])){
      global $state;
      $db= new Database("root","",$_GET["dbname"]);
      $db->delete($_GET["tbname"],$_GET["id"]);

      print_r($_GET);

      header("location:./?dbname=".$_GET["dbname"]."&&tbname=".$_GET["tbname"]);
    }
  }
?>