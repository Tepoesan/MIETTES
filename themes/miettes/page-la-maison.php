
<?php
/**
 * ==========================================================
 * MIETTES — PAGE LA MAISON
 * ==========================================================
 *
 * WordPress utilise automatiquement ce template
 * pour la page dont le slug est « la-maison ».
 *
 * ORGANISATION :
 * 01 — Introduction
 * 02 — Le Geste
 * 03 — La Matière
 * 04 — L'Essentiel
 *
 * OPTIMISATIONS :
 * - Images exclusivement au format WebP.
 * - Dimensions explicites pour limiter le CLS.
 * - Chargement différé des images secondaires.
 * - URLs générées et échappées avec WordPress.
 * - Conservation des classes CSS et attributs JS.
 */

// Charge l'en-tête global du thème.
get_header();
?>

<main id="main-content" class="maison">

    <!-- =====================================================
         01 — INTRODUCTION
         ===================================================== -->

    <section
        class="maison-intro"
        aria-labelledby="maison-title"
    >

        <div class="maison-intro__heading">

            <span class="maison-index">
                01 / NOTRE UNIVERS
            </span>

            <h1
                id="maison-title"
                class="maison-intro__title"
            >
                LA MAISON<span class="maison-period">.</span>
            </h1>

            <p class="maison-intro__subtitle">
                UNE AUTRE IDÉE DE L'ESSENTIEL.
            </p>

        </div>


        <!-- ================================================
             PHOTOGRAPHIE PRINCIPALE — ARCHITECTURE
             ================================================ -->

        <figure class="maison-intro__visual">

            <!--
                MIETTES — ARCHITECTURE

                Image principale optimisée en WebP.

                La classe CSS et les dimensions sont
                conservées pour préserver le cadrage.

                fetchpriority="high" indique au navigateur
                que cette photographie est prioritaire.

                decoding="async" permet au navigateur
                de décoder l'image de manière asynchrone.
            -->

            <img
                src="<?php echo esc_url(
                    get_theme_file_uri('images/architecture.webp')
                ); ?>"
                alt="Architecture brutaliste en pierre minérale, traversée par une lumière naturelle."
                class="maison-intro__image"
                width="1575"
                height="999"
                fetchpriority="high"
                decoding="async"
            >

            <figcaption>
                MIETTES — LABO
            </figcaption>

        </figure>

    </section>


    <!-- =====================================================
         02 — LE GESTE
         ===================================================== -->

    <section
        class="maison-geste"
        aria-labelledby="geste-title"
    >

        <span class="maison-index">
            02 / LE GESTE
        </span>

        <div class="maison-geste__content">

            <h2 id="geste-title">
                LE SAVOIR FAIRE.<br>
                ET LE FAIRE<br>
                AUTREMENT.
            </h2>

            <p>
                Nous croyons à la simplicité du geste,
                à la justesse des matières et à la beauté
                de ce qui n'a pas besoin d'en faire trop.
            </p>

        </div>

    </section>


    <!-- =====================================================
         03 — LA MATIÈRE
         ===================================================== -->

    <section
        class="maison-matiere"
        aria-labelledby="matiere-title"
    >

        <div class="maison-matiere__heading">

            <span class="maison-index">
                03 / LA MATIÈRE
            </span>

            <h2 id="matiere-title">
                RESISTER.<br>
                PRESERVER.<br>
                TRANSMETTRE.
            </h2>

        </div>


        <!-- ================================================
             GALERIE CINÉMATIQUE
             ================================================

             data-maison-scroll :
             identifie la galerie pour maison-scroll.js.

             data-maison-reveal :
             définit l'ordre d'apparition des images.

             Les animations JavaScript existantes
             restent inchangées.
        -->

        <div
            class="maison-matiere__gallery"
            data-maison-scroll
        >


            <!-- ============================================
                 IMAGE 01 — LA TEXTURE
                 ============================================

                 Deuxième image à apparaître.

                 Le conteneur conserve :
                 - maison-matiere__image
                 - maison-matiere__image--large
                 - data-maison-reveal="second"

                 L'image est chargée en WebP uniquement.
            -->

            <figure
                class="maison-matiere__image maison-matiere__image--large"
                data-maison-reveal="second"
            >

                <!--
                    MIETTES — LA TEXTURE

                    Photographie WebP optimisée.

                    loading="lazy" diffère le chargement
                    lorsque l'image est hors écran.

                    Les dimensions explicites limitent
                    les décalages de mise en page.
                -->

                <img
                    src="<?php echo esc_url(
                        get_theme_file_uri('images/texture.webp')
                    ); ?>"
                    alt="Gros plan sur une pierre brute aux reliefs irréguliers et aux ombres profondes."
                    width="1536"
                    height="1024"
                    loading="lazy"
                    decoding="async"
                >

                <figcaption>
                    01 / LA TEXTURE
                </figcaption>

            </figure>


            <!-- ============================================
                 IMAGE 02 — LA LUMIÈRE
                 ============================================

                 Première image à apparaître.

                 Le fichier s'appelle lumiere.webp,
                 sans accent, pour une meilleure
                 compatibilité entre environnements.

                 L'attribut data-maison-reveal="first"
                 conserve l'ordre de l'animation.
            -->

            <figure
                class="maison-matiere__image maison-matiere__image--small"
                data-maison-reveal="first"
            >

                <!--
                    MIETTES — LA LUMIÈRE

                    Photographie verticale au format WebP.

                    Les dimensions originales et
                    le chargement différé sont conservés.

                    L'animation est pilotée par
                    l'attribut du conteneur figure.
                -->

                <img
                    src="<?php echo esc_url(
                        get_theme_file_uri('images/lumiere.webp')
                    ); ?>"
                    alt="Lumière rasante dessinant des ombres géométriques sur une architecture en pierre."
                    width="1024"
                    height="1536"
                    loading="lazy"
                    decoding="async"
                >

                <figcaption>
                    02 / LA LUMIÈRE
                </figcaption>

            </figure>

        </div>

    </section>


    <!-- =====================================================
         04 — L'ESSENTIEL
         ===================================================== -->

    <section
        class="maison-essentiel"
        aria-labelledby="essentiel-title"
    >

        <span class="maison-index">
            04 / L'ESSENTIEL
        </span>

        <h2 id="essentiel-title">
            RIEN<br>
            À AJOUTER.
        </h2>

        <!--
            Retour vers la collection de l'accueil.

            L'identifiant correct est #collection
            et non #collections.
        -->

        <a
            class="maison-essentiel__link"
            href="<?php echo esc_url(
                home_url('/#collection')
            ); ?>"
        >
            DÉCOUVRIR NOS CRÉATIONS
            <span aria-hidden="true">↗</span>
        </a>

    </section>

</main>

<?php
/**
 * Charge le pied de page WordPress.
 * Celui-ci exécute également wp_footer().
 */
get_footer();
?>
