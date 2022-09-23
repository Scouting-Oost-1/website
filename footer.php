    <footer class="site-footer">
      <div class="site-footer__col">
        <a href="<?php echo get_site_url(); ?>">
          <img alt="<?php bloginfo( 'name' ); ?>"
            class="logo" width="195" height="68"
            src="<?php echo image_url('full-logo-black.svg'); ?>">
        </a>

        <address class="site-footer__address">
          <strong>Scouting Oost 1</strong><br>
          Kruislaan 224-226b<br>
          1098 SM Amsterdam<br>
          Verhuur: <a href="mailto:verhuur@scoutingoost1.nl">verhuur@scoutingoost1.nl</a><br>
          Vragen (nieuwe) leden: <a href="mailto:bestuur@scoutingoost1.nl">bestuur@scoutingoost1.nl</a><br>
          Overig: <a href="mailto:info@scoutingoost1.nl">info@scoutingoost1.nl</a><br>
          <a href="https://www.facebook.com/scoutingoost1/">facebook.com/scoutingoost1</a><br>
          <a href="https://www.instagram.com/scoutingoost1/">instagram.com/scoutingoost1</a><br>
          KVK 34330075
        </address>
      </div>

      <div class="site-footer__col">
        <h2 class="site-footer__head">Direct naar...</h2>
        <ul class="site-footer__links">
          <?php $privacy_link = get_permalink(
            get_page_by_path( 'privacy' ) ); ?>
          <li>
            <a href="<?php echo $privacy_link; ?>">Onze privacyverklaring</a>
          </li>
          <?php $regulations_link = get_permalink(
            get_page_by_path( 'reglement' ) ); ?>
          <li>
            <a href="<?php echo $regulations_link; ?>">Huishoudelijk reglement</a>
          </li>
          <li>
            Ledenadministratie
            <?php $administration_link = get_permalink(
              get_page_by_path( 'ledenadministratie' ) ); ?>
            <ul>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Aanmelden">
                  Word lid</a>
              </li>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Afmelden">
                  Uitschrijven</a>
              </li>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Wijzigen">
                  Gegevens wijzigen</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo get_permalink( get_page_by_path( 'steunen' ) ); ?>">
              Steun Scouting Oost 1</a>
              <?php $friend_link = get_permalink(
              get_page_by_path( 'vriend-worden' ) ); ?>
            <ul>
              <li>
                <a href="<?php echo $friend_link; ?>">
                  Word vriend</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo get_permalink( get_page_by_path( 'staf' ) ); ?>">
              Staf</a>
          </li>
        </ul>
      </div>
    </footer>

    <?php wp_footer(); ?>

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </body>
</html>
