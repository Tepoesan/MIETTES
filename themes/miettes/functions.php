
<?php
/**
 * ==========================================================
 * MIETTES — Fonctions du thème WordPress
 * ==========================================================
 *
 * Ce fichier permet notamment de charger :
 *
 * 1. La feuille de style principale (style.css).
 * 2. Le JavaScript du carrousel (collection-scroll.js).
 *
 * L'ancien script ghost-logo.js n'est plus utilisé.
 */


/* ==========================================================
   CHARGEMENT DES RESSOURCES CSS ET JAVASCRIPT
   ========================================================== */

/**
 * Charge les fichiers nécessaires au fonctionnement
 * et à l'apparence du thème MIETTES.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       1. FEUILLE DE STYLE PRINCIPALE
       ------------------------------------------------------

       wp_enqueue_style() demande à WordPress
       de charger notre fichier style.css.

       get_stylesheet_uri() récupère son URL.

       filemtime() utilise la date de modification
       du fichier comme numéro de version pour
       éviter de conserver une ancienne version
       du CSS dans le cache du navigateur.
    */

    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );


    /* ------------------------------------------------------
       2. JAVASCRIPT — COLLECTION HORIZONTALE
       ------------------------------------------------------

       wp_enqueue_script() demande à WordPress
       de charger notre animation personnalisée.

       get_template_directory_uri() récupère
       l'URL du dossier de notre thème.

       array() indique que ce script ne dépend
       d'aucune bibliothèque externe.

       filemtime() évite les problèmes de cache.

       true demande le chargement en bas de page,
       avant la fermeture de la balise body.
    */

    wp_enqueue_script(
        'miettes-collection-scroll',
        get_template_directory_uri() . '/js/collection-scroll.js',
        array(),
        filemtime(
            get_template_directory() . '/js/collection-scroll.js'
        ),
        true
    );

}


/* ==========================================================
   ACTIVATION DU CHARGEMENT
   ==========================================================

   Le hook wp_enqueue_scripts indique à WordPress
   quand exécuter notre fonction.

   Il charge ainsi automatiquement le CSS
   et le JavaScript sur les pages du site.
*/

add_action('wp_enqueue_scripts', 'miettes_enqueue_assets');
