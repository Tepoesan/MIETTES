<?php
/**
 * Fonctions du thème MIETTES.
 */

// Chargement de la feuille de style du thème.
function miettes_enqueue_styles() {
    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'miettes_enqueue_styles');