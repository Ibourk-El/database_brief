<?php 

  class Database{
    private $user;
    private $pwd;
    private $dbname;
    private $dsn="mysql:host=localhost;";
    private $pdo;

    public function __construct($user,$pwd,$dbname="")
    {
      $this->user=$user;
      $this->pwd=$pwd;
      $this->dbname=$dbname;
    }
    public function connect(){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return "<p style='color:green;'>you are new connected with ".$this->dbname."</p>";

      }catch(PDOException $e){
        return "<p style='color:red;'>connect to ".$this->dbname ." db is fialde</p>";
      }
    }
    public function createDB(){
      try{
        $this->pdo=new PDO($this->dsn,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="CREATE DATABASE ".$this->dbname;
        $this->pdo->exec($query);
        return "<p style='color:green;'>the database ".$this->dbname." is created </p>";

      }catch(PDOException $e){
        return "<p style='color:red;'>".$this->dbname." is already exist </p>";
      }
    }

    public function createTB($tbname,$col1,$col2,$col3,$col4){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="CREATE TABLE $tbname(
          id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          $col1 VARCHAR(255) NOT NULL,
          $col2 VARCHAR(255) NOT NULL,
          $col3 VARCHAR(255) NOT NULL,
          $col4 VARCHAR(255) NOT NULL
          
        )";
        $this->pdo->exec($query);
        return "<p style='color:green;'>the $tbname  is added to ".$this->dbname."  database</p>";

      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>";
      }
    }

    public function insert($tbname,$data){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="INSERT INTO $tbname(fname,lname,email,pwd) VALUES (:fname,:lname,:email,:pwd)";
        $t=$this->pdo->prepare($query);
        foreach($data as $k=>$v){
          $t->bindValue($k,$v);
        }
        
        $t->execute();
        $last_id = $this->pdo->lastInsertId();
        return "<p style='color:green;'>the new user  is added to ".$tbname." and thi last id is $last_id </p>";

      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }

    public function select($tbname){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="SELECT * FROM $tbname ";
        $t=$this->pdo->prepare($query);
        $t->execute();
        $re=$t->fetchAll(PDO::FETCH_ASSOC);
        return $re;
      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }

    public function select_where($tbname,$k,$v){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="SELECT * FROM $tbname WHERE $k=:$k";
        $t=$this->pdo->prepare($query);
        $t->bindParam(":$k",$v);
        $t->execute();
        $re=$t->fetchAll(PDO::FETCH_ASSOC);
        return $re;
      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }

    public function order_by($tbname,$col,$or){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="SELECT * FROM $tbname ORDER BY $col $or ";
        $t=$this->pdo->prepare($query);
        $t->execute();
        $re=$t->fetchAll(PDO::FETCH_ASSOC);
        return $re;
      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }

    public function update($tbname,$data){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="UPDATE $tbname SET fname=:fname,lname=:lname,email=:email WHERE id=:id ";
        $t=$this->pdo->prepare($query);
        foreach($data as $k=>$v){
          $t->bindValue(":$k",$v);
        }
        $t->execute();
      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }

    public function delete($tbname,$id){
      try{
        $this->pdo=new PDO($this->dsn."dbname=".$this->dbname,$this->user,$this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query="DELETE FROM $tbname  WHERE id=:id ";
        $t=$this->pdo->prepare($query);
        $t->bindParam(":id",$id);
        $t->execute();
      }catch(PDOException $e){
        return "<p style='color:red;'>".$tbname." is already exist in ".$this->dbname." </p>".$e->getMessage();
      }
    }


  }

?>