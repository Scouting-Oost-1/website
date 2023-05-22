<?php

/*-------------------------------------*\
  ADMINISTRATION HANDLING
\*-------------------------------------*/

add_action('wp_ajax_nopriv_members', 'members');
add_action('wp_ajax_members', 'members');





$message_welcome = "<p>Beste ouders/verzorgers,</p>
<p>Welkom bij Scouting Oost 1! Uw kind is meteen welkom bij de eerstvolgende opkomsten, behalve bij de Kabouters en Welpen, daar hebben we een wachtrij. De contributie wordt vanaf de volgende maand geïnd. In deze mail vindt u praktische informatie die handig kan zijn.</p>
<p>Bij noodgevallen, contact met het bestuur of andere dringende zaken kunt u bellen met:<br>
%s
Mailen kan ook naar: bestuur@scoutingoost1.nl</p>

<p>Altijd op de hoogte van het laatste nieuws? Like onze pagina op Facebook (www.facebook.com/scoutingoost1) of volg ons op Instagram (www.instagram.com/scoutingoost1). Natuurlijk staat de belangrijkste informatie ook op onze website www.scoutingoost1.nl.</p>

<p>Drie tot vier keer per jaar verschijnt ons clubblad ‘Het Lopend Vuurtje’ Dit blad brengt u leuke nieuwtjes en weetjes van onze club. Wilt u adverteerder worden om dit blad mogelijk te blijven houden? Stuur dan een mail naar het bestuur.</p>

<p>Via <a href='https://www.sponsorkliks.com/products/shops.php?club=5886&nbta=20160701&cn=NL&ln=nl'>Sponsorkliks.nl</a> kunt u gratis onze club sponsoren. Dit doet u door alle online aankopen via onze site te doen; alle grote webwinkels doen mee! Daarnaast kunt u ook <a href='https://scoutingoost1.nl/pionier-worden/'>Pionier worden</a> en jaarlijks een bedrag doneren. Als u op een andere manier Scouting Oost 1 wilt steunen of sponsoren, dan horen wij dat natuurlijk graag.</p>

<p>Contributie:<br>
De contributie wordt eens per maand automatisch van uw rekening geïnd. Als de contributie niet kan worden afgeschreven worden er administratiekosten in rekening gebracht. Uitschrijven is alleen mogelijk via onze website. De uitschrijving gaat op de eerste van de daarop volgende maand van kracht.<br>
Als er geen contributie wordt geïncasseerd heeft dit gevolgen voor het lidmaatschap en deelname aan het zomerkamp. Lukt het niet met betalen? Dan kan je een aanvraag doen bij het <a href='https://scoutingoost1.nl/ledenadministratie/jeugdfonds/'>Jeugdfonds Sport Amsterdam</a>.</p>

<p>Ten slotte proberen we een veilige omgeving voor iedereen te creeëren. Als dit niet zo is kunt u altijd contact opnemen met het bestuur, maar er zijn ook twee <a href='https://scoutingoost1.nl/commissies-en-functies/'>vertrouwenspersonen</a> beschikbaar waar iedereen altijd terecht kan.</p>

<p>Heeft u vragen over de contributie of over andere praktische zaken, neem dan gerust contact met ons op!</p>

<p>Met vriendelijke groet,</p>

<p>%s<br>
Voorzitter Vereniging Scouting Oost 1<br>
bestuur@scoutingoost1.nl</p>";

$message_leave = "<p>Beste ouders/verzorgers,</p>
<p>Tot ziens bij Scouting Oost 1. De afmelding is per de 1e van de volgende maand van kracht. Deze maand wordt er dus voor de laatste maand contributie geïnd.</p>
<p>Heeft u vragen over de contributie of over andere praktische zaken, of wilt u ons nog iets meegeven? Neem dan gerust contact met ons op!</p>
<p>Ten slotte: willen jullie nog een beetje verbonden blijven met Scouting? Jullie kunnen ons altijd blijven <a href='https://scoutingoost1.nl/steunen/'>steunen</a>, bijvoorbeeld door pionier te worden vanaf 10 euro per maand. Zo maak je scouting ook mogelijk voor de volgende generatie!</p>
<p>Met vriendelijke groet,</p>
<p>%s<br>
Voorzitter Vereniging Scouting Oost 1<br>
bestuur@scoutingoost1.nl</p>";





function members() {

  if (!empty($_POST['url'])) {
    $response = array(
      'success' => false
    );
    wp_send_json($response);
    exit();
  }

  $message = sprintf("<p>%s heeft zojuist het Ledenadministratie-formulier ingevuld:</p>", $_POST['Ouder']);
  $message .= "<table>";
  foreach ($_POST as $key => $value) {
    if ($key !== 'action' && $key !== 'url')
      $message .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
  }
  $message .= "</table>";

  $main_email_success = send_mail(ADMINISTRATION_EMAIL, // receiver
    "Ledenadministratie " . $_POST['Actie'] . " " . $_POST['Naam'], // subject
    $message, // message
    "Ledenadministratie <noreply@scoutingoost1.nl>"); // sender


  $parent = sprintf("%s <%s>", $_POST['Ouder'], sanitize_email($_POST['Email']));
  $bestuur = "Scouting Oost 1 <bestuur@scoutingoost1.nl>";

  if ($_POST['Actie'] === 'Aanmelden') {
    global $message_welcome;
    send_mail($parent, // receiver
      "Welkom bij Scouting Oost 1", // subject
      sprintf($message_welcome, EMERGENCY_CONTACT, CHAIR), // message
      $bestuur); // sender
  }

  if ($_POST['Actie'] === 'Wijzigen') {
    $message = "<p>Hierbij de bevestiging van de wijziging zoals die ook naar ons is gestuurd.</p>" . $message;
    send_mail($parent, // receiver
      "Wijziging gegevens Scouting Oost 1", // subject
      $message, // message
      $bestuur); // sender
  }

  if ($_POST['Actie'] === 'Afmelden') {
    global $message_leave;
    send_mail($parent, // receiver
      "Tot ziens bij Scouting Oost 1", // subject
      sprintf($message_leave, CHAIR), // message
      $bestuur); // sender
  }

  $response = array(
    'success' => true
  );

  if (!$main_email_success) {
    $response['success'] = false;
  }

  wp_send_json($response);

}
