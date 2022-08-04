<?php
$url="images/min";
$supprOk=false;
if(isset($_POST["chooseToDelete"])){
    echo "Fichier à détruire :";
    $fileToDelete=$_POST["chooseToDelete"];
    var_dump($_POST["chooseToDelete"]);
}elseif(isset($_POST["fileToDelete"])){
    $fileToDelete=$_POST["fileToDelete"];
    echo "Fichier à détruire :";
    var_dump($fileToDelete);
    destroyImages($fileToDelete);
    $supprOk=true;
}
function destroyImages($fileName){
    unlink("images/min/".$fileName);
    unlink("images/".$fileName);
    $supprOk=true;
}
function viewImage(){

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
    <title>Destruction fichier</title>
</head>
<body>
<header>
    <h1>Page administration</h1><a href="index.php" target="_self" rel="noopener noreferrer">Retour Page publique</a>
    </header>
    <article>
        <h2>Supprimer fichier</h2>
        <?php if(!$supprOk): ?>
        <section class="gallery">
            <figure class="min">
                <img src="images/min/<?php echo $fileToDelete; ?>" title="Image à supprimer"/>
                <figcaption>
                    <div class="titleFigcaption">Fichier à supprimer :</div>
                    <div></div><?php echo $fileToDelete; ?>
                    </div>
                </figcaption>
            </figure>
        </section>
    <!--Formulaire de validation de nouvelle image-->
        <form action="" method="POST">
                <fieldset>
                <legend>Voulez vous vraiment supprimer?</legend>
                <textarea name="fileToDelete" id="" ><?php echo $fileToDelete ?></textarea>
                <button type="submit">Détruire</button>
            </fieldset>
        </form>
        <?php endif;?>

    </article>
    <fieldset><legend>README</legend>
        <p>Interface delete
            <H2>Done :</H2>
            <ul>
                <li>passer fichier à détruire via post</li>
            </ul> , 
            <h2>ToDo :</h2>
            <ul>
                <li>Design</li>
                <li>Création de TESTS avant delete</li>
            </ul>
        </p>
    </fieldset>
</body>
</html>

