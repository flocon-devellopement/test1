// utilisation de l'API JQUERRY : http://code.jquery.com/jquery-2.1.0.min.js

/* METHODE .HASHCLASS 
---------------------------------------------------------------------------
Vérifie "nom de classe spécifié" des éléments sélectionnés (return true) */

// Execution du JS quand le DOM est prêt
$(document).on('ready', function() {
    let zindex = 1;

    // event au click sur div.card
    $("div.card").click(function(event){
    event.preventDefault();

    let isShowing = false;

    if ($(this).hasClass("show")){
        isShowing = true
    }
    if ($("div.cards").hasClass("showing")) {
        // a card is already in view
        $("div.card.show")
        .removeClass("show");

        if (isShowing) {
        // this card was showing - reset the grid
            $("div.cards")
            .removeClass("showing");
        } 
        else {
        // this card isn't showing - get in with it
            $(this)
            .css({zIndex: zindex})
            .addClass("show");
        }
        zindex++;

    } 
    else {
        // no cards in view
        $("div.cards")
        .addClass("showing");
        $(this)
        .css({zIndex:zindex})
        .addClass("show");

        zindex++;
    }
    });
});
