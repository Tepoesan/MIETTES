
/* ==========================================================
   MIETTES — MANIFESTE AU SCROLL
   ==========================================================

   Deux tableaux se succèdent doucement pendant
   le défilement vertical.

   Le navigateur conserve son scroll naturel :
   aucun événement wheel n'est intercepté.

   Progression :
   0 % à 30 %  : premier tableau visible.
   30 % à 70 % : transition progressive.
   70 % à 100 %: deuxième tableau visible.
*/

document.addEventListener("DOMContentLoaded", () => {

    /* ------------------------------------------------------
       1. ÉLÉMENTS HTML
       ------------------------------------------------------ */

    const section = document.querySelector(".manifesto");
    const sticky = document.querySelector(".manifesto-sticky");
    const slides = [
        ...document.querySelectorAll(".manifesto-slide")
    ];
    const counter = document.querySelector(".manifesto-counter");
    const header = document.querySelector(".site-header");

    if (!section || !sticky || slides.length !== 2) {
        return;
    }

    /* ------------------------------------------------------
       2. CONFIGURATION
       ------------------------------------------------------ */

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    let stickyTop = 0;
    let scrollDistance = 0;
    let animationPending = false;

    function animationActive() {
        return window.innerWidth > 600 && !reducedMotion.matches;
    }

    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    /*
     * Smoothstep :
     * transforme une progression linéaire
     * en mouvement plus doux au début et à la fin.
     */
    function smoothstep(value) {
        const t = clamp(value, 0, 1);
        return t * t * (3 - 2 * t);
    }

    /* ------------------------------------------------------
       3. CALCUL DE LA SECTION
       ------------------------------------------------------ */

    function calculateLayout() {

        section.style.height = "";
        sticky.style.removeProperty("--manifesto-top");
        sticky.style.removeProperty("--manifesto-height");

        if (!animationActive()) {

            slides.forEach(slide => {
                slide.style.opacity = "";
                slide.style.visibility = "";
                slide.style.transform = "";
            });

            if (counter) {
                counter.textContent = "01 — 02";
            }

            return;
        }

        /*
         * On réserve l'espace sous le header WordPress
         * et sous la barre d'administration éventuelle.
         */
        const headerHeight = header
            ? header.getBoundingClientRect().height
            : 0;

        const adminBar = document.querySelector("#wpadminbar");

        const adminHeight = adminBar
            ? adminBar.getBoundingClientRect().height
            : 0;

        stickyTop = headerHeight + adminHeight;

        const availableHeight = Math.max(
            300,
            window.innerHeight - stickyTop
        );

        sticky.style.setProperty(
            "--manifesto-top",
            `${stickyTop}px`
        );

        sticky.style.setProperty(
            "--manifesto-height",
            `${availableHeight}px`
        );

        /*
         * On utilise 1,8 hauteur d'écran pour
         * obtenir une transition lente.
         */
        scrollDistance = window.innerHeight * 1.8;

        /*
         * La section est assez haute pour permettre
         * au sticky de rester en place pendant
         * toute la transition.
         */
        section.style.height =
            `${availableHeight + scrollDistance}px`;

        updatePosition();
    }

    /* ------------------------------------------------------
       4. ANIMATION DES DEUX TABLEAUX
       ------------------------------------------------------ */

    function updatePosition() {

        if (!animationActive() || !scrollDistance) {
            return;
        }

        const sectionTop =
            section.getBoundingClientRect().top +
            window.scrollY;

        const travelled = clamp(
            window.scrollY - sectionTop + stickyTop,
            0,
            scrollDistance
        );

        const progress = travelled / scrollDistance;

        /*
         * Transition entre 30 % et 70 %.
         * Avant : premier tableau.
         * Après : deuxième tableau.
         */
        const transition = smoothstep(
            (progress - 0.3) / 0.4
        );

        const first = slides[0];
        const second = slides[1];

        /*
         * Le premier texte s'efface
         * et remonte légèrement.
         */
        first.style.opacity = 1 - transition;

        first.style.transform =
            `translate3d(0, ${-24 * transition}px, 0)`;

        /*
         * Le deuxième texte apparaît
         * en remontant doucement.
         */
        second.style.opacity = transition;

        second.style.transform =
            `translate3d(0, ${24 * (1 - transition)}px, 0)`;

        /*
         * visibility empêche les textes invisibles
         * de rester interactifs.
         */
        first.style.visibility =
            transition >= 0.999 ? "hidden" : "visible";

        second.style.visibility =
            transition <= 0.001 ? "hidden" : "visible";

        // Numéro du tableau majoritairement visible.
        if (counter) {
            counter.textContent =
                transition < 0.5 ? "01 / 02" : "02 / 02";
        }
    }

    /* ------------------------------------------------------
       5. ÉVÉNEMENTS
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

    window.addEventListener("scroll", onScroll, {
        passive: true
    });

    window.addEventListener("resize", calculateLayout);

    reducedMotion.addEventListener(
        "change",
        calculateLayout
    );

    calculateLayout();

    window.addEventListener("load", calculateLayout);

});
