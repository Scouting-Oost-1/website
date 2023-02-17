<?php

/*-------------------------------------*\
  PIONIERS FORM
\*-------------------------------------*/

$action_url = get_template_directory_uri() . 'inc/pioniers-handling.php';

?>

<form class="administration" method="post"
  name="<?php echo $ad_form; ?>-administration"
  action="<?php echo $action_url; ?>">

  <input type="hidden" name="action" value="<?php echo $ad_form; ?>">

  <fieldset class="start">

    <legend>Wat wil je doneren?</legend>

    <div class="options">
      <p class="options__label">Bedrag jaarlijkse donatie</p>
      <label class="options__opt">
        <input type="radio" name="Bedrag" value="Platte knoop: €10" required class="identifying">
        Platte knoop: €10 per jaar
      </label>
      <label class="options__opt">
        <input type="radio" name="Bedrag" value="Mastworp: €25" required class="identifying">
        Mastworp: €25 per jaar
      </label>
      <label class="options__opt">
        <input type="radio" name="Bedrag" value="Timmersteek: €50" required class="identifying">
        Timmersteek: €50 per jaar
      </label>
      <label class="options__opt">
        <input type="radio" name="Bedrag" value="Paalsteek: €100" required class="identifying">
        Paalsteek: €100 per jaar
      </label>
    </div>

    <label class="text-label">IBAN
      <input type="text" name="IBAN" placeholder="NL98 ABCD 1234567890" required>
    </label>
    <label class="text-label">Ter name van
      <input type="text" name="tnv" placeholder="P. M. Janssen" required>
    </label>

    <div class="terms">
      <p><strong>SEPA machtigingsformulier standaard Europese incasso – Doorlopende machtiging</strong></p>
      <p>U geeft toestemming aan Scouting Oost 1 om doorlopende incasso-opdrachten te sturen naar uw bank om een bedrag van uw rekening af te schrijven en aan uw bank om doorlopend een bedrag van uw rekening af te schrijven overeenkomstig de opdracht van Scouting Oost 1.</p>
      <p>Als u het niet eens bent met deze afschrijving kunt u deze laten terugboeken. Neem hiervoor binnen 8 weken na afschrijving contact op met uw bank. Vraag uw bank naar de voorwaarden.</p>
    </div>
    <label class="term-check">
      <input type="checkbox" name="SEPA Doorlopende machtiging" value="Akkoord" id="sepa" required>
      Ik ga akkoord met deze machtiging
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset>

    <legend>Wie ben je?</legend>

    <label class="text-label">Naam
      <input type="text" name="Naam" id="name" placeholder="Sam Janssen" required class="identifying">
    </label>

    <label class="text-label">Geboortedatum
      <input type="date" name="Geboortedatum" id="dob" placeholder="1-1-2000" required class="identifying">
    </label>

    <div class="options options--inlined">
      <p class="options__label">Geslacht</p>
      <label class="options__opt options__opt--inline">
        <input type="radio" name="Geslacht" value="Man" required class="identifying">
        Man
      </label>
      <label class="options__opt options__opt--inline">
        <input type="radio" name="Geslacht" value="Vrouw" required class="identifying">
        Vrouw
      </label>
      <p class="field-info">Helaas moet in de administratie van Scouting Nederland gekozen worden uit deze twee opties voor het geslacht.</p>
    </div>

    <label class="text-label">Emailadres
      <input type="email" name="Email" placeholder="sam@scoutingoost1.nl" required class="identifying">
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset>

    <legend>Verdere contactgegevens</legend>

    <label class="text-label">Postcode
      <input type="text" name="Postcode" placeholder="1234AA" required
        pattern="[0-9]{4}(\s?)[A-Za-z]{2}">
    </label>
    <label class="text-label">Huisnummer
      <input type="text" name="Huisnummer" placeholder="123" required>
    </label>
    <label class="text-label readonly">Straatnaam
      <input type="text" name="Straat">
    </label>
    <label class="text-label readonly">Stad
      <input type="text" name="Stad">
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset class="non-changing">

    <legend>Privacy & reglement</legend>

    <?php $privacy_link = get_permalink(
      get_page_by_path( 'privacy' ) ); ?>
    <div class="terms">
      <p>Wij verwerken persoonsgegevens om de donatie te innen en contact te hebben met onze Pioniers. In ons <a href="<?php echo $privacy_link; ?>">privacybeleid</a> is te hoe we hierbij te werk gaan.</p>
    </div>
    <label class="term-check">
      <input type="checkbox" name="Privacy-voorwaarden" value="Akkoord" required>
      Ik ga akkoord met het <a href="<?php echo $privacy_link; ?>">privacybeleid</a>
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset class="act-delete">

    <legend>Overzicht en opmerkingen</legend>

    <div class="form-overview"></div>

    <label class="text-label">Opmerkingen
      <textarea name="Opmerkingen" cols="40" rows="10"></textarea>
    </label>

    <p class="no-display">Vul hier niks in <input type="text" name="url" aria-label="Laat leeg"></p>

    <button type="submit" name="submit" class="button">Versturen</button>

  </fieldset>

</form>
