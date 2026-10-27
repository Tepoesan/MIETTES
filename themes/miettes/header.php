<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>


<!-- ==========================================
     MIETTES — En-tête principal
     ==========================================

     Le header contient :
     - le nom de la maison, cliquable ;
     - une navigation vers les sections du site.

     Son positionnement sticky est géré en CSS.
-->

<header class="site-header">

    <!--
        LOGO MIETTES

        home_url('/') récupère l'adresse d'accueil.
        esc_url() sécurise l'URL affichée.
        bloginfo('name') affiche le nom défini
        dans les réglages WordPress.
    -->
    <a
        href="<?php echo esc_url(home_url('/')); ?>"
        class="site-logo"
    >
        <?php bloginfo('name'); ?>
    </a>

    <!--
        NAVIGATION PRINCIPALE

        aria-label donne un nom explicite
        à la navigation pour les lecteurs d'écran.

        Les liens pointent vers des identifiants
        de sections de la page d'accueil.
    -->
    <nav class="site-nav" aria-label="Navigation principale">

        <!-- Future section présentant les créations. -->
        <a href="<?php echo esc_url(home_url('/#collection')); ?>">
            LA CARTE
        </a>

        <!-- Future section présentant la maison. -->
        <a href="<?php echo esc_url(home_url('/#maison')); ?>">
            LA MAISON
        </a>

        <!-- Future section de contact. -->
        <a href="<?php echo esc_url(home_url('/#contact')); ?>">
            CONTACT
        </a>

    </nav>

</header>
