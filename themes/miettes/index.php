
<?php
/**
 * ==========================================================
 * MIETTES — TEMPLATE DE SECOURS
 * ==========================================================
 *
 * WordPress utilise index.php lorsqu'aucun
 * template plus spécifique n'est disponible.
 *
 * La véritable page d'accueil se trouve
 * désormais dans front-page.php.
 */

// Charge l'en-tête du thème.
get_header();
?>

<main id="main-content" class="site-main">

    <section class="fallback-page">

        <h1>
            <?php esc_html_e('Bienvenue chez MIETTES', 'miettes'); ?>
        </h1>

        <p>
            <?php
            esc_html_e(
                'Découvrez notre maison et nos créations.',
                'miettes'
            );
            ?>
        </p>

        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php esc_html_e('Retour à l’accueil', 'miettes'); ?>
        </a>

    </section>

</main>

<?php
// Charge le pied de page WordPress.
get_footer();
?>
