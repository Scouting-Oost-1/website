<?php /**
 * Template Name: Front page
 */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

  <main class="front-page" id="site-content">



    <section class="top--front">
      <h1>[activiteit]</h1>
      <p>[korte beschrijving]</p>
      - Open Dag & eerste draaimomenten
      - Grote Clubactie
      - Sinterklaas
      - Poffertjes
      - Zomerkamp
      - Anders: Gebouw
    </section>



    <section class="past--front">
      <h1>Blijf op de hoogte</h1>

      <div class="news--front">
        <h2>Nieuws</h2>

        <article class="message--front">
          [Thumbnail]
          <h3>[Titel]</h3>
          [Excerpt]
          Lees verder...
        </article>
      </div>

      <div class="photos--front">
        <h2>Foto’s</h2>
        <article class="photoalbum--front">
          [Fotoalbum]
        </article>
      </div>

      <div class="lvs--front">
        <h2>Lopend Vuurtje</h2>
        <article class="lv--front">
          Bekijk de laatste editie van ons clubblad (januari)
        </article>
      </div>
    </section>



    <section class="upcoming--front">
      <h1>Binnenkort</h1>

      <h2>De eerstvolgende activiteit</h2>

      <h2>Zomerkamp</h2>

      <h2>Volledige agenda</h2>
    </section>



    <section class="members--front">
      <h1>Jeugdleden</h1>
      <div class="speltakken--front">
        <table>
          <thead>
            <th>Leeftijd</th>
            <th>Meisjes</th>
            <th>Jongens</th>
          </thead>
          <tbody>
            <tr>
              <td>4–7</td>
              <td>Bevers</td>
            </tr>
            <tr>
              <td>7–11</td>
              <td>Kabouters</td>
              <td>Welpen</td>
            </tr>
            <tr>
              <td>11–15</td>
              <td>Gidsen</td>
              <td>Verkenners</td>
            </tr>
            <tr>
              <td>15–18</td>
              <td>Explorers</td>
            </tr>
          </tbody>
        </table>
      </div>
      <a href="#" class="button">Word lid</a>
      <a href="#" class="button button--light">Uitschrijven</a>
      <a href="#" class="button button--light">Gegevens wijzigen</a>
    </section>



    <section class="rest--front">
      <h1>Over</h1>
      [Inhoud over-pagina]

      <a href="#" class="button">Huur onze gebouwen</a>
      <a href="#" class="button">Steun Scouting Oost 1</a>
      <a href="#" class="button">Neem contact op</a>
    </section>



  </main>

<?php endwhile; else: ?>

  <main>

    <p>Sorry, deze pagina lijkt niet te bestaan.</p>

  </main>

<?php endif; ?>
<?php get_footer(); ?>
