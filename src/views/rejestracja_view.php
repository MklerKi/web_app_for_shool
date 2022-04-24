<!DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="static/css/log.css" rel="stylesheet" type="text/css">
		<meta charset="UTF-8"/>
        <title>Rejestracja</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <style type="text/css"></style>

        <script type="text/javascript">
            $(document).ready(function(){
               $("#datepicker").datepicker({ monthNames:
                  ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień",  
                  "Wrzesień","Październik","Listopad","Grudzień"],
                  dayNamesMin: ["Pn", "Wt", "Śr", "Czw", "Pn", "Sb", "Ndz"]});
            
            });
            </script>
    
    </head>
    <body>
        <header>
            <div class="navbar">
                <a href="naczlo.php">o mnie</a>
                <a href="../foto.php">foto</a>
                <a href="narzedzie.php">narzędzie</a>
                <a href="../index.php">logowanie</a>
            </div>
        </header>

        <div class="block2">
            <form method="post">​
            
                <h2>Rejestracja</h2>

                Imie:<br/> <input  class="item" type="text" name="imie"><br/>​

                Nazwisko:<br/> <input  class="item" type="text" name="nazwisko"><br/>
                
                Data urodzenia:<br/>
                <input id="datepicker" type="text" name="dataur"/><br/>

                Email:<br/> <input class="item" type="email" name="email"><br/>​

                Login:<br/> <input class="item" type="text" name="login"><br/>

                Hasło:<br/> <input  class="item" type="password" name="haslo"><br/>

                Powtórz hasło:<br/> <input  class="item" type="password" name="phaslo"><br/>
                
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="regulamin">
                <label class="custom-control-label" for="customCheck">Akceptuję regulamin</label>
                </div>
                
                <div class="button">
                    <button onclick="myFunction()" class="knopka" name="send">​Wyślij</button><br/>
                </div>      
                <a class="item" href="index">już jeseś zarejestrowany?</a>          
            </form>
        </div>
        <footer>
            Copyright 2020, Marharyta Karnilava, WETI, informatyka, gr nr 5
        </footer>
    </body>
</html>