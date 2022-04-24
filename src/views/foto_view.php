<!DOCTYPE html>
<html lang="pl">
    <head>
        <link href="static/css/foto.css" rel="stylesheet" type="text/css">
		<meta charset="UTF-8"/>
        <title>
            Photography
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    </head>
    <body>
        <?php include "includes/header.inc.php"; ?>

        <div class="gallery" id="myGallery">
            <form action="cart/add" method="post">
                <h3>My gallery</h3>
                <?php foreach($gallery as $foto): ?>
                <div style="text-align: center; display: inline-block;">               
                    <a href="pokaz?id=<?=$foto['_id']?>"><img src="static/images/miniatures/<?=$foto['name']?>" alt="foto" class="big"></a><br/>
                    Tytul: <?=$foto['tytul']?><br/>
                    Autor: <?=$foto['autor']?><br/>
                    <div>
                        <input type="hidden" name="idd" value="<?= $foto['_id'] ?>"/>
                        <input type="checkbox" name="id[]" value="<?= $foto['_id'] ?>" id="<?= $foto['_id'] ?>">
                        <label for="id">Wybierz</label>
                    </div>
                </div>
                <?php endforeach ?><br/>
                <ul>
                    <?php
                        for ($i = 1; $i <= $pageMax; $i++) {
                            echo '<li style="padding: 10px;"><a href="../foto?page='.$i.'">'.$i.'</a></li>';	
                        }
                    ?>
                </ul><br/>
                <a href="../dodawanie">Dodaj zdjecie</a><br/>
                <input type="submit" name="add_to_cart" value="Do koszyka"/>
            </form>
        </div>

        <footer>
            Copyright 2020, Marharyta Karnilava, WETI, informatyka, gr nr 5
        </footer>
    </body>
</html>
