
<?php
/**
 * ==========================================================
 * MIETTES — FOOTER DU THÈME
 * ==========================================================
 *
 * RESPONSABILITÉS :
 * 01 — Afficher la signature de la Maison.
 * 02 — Proposer les liens secondaires.
 * 03 — Afficher l'identité française.
 * 04 — Exécuter le hook wp_footer().
 *
 * Les classes CSS existantes sont conservées
 * afin de ne pas modifier le design.
 */


/* ==========================================================
   01 — PRÉPARATION DES DONNÉES
   ========================================================== */

// Année courante selon le fuseau horaire WordPress.
$current_year = wp_date('Y');

// Nom du site configuré dans WordPress.
$site_name = get_bloginfo('name');

// Recherche de la page Contact par son slug.
$contact_page = get_page_by_path('contact');

// Vérification de sa publication.
$contact_published = (
    $contact_page instanceof WP_Post &&
    $contact_page->post_status === 'publish'
);

// URL de Contact uniquement si la page est publiée.
$contact_url = $contact_published
    ? get_permalink($contact_page->ID)
    : '';

// URL de la politique de confidentialité
// définie dans les réglages WordPress.
$privacy_url = get_privacy_policy_url();
?>

<!-- ========================================================
     MIETTES — PIED DE PAGE
     ======================================================== -->

<footer class="site-footer">

    <div class="site-footer__inner">

        <!-- 01 — SIGNATURE DE LA MAISON -->
        <p class="site-footer__copyright">
            &copy; <?php echo esc_html($current_year); ?>
            <?php echo esc_html($site_name); ?>
            — LE GOÛT. SANS COMPROMIS.
        </p>

        <!-- 02 — NAVIGATION SECONDAIRE -->
        <?php if ($contact_url || $privacy_url) : ?>

            <nav
                class="site-footer__nav"
                aria-label="Navigation secondaire"
            >

                <!-- Lien vers Contact -->
                <?php if ($contact_url) : ?>
                    <a
                        href="<?php echo esc_url($contact_url); ?>"
                        class="site-footer__link"
                    >
                        Contact
                    </a>
                <?php endif; ?>

                <!-- Politique de confidentialité -->
                <?php if ($privacy_url) : ?>
                    <a
                        href="<?php echo esc_url($privacy_url); ?>"
                        class="site-footer__link"
                    >
                        Politique de confidentialité
                    </a>
                <?php endif; ?>

            </nav>

        <?php endif; ?>

        <!-- 03 — IDENTITÉ FRANÇAISE -->
        <div class="site-footer__origin">

            <!--
                Drapeau tricolore décoratif.
                Les trois bandes sont dessinées en CSS.

                aria-hidden="true" empêche les lecteurs
                d'écran de lire les éléments décoratifs.
            -->
            <span
                class="site-footer__flag"
                aria-hidden="true"
            >
                <span class="flag-blue"></span>
                <span class="flag-white"></span>
                <span class="flag-red"></span>
            </span>

            <span class="site-footer__country">
                FRANCE
            </span>

        </div>

    </div>

</footer>

<?php
/**
 * ==========================================================
 * 04 — HOOK WORDPRESS
 * ==========================================================
 *
 * Indispensable pour les scripts chargés dans le footer
 * et pour les extensions WordPress.
 */
wp_footer();
?>

</body>
</html>
