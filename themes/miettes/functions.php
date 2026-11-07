
<?php
/**
 * ==========================================================
 * MIETTES â€” FONCTIONS DU THÃˆME WORDPRESS
 * ==========================================================
 *
 * Gestion centralisÃ©e des ressources CSS et JavaScript.
 *
 * OBJECTIFS :
 * - Organiser les feuilles CSS en composants.
 * - Respecter l'ordre de chargement des styles.
 * - Charger les animations uniquement si nÃ©cessaire.
 * - Ã‰viter les identifiants WordPress propres Ã  une installation.
 * - VÃ©rifier l'existence des fichiers avant leur chargement.
 * - Actualiser automatiquement le cache aprÃ¨s modification.
 *
 * ARCHITECTURE CSS :
 *
 * assets/css/base.css
 *   Variables, reset, styles globaux et accessibilitÃ©.
 *
 * assets/css/header.css
 *   Header, logo, navigation et barre admin WordPress.
 *
 * style.css
 *   En-tÃªte du thÃ¨me et composants encore Ã  migrer.
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
   01 â€” FONCTION UTILITAIRE JAVASCRIPT
   ========================================================== */

/**
 * Charge un fichier JavaScript du thÃ¨me.
 *
 * @param string $handle   Identifiant unique du script.
 * @param string $filename Nom du fichier JavaScript.
 *
 * Les scripts sont recherchÃ©s dans le dossier /js/.
 */
function miettes_enqueue_script($handle, $filename) {

    // VÃ©rifie le type et empÃªche les chemins arbitraires.
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

    // Version basÃ©e sur la derniÃ¨re modification.
    // Permet au navigateur de rÃ©cupÃ©rer les changements.
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
   02 â€” CHARGEMENT DES RESSOURCES
   ========================================================== */

/**
 * Charge les feuilles CSS et les scripts JavaScript
 * selon la page WordPress actuellement affichÃ©e.
 */
function miettes_enqueue_assets() {

    /* ------------------------------------------------------
       A â€” ARCHITECTURE CSS
       ------------------------------------------------------

       ORDRE DE CHARGEMENT :

       1. base.css
          Design system, reset et styles globaux.

       2. header.css
          En-tÃªte, logo et navigation.

       3. style.css
          Composants restants et surcharges responsive.

       Les dÃ©pendances WordPress garantissent cet ordre
       lorsque les fichiers concernÃ©s existent.
    */


    /* ------------------------------------------------------
       A.1 â€” BASE CSS
       ------------------------------------------------------ */

    // Chemin physique de la feuille CSS de base.
    $base_css_path = get_theme_file_path(
        '/assets/css/base.css'
    );

    // VÃ©rifie la prÃ©sence du fichier.
    $base_css_exists = is_file($base_css_path);

    if ($base_css_exists) {

        // Charge les fondations graphiques du thÃ¨me.
        wp_enqueue_style(
            'miettes-base',
            get_theme_file_uri('/assets/css/base.css'),
            array(),
            filemtime($base_css_path)
        );
    }


    /* ------------------------------------------------------
       A.2 â€” HEADER CSS
       ------------------------------------------------------ */

    // Chemin physique du composant header.
    $header_css_path = get_theme_file_path(
        '/assets/css/header.css'
    );

    // VÃ©rifie que le fichier a bien Ã©tÃ© crÃ©Ã©.
    $header_css_exists = is_file($header_css_path);

    if ($header_css_exists) {

        // Le header dÃ©pend de base.css uniquement
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
    A.2 BIS â€” FOOTER CSS
    ------------------------------------------------------

    Styles communs du pied de page MIETTES.

    ChargÃ©s sur toutes les pages, car le footer
    est un composant global du thÃ¨me.
    */

    $footer_css_path = get_theme_file_path(
        '/assets/css/footer.css'
    );

    $footer_css_exists = is_file($footer_css_path);

    if ($footer_css_exists) {

        // Le footer utilise les variables dÃ©finies dans base.css.
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
       A.3 â€” STYLE CSS PRINCIPAL
       ------------------------------------------------------

       WordPress utilise Ã©galement style.css
       pour identifier le thÃ¨me.

       Pendant la migration, ce fichier conserve
       les composants qui n'ont pas encore Ã©tÃ©
       dÃ©placÃ©s vers assets/css/.
    */

    // Chemin physique de style.css.
    $css_path = get_stylesheet_directory()
        . '/style.css';

    // Actualise la version aprÃ¨s chaque modification.
    $css_version = is_file($css_path)
        ? filemtime($css_path)
        : wp_get_theme()->get('Version');

    // PrÃ©pare les dÃ©pendances dans le bon ordre.
    $css_dependencies = array();

    if ($base_css_exists) {
        $css_dependencies[] = 'miettes-base';
    }

    if ($header_css_exists) {
        $css_dependencies[] = 'miettes-header';
    }

    // Charge la feuille principale aprÃ¨s les composants.
    wp_enqueue_style(
        'miettes-style',
        get_stylesheet_uri(),
        $css_dependencies,
        $css_version
    );

    /* ------------------------------------------------------
    A.3 â€” CSS SPÃ‰CIFIQUE Ã€ L'ACCUEIL
    ------------------------------------------------------ */

    if (is_front_page()) {

        $home_css_path = get_theme_file_path('/assets/css/home.css');

        if (is_file($home_css_path)) {

            wp_enqueue_style(
                'miettes-home',
                get_theme_file_uri('/assets/css/home.css'),
                array('miettes-style'),
                filemtime($home_css_path)
            );
        }
    }

    /* ------------------------------------------------------
       A.4 â€” COLLECTION CINEMATIQUE
       ------------------------------------------------------ */
    if (is_front_page()) {
        $collection_css_path = get_theme_file_path(
            '/assets/css/collection.css'
        );
        if (is_file($collection_css_path)) {
            wp_enqueue_style(
                'miettes-collection',
                get_theme_file_uri('/assets/css/collection.css'),
                array('miettes-home'),
                filemtime($collection_css_path)
            );
        }
    }

    /* ------------------------------------------------------
       A.5 â€” MANIFESTE
       ------------------------------------------------------ */
    if (is_front_page()) {
        $manifesto_css_path = get_theme_file_path(
            '/assets/css/manifesto.css'
        );
        if (is_file($manifesto_css_path)) {
            wp_enqueue_style(
                'miettes-manifesto',
                get_theme_file_uri('/assets/css/manifesto.css'),
                array('miettes-collection'),
                filemtime($manifesto_css_path)
            );
        }
    }
    /* ------------------------------------------------------
       A.6 â€” CSS LA MAISON
       ------------------------------------------------------ */
    if (
        is_page('la-maison') ||
        is_page_template('page-la-maison.php')
    ) {
        $maison_css_path = get_theme_file_path(
            '/assets/css/maison.css'
        );
        if (is_file($maison_css_path)) {
            wp_enqueue_style(
                'miettes-maison',
                get_theme_file_uri('/assets/css/maison.css'),
                array('miettes-style'),
                filemtime($maison_css_path)
            );
        }
    }
    /* ------------------------------------------------------
       B â€” PAGE D'ACCUEIL
       ------------------------------------------------------

       is_front_page() dÃ©tecte la page d'accueil
       configurÃ©e dans les rÃ©glages WordPress.

       Les animations suivantes ne sont chargÃ©es
       que sur cette page.
    */

    if (is_front_page()) {

        // DÃ©filement horizontal de la collection.
        miettes_enqueue_script(
            'miettes-collection-scroll',
            'collection-scroll.js'
        );

        // Apparition animÃ©e du manifeste.
        miettes_enqueue_script(
            'miettes-manifesto-scroll',
            'manifesto-scroll.js'
        );
    }


    /* ------------------------------------------------------
       C â€” PAGE LA MAISON
       ------------------------------------------------------

       DÃ©tection par :
       - le slug "la-maison" ;
       - le template page-la-maison.php.

       Aucun identifiant WordPress local n'est utilisÃ©.
    */

    if (
        is_page('la-maison') ||
        is_page_template('page-la-maison.php')
    ) {

        // Animations au dÃ©filement de La Maison.
        miettes_enqueue_script(
            'miettes-maison-scroll',
            'maison-scroll.js'
        );
    }


    /* ------------------------------------------------------
       CSS CONTACT â€” CHARGEMENT CONDITIONNEL
       ------------------------------------------------------ */
    if (
        is_page('contact') ||
        is_page_template('page-contact.php')
    ) {
        $contact_css_path = get_theme_file_path(
            '/assets/css/contact.css'
        );
        if (is_file($contact_css_path)) {
            wp_enqueue_style(
                'miettes-contact-css',
                get_theme_file_uri('/assets/css/contact.css'),
                array('miettes-style'),
                filemtime($contact_css_path)
            );
        }
    }
    /* ------------------------------------------------------
       D â€” PAGE CONTACT
       ------------------------------------------------------

       DÃ©tection par :
       - le slug "contact" ;
       - le template page-contact.php.

       L'ancienne condition is_page(10)
       n'est plus utilisÃ©e.
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
   03 â€” ACTIVATION WORDPRESS
   ========================================================== */

/**
 * Enregistre notre fonction de chargement
 * sur le hook officiel wp_enqueue_scripts.
 *
 * WordPress appelle automatiquement cette fonction
 * pendant la prÃ©paration des ressources de la page.
 */
add_action(
    'wp_enqueue_scripts',
    'miettes_enqueue_assets'
);

/**
 * MIETTES â€” Support des fonctionnalitÃ©s WordPress.
 *
 * Confie Ã  WordPress la gÃ©nÃ©ration de la balise <title>
 * dans l'en-tÃªte HTML.
 */
function miettes_theme_setup() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'miettes_theme_setup');

/* ==========================================================
   05 â€” SEO : TITRES DES PAGES
   ========================================================== */
/**
 * MIETTES â€” Personnalisation des titres SEO.
 *
 * DÃ©finit un titre spÃ©cifique pour chaque page.
 * Supprime le nom du site ajoutÃ© automatiquement
 * par WordPress afin d'Ã©viter les doublons.
 */
function miettes_seo_document_title($title) {

    if (is_front_page()) {

        $title['title'] = 'MIETTES â€” Maison de Pain Perdu Ã  Paris';

    } elseif (is_page('la-maison')) {

        $title['title'] = 'La Maison â€” Lâ€™univers MIETTES';

    } elseif (is_page('contact')) {

        $title['title'] = 'Contact â€” MIETTES';

    } elseif (is_page('politique-de-confidentialite')) {

        $title['title'] = 'Politique de confidentialitÃ© â€” MIETTES';

    } else {

        // Conserve les titres WordPress pour les autres pages.
        return $title;
    }

    // Ã‰vite l'ajout automatique de Â« â€“ MIETTES Â».
    unset($title['site']);
    unset($title['tagline']);

    return $title;
}

add_filter('document_title_parts', 'miettes_seo_document_title');

/* ==========================================================
   06 â€” SEO : MÃ‰TA-DESCRIPTIONS
   ========================================================== */
/**
 * Ajoute une mÃ©ta-description spÃ©cifique aux pages MIETTES.
 * Le contenu est Ã©chappÃ© pour sÃ©curiser le HTML.
 */
function miettes_seo_meta_description() {
    $description = '';
    if (is_front_page()) {
        $description = 'DÃ©couvrez MIETTES, maison parisienne de pain perdu rÃ©inventÃ©. Une expÃ©rience gastronomique singuliÃ¨re entre tradition et audace.';
    } elseif (is_page('la-maison')) {
        $description = 'Entrez dans lâ€™univers de MIETTES. Une maison oÃ¹ le pain perdu devient une crÃ©ation gastronomique, entre savoir-faire et libertÃ©.';
    } elseif (is_page('contact')) {
        $description = 'Contactez MIETTES, maison de pain perdu Ã  Paris. Une question, une demande ou simplement lâ€™envie de dÃ©couvrir notre univers ?';
    } elseif (is_page('politique-de-confidentialite')) {
        $description = 'Consultez la politique de confidentialitÃ© de MIETTES et dÃ©couvrez les informations relatives Ã  la protection de vos donnÃ©es personnelles.';
    }
    if ($description !== '') {
        echo '<meta name="description" content="' .
            esc_attr($description) .
            '">' . "\n";
    }
}
add_action('wp_head', 'miettes_seo_meta_description', 5);

/* ==========================================================
   07 â€” SEO : OPEN GRAPH
   ========================================================== */
/**
 * PrÃ©pare les aperÃ§us des liens MIETTES sur les rÃ©seaux sociaux.
 */
function miettes_open_graph_tags() {
    // Pages disposant d'une mÃ©ta-description personnalisÃ©e.
    $descriptions = array(
        'accueil' => 'DÃ©couvrez MIETTES, maison parisienne de pain perdu rÃ©inventÃ©. Une expÃ©rience gastronomique singuliÃ¨re entre tradition et audace.',
        'la-maison' => 'Entrez dans lâ€™univers de MIETTES. Une maison oÃ¹ le pain perdu devient une crÃ©ation gastronomique, entre savoir-faire et libertÃ©.',
        'contact' => 'Contactez MIETTES, maison de pain perdu Ã  Paris. Une question, une demande ou simplement lâ€™envie de dÃ©couvrir notre univers ?',
        'politique-de-confidentialite' => 'Consultez la politique de confidentialitÃ© de MIETTES et dÃ©couvrez les informations relatives Ã  la protection de vos donnÃ©es personnelles.'
    );
    // Identifie la page consultÃ©e.
    if (is_front_page()) {
        $key = 'accueil';
    } elseif (is_page()) {
        $key = get_post_field('post_name', get_queried_object_id());
    } else {
        return;
    }
    if (!isset($descriptions[$key])) {
        return;
    }
    // RÃ©utilise le titre SEO WordPress.
    $title = wp_get_document_title();
    // URL de la page, sans paramÃ¨tres de test.
    $url = is_front_page() ? home_url('/') : get_permalink();
    // Image commune Ã  toutes les pages.
    $image = get_template_directory_uri() . '/images/og-miettes.png';
    echo "\n<!-- MIETTES â€” Open Graph -->\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="MIETTES">' . "\n";
    echo '<meta property="og:locale" content="fr_FR">' . "\n";
    echo '<meta property="og:title" content="' .
        esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' .
        esc_attr($descriptions[$key]) . '">' . "\n";
    echo '<meta property="og:url" content="' .
        esc_url($url) . '">' . "\n";
    echo '<meta property="og:image" content="' .
        esc_url($image) . '">' . "\n";
    echo '<meta property="og:image:width" content="1734">' . "\n";
    echo '<meta property="og:image:height" content="907">' . "\n";
}
add_action('wp_head', 'miettes_open_graph_tags', 6);