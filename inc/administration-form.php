<?php

/*-------------------------------------*\
  ADMINISTRATION FORM
\*-------------------------------------*/

$action_url = get_template_directory_uri() . 'inc/administration-handling.php';

?>
<script type="text/javascript">
  var pickAction = <?php echo ($_GET['Actie']) ? 'true' : 'false'; ?>;
</script>

<form class="administration" method="post"
  name="<?php echo $ad_form; ?>-administration"
  action="<?php echo $action_url; ?>">

  <input type="hidden" name="action" value="<?php echo $ad_form; ?>">

  <fieldset class="start act-delete">

    <legend>Wilt u een nieuw lid inschrijven, gegevens wijzigen of een bestaand lid uitschrijven?</legend>

    <div class="options">
      <label class="options__opt">
        <input type="radio" name="Actie" value="Aanmelden" required
        <?php if($_GET['Actie'] === 'Aanmelden') echo 'checked'; ?>>
        Lid worden
      </label>
      <label class="options__opt">
        <input type="radio" name="Actie" value="Wijzigen" required
        <?php if($_GET['Actie'] === 'Wijzigen') echo 'checked'; ?>>
        Gegevens aanpassen
      </label>
      <label class="options__opt">
        <input type="radio" name="Actie" value="Afmelden" required
        <?php if($_GET['Actie'] === 'Afmelden') echo 'checked'; ?>>
        Lidmaatschap opzeggen
      </label>
    </div>

    <button class="button js-choose-action" type="button">Volgende</button>

  </fieldset>



  <fieldset class="act-delete">

    <legend>Wie is het?</legend>

    <label class="text-label">Naam lid
      <input type="text" name="Naam" id="name" placeholder="Sam Janssen" required class="identifying">
    </label>

    <label class="text-label">Geboortedatum
      <input type="date" name="Geboortedatum" id="dob" placeholder="1-1-2000" required class="identifying">
    </label>

    <div class="options options--inlined">
      <label class="options__opt options__opt--inline">
        <input type="radio" name="Gender" value="Jongen" required class="identifying">
        Jongen
      </label>
      <label class="options__opt options__opt--inline">
        <input type="radio" name="Gender" value="Meisje" required class="identifying">
        Meisje
      </label>
      <label class="options__opt options__opt--inline">
        <input type="radio" name="Gender" value="Anders" required class="identifying">
        Anders
      </label>
    </div>

    <label class="text-label">Speltak
      <select name="Speltak" required class="identifying">
        <option value="">Om welk speltak gaat het?</option>
        <option value="Bevers">Bevers (4-7, m/v)</option>
        <option value="Kabouters">Kabouters (7-11, v)</option>
        <option value="Welpen Dinsdag">Welpen dinsdag (7-11, m)</option>
        <option value="Welpen Zaterdag">Welpen zaterdag (7-11, m)</option>
        <option value="Gidsen">Gidsen (11-15, v)</option>
        <option value="Verkenners">Verkenners (11-15, m)</option>
        <option value="Explos">Explo's (15-18, m/v)</option>
        <option value="Stam">Stam (18+, m/v)</option>
      </select>
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset class="act-delete">

    <legend>Wat zijn jouw contactgegevens?</legend>

    <label class="text-label">Naam ouder
      <input type="text" name="Ouder" placeholder="Puk Janssen" required class="identifying">
    </label>
    <label class="text-label">Emailadres
      <input type="email" name="Email" placeholder="sam@scoutingoost1.nl" required class="identifying">
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset>

    <legend>Verdere contactgegevens</legend>

    <label class="text-label">Telefoonnummer
      <input type="tel" name="Telefoonnummer" placeholder="020 1234567" required
        pattern="^((\+|00(\s|\s?-\s?)?)31(\s|\s?-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$">
    </label>
    <label class="text-label">Postcode
      <input type="text" name="Postcode" placeholder="1234AA" required
        pattern="[0-9]{4}(\s?)[A-Za-z]{2}">
    </label>
    <label class="text-label">Huisnummer
      <input type="text" name="Huisnummer" placeholder="123" required>
    </label>
    <label class="text-label readonly">Straatnaam
      <input type="text" name="Straat" required readonly>
    </label>
    <label class="text-label readonly">Stad
      <input type="text" name="Stad" required readonly>
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset>

    <legend>Contributie: SEPA machtigingsformulier standaard Europese incasso – Doorlopende machtiging</legend>

    <label class="text-label">IBAN
      <input type="text" name="IBAN" placeholder="NL98 ABCD 1234567890" required>
    </label>
    <label class="text-label">Ter name van
      <input type="text" name="tnv" placeholder="P. M. Janssen" required>
    </label>

    <div class="terms">
      <p>U geeft toestemming aan ST Scouting Oost 1 om doorlopende incasso-opdrachten te sturen naar uw bank om een bedrag van uw rekening af te schrijven en aan uw bank om doorlopend een bedrag van uw rekening af te schrijven overeenkomstig de opdracht van ST Scouting Oost 1.</p>
      <p>Als u het niet eens bent met deze afschrijving kunt u deze laten terugboeken. Neem hiervoor binnen 8 weken na afschrijving contact op met uw bank. Vraag uw bank naar de voorwaarden.</p>
      <p>Het bedrag voor de sweater, t-shirt of beide dient vooraf contant betaald te worden bij de leiding. Daarna zullen de kledingstukken geleverd worden.</p>
    </div>
    <label class="term-check">
      <input type="checkbox" name="SEPA Doorlopende machtiging" value="Akkoord" id="sepa" required>
      Ik ga akkoord met deze machtiging
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset class="non-changing">

    <legend>Privacy</legend>

    <div class="terms">
      <p>Als Scoutingorganisatie verwerken wij persoonsgegevens om onze vereniging te kunnen organiseren, activiteiten uit te kunnen voeren en contact te hebben met onze leden. De gegevens van leden worden opgenomen in ons ledenadministratiesysteem Scouts Online. Als lid heb je zelf altijd inzicht in je eigen gegevens en heb je de mogelijkheid deze te bewerken of gegevens af te schermen. Hoe we met je gegevens omgaan staat beschreven op <a href="https://www.scouting.nl/privacy">www.scouting.nl/privacy</a>.</p>
      <p>Voor vragen kunt u zich richten tot de stafteams of een mail sturen naar: bestuur@scoutingoost1.nl</p>
      <p>Scouting Oost 1 maakt gebruik van diverse (sociale) media. Foto’s worden geplaatst op Facebook en onze website om een beeld te geven van de activiteiten die Scouting Oost 1 doet. Indien u bezwaar heeft tegen het plaatsen van fotografische opnames dan kunt u dit aangeven bij de staf van de speltak van uw zoon/dochter.</p>
    </div>
    <label class="term-check">
      <input type="checkbox" name="Privacy-voorwaarden" value="Akkoord" required>
      Ik ga akkoord met de privacy-voorwaarden
    </label>

    <button class="button js-next" type="button">Volgende</button>

  </fieldset>



  <fieldset class="act-delete">

    <legend>Overzicht en opmerkingen</legend>

    <div class="form-overview"></div>

    <label class="text-label">Opmerkingen
      <textarea name="Opmerkingen" cols="40" rows="10"></textarea>
    </label>

    <p class="no-display">Vul hier niks in <input type="text" name="url"></p>

    <button type="submit" name="submit" class="button">Versturen</button>

  </fieldset>

</form>
