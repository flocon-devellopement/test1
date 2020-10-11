// utilisation de l'API JQUERRY : http://code.jquery.com/jquery-2.1.0.min.js

/* METHODE .ON 
-----------------------------------------------------------------------------
Attache des gestionnaires d'événements à un ensemble d'élément sélectionné */

/* METHODE .CLOSEST 
------------------------------------------------------------------
Renvoie le premier ancêtre de l'élément sélectionné dans le DOM */

/* METHODE .FIND
--------------------------------------------------------------
Retourne les éléments descendants de l'élément sélectionné. */

/* METHODE .DATA
-------------------------------------------------------------------
Accéde aux données de l'élément et renvoie la valeur de consigne */

/* METHODE .HTML
----------------------------------------------------------------------
Définit / Retourne le contenu (innerHTML) de l'élément sélectionné. */

/* METHODE .APENDTO
-----------------------------------------------------------
Insère le contenu à l'interieur de l'élément sélectionné */

/* METHODE .SLIDUP
------------------------------------------------------------
Masquer et afficher un éléments (mouvement de glissement) */

/* METHODE .TOFIXED
------------------------------------------------------
Converti un nombre en chaîne. Arrondi à 2 décimales */

/* METHODE .EACH
-----------------------------------------------
Traverse les objets et les tableaux indiqués */

/* METHODE .CHILDREN
---------------------------------------------------------------------------------
Obtien les enfants de chaque élément de l'ensemble des éléments correspondants */

/* METHODE .SILBLINGS
--------------------------------
Sélection de l'élément voisin */

// Execution du JS quand le DOM est prêt
$(document).on("ready",function(){
    'use strict';

  // event au click sur bouton ajouter
  $(".cards").on("click",".ajouter",function(e){

    //Arrèt des actions par défaut du navigateur
    e.preventDefault();
    
    // Stocker la section, le produit, le prix
    let $article = $(this).closest(".cards");
    let title = $article.find(".titleJs").html();
    let price = $article.data("price");
    
    // Stock et génére une balise pour afficher le prix
    let $li = $('<li data-price="'+price+'"></li>');
    
    // Affichage des li dans balise ul (Prix et produit)
    $li.html(title+" - "+price+" € ").appendTo($("#basket>ul"));
    
    // Exectution de la fonction : calcul du total
    computePrice();
  });

  // event au click : Supression du produit
  $("#basket").on("click","li",function(){

    // Stock et Cible l'élément séléctionné
    let $this = $(this);

    // Ajoute de la class removing
    $this.addClass("removing").slideUp(function(){
    
      // Supression de la class
      $this.remove();
      // Calcul du total panier
      computePrice();    
    });
  });
  
  // event au click : Panier total  
  $(".paiement").on("click", function(){
    let price = $(this).data("total");
    if (price == undefined){
      price=0.00;
    }
    // Message d'alert (ici ouvrir modue de paiement)
    alert("Votre commande est de "+price.toFixed(2)+"€");
  });
  
  // Fonction : calcul du total
  function computePrice(){
    let totalPrice = 0;

    // On parcourt le tableau et on addition le total du panier
    $("#basket li").each(function(key,val){
      let $product = $(val)
      totalPrice += $product.data("price");
    });
    // selection du total       
    $("#payer").data("total",totalPrice).children(".total").html(totalPrice.toFixed(2)+"€");
  };

  

  // event au click : toggle sur le titre
  $("#toggle").on("click",function(){
    $(this).siblings("[data-food="+$(this).data("food")+"]").slideToggle("slow");
  });

});













