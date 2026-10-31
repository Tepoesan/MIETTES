
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    /**
     * Charge les ressources CSS, JavaScript
     * et les métadonnées nécessaires à WordPress.
     */
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>


<!-- ==========================================
     MIETTES — EN-TÊTE PRINCIPAL
     ==========================================

     Le header contient :
     - Le logo MIETTES, lié à l'accueil.
     - LA CARTE : section Collection.
     - LA MAISON : page WordPress dédiée.
     - CONTACT : page WordPress dédiée.

     Son positionnement sticky reste géré en CSS.
-->


<?php
/* ==========================================================
   RÉCUPÉRATION DES LIENS WORDPRESS
   ========================================================== */

/*
 * LA CARTE
 *
 * Pointe vers la section Collection
 * de notre page d'accueil.
 */
$carte_url = home_url('/#collection');


/*
 * LA MAISON
 *
 * Recherche la page WordPress dont
 * le slug est "la-maison".
 */
$maison_page = get_page_by_path('la-maison');

$maison_url = (
    $maison_page && $maison_page->post_status === 'publish'
)
    ? get_permalink($maison_page->ID)
    : home_url('/');


/*
 * CONTACT
 *
 * Recherche la page WordPress
 * publiée avec le slug "contact".
 */
$contact_page = get_page_by_path('contact');

$contact_url = (
    $contact_page && $contact_page->post_status === 'publish'
)
    ? get_permalink($contact_page->ID)
    : home_url('/');
?>


<header class="site-header">

    <!-- ==========================================
         LOGO MIETTES
         ========================================== -->

    <a
        href="<?php echo esc_url(home_url('/')); ?>"
        class="site-logo"
    >
        <?php bloginfo('name'); ?>
    </a>


    <!-- ==========================================
         NAVIGATION PRINCIPALE
         ========================================== -->

    <nav
        class="site-nav"
        aria-label="Navigation principale"
    >

        <!-- LA CARTE : galerie de l'accueil -->
        <a href="<?php echo esc_url($carte_url); ?>">
            LA CARTE
        </a>

        <!-- LA MAISON : page dédiée -->
        <a href="<?php echo esc_url($maison_url); ?>">
            LA MAISON
        </a>

        <!-- CONTACT : page dédiée -->
        <a href="<?php echo esc_url($contact_url); ?>">
            CONTACT
        </a>

    </nav>

</header>
