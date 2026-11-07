# MIETTES — Maison de Pain Perdu

**Rien ne se perd. Tout se désire.**

MIETTES est un projet de site vitrine fictif pour une maison de pain perdu haut de gamme, imaginée autour d'une identité visuelle minimaliste, brute et éditoriale.

Le projet explore la création d'une expérience web immersive à travers WordPress, un thème développé sur mesure et des interactions JavaScript.

## Concept

MIETTES revisite le pain perdu comme une création gastronomique contemporaine.

L'identité graphique repose sur une esthétique brutaliste : contrastes noir et blanc, typographie affirmée, photographie culinaire et animations discrètes.

**Signature :** Le goût. Sans compromis.

## Technologies

- **CMS :** WordPress
- **Back-end :** PHP 8.3
- **Front-end :** HTML5, CSS3, JavaScript natif
- **Base de données :** MySQL 8.4
- **Environnement :** Docker Compose
- **Versionnement :** Git
- **Développement :** VS Code, Composer (stubs WordPress)

## Fonctionnalités

### Accueil
- Hero éditorial
- Collection de créations culinaires
- Galerie horizontale animée au défilement
- Manifeste avec apparition progressive des textes

### La Maison
- Présentation de l'univers de la marque
- Galerie photographique
- Animations au défilement

### Contact
- Hero cinématographique
- Animation typographique inspirée d'une machine à sous
- Effet de reflet
- Composition éditoriale

### Accessibilité et responsive
- Adaptations aux écrans mobiles
- Navigation sémantique
- Prise en compte de `prefers-reduced-motion`

## Architecture

```text
MIETTES/
├── compose.yaml
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
└── themes/
    └── miettes/
        ├── assets/
        │   └── css/
        │       ├── base.css
        │       ├── header.css
        │       ├── footer.css
        │       ├── home.css
        │       ├── collection.css
        │       ├── manifesto.css
        │       ├── maison.css
        │       └── contact.css
        ├── images/
        ├── js/
        ├── functions.php
        ├── front-page.php
        ├── page-la-maison.php
        ├── page-contact.php
        ├── page-politique-de-confidentialite.php
        └── style.css
```

## Installation locale

### Prérequis

- Docker Desktop avec Docker Compose
- Git

### 1. Cloner le dépôt

```bash
git clone <URL_DU_DEPOT>
cd MIETTES
```

### 2. Configurer l'environnement

Copier `.env.example` vers `.env`.

Remplacer les valeurs `CHANGE_ME` par des mots de passe personnels.

Ne jamais publier le fichier `.env`.

### 3. Démarrer Docker

```bash
docker compose up -d
```

### 4. Accéder au site

Ouvrir :

http://localhost:8080/

Lors de la première installation, terminer la configuration WordPress et activer le thème **MIETTES** dans l'administration.

**Important :** le dépôt contient le thème et sa configuration Docker, mais pas encore d'export de la base de données. Les pages et contenus WordPress doivent donc être recréés ou importés séparément.

## Architecture CSS

Le thème utilise une architecture CSS modulaire.

Les styles sont répartis selon leurs responsabilités : base commune, navigation, pied de page, accueil, collection, manifeste et pages spécifiques.

Le chargement des ressources est géré dans `functions.php` à l'aide des fonctions natives de WordPress.

Les feuilles de style propres à certaines pages sont chargées conditionnellement.

## Animations

Les interactions sont développées en JavaScript natif, sans bibliothèque d'animation externe.

Principaux scripts :

- `collection-scroll.js`
- `manifesto-scroll.js`
- `maison-scroll.js`
- `contact-slot.js`

## Statut

Développement du thème et refactorisation CSS terminés.

Préparation de la documentation, de la reproductibilité de l'installation et de la publication GitHub.

## Auteur

**Tepoe'San**

Projet personnel de développement web et de direction artistique.