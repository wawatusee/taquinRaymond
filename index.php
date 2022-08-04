<?php 
//Rapatrier les infos nécessaires, ex: $dirImages,$sizeTaquin
require_once "config.php";
//Import du fichier json source
$jsonImageTaquin=json_decode(file_get_contents("js/image-taquin.json"));
//Récupération du nom de l'image source
$nomImage=$jsonImageTaquin->image_taquin;
$urlImage=$dirImages.$nomImage;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="zoombox/jquery.js"></script>
    <script type="text/javascript" src="zoombox/zoombox.js"></script> 
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/taquin.css">
    <link href="zoombox/zoombox.css" rel="stylesheet" type="text/css" media="screen" />
    <title>Taquin</title>
    <?php
    //Valeurs pour ratio image dans la balise style
    //Ratio est utilisé pour le positionnement de l'image de fond de chaque pièce et pour la taille du taquin
    $dimensionsImage=getimagesize($urlImage);
            $largeurImage=$dimensionsImage[0];
            $hauteurImage=$dimensionsImage[1];
            $ratioImage=$hauteurImage/$largeurImage;
    ?>
    <!--Déclaration de la variable qui sera employée pour l'arrière plan de chaque pièce. Attention au slash ajouté avant le nom du dossier-->
   <!--Utilisé pour le style de class piece dans taquin.css pour le background--> 
   <style>:root{--image-taquin:url('<?php echo "../".$urlImage ?>');
                --totalLargeur:<?php echo $sizeTaquin?>;
                --ratioImage:<?php echo $ratioImage ?>;
                --nombrePiecesLigne:3;
            }
    </style>
</head>
<body onload="taquin()">
    <div class="c1">
        <header>
            <h1><?php echo $titrePage ?><a href="admin.php" target="_self" rel="noopener noreferrer"><img src="css/images/engrenages.png" alt="Gestion taquin"></a></h1>
        </header>
        <section id="scene">
            <div class="taquin">
                <div class="piece"></div>
                <div class="piece"></div>
                <div class="piece"></div>       
                <div class="piece"></div>             
                <div class="piece"></div>             
                <div class="piece"></div>             
                <div class="piece"></div>             
                <div class="piece"></div>                                             
                <div id="pieceInvisible" class="piece"></div>
            </div>
        </section>
        <footer>
            <section id="planDeSite">
                <div class="debug">
                     <fieldset>
                        <legend>Debug</legend>
                        <button><a href="images/<?php echo $nomImage; ?>" rel="zoombox[galerie]">?</a></button>
                        <button id="numeroButton"><a  href="#" onclick=displayPiecesNumber();>1</a></button>
                     </fieldset>
                </div>
            </section>
        </footer>
    </div>
    <script type="text/javascript" src="js/taquin.js"></script>
</body>
</html>