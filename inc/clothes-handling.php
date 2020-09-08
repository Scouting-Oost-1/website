<?php

/*-------------------------------------*\
  CLOTHES HANDLING
\*-------------------------------------*/

add_action('wp_ajax_nopriv_clothes', 'clothes');
add_action('wp_ajax_clothes', 'clothes');





function clothes() {

  if (!empty($_POST['url'])) {
    $response = array(
      'success' => false
    );
    wp_send_json($response);
    exit();
  }

  $requesting_party = sprintf("%s <%s>", $_POST['Ouder'], sanitize_email($_POST['Email']));
  $clothes = sprintf("Kleding - Scouting Oost 1 <%s>", CLOTHES_EMAIL);

  $message = sprintf("<p>%s heeft zojuist het Kledingaanschaf-formulier ingevuld:</p>", $_POST['Ouder']);
  $message .= "<table>";
  foreach ($_POST as $key => $value) {
    if ($key !== 'action' && $key !== 'url')
      $message .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
  }
  $message .= "</table>";

  $main_email_success = send_mail(CLOTHES_EMAIL, // receiver
    "Kleding voor " . $_POST['Naam'], // subject
    $message, // message
    $requesting_party); // sender

  $message = "<p>Hierbij de bevestiging van de kledingaanschaf-aanvraag zoals die ook naar ons is gestuurd. We streven ernaar u binnen vijf werkdagen een reactie te sturen.</p>" . $message;
  send_mail($requesting_party, // receiver
    "Kledingaanschaf Scouting Oost 1", // subject
    $message, // message
    $clothes); // sender

  $response = array(
    'success' => true
  );

  if (!$main_email_success) {
    $response['success'] = false;
  }

  wp_send_json($response);

}
