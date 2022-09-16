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

  $human_table = "<table>";
  foreach ($_POST as $key => $value) {
    if ($key !== 'action' && $key !== 'url')
      $human_table .= sprintf("<tr><td>%s</td><td>%s</td></tr>", $key, $value);
  }
  $human_table .= "</table>";

  $sheets_table .= "<table><tr>";
  foreach ($_POST as $key => $value) {
    if ($key !== 'action' && $key !== 'url')
      $sheets_table .= sprintf("<td>%s</td>", $value);
  }
  $sheets_table .= "</tr></table>";

  $main_intro = "<p>Hey topper,</p>";
  $requesting_intro = "<p>Hierbij de kopie van de kleding-bestelling. We proberen binnen vijf werkdagen te reageren.</p>" . $message;
  $requesting_footer .= "<p>Bij het ophalen van de kleding kunt u betalen met pin.</p>";

  $base_message = "%s<p>%s heeft zojuist het kleding-bestel-formulier ingevuld:</p>%s%s";
  $main_message = sprintf($base_message, $main_intro, $_POST['Ouder'], $human_table, $sheets_table);
  $requesting_message = sprintf($base_message, $requesting_intro, $_POST['Ouder'], $human_table, $requesting_footer);

  $main_email_success = send_mail(CLOTHES_EMAIL, // receiver
    "Kleding voor " . $_POST['Naam'], // subject
    $main_message, // message
    $requesting_party); // sender

  send_mail($requesting_party, // receiver
    "Kledingaanschaf Scouting Oost 1", // subject
    $requesting_message, // message
    $clothes); // sender

  $response = array(
    'success' => true
  );

  if (!$main_email_success) {
    $response['success'] = false;
  }

  wp_send_json($response);

}
