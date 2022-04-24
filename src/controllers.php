<?php
require_once 'business.php';
require_once 'controller_utils.php';

function logowanie(&$model){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        if(isset($_POST['send'])){
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
        
            $client = get_client_by_login($login);
            if($client !== 0 && password_verify($haslo, $client['haslo'])){
                $_SESSION['client_id'] = $client['_id'];
                
                return 'redirect:foto';
            }
            else{
                echo 'Nieoprawne haslo!';
            }
        }
    }
    
    return 'index_view';
}

function rejestracja(&$model){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        if(isset($_POST['send'])){
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $dataur = $_POST['dataur'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
            $phaslo = $_POST['phaslo'];
            $regulamin = $_POST['regulamin'];
    
            $hash = password_hash($haslo, PASSWORD_DEFAULT);
            $log = get_client_by_login($login);

            if($log == 0){
                if(!empty($regulamin) && !empty($login) && !empty($haslo) && ($haslo === $phaslo)){
                    if(dodaj_klienta($imie, $nazwisko, $dataur, $email, $login, $hash)){
                        return 'redirect:index';
                    }
                }
                else{
                    echo "Nieprawiedlowe dane!";
                }
            }  
            else{
                echo 'Taki login jest już zajęty';
            } 
        }
    }
    
    return 'rejestracja_view';
}

function add_to_cart($gallery)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && !empty($_SESSION['client_id'])) {
        $id = $_POST['id'];
        $cart = &get_cart();
        foreach($id as $i){
            $zdjecie = znajdz_zdjecie_po_id($i);  
            $cart[$i] = ['name' => $zdjecie['name']];
        }
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
    else{
        echo 'Nalezy zalogowac sie';
        exit();
    }
}

function foto(&$model){
    if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
    } 
    else{ 
        $page = 1;
    };  
    
    if(!empty($_SESSION['client_id'])){
        echo 'Zalogowano pomyślnie ';
        echo '<a href="index" name="wyloguj">wyloguj</a>';
    }
    else{
        echo 'Nie jesteś załogowany';
        echo '<a href="index" name="zaloguj">Zaloguj</a>';
    }
    
    $pageSize = 3;
    $gallery = paging($page, $pageSize);
    $pageMax = max_page($pageSize);

    $model['gallery'] = $gallery;
    $model['pageMax'] = $pageMax;
    
    if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['wyloguj'])){
        set_cookie('PHPSESSID', "", time() - 3600);
        $_SESSION['client_id'] = "";
        session_write_close();
        return 'redirect:index';
    }
    
    return 'foto_view';
}

function pokaz(&$model){
    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        
        $zdjecie = znajdz_zdjecie_po_id($id);
        if ($zdjecie == null) {
            http_response_code(404);
            exit;
        }
        else{
            $model['zdjecie'] = $zdjecie;
            return 'pokaz_view';
        }
    }
}

function mini($name){
    list($width, $height) = getimagesize($name);
    $newwidth = 200;
    $newheight = 125;

    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($name);

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $thumb;
}

function watermark($name, $mark, $stroka){

    $source = imagecreatefromjpeg($name);
    $black = imagecolorallocate($source, 0, 0, 0);
    $font_file = $stroka.'font/arial.ttf';
    imagefttext($source, 20, 0, 11, 21, $black, $font_file, $mark);

    return $source;
}

function dodawanie(&$model){
    if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['send'])){
        $stroka = 'static/images/';
        $mark = $_POST['mark'];
        $tytul = $_POST['tytul'];
        $autor = $_POST['autor'];
        $zdjecie = $_FILES['zdjecie'];
    
        $image = [
            'name' => $zdjecie['name'],
            'type' => $zdjecie['type'],
            'tmp_name'=> $zdjecie['tmp_name'],
            'error' => $zdjecie['error'],
            'size' => $zdjecie['size'],
            'tytul' => $tytul,
            'autor' => $autor
        ];
    
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $zdjecie['tmp_name'];
        $mime_type = finfo_file($finfo, $file_name);
    
        if($zdjecie['size'] < 1000000 && ($mime_type === 'image/jpeg' || $mime_type === 'image/png')){
    
            $name = $stroka.basename($zdjecie['name']);
            
            dodaj_zdjecie_do_db($zdjecie, $image, $file_name, $name);
            
            $img = mini($name);
            imagejpeg($img, $stroka.'miniatures/'.basename($zdjecie['name']));
            $img = watermark($name, $mark, $stroka);
            imagejpeg($img, $stroka.'watermark/'.basename($zdjecie['name']));
        }
        else if($zdjecie['size'] > 1000000){
            echo 'The size is wrong<br/>';
        }
        else{
            echo 'Niepoprawny format, nalezy zalaczyc jpeg lub png<br/>';
        }
    }
    
    return 'dodawanie_view';
}

function cart(&$model)
{
    if(!empty($_SESSION['client_id'])){
        $model['cart'] = &get_cart();
        return 'partial/cart_view';
    }
    else{
        echo 'Nalezy zalogowac sie';
        exit();
    }  
}

function clear_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        foreach($id as $i){
            unset($_SESSION['cart'][$i]);
        }
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}