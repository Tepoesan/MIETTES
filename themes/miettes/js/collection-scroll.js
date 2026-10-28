
/* ==========================================================
   MIETTES — CARROUSEL CINÉMATIQUE
   ==========================================================

   Objectif :
   - Une grande création au premier plan, à gauche.
   - Les créations suivantes en retrait, à droite.
   - Une transition progressive au scroll vertical.
   - Les légendes restent visibles sous les images.
   - Le scroll naturel du navigateur est conservé.

   Sur mobile ou en mode "réduction des animations",
   on conserve une galerie horizontale classique.
*/

document.addEventListener("DOMContentLoaded", () => {

    /* ------------------------------------------------------
       1. RÉCUPÉRATION DES ÉLÉMENTS HTML
       ------------------------------------------------------ */

    const section = document.querySelector(".collection");
    const sticky = document.querySelector(".collection-sticky");
    const intro = document.querySelector(".collection-intro");
    const viewport = document.querySelector(".collection-viewport");
    const track = document.querySelector(".collection-track");
    const items = [...document.querySelectorAll(".collection-item")];
    const header = document.querySelector(".site-header");

    // On arrête si un élément essentiel est absent.
    if (
        !section ||
        !sticky ||
        !intro ||
        !viewport ||
        !track ||
        !items.length
    ) {
        return;
    }

    /* ------------------------------------------------------
       2. CONFIGURATION
       ------------------------------------------------------ */

    // Préférence d'accessibilité du navigateur.
    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    // Distance verticale nécessaire pour changer de création.
    let stepDistance = 0;

    // Distance totale de notre animation.
    let totalDistance = 0;

    // Décalage sous le header et la barre WordPress.
    let stickyTop = 0;

    // Empêche de lancer plusieurs animations simultanément.
    let animationPending = false;

    /*
     * L'animation cinématique fonctionne sur ordinateur.
     * Sur mobile, on utilise le défilement horizontal natif.
     */
    function animationActive() {
        return window.innerWidth > 600 && !reducedMotion.matches;
    }

    // Limite une valeur entre un minimum et un maximum.
    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    /*
     * Interpolation linéaire :
     *
     * lerp(0, 100, 0.5) retourne 50.
     *
     * Cette fonction permet de faire évoluer
     * progressivement la position, la taille
     * et l'opacité de chaque création.
     */
    function lerp(start, end, progress) {
        return start + (end - start) * progress;
    }

    /* ------------------------------------------------------
       3. CALCUL DES DIMENSIONS
       ------------------------------------------------------ */

    function calculateLayout() {

        // Réinitialise les anciennes dimensions.
        section.style.height = "";

        sticky.style.removeProperty(
            "--collection-sticky-top"
        );

        sticky.style.removeProperty(
            "--collection-sticky-height"
        );

        viewport.style.removeProperty(
            "--collection-viewport-height"
        );

        // L'ancienne translation horizontale est supprimée.
        track.style.transform = "";

        /*
         * Sur mobile ou avec les animations réduites,
         * on efface les styles injectés par JavaScript.
         */
        if (!animationActive()) {

            stepDistance = 0;
            totalDistance = 0;

            items.forEach(item => {
                item.style.transform = "";
                item.style.opacity = "";
                item.style.zIndex = "";
                item.style.visibility = "";
            });

            return;
        }

        // Hauteur du header MIETTES.
        const headerHeight = header
            ? header.getBoundingClientRect().height
            : 0;

        // Hauteur de la barre WordPress, si présente.
        const adminBar = document.querySelector("#wpadminbar");

        const adminHeight = adminBar
            ? adminBar.getBoundingClientRect().height
            : 0;

        // La collection se place sous les deux barres.
        stickyTop = headerHeight + adminHeight + 12;

        // Espace disponible dans la fenêtre.
        const availableHeight = Math.max(
            240,
            window.innerHeight - stickyTop - 16
        );

        // Transmet les valeurs calculées au CSS.
        sticky.style.setProperty(
            "--collection-sticky-top",
            `${stickyTop}px`
        );

        sticky.style.setProperty(
            "--collection-sticky-height",
            `${availableHeight}px`
        );

        /*
         * On mesure la hauteur du titre "LA COLLECTION"
         * et son espacement inférieur.
         */
        const introHeight =
            intro.getBoundingClientRect().height;

        const introMargin =
            parseFloat(getComputedStyle(intro).marginBottom) || 0;

             /*
            * On réserve 65 px supplémentaires sous la galerie.
            *
            * Cela permet de garder les légendes visibles
            * sans devoir remonter et perdre le grand titre.
            */
            const bottomBreathingRoom = 65;

            const viewportHeight = Math.max(
                120,
                availableHeight
                    - introHeight
                    - introMargin
                    - bottomBreathingRoom
            );

        viewport.style.setProperty(
            "--collection-viewport-height",
            `${viewportHeight}px`
        );

        /*
         * Chaque transition occupe environ 80 %
         * de la hauteur de l'écran en scroll.
         *
         * Plus cette valeur est grande,
         * plus l'animation est lente.
         */
        stepDistance = Math.max(
            350,
            window.innerHeight * 0.8
        );

        // Exemple : 3 créations = 2 transitions.
        totalDistance = Math.max(
            0,
            (items.length - 1) * stepDistance
        );

        /*
         * On allonge la section pour permettre
         * au sticky de rester visible pendant
         * toute l'animation.
         */
        section.style.height =
            `${availableHeight + totalDistance}px`;

        // Place immédiatement les cartes correctement.
        updatePosition();
    }

    /* ------------------------------------------------------
       4. ANIMATION CINÉMATIQUE
       ------------------------------------------------------ */

    function updatePosition() {

        if (!animationActive() || !stepDistance) {
            return;
        }

        /*
         * Position absolue de la collection
         * par rapport au début du document.
         */
        const sectionTop =
            section.getBoundingClientRect().top +
            window.scrollY;

        /*
         * Progression verticale dans la section.
         */
        const scrollProgress = clamp(
            window.scrollY - sectionTop + stickyTop,
            0,
            totalDistance
        );

        /*
         * Progression exprimée en nombre de créations.
         *
         * 0 : première création active.
         * 1 : deuxième création active.
         * 2 : troisième création active.
         */
        const progress = scrollProgress / stepDistance;

        items.forEach((item, index) => {

            /*
             * Distance entre cette création
             * et la création actuellement active.
             */
            const relative = index - progress;

            let x;
            let scale;
            let opacity;

            if (relative >= 0) {

                /* ------------------------------------------
                   CRÉATIONS EN ATTENTE
                   ------------------------------------------

                   Les créations suivantes sont plus petites,
                   décalées vers la droite et légèrement
                   moins visibles.

                   Quand leur tour arrive, elles avancent
                   progressivement au premier plan.
                */

                const depth = clamp(relative, 0, 2);

                // Décalage horizontal en pourcentage.
                x = lerp(
                    0,
                    68,
                    Math.min(depth, 1)
                );

                // La troisième création est encore plus loin.
                if (depth > 1) {
                    x += (depth - 1) * 12;
                }

                // Réduction progressive de la taille.
                scale = lerp(
                    1,
                    0.72,
                    Math.min(depth, 1)
                );

                if (depth > 1) {
                    scale -= (depth - 1) * 0.12;
                }

                // Effet de profondeur par l'opacité.
                opacity = lerp(
                    1,
                    0.72,
                    Math.min(depth, 1)
                );

                if (depth > 1) {
                    opacity -= (depth - 1) * 0.22;
                }

            } else {

                /* ------------------------------------------
                   CRÉATIONS DÉPASSÉES
                   ------------------------------------------

                   Une création déjà vue recule,
                   se réduit et disparaît progressivement.
                */

                const departure = clamp(
                    -relative,
                    0,
                    1
                );

                x = lerp(0, -32, departure);

                scale = lerp(1, 0.86, departure);

                opacity = lerp(1, 0, departure);
            }

          
             item.style.transform =
            `translate3d(${x}%, 0, 0) scale(${scale})`;

            // Rend les cartes plus ou moins visibles.
            item.style.opacity = opacity;

            /*
             * Ordre de superposition :
             * - les créations dépassées passent derrière ;
             * - la création active reste devant ;
             * - les suivantes attendent en retrait.
             */
            item.style.zIndex = relative < 0
                ? 0
                : items.length - index;

            /*
             * Une carte complètement disparue ne doit
             * pas bloquer les interactions à la souris.
             */
            item.style.visibility = opacity <= 0.01
                ? "hidden"
                : "visible";
        });
    }

    /* ------------------------------------------------------
       5. OPTIMISATION DU SCROLL
       ------------------------------------------------------ */

    function onScroll() {

        if (animationPending) {
            return;
        }

        animationPending = true;

        /*
         * requestAnimationFrame synchronise
         * les changements visuels avec l'affichage
         * du navigateur.
         */
        requestAnimationFrame(() => {
            updatePosition();
            animationPending = false;
        });
    }

    /* ------------------------------------------------------
       6. ÉVÉNEMENTS
       ------------------------------------------------------ */

    // Animation au scroll vertical.
    window.addEventListener("scroll", onScroll, {
        passive: true
    });

    // Recalcule lors d'un changement de largeur.
    window.addEventListener("resize", calculateLayout);

    // Respecte les changements d'accessibilité.
    reducedMotion.addEventListener(
        "change",
        calculateLayout
    );

    // Premier calcul dès que le HTML est prêt.
    calculateLayout();

    // Nouveau calcul après chargement des images.
    window.addEventListener("load", calculateLayout);

});
