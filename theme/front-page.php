<?php
/**
 * Template de la page d'accueil
 *
 * @package WordPress
 * @subpackage Epf_Occitanie
 * @since 1.0.0
 */
get_header(); ?>

<section class="row no-gutters mt-0 justify-content-center position-relative home-last-news">
  <div class="col">
    <h2 class="mt-1 position-absolute display-4 text-secondary font-weight-bold text-uppercase">
      à la une
    </h2>

    <div class="news">
      <!--(bake-start _foreach="actu:news")-->
      <!--(bake-start _if="actu@iteration == 1")-->
      <div class="row news-wrapper current">
        <!--(bake-end)-->
        <!--(bake-start _if="actu@iteration != 1")-->
        <div class="row news-wrapper">
          <!--(bake-end)-->
          <img src="assets/{{actu.picture}}" />

          <div class="col-12 offset-md-5 col-md-7 content-wrapper">
            <div class="py-4 px-5 content shadow">
              <h3 class="mb-4">{{actu.title}}</h3>
              <p>{{actu.content}}</p>
            </div>
          </div>
        </div>
        <!--(bake-end)-->
      </div>

      <div class="row nav-container">
        <nav class="col-12 col-md-5 navigation">
          <ul class="list-unstyled">
            <li>
              <a class="nav-btn" href="#"><span class="sr-only">Actualité précédente</span></a>
            </li>

            <!--(bake-start _foreach="actu:news")-->
            <!--(bake-start _if="actu@iteration == 1")-->
            <li class="active">
              <!--(bake-end)-->
              <!--(bake-start _if="actu@iteration != 1")-->
            <li>
              <!--(bake-end)-->
              <a href="#"><span class="sr-only">Actualité {{actu@iteration}}</span></a>
            </li>
            <!--(bake-end)-->

            <li>
              <a class="nav-btn" href="#"><span class="sr-only">Actualité suivante</span></a>
            </li>
          </ul>
        </nav>

        <div class="w-100"></div>

        <div class="col-12 col-md-5 text-center">
          <a class="mb-3 mx-5 shadow btn btn-secondary text-uppercase" href="#">Toute l'actu</a>
        </div>
      </div>
    </div>
</section>

<section class="missions">
  <h2 class="ml-2 mt-1 text-center">
    Expertise <span class="text-secondary">&</span> <strong>missions</strong>
  </h2>

  <div class="position-relative">
    <a class="nav-btn" href="#">
      <i class="fas fa-chevron-left text-body"></i>
    </a>

    <div class="icon-list mx-5">
      <!--(bake-start _foreach="mission:missions")-->
      <div>
        <a href="#">
          <img src="assets/home/{{mission.icon}}">
          <span>{{mission.title}}</span>
        </a>
      </div>
      <!--(bake-end)-->
    </div>

    <a class="nav-btn" href="#">
      <i class="fas fa-chevron-right text-body"></i>
    </a>
  </div>
</section>

<section style="height: 3px;" class="row no-gutters justify-content-center" role="presentation">
  <div class="col-4 h-100 bg-primary">&nbsp;</div>
  <div class="col-2"></div>
  <div class="col-4 h-100 bg-primary">&nbsp;</div>
</section>

<section class="publications">
  <div class="navigation-buttons d-flex justify-content-around">
    <a href="#"><span class="sr-only">Publication précédente</span></a>
    <a href="#"><span class="sr-only">Publication suivante</span></a>
  </div>

  <div class="col-6 ovale text-center">
    <h2 class="mt-2">
      Nos<br />
      <strong>Publications</strong>
    </h2>

    <p class="font-italic">Retrouvez l'ensemble de nos documents à télécharger</p>
  </div>

  <nav class="publication-list">
    <!--(bake-start _foreach="publication:publications")-->
    <div>
      <h3 class="mb-5 h5 font-weight-bold">{{publication.title}}</h3>
      <footer>
        <small class="flex-grow-1 text-muted">{{publication.type}} | {{publication.size}}Mo</small>
        <a href="#">Télécharger</a>
      </footer>
    </div>
    <!--(bake-end)-->
  </nav>
</section>

<section class="numbers row no-gutters text-center text-white">
  <!--(bake-start _foreach="stat:stats")-->
  <div class="col-4 d-flex flex-column justify-content-center align-items-center">
    <p class="display-2 font-weight-bold">{{stat.value}}</p>
    <img src="assets/home/{{stat.icon}}">
    <p class="mt-4 font-weight-bold">{{stat.title}}</p>
  </div>
  <!--(bake-end)-->
</section>

<section class="row no-gutters map">
  <div class="col">
    <div class="row">
      <div class="col-7">
        <h2 class="display-4">
          Cartographie<br />
          des <strong class="font-weight-bold">sites</strong>
        </h2>

        <p class="my-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>

        <form>
          <div class="input-group">
            <input class="form-control form-control-lg" type="text" placeholder="Rechercher une commune" aria-label="Rechercher une commune">
            <div class="input-group-append">
              <button class="btn btn-secondary" type="button">OK</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-5">

      </div>
    </div>

    <p class="watermark font-weight-bold">Carte</p>
  </div>
</section>

<?php get_footer();
