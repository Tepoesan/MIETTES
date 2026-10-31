
<?php
/**
 * Template de la page « La Maison ».
 *
 * WordPress utilise automatiquement ce fichier
 * pour une page dont le slug est « la-maison ».
 *
 * Organisation :
 * 01 — Introduction
 * 02 — Le Geste
 * 03 — La Matière
 * 04 — L'Essentiel
 */

get_header();
?>

<main id="main-content" class="maison">

    <!-- ==========================================
         01 — INTRODUCTION
         ========================================== -->
    <section class="maison-intro" aria-labelledby="maison-title">

        <div class="maison-intro__heading">
            <span class="maison-index">01 / NOTRE UNIVERS</span>

            <h1 id="maison-title" class="maison-intro__title">
                LA MAISON<span class="maison-period">.</span>
            </h1>

            <p class="maison-intro__subtitle">
                UNE AUTRE IDÉE DE L'ESSENTIEL.
            </p>
        </div>

        
        <figure class="maison-intro__visual">

            <!--
                Photographie principale de LA MAISON.
                get_template_directory_uri() récupère
                l'URL du dossier de notre thème WordPress.
            -->
            <img
                src="<?php echo esc_url(
                    get_template_directory_uri() . '/images/architecture.png'
                ); ?>"
                alt="Architecture brutaliste en pierre minérale, traversée par une lumière naturelle."
                class="maison-intro__image"
                fetchpriority="high"
                decoding="async"
            >

            <figcaption>
                MIETTES — LABO
            </figcaption>

        </figure>


    </section>

    <!-- ==========================================
         02 — LE GESTE
         ========================================== -->
    <section class="maison-geste" aria-labelledby="geste-title">

        <span class="maison-index">02 / LE GESTE</span>

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

    <!-- ==========================================
         03 — LA MATIÈRE
         ========================================== -->
    <section class="maison-matiere" aria-labelledby="matiere-title">

        <div class="maison-matiere__heading">
            <span class="maison-index">03 / LA MATIÈRE</span>

            <h2 id="matiere-title">
                RESISTER.<br>
                PRESERVER.<br>
                TRANSMETTRE.
            </h2>
        </div>

        <!-- Galerie animée progressivement au défilement -->
        <div class="maison-matiere__gallery" data-maison-scroll>

            
            <!-- Deuxième image à apparaître : LA TEXTURE -->
            <figure class="maison-matiere__image maison-matiere__image--large"
                    data-maison-reveal="second">

                <!-- Gros plan sur la matière minérale. -->
                <img
                    src="<?php echo esc_url(
                        get_template_directory_uri() . '/images/texture.png'
                    ); ?>"
                    alt="Gros plan sur une pierre brute aux reliefs irréguliers et aux ombres profondes."
                    loading="lazy"
                    decoding="async"
                >

                <figcaption>01 / LA TEXTURE</figcaption>

            </figure>


            
             <!-- Première image à apparaître : LA LUMIÈRE -->
            <figure class="maison-matiere__image maison-matiere__image--small"
                    data-maison-reveal="first">

                <!--
                    Photographie secondaire.
                    Le nom du fichier contient un accent :
                    lumière.png
                -->
                <img
                    src="<?php echo esc_url(
                        get_template_directory_uri() . '/images/lumière.png'
                    ); ?>"
                    alt="Lumière rasante dessinant des ombres géométriques sur une architecture en pierre."
                    loading="lazy"
                    decoding="async"
                >

                <figcaption>02 / LA LUMIÈRE</figcaption>

            </figure>


        </div>

    </section>

    <!-- ==========================================
         04 — L'ESSENTIEL
         ========================================== -->
    <section class="maison-essentiel" aria-labelledby="essentiel-title">

        <span class="maison-index">04 / L'ESSENTIEL</span>

        <h2 id="essentiel-title">
            RIEN<br>
            À AJOUTER.
        </h2>

        <a class="maison-essentiel__link"
           href="<?php echo esc_url(home_url('/#collections')); ?>">
            DÉCOUVRIR NOS CRÉATIONS
            <span aria-hidden="true">↗</span>
        </a>

    </section>

</main>

<?php get_footer(); ?>
