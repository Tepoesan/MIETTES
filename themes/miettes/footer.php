
<?php
/**
 * ==========================================================
 * MIETTES — FOOTER DU THÈME
 * ==========================================================
 *
 * Affiche :
 * 01 — La signature de la Maison.
 * 02 — Les liens Contact et Confidentialité.
 * 03 — L'identité française et son drapeau.
 *
 * wp_footer() est indispensable au fonctionnement
 * de WordPress et des extensions.
 */
?>

<footer class="site-footer">

    <div class="site-footer__inner">

        <!-- ==========================================
             01 — SIGNATURE DE LA MAISON
             ========================================== -->

        <p class="site-footer__copyright">
            &copy; <?php echo esc_html(date('Y')); ?>
            <?php bloginfo('name'); ?> — LE GOÛT. SANS COMPROMIS.
        </p>


        <!-- ==========================================
             02 — NAVIGATION DU FOOTER
             ========================================== -->

        <nav
            class="site-footer__nav"
            aria-label="Navigation secondaire"
        >

            <!--
                Lien vers la page Contact.
                get_page_by_path() vérifie son existence.
            -->
            <?php
            $contact_page = get_page_by_path('contact');

            if ($contact_page && $contact_page->post_status === 'publish') :
            ?>
                <a
                    href="<?php echo esc_url(
                        get_permalink($contact_page->ID)
                    ); ?>"
                    class="site-footer__link"
                >
                    Contact
                </a>
            <?php endif; ?>


            <!--
                Lien vers la politique de confidentialité
                sélectionnée dans les réglages WordPress.
            -->
            <?php
            $privacy_url = get_privacy_policy_url();

            if ($privacy_url) :
            ?>
                <a
                    href="<?php echo esc_url($privacy_url); ?>"
                    class="site-footer__link"
                >
                     Politique de confidentialité
                </a>
            <?php endif; ?>

        </nav>


        <!-- ==========================================
             03 — IDENTITÉ FRANÇAISE
             ========================================== -->

        <div class="site-footer__origin">

            <!--
                Drapeau décoratif composé de trois bandes CSS.
                aria-hidden évite sa lecture inutile
                par les lecteurs d'écran.
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
 * Permet à WordPress et aux extensions
 * de charger leurs scripts avant la fin du document.
 */
wp_footer();
?>

</body>
</html>
