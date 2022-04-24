<?php

require '../../vendor/autoload.php';

use MongoDB\BSON\ObjectID;

function get_db(){
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b'
        ]);
    $db = $mongo->wai;

    return $db;
}

function get_client_by_login($login){
    $db = get_db();
    $client = $db->clients->findOne(['login' => $login]);
    return $client;
}

function dodaj_klienta($imie, $nazwisko, $dataur, $email, $login, $hash){
    try{
        $db = get_db();
        $client = [
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'dataur' => $dataur,
            'email' => $email,
            'login' => $login,
            'haslo' => $hash
        ];

        $db->clients->insertOne($client);
        return true;
    }  
    catch(Exception $e){
        echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        return false;
    }

}

function paging($page, $pageSize){
    $db = get_db();

    $opts = [
        'skip' => ($page - 1) * $pageSize,
        'limit' => $pageSize
    ];
    $gallery = $db->images->find([], $opts);

    return $gallery;
}

function max_page($pageSize){
    $db = get_db();
    $pageMax = ceil(($db->images->count()) / $pageSize);

    return $pageMax;
}

function znajdz_zdjecie_po_id($id){
    $db = get_db();
    
    $zdjecie = $db->images->findOne(['_id' => new ObjectID($id)]);

    return $zdjecie;
}

function dodaj_zdjecie_do_db($zdjecie, $image, $file_name, $name){
    $db = get_db();
    $zdj = $db->images->findOne(['name' => $zdjecie['name']]);

    if($zdj){
        $db->images->replaceOne($zdj, $image);
        move_uploaded_file($file_name, $name);
    }
    else{
        move_uploaded_file($file_name, $name);
        $db->images->insertOne($image);
    }
}