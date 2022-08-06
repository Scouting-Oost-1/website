<?php

/*-------------------------------------*\
  CLOTHES FORM
\*-------------------------------------*/

function clothes_form_view() {

  $action_url = get_template_directory_uri() . 'inc/clothes-handling.php';

  ob_start();
  ?>

  <form class="clothes" method="post" name="clothes"
    action="<?php echo $action_url; ?>">

    <input type="hidden" name="action" value="clothes">

    <fieldset class="start">

      <legend>Welk kledingstuk wil je aanschaffen?</legend>

      <label class="text-label">Maat
        <select name="Maat" required class="identifying">
          <option value="">Om welke maat gaat het?</option>
          <option value="116">116</option>
          <option value="128">128</option>
          <option value="140">140</option>
          <option value="152">152</option>
          <option value="164">164</option>
          <option value="S">S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="XXL">XXL</option>
        </select>
      </label>

      <div class="options">
        <label class="options__opt">
          <input type="number" name="Trui" max="5" min="0" step="1" placeholder="0">
          Trui (€18)
        </label>
        <label class="options__opt">
          <input type="number" name="T-shirt" max="5" min="0" step="1" placeholder="0">
          T-shirt (€8)
        </label>
        <label class="options__opt">
          <input type="number" name="Trui met capuchon" max="5" min="0" step="1" placeholder="0">
          Trui met capuchon (€25)
        </label>
        <label class="options__opt">
          <input type="number" name="Polo" max="5" min="0" step="1" placeholder="0">
          Polo (€15, leiding)
        </label>
      </div>

    </fieldset>



    <fieldset class="start">

      <legend>Voor wie is het?</legend>

      <label class="text-label">Naam lid
        <input type="text" name="Naam" id="name" placeholder="Sam Janssen" required class="identifying">
      </label>

      <label class="text-label">Speltak
        <select name="Speltak" required class="identifying">
          <option value="">Om welk speltak gaat het?</option>
          <option value="Bevers">Bevers</option>
          <option value="Kabouters">Kabouters</option>
          <option value="Welpen">Welpen</option>
          <option value="Gidsen">Gidsen</option>
          <option value="Scouts">Scouts</option>
          <option value="Verkenners">Verkenners</option>
          <option value="Explos">Explo's</option>
          <option value="Leiding en bestuur">Leiding of bestuur</option>
        </select>
      </label>

    </fieldset>



    <fieldset class="start">

      <legend>Wat zijn uw contactgegevens?</legend>

      <label class="text-label">Naam
        <input type="text" name="Ouder" placeholder="Puk Janssen" required>
      </label>
      <label class="text-label">Emailadres
        <input type="email" name="Email" placeholder="sam@scoutingoost1.nl" required>
      </label>

      <button class="button js-next" type="button">Volgende</button>

    </fieldset>



    <fieldset>

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
add_shortcode( 'clothes_form', 'clothes_form_view' );
?>
