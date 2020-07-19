<?php
function send_mail($receiver, $subject, $message, $sender) {

  $message_top = "<!DOCTYPE html>
      <html>
       <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <title>$subject</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      </head>
      <body>";
  $message_bottom = "</body></html>";

  $message = $message_top . $message . $message_bottom;
  $message = wordwrap($message, 70);

  $headers = "From:noreply@scoutingoost1.nl\r\n";
  $headers .= 'Reply-To:'. $sender . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  return wp_mail($receiver, $subject, $message, $headers);

  return;

}
