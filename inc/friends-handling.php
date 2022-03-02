<?php

/*-------------------------------------*\
  ADMINISTRATION HANDLING
\*-------------------------------------*/

add_action('wp_ajax_nopriv_friends', 'friends');
add_action('wp_ajax_friends', 'friends');





$message_welcome = "<p>Beste %s,</p>
<p>Bedankt dat u ons wil steunen!</p>

<p>De donatie van %s wordt eens per jaar automatisch van uw rekening geïnd. Uitschrijven is mogelijk middels een mail aan %s.</p>

<p>Altijd op de hoogte van het laatste nieuws? Like onze pagina op Facebook (www.facebook.com/scoutingoost1) of volg ons op Instagram (www.instagram.com/scoutingoost1). Natuurlijk staat de belangrijkste informatie ook op onze website www.scoutingoost1.nl.</p>

<p>Drie tot vier keer per jaar verschijnt ons clubblad ‘Het Lopend Vuurtje’ Dit blad brengt u leuke nieuwtjes en weetjes van onze club, die krijgt u per mail toegestuurd. Wilt u adverteerder worden om dit blad mogelijk te blijven houden? Stuur dan een mail naar het bestuur.</p>

<p>Wilt u nog meer bijdragen? Via Sponsorkliks.nl kunt u gratis onze club sponsoren. Dit doet u door alle online aankopen via onze site te doen; alle grote webwinkels doen mee! Kijk op onze website hoe het werkt. Als u op een andere manier Scouting Oost 1 wilt steunen of sponsoren, dan horen wij dat natuurlijk graag.</p>

<p>Heeft u vragen, neem dan gerust contact met ons op!</p>

<p>Met vriendelijke groet,</p>

<p>%s<br>
Voorzitter Vereniging Scouting Oost 1<br>
bestuur@scoutingoost1.nl</p>";





function friends() {

  if (!empty($_POST['url'])) {
    $response = array(
      'success' => false
    );
    wp_send_json($response);
    exit();
  }

  $message = sprintf("<p>%s heeft zojuist het Vriend-worden-formulier ingevuld:</p>", $_POST['Naam']);
  $message .= "<table>";
  foreach ($_POST as $key => $value) {
    if ($key !== 'action' && $key !== 'url')
      $message .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
  }
  $message .= "</table>";

  $main_email_success = send_mail(ADMINISTRATION_EMAIL, // receiver
    "Vriendenadministratie " . $_POST['Actie'] . " " . $_POST['Naam'], // subject
    $message, // message
    "Vriendenadministratie <noreply@scoutingoost1.nl>"); // sender


  $friend = sprintf("%s <%s>", $_POST['Naam'], sanitize_email($_POST['Email']));
  $bestuur = "Scouting Oost 1 <bestuur@scoutingoost1.nl>";

  global $message_welcome;
  send_mail($friend, // receiver
    "Welkom, vriend, bij Scouting Oost 1", // subject
    sprintf($message_welcome, $_POST['Naam'], $_POST['Bedrag'], ADMINISTRATION_EMAIL, CHAIR), // message
    $bestuur); // sender

  $response = array(
    'success' => true
  );

  if (!$main_email_success) {
    $response['success'] = false;
  }

  wp_send_json($response);

}
