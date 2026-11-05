
<?php
/**
 * ==========================================================
 * MIETTES — PAGE CONTACT
 * ==========================================================
 *
 * Template spécifique à la page Contact.
 *
 * COMPOSITION :
 * 01 — Hero : logo MIETTES animé et reflet.
 * 02 — En-tête éditorial CONTACT / ©27.
 * 03 — Coordonnées et présentation de la maison.
 * 04 — Photographie gastronomique.
 *
 * OPTIMISATIONS :
 * - Image WebP avec PNG de secours.
 * - Dimensions explicites de l'image.
 * - Chargement différé de la photographie.
 * - URL générée et échappée avec WordPress.
 * - Conservation des classes CSS et attributs JS.
 *
 * IMPORTANT :
 * Les coordonnées sont fictives et utilisées
 * uniquement pour ce projet de démonstration.
 */

// Charge l'en-tête global du thème.
get_header();
?>

<main id="main-content" class="miettes-contact">

    <!-- =====================================================
         01 — HERO / LOGO MIETTES ANIMÉ
         ===================================================== -->

    <section
        class="contact-slot"
        aria-label="Maison MIETTES"
    >

        <!-- Signature au-dessus du logo -->
        <p class="contact-slot__eyebrow">
            MAISON DE PAIN PERDU · PARIS
        </p>

        <!--
            Fenêtre de défilement du logo.

            Les classes suivantes sont utilisées
            par contact-slot.js et style.css.

            On les conserve pour préserver
            le fonctionnement de l'animation.
        -->
        <div class="contact-slot__window">

            <div
                class="contact-slot__reel"
                aria-hidden="true"
            >

                <span>MIETTES</span>
                <span>MIETTES</span>
                <span>MIETTES</span>
                <span>MIETTES</span>

            </div>

        </div>

        <!-- Reflet inversé du logo -->
        <div
            class="contact-slot__reflection"
            aria-hidden="true"
        >
            MIETTES
        </div>

        <!-- Nom accessible aux lecteurs d'écran -->
        <span class="screen-reader-text">
            MIETTES — Maison de pain perdu
        </span>

    </section>


    <!-- =====================================================
         02 — COMPOSITION ÉDITORIALE
         ===================================================== -->

    <section
        class="contact-editorial"
        aria-labelledby="contact-title"
    >

        <!-- En-tête monumental -->
        <div class="contact-editorial__heading">

            <div class="contact-editorial__heading-main">

                <span class="contact-editorial__eyebrow">
                    ÉCRIVEZ-NOUS
                </span>

                <h1
                    id="contact-title"
                    class="contact-editorial__title"
                >
                    CONTACT
                </h1>

            </div>

            <!-- Numéro d'édition graphique -->
            <span
                class="contact-editorial__edition"
                aria-label="Édition 2027"
            >
                ©27
            </span>

        </div>


        <!-- =================================================
             03 — GRILLE DES INFORMATIONS
             ================================================= -->

        <div class="contact-editorial__body">

            <!-- =============================================
                 COLONNE 01 — COORDONNÉES
                 ============================================= -->

            <div class="contact-editorial__details">

                <div class="contact-editorial__detail">

                    <h2>
                        PRESSE & COLLABORATIONS
                    </h2>

                    <a href="mailto:presse@miettes.fr">
                        presse@miettes.fr
                    </a>

                </div>

                <div class="contact-editorial__detail">

                    <h2>
                        PARTENARIATS
                    </h2>

                    <a href="mailto:partenariat@miettes.fr">
                        partenariat@miettes.fr
                    </a>

                </div>

                <div class="contact-editorial__detail">

                    <h2>
                        INFORMATIONS GÉNÉRALES
                    </h2>

                    <a href="mailto:contact@miettes.fr">
                        contact@miettes.fr
                    </a>

                </div>

            </div>


            <!-- =============================================
                 COLONNE 02 — TEXTE ÉDITORIAL
                 ============================================= -->

            <div class="contact-editorial__story">

                <h2 class="contact-editorial__story-title">
                    UNE QUESTION, UN PROJET,
                    UNE ENVIE DE COLLABORATION ?
                </h2>

                <p class="contact-editorial__story-text">
                    Nous sommes à votre écoute pour toute
                    demande, proposition ou simple curiosité
                    autour de l'univers MIETTES.
                </p>

                <!-- Localisation de la maison -->
                <div class="contact-editorial__address">

                    <span
                        class="contact-editorial__dash"
                        aria-hidden="true"
                    ></span>

                    <h3>
                        LA MAISON MIETTES
                    </h3>

                    <p>
                        PARIS — FRANCE
                    </p>

                </div>

            </div>


            <!-- =============================================
                 COLONNE 03 — PHOTOGRAPHIE
                 ============================================= -->

            <figure class="contact-editorial__visual">

                <!--
                    Photographie gastronomique de MIETTES.

                    WebP :
                    Format optimisé chargé en priorité.

                    PNG :
                    Format original conservé en secours.

                    get_theme_file_uri() :
                    Génère l'URL de l'image du thème.

                    esc_url() :
                    Échappe l'URL pour son affichage HTML.

                    width / height :
                    Réservent les proportions de l'image
                    pour limiter les décalages de mise en page.

                    loading="lazy" :
                    Diffère le chargement de cette image
                    lorsqu'elle est hors de l'écran.
                -->


                <!--
                    MIETTES — CONTACT : LA MATIÈRE

                    Photographie optimisée au format WebP.

                    get_theme_file_uri() génère l'URL du fichier.
                    esc_url() sécurise son affichage HTML.

                    Les dimensions 1254 × 1254 sont conservées
                    pour limiter les décalages de mise en page.

                    loading="lazy" diffère le chargement de l'image.
                    decoding="async" permet un décodage asynchrone.
                -->
                <img
                    src="<?php echo esc_url(
                        get_theme_file_uri('images/contact-matiere.webp')
                    ); ?>"
                    alt="Sculpture de beurre sur une pierre brute"
                    width="1254"
                    height="1254"
                    loading="lazy"
                    decoding="async"
                >


            </figure>

        </div>

    </section>

</main>

<?php
/**
 * ==========================================================
 * FOOTER GLOBAL
 * ==========================================================
 *
 * Charge footer.php.
 *
 * L'ancienne signature éditoriale en double
 * et l'ancien contenu de l'éditeur WordPress
 * ne sont pas affichés dans ce template.
 */
get_footer();
?>
