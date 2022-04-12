<?php 
 include_once("php/connexion.php"); 
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>connexion</title>
        <link rel="stylesheet" href="assets/css/ins.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width-device=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <div class="title" >CONNEXION</div>
            <form action="#" method="POST" autocomplete="off" >
                <div class="user-details">
                
                    <div class="input-box">
                        <span class="details"> Addresse email</span>
                        <input style="width:650px;" type="text" name="email" placeholder="Entrez votre addresse email" required>   
                    </div>

                    <div class="input-box">
                        <span class="details"> Mot de passe</span>
                        <input style="width:650px;" type="password" name="pass" placeholder="entrez votre mot de passe" required>   
                    </div>
                                       <div >
                        <input type="radio" name="gender" id="dot-1">
                        <div class="category">
                            <p align="left">      
                                En validant ce formulaire vous acceptez  <a href="">les conditions generales d'utilisations et les accords de confidentialite</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php if(isset($erreur)) {  ?><p style="background-color: red; color: white;"><?= $erreur?></p><?php } ?>
                <div class="button">
                    <input type="submit" name="form_connexion" value="connexion"><br>
                    <br><i style="margin-left: 200px;">Je ne suis pas inscris</i>
                <a href="menbre.php"> Inscription</a>
                </div>
            </form>
        </div>
        
    </body>
</html>