<?php

/*-------------------------------------*\
  RENTAL FORM
\*-------------------------------------*/

function rental_form_view() {

  $action_url = get_template_directory_uri() . 'inc/rental-handling.php';

  ob_start();
  ?>

  <form class="rental" method="post" name="rental"
    action="<?php echo $action_url; ?>">

    <input type="hidden" name="action" value="rental">

    <fieldset class="start one-day multi-day">

      <label class="text-label">Gelegenheid
        <input type="text" name="Gelegenheid" id="occasion" placeholder="Weekend Scouting Lutjebroek" required>
      </label>

      <legend>Waar wilt u het gebouw voor huren?</legend>

      <div class="options">
        <label class="options__opt">
          <input type="radio" name="Soort verhuur" value="Evenement" required>
          Evenement (ééndaags)
        </label>
        <label class="options__opt">
          <input type="radio" name="Soort verhuur" value="Overnachting" required>
          Overnachting (meerdaags)
        </label>
      </div>

      <button class="button js-choose-rental-type" type="button">Volgende</button>

    </fieldset>



    <fieldset class="one-day">

      <legend>Over het evenement</legend>

      <label class="text-label">Datum
        <input type="date" name="Datum" id="date" placeholder="1-1-2020" required>
      </label>

      <div class="options">
        <label class="options__opt">
          <input type="radio" name="Tijdslot" value="13:00 - 01:00" required>
          Hele dag (13:00 - 01:00)
        </label>
        <label class="options__opt">
          <input type="radio" name="Tijdslot" value="13:00 - 18:00" required>
          Alleen overdag (13:00 - 18:00)
        </label>
        <label class="options__opt">
          <input type="radio" name="Tijdslot" value="17:00 - 01:00" required>
          Alleen avond (17:00 - 01:00)
        </label>
        <label class="options__opt">
          <input type="radio" name="Tijdslot" value="20:00 - 01:00" required>
          Late avond (20:00 - 01:00)
        </label>
      </div>

      <label class="text-label">Aantal personen
        <input type="number" name="Aantal personen" id="participants" placeholder="30"
          min="1" required>
      </label>

      <button class="button js-next" type="button">Volgende</button>

    </fieldset>



    <fieldset class="multi-day">

      <legend>Over de overnachting</legend>

      <label class="text-label">Datum aankomst
        <input type="date" name="Datum aankomst" id="date-arrival" placeholder="1-1-2020" required>
      </label>

      <label class="text-label">Tijd aankomst
        <input type="time" name="Tijd aankomst" id="time-arrival" placeholder="13:00" required>
      </label>

      <label class="text-label">Datum vertrek
        <input type="date" name="Datum vertrek" id="date-departure" placeholder="2-1-2020" required>
      </label>

      <label class="text-label">Tijd vertrek
        <input type="time" name="Tijd vertrek" id="time-departure" placeholder="10:00" required>
      </label>

      <label class="text-label">Aantal personen
        <input type="number" name="Aantal personen" id="participants" placeholder="30"
          min="1" required>
      </label>

      <button class="button js-next" type="button">Volgende</button>

    </fieldset>



    <fieldset class="one-day multi-day">

      <legend>Wat zijn uw contactgegevens?</legend>

      <label class="text-label">Naam
        <input type="text" name="Naam" placeholder="Puk Janssen" required>
      </label>
      <label class="text-label">Emailadres
        <input type="email" name="Email" placeholder="sam@scoutingoost1.nl" required>
      </label>
      <label class="text-label">Telefoonnummer
        <input type="tel" name="Telefoonnummer" placeholder="020 1234567" required
          pattern="^((\+|00(\s|\s?-\s?)?)31(\s|\s?-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$">
      </label>

      <button class="button js-next" type="button">Volgende</button>

    </fieldset>



    <fieldset class="one-day multi-day">

      <legend>Overzicht en opmerkingen</legend>

      <div class="form-overview"></div>

      <label class="text-label">Opmerkingen
        <textarea name="Opmerkingen" cols="40" rows="10"></textarea>
      </label>

      <p class="no-display">Vul hier niks in <input type="text" name="url"></p>

      <button type="submit" name="submit" class="button">Versturen</button>

    </fieldset>

  </form>

  <?php return ob_get_clean();
}
add_shortcode( 'rental_form', 'rental_form_view' );
?>
