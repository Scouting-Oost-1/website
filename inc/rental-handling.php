<?php

/*-------------------------------------*\
  ADMINISTRATION HANDLING
\*-------------------------------------*/

add_action('wp_ajax_nopriv_rental', 'rental');
add_action('wp_ajax_rental', 'rental');





function rental() {

  if (!empty($_POST['url'])) {
    $response = array(
      'success' => false
    );
    wp_send_json($response);
    exit();
  }

  $requesting_party = sprintf("%s <%s>", $_POST['Naam'], sanitize_email($_POST['Email']));
  $rental = sprintf("Verhuur - Scouting Oost 1 <%s>", RENTAL_EMAIL);

  $message = sprintf("<p>%s heeft zojuist het Verhuuraanvraag-formulier ingevuld:</p>", $_POST['Naam']);
  $message .= "<table>";
  foreach ($_POST as $key => $value) {
    if ($key === 'Datum' ||
        $key === 'Datum_aankomst' ||
        $key === 'Datum_vertrek') {
        $val_date_time = new DateTime($value);
        $value = $val_date_time->format('d-m-Y');
    }
    if ($key !== 'action' && $key !== 'url')
      $message .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
  }
  $message .= "</table>";

  $main_email_success = send_mail(RENTAL_EMAIL, // receiver
    "Verhuuraanvraag " . $_POST['Soort verhuur'] . " " . $_POST['Naam'], // subject
    $message, // message
    $requesting_party); // sender

  $message = "<p>Hierbij de bevestiging van de verhuuraanvraag zoals die ook naar ons is gestuurd.</p>" . $message;
  send_mail($requesting_party, // receiver
    "Verhuuraanvraag Scouting Oost 1", // subject
    $message, // message
    $rental); // sender

  if (!$main_email_success) {
    $response = array(
      'success' => false
    );
  }

  $response = array(
    'success' => true
  );

  wp_send_json($response);

}
