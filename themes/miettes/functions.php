<?php
/**
 * ==========================================================
 * MIETTES — FONCTIONS DU THÈME WORDPRESS
 * ==========================================================
 *
 * Gestion centralisée des ressources CSS et JavaScript.
 *
 * OBJECTIFS :
 * - Charger uniquement les scripts nécessaires.
 * - Conserver la compatibilité avec les IDs locaux.
 * - Préparer une future migration WordPress.
 * - Vérifier l'existence des fichiers.
 * - Actualiser automatiquement le cache.
 *
 * ARCHITECTURE :
 *
 * GLOBAL
 *   style.css
 *
 * ACCUEIL
 *   collection-scroll.js
 *   manifesto-scroll.js
 *
 * LA MAISON
 *   maison-scroll.js
 *
 * CONTACT
 *   contact-slot.js
 */


/* ==========================================================
   01 — FONCTION UTILITAIRE JAVASCRIPT
   ========================================================== */

/**
 * Charge un fichier JavaScript du thème.
 *
 * @param string $handle   Identifiant unique du script.
 * @param string $filename Nom du fichier JavaScript.
 *
 * Le fichier doit se trouver dans /js/.
 */
function miettes_enqueue_script($handle, $filename) {

    // Empêche l'utilisation de chemins arbitraires.
    if (
        !is_string($filename) ||
        basename($filename) !== $filename
    ) {
        return;
    }

    // Chemin physique du fichier.
    $file_path = get_theme_file_path(
        '/js/' . $filename
    );

    // Vérification de son existence.
    if (!is_file($file_path)) {
        return;
    }

    // URL publique du fichier.
    $file_url = get_theme_file_uri(
        '/js/' . $filename
    );

    // Version automatique pour éviter un cache obsolète.
    $version = filemtime($file_path);

    // Chargement du JavaScript dans le pied de page.
    wp_enqueue_script(
        $handle,
        $file_url,
        array(),
        $version,
        array(
            'in_footer' => true
        )
    );
}


/* ==========================================================
   02 — CHARGEMENT DES RESSOURCES
   ========================================================== */

/**
 * Charge les fichiers CSS et JavaScript
 * uniquement sur les pages concernées.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       A — CSS GLOBAL
       ------------------------------------------------------ */

    $css_path = get_stylesheet_directory()
        . '/style.css';

    // Version de secours.
    $css_version = wp_get_theme()->get('Version');

    if (is_file($css_path)) {
        $css_version = filemtime($css_path);
    }

    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        array(),
        $css_version
    );


    /* ------------------------------------------------------
       B — ACCUEIL
       ------------------------------------------------------

       is_front_page() fonctionne avec la page
       d'accueil configurée dans WordPress.

       is_home() n'est pas ajouté car il peut
       correspondre à une page d'articles distincte.
    */

    if (is_front_page()) {

        // Animation de la collection.
        miettes_enqueue_script(
            'miettes-collection-scroll',
            'collection-scroll.js'
        );

        // Animation du manifeste.
        miettes_enqueue_script(
            'miettes-manifesto-scroll',
            'manifesto-scroll.js'
        );
    }


    /* ------------------------------------------------------
       C — PAGE LA MAISON
       ------------------------------------------------------

       Compatible avec :
       - Le slug "la-maison".
       - Le template page-la-maison.php.

       WordPress reconnaît le template utilisé
       même lorsque les permaliens sont numériques.
    */

    if (
        is_page('la-maison') ||
        is_page_template('page-la-maison.php')
    ) {

        miettes_enqueue_script(
            'miettes-maison-scroll',
            'maison-scroll.js'
        );
    }


    /* ------------------------------------------------------
       D — PAGE CONTACT
       ------------------------------------------------------

       Compatible avec :
       - L'ID local 10.
       - Le slug "contact".
       - Le template page-contact.php.

       L'ID 10 est conservé temporairement
       pour ton environnement local.

       Après migration, il pourra être supprimé.
    */

    if (
        is_page(10) ||
        is_page('contact') ||
        is_page_template('page-contact.php')
    ) {

        miettes_enqueue_script(
            'miettes-contact-slot',
            'contact-slot.js'
        );
    }
}


/* ==========================================================
   03 — ACTIVATION WORDPRESS
   ========================================================== */

/**
 * WordPress appelle cette fonction au moment
 * de préparer les ressources du thème.
 */
add_action(
    'wp_enqueue_scripts',
    'miettes_enqueue_assets'
);
