function updateStatus() {

  leMot= JSON.parse(lesMotsJson[tour-1]);
  $('#leMot').text(leMot["nomAllemand"]);
  $('#Traduction').text('(' + leMot["nomFrancais"] + ')');
  $('#Tour').text(tour + " / " + nbtours);
  $('#Score').text(score);

  if (!aRepondu) {
    if (leMot["estIndice"]=='1') {
      let indice = "Le nom est ";
      let tableauIndice = ["masculin","féminin","neutre","féminin ou neutre","masculin ou neutre","masculin ou féminin","masculin, féminin ou neutre"];
      indice += tableauIndice[leMot["genre_idgenre"]-1];
      $('#Ligne1').html('<div class="collapse" id="collapseLigne1">' + indice +  '</div>');
      $('#btnLigne1').html('<a class="btn btn-link" data-toggle="collapse" href="#collapseLigne1" role="button" aria-expanded="false" aria-controls="collapseLigne1">Voir l\'indice</a><br>');
    };

    $("#Suivant").prop('disabled', true);
    $("#Der").prop('disabled', false);
		$("#Die").prop('disabled', false);
		$("#Das").prop('disabled', false);
  } else {
    $('#Ligne1').html(resultat);
    $("#Suivant").prop('disabled', false);
    $("#Der").prop('disabled', true);
		$("#Die").prop('disabled', true);
		$("#Das").prop('disabled', true);

    explication = leMot["reglegenre1_descrFrancais"]
    textadd = leMot["reglegenre2_descrFrancais"];
    if (textadd) explication += '<br>' + textadd;
    textadd = leMot["facteurconfusion_descrFrancais"];
    if (textadd) explication += '<br>' +  textadd;

    $('#Ligne2').html('<div class="collapse" id="collapseLigne2">' + explication + '</div>');
    $('#btnLigne2').html('<a class="btn btn-link" data-toggle="collapse" href="#collapseLigne2" role="button" aria-expanded="false" aria-controls="collapseLigne2">Explications</a><br>');
  }

};

		
$(document).ready(function() {

  updateStatus();

  $("#Suivant").click(function() {
    tour++;
    aRepondu = 0;
    resultat = "";
    $('#Ligne1').html('');
    $('#Ligne2').html('');
    $('#btnLigne1').html('');
    $('#btnLigne2').html('');
    $(".btnGenre").css('background-color', originalButtonBackground);
    $(".btnGenre").css('color', originalButtonColor);
    if (tour>nbtours) finDeListe();
    updateStatus();
  });

  $(".btnGenre").click(function() {
    aRepondu++;

    $('#Ligne1').html('');
    $('#Ligne2').html('');
    $('#btnLigne1').html('');
    $('#btnLigne2').html('');

    if (leMot["est" + $(this).attr("id")]=='1') {
      $(this).css('background-color','lightGreen');
      $(this).css('color','DarkGreen');
      bonneReponse();
    } else {
      $(this).css('background-color','red');
      $(this).css('color','black');
      mauvaiseReponse();
    };
    updateStatus();
  });
  

  
});

function bonneReponse() {
  score++;
  resultat = "Bonne réponse";
  updateMotUtilisateur(parseInt(leMot["idmotAllemand"]),"O");
}

function mauvaiseReponse() {
  resultat = "Réponse incorrecte";
  updateMotUtilisateur(parseInt(leMot["idmotAllemand"]),"N");
}

function finDeListe() {
  scorepourcent = Math.round(100*score/nbtours);
  scoreUtilisateur(listeid , scorepourcent);
  window.location.assign("http://localhost/views/message.php?titre=Bravo&message=Votre score est de " + scorepourcent + " %");
}

function updateMotUtilisateur(motid, correct ) {

      let requete = $.ajax({
          url: '../../controllers/ajax/ajax.updateMotUtilisateur.php',
          type: 'GET',
          data: 'motId=' + motid + '&Correct=' + correct,
          dataType: 'json'
      });
      
      requete.done(function(data) {
      });

      requete.fail(function(jqXHR, textStatus) {
          // Gestion de l'erreur
      });

}

function scoreUtilisateur(idliste, score1) {
  if (score > 0) {
      // On enregistre le score pour cette liste
      let requete = $.ajax({
          url: '../../controllers/ajax/ajax.scoreUtilisateur.php',
          type: 'GET',
          data: 'listeId=' + idliste + '&score=' + score1,
          dataType: 'json'
      });

      requete.done(function(data) {
      });

      requete.fail(function(jqXHR, textStatus) {
          // Gestion de l'erreur
      });
  }
}




