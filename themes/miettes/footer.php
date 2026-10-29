
<?php
/**
 * Footer du thème MIETTES.
 *
 * Affiche la signature de la Maison et son identité française.
 * wp_footer() est indispensable au bon fonctionnement de WordPress.
 */
?>

<footer class="site-footer">

    <div class="site-footer__inner">

        <!-- Signature : année automatique et nom du site WordPress -->
        <p class="site-footer__copyright">
            &copy; <?php echo esc_html(date('Y')); ?>
            <?php bloginfo('name'); ?> — LE GOÛT. SANS COMPROMIS.
        </p>

        <!-- Identité française : drapeau tricolore et pays -->
        <div class="site-footer__origin">

            <!--
                Drapeau décoratif composé de trois bandes CSS.
                aria-hidden évite sa lecture inutile par les lecteurs d'écran.
            -->
            <span class="site-footer__flag" aria-hidden="true">
                <span class="flag-blue"></span>
                <span class="flag-white"></span>
                <span class="flag-red"></span>
            </span>

            <span class="site-footer__country">FRANCE</span>

        </div>

    </div>

</footer>

<?php
// Permet à WordPress et aux extensions de charger leurs scripts.
wp_footer();
?>

</body>
</html>
