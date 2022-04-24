<!DOCTYPE html>
<html lang="pl">
    <head>
        <link href="static/css/foto.css" rel="stylesheet" type="text/css">
		<meta charset="UTF-8"/>
        <title>
            Photography
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </head>
    <body>
        <?php include "includes/header.inc.php"; ?>
        <div class="dodaj">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="zdjecie"/><br/>
                Watermark:<br/><input type="text" name="mark"/><br/>
                Tytul:<br/><input type="text" name="tytul"/><br/>
                Autor:<br/><input type="text" name="autor"/><br/>
                <input type="submit" id="submit" value="Wyslij" name="send"/>
            </form>
           
        </div>
        <footer>
            Copyright 2020, Marharyta Karnilava, WETI, informatyka, gr nr 5
        </footer>
    </body>
</html>
