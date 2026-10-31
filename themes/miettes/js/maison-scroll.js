
/**
 * ==========================================================
 * MIETTES — LA MAISON
 * Révélation permanente des photographies au scroll
 * ==========================================================
 *
 * 1. L'image de droite apparaît en premier.
 * 2. L'image de gauche apparaît ensuite.
 * 3. Les opacités augmentent avec le défilement.
 * 4. Les images ne disparaissent jamais en remontant.
 * 5. Un rechargement réinitialise l'animation.
 */

document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    /* ------------------------------------------------------
       01 — RÉCUPÉRATION DES ÉLÉMENTS
       ------------------------------------------------------ */

    const gallery = document.querySelector(
        "[data-maison-scroll]"
    );

    if (!gallery) return;

    const first = gallery.querySelector(
        '[data-maison-reveal="first"]'
    );

    const second = gallery.querySelector(
        '[data-maison-reveal="second"]'
    );

    if (!first || !second) return;

    /* ------------------------------------------------------
       02 — ACCESSIBILITÉ
       ------------------------------------------------------ */

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    // Les images restent visibles si les animations
    // sont désactivées dans les préférences système.
    if (reducedMotion.matches) return;

    /* ------------------------------------------------------
       03 — FONCTIONS UTILITAIRES
       ------------------------------------------------------ */

    // Limite une valeur entre 0 et 1.
    const clamp = (value) => {
        return Math.min(1, Math.max(0, value));
    };

    // Calcule l'opacité selon la progression du scroll.
    const fadeProgress = (progress, start, end) => {
        return clamp(
            (progress - start) / (end - start)
        );
    };

    /* ------------------------------------------------------
       04 — MÉMORISATION DES OPACITÉS
       ------------------------------------------------------

       Ces variables conservent la plus grande opacité
       atteinte depuis le chargement de la page.

       Elles ne sont pas enregistrées dans le navigateur :
       un nouveau chargement réinitialise les valeurs.
    */

    let firstMaxOpacity = 0;
    let secondMaxOpacity = 0;

    // Évite de calculer plusieurs animations
    // pendant une même image de rendu du navigateur.
    let ticking = false;

    /* ------------------------------------------------------
       05 — CALCUL DE LA PROGRESSION
       ------------------------------------------------------ */

    function updateGallery() {

        const rect = gallery.getBoundingClientRect();
        const viewportHeight = window.innerHeight;

        /*
         * Progression de la galerie dans la fenêtre :
         *
         * 0 = la galerie arrive en bas de l'écran.
         * 1 = la galerie quitte le haut de l'écran.
         */

        const distance = viewportHeight + rect.height;

        const progress = clamp(
            (viewportHeight - rect.top) / distance
        );

        /*
         * IMAGE 01 — LA LUMIÈRE (DROITE)
         *
         * Apparition entre 10 % et 40 %.
         */

        const firstOpacity = fadeProgress(
            progress,
            0.10,
            0.40
        );

        /*
         * IMAGE 02 — LA TEXTURE (GAUCHE)
         *
         * Apparition entre 35 % et 65 %.
         * Elle devient visible plus rapidement.
         */

        const secondOpacity = fadeProgress(
            progress,
            0.35,
            0.65
        );

        /* --------------------------------------------------
           06 — CONSERVATION DES OPACITÉS
           --------------------------------------------------

           Math.max() conserve la valeur la plus élevée.

           Exemple :
           - L'image atteint 80 % d'opacité.
           - L'utilisateur remonte la page.
           - Le scroll indique désormais 30 %.
           - L'image reste à 80 %.

           Les photographies ne peuvent donc
           jamais redevenir plus transparentes.
        */

        firstMaxOpacity = Math.max(
            firstMaxOpacity,
            firstOpacity
        );

        secondMaxOpacity = Math.max(
            secondMaxOpacity,
            secondOpacity
        );

        // Application des opacités mémorisées.
        first.style.opacity = firstMaxOpacity;
        second.style.opacity = secondMaxOpacity;

        ticking = false;
    }

    /* ------------------------------------------------------
       07 — OPTIMISATION DU DÉFILEMENT
       ------------------------------------------------------ */

    function requestUpdate() {

        // Empêche les calculs inutiles.
        if (ticking) return;

        ticking = true;

        // Synchronise l'animation avec le navigateur.
        window.requestAnimationFrame(updateGallery);
    }

    /* ------------------------------------------------------
       08 — INITIALISATION
       ------------------------------------------------------ */

    // Active les styles CSS de l'animation.
    gallery.classList.add("is-scroll-ready");

    // Calcule immédiatement les opacités initiales.
    updateGallery();

    // Met à jour les images pendant le défilement.
    window.addEventListener(
        "scroll",
        requestUpdate,
        { passive: true }
    );

    // Recalcule si la fenêtre change de dimensions.
    window.addEventListener(
        "resize",
        requestUpdate
    );

});
