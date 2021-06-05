<?php

class db
{

    private static function conn()
    {
        
            $pdo = new PDO('mysql:host=localhost;dbname=foods_api', 'root', '');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        
    }
    public static function select($query,$value = array()){
        $req = self::conn()->prepare($query);
        $req->execute($value);
        if($req->rowCount()>0){
            return $req->fetchAll(PDO::FETCH_ASSOC); 
        }else{
            return null;
        }
    }
    public static function query($query,$value=array()){
        try{

            $req = self::conn()->prepare($query);
            $req->execute($value);
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
}
