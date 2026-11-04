
/**
 * ==========================================================
 * MIETTES — ANIMATION DU LOGO CONTACT
 * ==========================================================
 *
 * Déclenche l'animation de machine à sous
 * lorsque la page Contact est chargée.
 *
 * Respecte la préférence de mouvement réduit.
 */

document.addEventListener("DOMContentLoaded", () => {

    // Recherche le composant sur la page Contact.
    const slot = document.querySelector(".contact-slot");

    // Ne fait rien si le composant n'existe pas.
    if (!slot) {
        return;
    }

    // Vérifie les préférences d'accessibilité.
    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    // Si l'utilisateur préfère moins de mouvement,
    // on conserve directement l'état final.
    if (reducedMotion.matches) {
        return;
    }

    // Active les animations définies en CSS.
    slot.classList.add("is-animating");

});
