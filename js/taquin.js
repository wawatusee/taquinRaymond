function taquin() {
    let ratioImage=getComputedStyle(document.documentElement).getPropertyValue('--ratioImage');
    /*Sélection de toutes les div identifiées pièces, dans un tableau "lesPieces", on range leurs réfèrences*/
    var lesPieces = document.getElementsByClassName("piece");
    /*Find the invisible piece:*/
    pieceInvisible = document.querySelector("#pieceInvisible");
    /*Get his style :*/
    stylePieceInvisible = getComputedStyle(pieceInvisible);
    /*Create an Array of an playable order of pieces */
    var shuffleArray=[ 2, 6, 5, 8, 3, 9, 4, 7, 1 ];
    /*Loop on taquin's pieces*/
    for (var i = 0; i < lesPieces.length; i++) {
        let largeurPiece=133;
        let hauteurPiece=largeurPiece*ratioImage;
        var chaquePiece = lesPieces[i];
        /*Background image position for each piece*/
        chaquePiece.style.backgroundPositionX=`${-(i%3)*largeurPiece}px`;
        console.log(chaquePiece.style.backgroundPositionX);
        chaquePiece.style.backgroundPositionY=`${-Math.floor(i/3)*hauteurPiece}px`;
        /*Background is ok for each piece */
        chaquePiece.style.order =shuffleArray[i];
        /*Listenner on each piece */
        chaquePiece.addEventListener("click", joue);
    };
};
function joue(evt) {
    //Get the style of the clicked piece
    var sonStyle = getComputedStyle(evt.target);
    //Check if this piece is cliquable
    if (pieceCliquable(stylePieceInvisible.order, sonStyle.order)) {
        //If true, the order of the invisible piece become the order of the clicked piece
        let temporaryOrder = pieceInvisible.style.order;
        pieceInvisible.style.order = sonStyle.order;
        evt.target.style.order = temporaryOrder;
        console.log('La pièce invisible qui est en position ' + stylePieceInvisible.order + ' prend la position de la piece cliquée ' + sonStyle.order);
        console.log("Index de pièce cliquée"+aGetPiecesOrder().indexOf(Number(temporaryOrder)));
    } 
   if( testIssue()){
    //Test issue tell if the taquin is in order
    //If thats true end of the gagme.
        endOfGame();
   };
};
function pieceCliquable(pieceInvisible, pieceAtester, largueurTaquin = 3) {
    pieceInvisible = Number(pieceInvisible);
    pieceAtester = Number(pieceAtester);
    //Cliquable est définit comme true quand l'ordre de la piece testée est égale à l'ordre de la pièce invisible,-1 ou +1 ou -4 ou +4 sauf quand le reste de la division de l'orde de la piece invisible par la largeur du taquin est égal à 1 ou à 0
    var jouable = (pieceAtester == (pieceInvisible - 1) && (pieceInvisible % largueurTaquin != 1)) // Vérifie si déplaçable vers la gauche
        ||
        (pieceAtester == (pieceInvisible + 1) && (pieceInvisible % largueurTaquin != 0)) // Vérifie si déplaçable vers la droite
        ||
        (pieceAtester == (pieceInvisible + largueurTaquin)) // Vérifie si déplaçable vers le bas
        ||
        (pieceAtester == (pieceInvisible - largueurTaquin)); // Vérifie si déplaçable vers le haut
    return jouable;
}

function aGetPiecesOrder() {
    //Tidy the flex order of taquin's pieces in an array. Return this array
    var lesPieces = document.getElementsByClassName("piece");
    let orderArray=[];
    stylePieceInvisible = getComputedStyle(pieceInvisible);
    for (var i = 0; i < lesPieces.length; i++) {
        var chaquePiece = lesPieces[i];
        var sonStyle = getComputedStyle(chaquePiece);
        var sonOrdre=Number(sonStyle.order);
        orderArray.push(sonOrdre);
    };
    return orderArray
};

function testIssue(){
    let nbrPiecesOrdonnees=0;
    var lesPieces = document.getElementsByClassName("piece");
    let nbrPieces= lesPieces.length;
    for(var i=0; i<nbrPieces;i++){
        var chaquePiece=lesPieces[i];
        var sonStyle=getComputedStyle(chaquePiece);
        if(sonStyle.order==i+1){
            nbrPiecesOrdonnees+=1;
        }
        if(nbrPiecesOrdonnees>7){
            return true;
        }
    }   
}
var displayedNumero=false;
function displayPiecesNumber(){
    var pieces=document.getElementsByClassName("piece");
    if(displayedNumero===false){
        for (i=0; i<pieces.length; i++){
            var piece=pieces[i]
            //Display the number of the piece
            piece.textContent=i+1;
        }
        displayedNumero=true;
    }else{
        for (i=0; i<pieces.length; i++){
            var piece=pieces[i]
            piece.textContent=" ";
        }
        displayedNumero=false;
    }
}
function endOfGame(){
    var lesPieces = document.getElementsByClassName("piece");
    /*The invisible piece is not any more*/
    document.getElementById("pieceInvisible").style.visibility ="visible";
        /*Boucle sur les  */
        for (var i = 0; i < lesPieces.length; i++) {
            /*Kill Listenner on each piece */
            var chaquePiece = lesPieces[i];
            chaquePiece.removeEventListener("click", joue);
        };
}