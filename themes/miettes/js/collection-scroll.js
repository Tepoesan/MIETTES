
/* ==========================================================
   MIETTES — SCROLL HORIZONTAL DE LA COLLECTION
   ==========================================================

   Fonctionnement :

   1. L'utilisateur descend normalement dans la page.
   2. La collection arrive sous le header MIETTES.
   3. Elle reste visible grâce à position: sticky.
   4. Le scroll vertical déplace les créations vers la gauche.
   5. Une fois la dernière création atteinte,
      le défilement vertical reprend normalement.

   En remontant, le mouvement s'inverse.

   Aucun événement "wheel" n'est bloqué.
   Le défilement natif du navigateur est conservé.
*/

document.addEventListener("DOMContentLoaded", () => {

    /* ------------------------------------------------------
       1. RÉCUPÉRATION DES ÉLÉMENTS HTML
       ------------------------------------------------------ */

    const section = document.querySelector(".collection");
    const sticky = document.querySelector(".collection-sticky");
    const viewport = document.querySelector(".collection-viewport");
    const track = document.querySelector(".collection-track");
    const header = document.querySelector(".site-header");

    // Arrêt si la galerie n'est pas présente sur la page.
    if (!section || !sticky || !viewport || !track) {
        return;
    }

    /* ------------------------------------------------------
       2. VARIABLES ET PRÉFÉRENCES
       ------------------------------------------------------ */

    // Respecte les préférences de réduction des animations.
    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    // Distance horizontale totale à parcourir.
    let distance = 0;

    // Position du conteneur sticky sous le header.
    let stickyTop = 0;

    // Empêche les calculs répétés à chaque événement scroll.
    let animationPending = false;

    // L'animation est réservée aux écrans de plus de 600 px.
    function animationActive() {
        return window.innerWidth > 600 && !reducedMotion.matches;
    }

    // Limite une valeur entre deux bornes.
    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    /* ------------------------------------------------------
       3. CALCUL DES DIMENSIONS
       ------------------------------------------------------ */

    function calculateLayout() {

        // Efface les dimensions calculées précédemment.
        section.style.height = "";
        sticky.style.removeProperty("--collection-sticky-top");
        sticky.style.removeProperty("--collection-sticky-height");
        track.style.transform = "translate3d(0, 0, 0)";

        // Sur mobile ou en mode réduit, on laisse le scroll natif.
        if (!animationActive()) {
            distance = 0;
            return;
        }

        // Mesure la hauteur du header MIETTES.
        const headerHeight = header
            ? header.getBoundingClientRect().height
            : 0;

        // Mesure la barre d'administration WordPress si présente.
        const adminBar = document.querySelector("#wpadminbar");

        const adminHeight = adminBar
            ? adminBar.getBoundingClientRect().height
            : 0;

        // Positionne la collection sous les deux barres.
        stickyTop = headerHeight + adminHeight + 12;

        // Calcule l'espace vertical disponible.
        const availableHeight = Math.max(
            240,
            window.innerHeight - stickyTop - 16
        );

        // Transmet les dimensions au CSS.
        sticky.style.setProperty(
            "--collection-sticky-top",
            `${stickyTop}px`
        );

        sticky.style.setProperty(
            "--collection-sticky-height",
            `${availableHeight}px`
        );

        /*
         * Distance horizontale :
         *
         * largeur totale de la piste
         * moins largeur de la fenêtre visible.
         */
        distance = Math.max(
            0,
            track.scrollWidth - viewport.clientWidth
        );

        /*
         * Réserve la hauteur nécessaire :
         *
         * hauteur visible + distance horizontale.
         *
         * Cette hauteur permet au sticky de se libérer
         * automatiquement à la fin de la galerie.
         */
        section.style.height = `${availableHeight + distance}px`;

        // Met immédiatement la galerie à la bonne position.
        updatePosition();
    }

    /* ------------------------------------------------------
       4. ANIMATION HORIZONTALE
       ------------------------------------------------------ */

    function updatePosition() {

        if (!animationActive()) {
            return;
        }

        // Position absolue de la section dans la page.
        const sectionTop =
            section.getBoundingClientRect().top + window.scrollY;

        /*
         * Progression verticale depuis l'arrivée
         * de la collection sous le header.
         */
        const progress = clamp(
            window.scrollY - sectionTop + stickyTop,
            0,
            distance
        );

        /*
         * Transforme la progression verticale
         * en déplacement horizontal.
         *
         * 0 : première création.
         * distance : dernière création.
         */
        track.style.transform =
            `translate3d(${-progress}px, 0, 0)`;
    }

    /* ------------------------------------------------------
       5. OPTIMISATION DU SCROLL
       ------------------------------------------------------ */

    function onScroll() {

        if (animationPending) {
            return;
        }

        animationPending = true;

        requestAnimationFrame(() => {
            updatePosition();
            animationPending = false;
        });
    }

    /* ------------------------------------------------------
       6. ÉVÉNEMENTS
       ------------------------------------------------------ */

    // Déplacement horizontal lors du scroll.
    window.addEventListener("scroll", onScroll, {
        passive: true
    });

    // Recalcule si la taille de la fenêtre change.
    window.addEventListener("resize", calculateLayout);

    // Réagit aux préférences d'accessibilité.
    reducedMotion.addEventListener("change", calculateLayout);

    // Calcule les dimensions dès l'ouverture.
    calculateLayout();

    // Recalcule lorsque les images sont chargées.
    window.addEventListener("load", calculateLayout);

});
