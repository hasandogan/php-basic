<?php
    function get_connection(){
        $config = require 'config.php' ;
        return  new PDO(
            $config['database_dsn'],
            $config['database_user'],
            $config['database_password']
        );
    }
    function get_pets($limit)
    {
        $pdo = get_connection();
        $result = $pdo->query('SELECT * FROM pet LIMIT'.$limit);
        $pets = $result->fetchAll();
        return $pets;
    }
        function save_pets($petsToSave)
    {
        $json = json_encode($petsToSave, JSON_PRETTY_PRINT);
        file_put_contents('data/pets.json', $json);
    }
    function get_pet($id){
         $pdo = get_connection();
        $query = 'SELECT * FROM pet WHERE id = :idVal';
        $stmt = $pdo->prepare($query);
        $stmt -> bindParam('idVal',$id);
        $stmt->execute();

        return $stmt->fetch();
    }