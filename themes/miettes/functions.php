
<?php
/**
 * ==========================================================
 * MIETTES — FONCTIONS DU THÈME WORDPRESS
 * ==========================================================
 *
 * Gestion des ressources CSS et JavaScript.
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
 * 05 — contact-slot.js
 *      Défilement vertical du logo MIETTES
 *      sur la page Contact.
 *
 * Chaque animation possède son propre fichier
 * JavaScript pour faciliter la maintenance.
 *
 * L'ancien script ghost-logo.js n'est plus utilisé.
 */


/* ==========================================================
   CHARGEMENT DES RESSOURCES CSS ET JAVASCRIPT
   ========================================================== */

/**
 * Charge les ressources du thème.
 *
 * Cette fonction est exécutée grâce au hook
 * WordPress wp_enqueue_scripts.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       01 — FEUILLE DE STYLE PRINCIPALE
       ------------------------------------------------------

       get_stylesheet_uri() récupère l'URL du CSS.

       filemtime() utilise la date de modification
       comme version pour actualiser le cache.
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

       Anime les créations gastronomiques pendant
       le défilement vertical de la page d'accueil.

       Le script contrôle notamment :
       - La position des photographies.
       - Leur taille.
       - Leur opacité.
       - Leur superposition.
    */

    wp_enqueue_script(
        'miettes-collection-scroll',
        get_template_directory_uri()
            . '/js/collection-scroll.js',
        array(),
        filemtime(
            get_template_directory()
                . '/js/collection-scroll.js'
        ),
        true
    );


    /* ------------------------------------------------------
       03 — JAVASCRIPT : LE MANIFESTE
       ------------------------------------------------------

       Anime les deux tableaux éditoriaux :

       01 — La libre communication des pensées
            et des opinions...

       02 — Valeurs. Traditions.
            Le goût de l'essentiel.

       Le script fonctionne indépendamment
       de la Collection.
    */

    wp_enqueue_script(
        'miettes-manifesto-scroll',
        get_template_directory_uri()
            . '/js/manifesto-scroll.js',
        array(),
        filemtime(
            get_template_directory()
                . '/js/manifesto-scroll.js'
        ),
        true
    );


    /* ------------------------------------------------------
       04 — JAVASCRIPT : LA MAISON
       ------------------------------------------------------

       Anime les photographies de la section
       LA MATIÈRE sur la page La Maison.

       Fonctionnement :
       - Apparition de la photographie de droite.
       - Pause entre les deux révélations.
       - Apparition de la photographie de gauche.
       - Inversion de l'animation au scroll inverse.

       Ce script est chargé uniquement sur
       la page dont le slug est "la-maison".
    */

    if (is_page('la-maison')) {

        // Chemin physique du fichier JavaScript.
        $maison_js_path = get_template_directory()
            . '/js/maison-scroll.js';

        // Vérifie que le fichier existe.
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


    /* ------------------------------------------------------
       05 — JAVASCRIPT : CONTACT / SLOT MACHINE
       ------------------------------------------------------

       Anime le grand logo MIETTES sur la page Contact.

       Fonctionnement prévu :
       - Défilement vertical des inscriptions MIETTES.
       - Ralentissement progressif.
       - Léger rebond à l'arrêt.
       - Apparition progressive du reflet.

       L'animation dure environ deux secondes.

       Le JavaScript vérifie également la préférence
       d'accessibilité prefers-reduced-motion.

       Le script est chargé uniquement sur
       la page Contact, identifiée par l'ID 10.
    */

    if (is_page(10)) {

        // Chemin physique du script Contact.
        $contact_js_path = get_template_directory()
            . '/js/contact-slot.js';

        // Ne charge le script que s'il existe.
        if (file_exists($contact_js_path)) {

            wp_enqueue_script(
                'miettes-contact-slot',
                get_template_directory_uri()
                    . '/js/contact-slot.js',
                array(),
                filemtime($contact_js_path),
                true
            );

        }
    }

}


/* ==========================================================
   ACTIVATION DU CHARGEMENT
   ==========================================================

   WordPress appelle miettes_enqueue_assets()
   au moment du chargement des ressources du thème.

   Chargement global :
   - style.css
   - collection-scroll.js
   - manifesto-scroll.js

   Chargement conditionnel :
   - maison-scroll.js : page La Maison.
   - contact-slot.js : page Contact.

   Les scripts sont chargés dans le pied de page
   grâce au dernier argument true de
   wp_enqueue_script().
*/

add_action(
    'wp_enqueue_scripts',
    'miettes_enqueue_assets'
);
