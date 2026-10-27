
<?php
/**
 * ==========================================================
 * MIETTES — Template principal du thème
 * ==========================================================
 *
 * Organisation de la page :
 *
 * 01 — HERO
 *      Présentation de la maison MIETTES.
 *
 * 02 — LA COLLECTION
 *      Galerie horizontale pilotée par le scroll.
 *
 * Le CSS gère l'apparence et le positionnement.
 * Le JavaScript synchronise le déplacement
 * horizontal avec le défilement vertical.
 */

// Charge l'en-tête du site.
get_header();
?>

<main id="main-content" class="site-main">

    <!-- =====================================================
         SECTION 01 — HERO
         ===================================================== -->

    <section class="hero" aria-labelledby="hero-title">

        <!-- Nom et signature de la maison -->
        <div class="hero-heading">

            <span class="hero-eyebrow">
                MAISON DE PAIN PERDU · PARIS
            </span>

            <h1 id="hero-title">MIETTES</h1>

            <p class="hero-signature">
                Rien ne se perd. Tout se désire.
            </p>

        </div>

        <!-- Photographie principale -->
        <div class="hero-visual">

            <img
                src="<?php
                    echo esc_url(
                        get_template_directory_uri()
                        . '/images/hero_accueil.png'
                    );
                ?>"
                alt="Pain perdu caramélisé présenté sur une pierre brute, accompagné de deux créations sur des socles minéraux."
                class="hero-image"
                width="1536"
                height="1024"
                fetchpriority="high"
            >

        </div>

        <!-- Bas du hero -->
        <div class="hero-bottom">

            <span>01 / LA PIÈCE SIGNATURE</span>

            <a href="#collection">
                DÉCOUVRIR LA COLLECTION
                <span aria-hidden="true">↗</span>
            </a>

        </div>

    </section>


    <!-- =====================================================
         SECTION 02 — LA COLLECTION
         =====================================================

         Fonctionnement attendu :

         1. L'utilisateur descend jusqu'à la collection.
         2. La collection reste visible à l'écran.
         3. Le scroll vertical fait avancer les créations
            horizontalement, de droite vers la gauche.
         4. Le mouvement s'arrête à la dernière création.
         5. La page reprend son défilement vertical.

         En remontant, le mouvement s'inverse.
    -->

    <section
        id="collection"
        class="collection"
        aria-labelledby="collection-title"
    >

        <!--
            CONTENEUR STICKY

            Englobe le titre ET les créations.

            CSS :
            position: sticky

            JavaScript :
            calcule la hauteur et la position nécessaires
            pour maintenir cette zone visible.
        -->
        <div class="collection-sticky">


            <!-- =============================================
                 INTRODUCTION DE LA COLLECTION
                 ============================================= -->

            <div class="collection-intro">

                <span class="collection-eyebrow">
                    02 / NOS CRÉATIONS
                </span>

                <h2 id="collection-title">
                    LA COLLECTION
                </h2>

                <p>
                    Le pain perdu, autrement.
                </p>

            </div>


            <!-- =============================================
                 GALERIE HORIZONTALE
                 =============================================

                 collection-viewport :
                 fenêtre visible de notre galerie.

                 collection-track :
                 piste contenant les créations.

                 Le JavaScript déplace uniquement
                 collection-track sur l'axe horizontal.
            -->

            <div class="collection-viewport">

                <div class="collection-track">


                    <!-- =====================================
                         CRÉATION 01 — L'ORIGINEL
                         ===================================== -->

                    <article class="collection-item">

                        <!--
                            Emplacement de la photographie.

                            Nous intégrerons ensuite notre
                            image sur support anthracite.
                        -->
                        <div class="collection-image">
                            <!-- Photographie à venir -->
                        </div>

                        <!-- Légende de la création -->
                        <div class="collection-caption">

                            <span>01 / SIGNATURE</span>

                            <h3>L'ORIGINEL</h3>

                        </div>

                    </article>


                    <!-- =====================================
                         CRÉATION 02 — LE ROUGE
                         ===================================== -->

                    <article class="collection-item">

                        <div class="collection-image">
                            <!-- Photographie à venir -->
                        </div>

                        <div class="collection-caption">

                            <span>02 / COLLECTION</span>

                            <h3>LE ROUGE</h3>

                        </div>

                    </article>


                    <!-- =====================================
                         CRÉATION 03 — L'OBSCUR
                         ===================================== -->

                    <article class="collection-item">

                        <div class="collection-image">
                            <!-- Photographie à venir -->
                        </div>

                        <div class="collection-caption">

                            <span>03 / COLLECTION</span>

                            <h3>L'OBSCUR</h3>

                        </div>

                    </article>


                </div>
                <!-- Fin de collection-track -->

            </div>
            <!-- Fin de collection-viewport -->

        </div>
        <!-- Fin de collection-sticky -->

    </section>
    <!-- Fin de la collection -->

</main>

<?php
// Charge le pied de page du thème.
get_footer();
?>
