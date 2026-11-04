
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    /**
     * WordPress charge ici les ressources et métadonnées
     * déclarées par le thème et les extensions.
     */
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * Point d'insertion pour les extensions WordPress
 * immédiatement après l'ouverture du body.
 */
wp_body_open();
?>

<?php
/**
 * ==========================================================
 * MIETTES — NAVIGATION PRINCIPALE
 * ==========================================================
 *
 * Les URLs sont générées par WordPress afin de rester
 * compatibles avec les permaliens et une future migration.
 *
 * Aucun ID de page n'est codé en dur.
 */

// URL de la page d'accueil.
$home_url = home_url('/');

// URL de la collection située sur l'accueil.
$carte_url = home_url('/#collection');

// Recherche des pages par leur slug.
$maison_page = get_page_by_path('la-maison');
$contact_page = get_page_by_path('contact');

// Vérifie que les pages existent et sont publiées.
$maison_published = (
    $maison_page instanceof WP_Post &&
    $maison_page->post_status === 'publish'
);

$contact_published = (
    $contact_page instanceof WP_Post &&
    $contact_page->post_status === 'publish'
);

// Construit les URLs à partir des permaliens WordPress.
$maison_url = $maison_published
    ? get_permalink($maison_page->ID)
    : $home_url;

$contact_url = $contact_published
    ? get_permalink($contact_page->ID)
    : $home_url;

// Détermine la page actuellement consultée.
$is_home = is_front_page();
$is_maison = $maison_published && is_page($maison_page->ID);
$is_contact = $contact_published && is_page($contact_page->ID);
?>

<!-- ========================================================
     EN-TÊTE DU SITE
     ======================================================== -->

<header class="site-header">

    <!-- Logo textuel : retour à l'accueil -->
    <a
        href="<?php echo esc_url($home_url); ?>"
        class="site-logo"
        aria-label="MIETTES — Retour à l'accueil"
    >
        <?php echo esc_html(get_bloginfo('name')); ?>
    </a>

    <!-- Navigation principale du site -->
    <nav
        class="site-nav"
        aria-label="Navigation principale"
    >

        <!-- Collection de l'accueil -->
        <a
            href="<?php echo esc_url($carte_url); ?>"
        >
            LA CARTE
        </a>

        <!-- Page La Maison -->
        <a
            href="<?php echo esc_url($maison_url); ?>"
            <?php if ($is_maison) : ?>
                aria-current="page"
            <?php endif; ?>
        >
            LA MAISON
        </a>

        <!-- Page Contact -->
        <a
            href="<?php echo esc_url($contact_url); ?>"
            <?php if ($is_contact) : ?>
                aria-current="page"
            <?php endif; ?>
        >
            CONTACT
        </a>

    </nav>

</header>
