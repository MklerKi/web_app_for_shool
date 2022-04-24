<!DOCTYPE html>
<html lang="pl">
    <head>
        <link href="static/css/foto.css" rel="stylesheet" type="text/css">
		<meta charset="UTF-8"/>
        <title>
            Zdjecie
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
    </head>
    <body>
        <?php include "includes/header.inc.php"; ?>

        <img src="static/images/watermark/<?=$zdjecie['name']?>" alt="foto">

        <form method="post" class="wide">
            <input type="hidden" name="id" value="<?= $id ?>"/>

            <div>
                <a href="foto" class="cancel">&laquo; Wróć</a>
            </div>
        </form>
    </body>
</html>