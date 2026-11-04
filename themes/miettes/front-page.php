
<?php
/**
 * ==========================================================
 * MIETTES — TEMPLATE PRINCIPAL DU THÈME
 * ==========================================================
 *
 * Organisation :
 *
 * 01 — HERO
 *      Présentation de la maison MIETTES.
 *
 * 02 — LA COLLECTION
 *      Carrousel cinématique piloté par le scroll.
 *      Les créations avancent progressivement
 *      au premier plan.
 *
 * 03 — SIGNATURE MIETTES
 *      Grande image de marque en pleine largeur,
 *      indépendante du carrousel.
 *
 * Le CSS gère l'apparence.
 * Le JavaScript anime uniquement la collection.
 */

// Charge l'en-tête WordPress.
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


        <!-- Photographie principale en pleine largeur -->
        <div class="hero-visual">

            <!--
                MIETTES — HERO optimisé

                Le navigateur privilégie le format WebP.
                Le PNG original reste disponible en secours.

                On conserve les classes CSS et les dimensions
                pour préserver le design existant.
            -->
            <picture>

                <!-- Version WebP optimisée -->
                <source
                    srcset="<?php echo esc_url(
                        get_theme_file_uri('images/hero_accueil.webp')
                    ); ?>"
                    type="image/webp"
                >

                <!-- Version PNG de secours -->
                <img
                    src="<?php echo esc_url(
                        get_theme_file_uri('images/hero_accueil.png')
                    ); ?>"
                    alt="Pain perdu caramélisé présenté sur une pierre brute, accompagné de deux créations sur des socles minéraux."
                    class="hero-image"
                    width="1536"
                    height="1024"
                    fetchpriority="high"
                >

            </picture>

        </div>


        <!-- Informations sous la photographie -->
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

         Le scroll vertical pilote les transitions
         entre les trois créations.

         Le conteneur sticky maintient la collection
         visible pendant l'animation.

         Les photographies sont superposées
         pour créer un effet de profondeur.
    -->

    <section
        id="collection"
        class="collection"
        aria-labelledby="collection-title"
    >

        <!-- Zone maintenue à l'écran pendant le scroll -->
        <div class="collection-sticky">

            <!-- Introduction de la collection -->
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
                 CARROUSEL CINÉMATIQUE
                 =============================================

                 collection-viewport :
                 fenêtre visible du carrousel.

                 collection-track :
                 conteneur des créations.

                 collection-item :
                 chaque création est animée séparément
                 par collection-scroll.js.
            -->

            <div class="collection-viewport">

                <div class="collection-track">

                    <!-- =====================================
                         CRÉATION 01 — BLEU MARINE CHÂTAIGNE
                         ===================================== -->

                    <article class="collection-item">

                        <div class="collection-image">


                            <picture>
                                <!-- Version WebP optimisée -->
                                <source
                                    srcset="<?php echo esc_url(
                                        get_theme_file_uri('images/Bleu_marine_chataigne.webp')
                                    ); ?>"
                                    type="image/webp"
                                >

                                <!-- PNG original en secours -->
                                <img
                                    src="<?php echo esc_url(
                                        get_theme_file_uri('images/Bleu_marine_chataigne.png')
                                    ); ?>"
                                    alt="Pain perdu Bleu Marine Châtaigne présenté sur des pierres calcaires blanches."
                                    width="1536"
                                    height="1024"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>


                        </div>

                        <div class="collection-caption">

                            <span>01 / SIGNATURE</span>

                            <h3>BLEU MARINE CHÂTAIGNE</h3>

                        </div>

                    </article>


                    <!-- =====================================
                         CRÉATION 02 — LE DÉCONSTRUIT
                         ===================================== -->

                    <article class="collection-item">

                        <div class="collection-image">


                            <picture>
                                <source
                                    srcset="<?php echo esc_url(
                                        get_theme_file_uri('images/deconstruit.webp')
                                    ); ?>"
                                    type="image/webp"
                                >

                                <img
                                    src="<?php echo esc_url(
                                        get_theme_file_uri('images/deconstruit.png')
                                    ); ?>"
                                    alt="Trois morceaux de pain perdu caramélisé disposés sur une pierre calcaire, accompagnés de fines dentelles de caramel."
                                    width="1536"
                                    height="1024"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>


                        </div>

                        <div class="collection-caption">

                            <span>02 / SIGNATURE</span>

                            <h3>LE DÉCONSTRUIT</h3>

                        </div>

                    </article>


                    <!-- =====================================
                         CRÉATION 03 — LE 49.3 FROMAGES
                         ===================================== -->

                    <article class="collection-item">

                        <div class="collection-image">


                            <picture>
                                <source
                                    srcset="<?php echo esc_url(
                                        get_theme_file_uri('images/49_3_fromages.webp')
                                    ); ?>"
                                    type="image/webp"
                                >

                                <img
                                    src="<?php echo esc_url(
                                        get_theme_file_uri('images/49_3_fromages.png')
                                    ); ?>"
                                    alt="Pain perdu salé aux fromages fondants et feuilles d'or, présenté sur une pierre calcaire avec un petit pot en granit."
                                    width="1536"
                                    height="1024"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>


                        </div>

                        <div class="collection-caption">

                            <span>03 / SIGNATURE</span>

                            <h3>LE 49.3 FROMAGES</h3>

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

    <!-- =====================================================
     SECTION 03 — LE MANIFESTE
     =====================================================

     Deux tableaux éditoriaux qui se succèdent
     au rythme du défilement vertical.

     Le JavaScript gère leur apparition progressive.
     Le CSS gère le positionnement et l'esthétique.

     Cette section est indépendante du carrousel
     gastronomique précédent.
-->

<section
    id="manifeste"
    class="manifesto"
    aria-label="Le manifeste de la maison MIETTES"
>

    <!-- Zone maintenue à l'écran pendant le scroll -->
    <div class="manifesto-sticky">

        <!-- Numéro de section -->
        <div class="manifesto-heading">
            <span>03 / MAISON MIETTES</span>
            <span>MIETTES · PARIS</span>
        </div>

        <!-- Conteneur des deux tableaux -->
        <div class="manifesto-content">

            <!-- TABLEAU 01 — LA LIBERTÉ -->
            <article class="manifesto-slide manifesto-slide--first">

                <div class="manifesto-slide-inner">

                    <h2>
                        La libre communication des pensées
                        et des opinions est un des droits
                        les plus précieux de l'Homme.
                    </h2>

                </div>

            </article>

            <!-- TABLEAU 02 — LES VALEURS -->
            <article class="manifesto-slide manifesto-slide--second">

                <div class="manifesto-slide-inner">

                    <h2>
                        Valeurs. Traditions.
                        <em>Le goût de l'essentiel.</em>
                    </h2>

                    <p class="manifesto-source">
                        MIETTES — MAISON DE PAIN PERDU
                    </p>

                </div>

            </article>

        </div>

        <!-- Signature discrète en bas -->
        <div class="manifesto-footer">
            <span>RIEN NE SE PERD. TOUT SE DÉSIRE.</span>
            <span class="manifesto-counter">01 / 02</span>
        </div>

    </div>

</section>
<!-- Fin du manifeste -->


</main>

<?php
// Charge le pied de page WordPress.
get_footer();
?>
