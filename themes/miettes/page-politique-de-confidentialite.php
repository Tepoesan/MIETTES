
<?php
/**
 * MIETTES — Politique de confidentialité
 *
 * Template éditorial brutaliste.
 * Le texte juridique reste administrable dans WordPress.
 */

get_header();
?>

<main id="main-content" class="miettes-privacy">

    <!-- HERO MINÉRAL -->
    <header class="privacy-hero">

        <div class="privacy-hero__inner">

            <p class="privacy-hero__eyebrow">
                MIETTES — INFORMATIONS LÉGALES
            </p>

            <h1 class="privacy-hero__title">
                POLITIQUE DE<br>
                CONFIDENTIALITÉ.
            </h1>

            <div class="privacy-hero__bottom">
                <span>VIE PRIVÉE & DONNÉES PERSONNELLES</span>
                <span>FRANCE — FR</span>
            </div>

        </div>

    </header>

    <!-- CORPS ÉDITORIAL -->
    <section class="privacy-content">

        <div class="privacy-layout">

            <!-- Colonne latérale -->
            <aside class="privacy-sidebar"
                   aria-label="Informations légales">

                <span class="privacy-sidebar__heading">
                    01 — LÉGAL
                </span>

                <div class="privacy-sidebar__line"></div>

                <p>
                    VIE PRIVÉE<br>
                    DONNÉES<br>
                    RGPD
                </p>

                <div class="privacy-sidebar__vertical"></div>

            </aside>

            <!-- Texte juridique -->
            <div class="privacy-content__inner">

                <?php
                /**
                 * Le contenu provient de la page WordPress.
                 * Aucun texte juridique n'est dupliqué ici.
                 */
                while (have_posts()) :
                    the_post();
                ?>

                    <article class="privacy-article">
                        <?php the_content(); ?>
                    </article>

                <?php endwhile; ?>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
