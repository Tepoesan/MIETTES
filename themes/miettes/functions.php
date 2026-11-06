
<?php
/**
 * ==========================================================
 * MIETTES — FONCTIONS DU THÈME WORDPRESS
 * ==========================================================
 *
 * Gestion centralisée des ressources CSS et JavaScript.
 *
 * OBJECTIFS :
 * - Organiser les feuilles CSS en composants.
 * - Respecter l'ordre de chargement des styles.
 * - Charger les animations uniquement si nécessaire.
 * - Éviter les identifiants WordPress propres à une installation.
 * - Vérifier l'existence des fichiers avant leur chargement.
 * - Actualiser automatiquement le cache après modification.
 *
 * ARCHITECTURE CSS :
 *
 * assets/css/base.css
 *   Variables, reset, styles globaux et accessibilité.
 *
 * assets/css/header.css
 *   Header, logo, navigation et barre admin WordPress.
 *
 * style.css
 *   En-tête du thème et composants encore à migrer.
 *   Conserve temporairement les adaptations responsive.
 *
 * JAVASCRIPT :
 *
 * ACCUEIL
 *   js/collection-scroll.js
 *   js/manifesto-scroll.js
 *
 * LA MAISON
 *   js/maison-scroll.js
 *
 * CONTACT
 *   js/contact-slot.js
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
 * Les scripts sont recherchés dans le dossier /js/.
 */
function miettes_enqueue_script($handle, $filename) {

    // Vérifie le type et empêche les chemins arbitraires.
    if (
        !is_string($filename) ||
        basename($filename) !== $filename
    ) {
        return;
    }

    // Chemin physique du fichier JavaScript.
    $file_path = get_theme_file_path(
        '/js/' . $filename
    );

    // Ne charge pas un fichier inexistant.
    if (!is_file($file_path)) {
        return;
    }

    // URL publique du fichier.
    $file_url = get_theme_file_uri(
        '/js/' . $filename
    );

    // Version basée sur la dernière modification.
    // Permet au navigateur de récupérer les changements.
    $version = filemtime($file_path);

    // Charge le script dans le pied de page.
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
 * Charge les feuilles CSS et les scripts JavaScript
 * selon la page WordPress actuellement affichée.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       A — ARCHITECTURE CSS
       ------------------------------------------------------

       ORDRE DE CHARGEMENT :

       1. base.css
          Design system, reset et styles globaux.

       2. header.css
          En-tête, logo et navigation.

       3. style.css
          Composants restants et surcharges responsive.

       Les dépendances WordPress garantissent cet ordre
       lorsque les fichiers concernés existent.
    */


    /* ------------------------------------------------------
       A.1 — BASE CSS
       ------------------------------------------------------ */

    // Chemin physique de la feuille CSS de base.
    $base_css_path = get_theme_file_path(
        '/assets/css/base.css'
    );

    // Vérifie la présence du fichier.
    $base_css_exists = is_file($base_css_path);

    if ($base_css_exists) {

        // Charge les fondations graphiques du thème.
        wp_enqueue_style(
            'miettes-base',
            get_theme_file_uri('/assets/css/base.css'),
            array(),
            filemtime($base_css_path)
        );
    }


    /* ------------------------------------------------------
       A.2 — HEADER CSS
       ------------------------------------------------------ */

    // Chemin physique du composant header.
    $header_css_path = get_theme_file_path(
        '/assets/css/header.css'
    );

    // Vérifie que le fichier a bien été créé.
    $header_css_exists = is_file($header_css_path);

    if ($header_css_exists) {

        // Le header dépend de base.css uniquement
        // lorsque cette feuille est disponible.
        $header_dependencies = $base_css_exists
            ? array('miettes-base')
            : array();

        // Charge les styles du header.
        wp_enqueue_style(
            'miettes-header',
            get_theme_file_uri('/assets/css/header.css'),
            $header_dependencies,
            filemtime($header_css_path)
        );
    }

    /* ------------------------------------------------------
    A.2 BIS — FOOTER CSS
    ------------------------------------------------------

    Styles communs du pied de page MIETTES.

    Chargés sur toutes les pages, car le footer
    est un composant global du thème.
    */

    $footer_css_path = get_theme_file_path(
        '/assets/css/footer.css'
    );

    $footer_css_exists = is_file($footer_css_path);

    if ($footer_css_exists) {

        // Le footer utilise les variables définies dans base.css.
        $footer_dependencies = $base_css_exists
            ? array('miettes-base')
            : array();

        wp_enqueue_style(
            'miettes-footer',
            get_theme_file_uri('/assets/css/footer.css'),
            $footer_dependencies,
            filemtime($footer_css_path)
        );
    }

    /* ------------------------------------------------------
       A.3 — STYLE CSS PRINCIPAL
       ------------------------------------------------------

       WordPress utilise également style.css
       pour identifier le thème.

       Pendant la migration, ce fichier conserve
       les composants qui n'ont pas encore été
       déplacés vers assets/css/.
    */

    // Chemin physique de style.css.
    $css_path = get_stylesheet_directory()
        . '/style.css';

    // Actualise la version après chaque modification.
    $css_version = is_file($css_path)
        ? filemtime($css_path)
        : wp_get_theme()->get('Version');

    // Prépare les dépendances dans le bon ordre.
    $css_dependencies = array();

    if ($base_css_exists) {
        $css_dependencies[] = 'miettes-base';
    }

    if ($header_css_exists) {
        $css_dependencies[] = 'miettes-header';
    }

    // Charge la feuille principale après les composants.
    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        $css_dependencies,
        $css_version
    );


    /* ------------------------------------------------------
       B — PAGE D'ACCUEIL
       ------------------------------------------------------

       is_front_page() détecte la page d'accueil
       configurée dans les réglages WordPress.

       Les animations suivantes ne sont chargées
       que sur cette page.
    */

    if (is_front_page()) {

        // Défilement horizontal de la collection.
        miettes_enqueue_script(
            'miettes-collection-scroll',
            'collection-scroll.js'
        );

        // Apparition animée du manifeste.
        miettes_enqueue_script(
            'miettes-manifesto-scroll',
            'manifesto-scroll.js'
        );
    }


    /* ------------------------------------------------------
       C — PAGE LA MAISON
       ------------------------------------------------------

       Détection par :
       - le slug "la-maison" ;
       - le template page-la-maison.php.

       Aucun identifiant WordPress local n'est utilisé.
    */

    if (
        is_page('la-maison') ||
        is_page_template('page-la-maison.php')
    ) {

        // Animations au défilement de La Maison.
        miettes_enqueue_script(
            'miettes-maison-scroll',
            'maison-scroll.js'
        );
    }


    /* ------------------------------------------------------
       D — PAGE CONTACT
       ------------------------------------------------------

       Détection par :
       - le slug "contact" ;
       - le template page-contact.php.

       L'ancienne condition is_page(10)
       n'est plus utilisée.
    */

    if (
        is_page('contact') ||
        is_page_template('page-contact.php')
    ) {

        // Animation typographique de la page Contact.
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
 * Enregistre notre fonction de chargement
 * sur le hook officiel wp_enqueue_scripts.
 *
 * WordPress appelle automatiquement cette fonction
 * pendant la préparation des ressources de la page.
 */
add_action(
    'wp_enqueue_scripts',
    'miettes_enqueue_assets'
);
