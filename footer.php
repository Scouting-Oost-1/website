    <footer class="site-footer">
      <div class="site-footer__col">
        <a href="<?php echo get_site_url(); ?>">
          <picture>
            <source type="image/svg+xml"
              srcset="<?php echo image_url('full-logo-black.svg'); ?>">
            <img alt="<?php bloginfo( 'name' ); ?>"
              title="<?php bloginfo( 'name' ); ?>"
              class="logo"
              srcset="<?php echo image_url('full-logo-black.png'); ?> 1x,
                <?php echo image_url('full-logo-black@2x.png'); ?> 2x"
              src="<?php echo image_url('full-logo-black.png'); ?>">
          </picture>
        </a>

        <address class="site-footer__address">
          <strong>Scouting Oost 1</strong><br>
          Kruislaan 224-226b<br>
          1098 SL Amsterdam<br>
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
          <li>
            <a href="https://scoutingoost1.nl/wp-content/uploads/2021/02/Huishoudelijk-reglement.pdf">Huishoudelijk reglement</a> (PDF, 227KB)
          </li>
          <li>
            Ledenadministratie
            <?php $administration_link = get_permalink(
              get_page_by_path( 'ledenadministratie' ) ); ?>
            <ul>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Aanmelden">
                  Word lid</a>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Wijzigen">
                  Uitschrijven</a>
              <li>
                <a href="<?php echo $administration_link; ?>?Actie=Afmelden">
                  Gegevens wijzigen</a>
            </ul>
          </li>
          <li>
            <a href="<?php echo get_permalink( get_page_by_path( 'steunen' ) ); ?>">
              Steun Scouting Oost 1</a>
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
