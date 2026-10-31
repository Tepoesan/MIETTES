
<?php
/**
 * ==========================================================
 * MIETTES — TEMPLATE GÉNÉRIQUE DES PAGES
 * ==========================================================
 *
 * Ce fichier affiche les pages WordPress classiques :
 *
 * - Politique de confidentialité
 * - Mentions légales
 * - Autres pages éditoriales
 *
 * WordPress utilise ce template lorsqu'aucun
 * modèle de page plus spécifique n'existe.
 *
 * Les pages personnalisées comme La Maison
 * conservent leur propre template.
 */

get_header();
?>

<main id="main-content" class="miettes-page">

    <?php
    /**
     * La boucle WordPress récupère la page demandée
     * et affiche son titre ainsi que son contenu.
     */
    while (have_posts()) :
        the_post();
    ?>

        <article
            id="post-<?php the_ID(); ?>"
            <?php post_class('miettes-page__article'); ?>
        >

            <header class="miettes-page__header">

                <span class="miettes-page__eyebrow">
                    MIETTES — MAISON GASTRONOMIQUE
                </span>

                <h1 class="miettes-page__title">
                    <?php the_title(); ?>
                </h1>

            </header>

            <div class="miettes-page__content">
                <?php
                /**
                 * Affiche le contenu rédigé dans
                 * l'éditeur WordPress (Gutenberg).
                 */
                the_content();
                ?>
            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php
/**
 * Charge le footer commun du thème MIETTES.
 */
get_footer();
?>
