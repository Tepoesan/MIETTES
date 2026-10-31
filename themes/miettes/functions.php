
<?php
/**
 * ==========================================================
 * MIETTES — FONCTIONS DU THÈME WORDPRESS
 * ==========================================================
 *
 * Ce fichier permet de charger :
 *
 * 01 — style.css
 *      Feuille de style principale du site.
 *
 * 02 — collection-scroll.js
 *      Carrousel cinématique des créations.
 *
 * 03 — manifesto-scroll.js
 *      Animation éditoriale du manifeste.
 *
 * 04 — maison-scroll.js
 *      Révélation progressive des photographies
 *      de la page La Maison.
 *
 * Chaque animation possède son propre fichier JS
 * pour faciliter la maintenance du thème.
 *
 * L'ancien script ghost-logo.js n'est plus utilisé.
 */


/* ==========================================================
   CHARGEMENT DES RESSOURCES CSS ET JAVASCRIPT
   ========================================================== */

/**
 * Charge les fichiers nécessaires au fonctionnement
 * et à l'apparence du thème MIETTES.
 *
 * Cette fonction est appelée automatiquement
 * par WordPress grâce au hook wp_enqueue_scripts.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       01 — FEUILLE DE STYLE PRINCIPALE
       ------------------------------------------------------

       wp_enqueue_style() charge notre style.css.

       get_stylesheet_uri() récupère son URL.

       filemtime() utilise la date de modification
       du fichier comme numéro de version pour
       éviter les problèmes de cache.
    */

    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        array(),
        filemtime(
            get_stylesheet_directory() . '/style.css'
        )
    );


    /* ------------------------------------------------------
       02 — JAVASCRIPT : COLLECTION CINÉMATIQUE
       ------------------------------------------------------

       Anime les trois créations gastronomiques
       pendant le défilement vertical.

       Le script contrôle :
       - la position des photographies ;
       - leur taille ;
       - leur opacité ;
       - leur superposition.

       Le scroll naturel du navigateur est conservé.
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


    /* ------------------------------------------------------
       03 — JAVASCRIPT : LE MANIFESTE
       ------------------------------------------------------

       Anime la section éditoriale située
       après notre collection gastronomique.

       Deux tableaux se succèdent progressivement :

       01 — La libre communication des pensées
            et des opinions...

       02 — Valeurs. Traditions.
            Le goût de l'essentiel.

       Le script utilise le scroll vertical
       pour gérer les transitions douces.

       Il fonctionne indépendamment
       du carrousel gastronomique.
    */

    wp_enqueue_script(
        'miettes-manifesto-scroll',
        get_template_directory_uri() . '/js/manifesto-scroll.js',
        array(),
        filemtime(
            get_template_directory() . '/js/manifesto-scroll.js'
        ),
        true
    );


    /* ------------------------------------------------------
       04 — JAVASCRIPT : LA MAISON
       ------------------------------------------------------

       Anime les deux photographies de la section
       LA MATIÈRE sur la page La Maison.

       Fonctionnement :
       - La photographie de droite apparaît en premier.
       - Une pause sépare les deux révélations.
       - La photographie de gauche apparaît ensuite.
       - Le défilement contrôle directement l'opacité.
       - En remontant, l'animation s'inverse.

       Le script est chargé uniquement sur la page
       utilisant le slug "la-maison".

       file_exists() vérifie la présence du fichier
       avant de tenter de le charger.
    */

    if (is_page('la-maison')) {

        // Chemin physique du fichier JavaScript.
        $maison_js_path = get_template_directory()
            . '/js/maison-scroll.js';

        // Charge le script uniquement s'il existe.
        if (file_exists($maison_js_path)) {

            wp_enqueue_script(
                'miettes-maison-scroll',
                get_template_directory_uri()
                    . '/js/maison-scroll.js',
                array(),
                filemtime($maison_js_path),
                true
            );

        }
    }

}


/* ==========================================================
   ACTIVATION DU CHARGEMENT
   ==========================================================

   Le hook wp_enqueue_scripts indique à WordPress
   à quel moment charger nos ressources.

   Les fichiers sont automatiquement ajoutés
   aux pages du site utilisant le thème MIETTES.

   Le script de La Maison constitue une exception :
   il est chargé uniquement sur sa page dédiée.
*/

add_action(
    'wp_enqueue_scripts',
    'miettes_enqueue_assets'
);
