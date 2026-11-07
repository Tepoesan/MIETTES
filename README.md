# MIETTES — Maison de Pain Perdu

**Rien ne se perd. Tout se désire.**  
*Nothing is wasted. Everything is desired.*

MIETTES is a fictional showcase website for a premium French toast house, built around a minimalist, raw, and editorial visual identity.

The project explores the creation of an immersive web experience using WordPress, a fully custom-developed theme, and interactive JavaScript animations.

## Concept

MIETTES reimagines traditional French toast as a contemporary culinary creation.

Its visual identity draws inspiration from brutalist design, combining bold black-and-white contrasts, expressive typography, food photography, and subtle animations.

**Brand signature:** *Le goût. Sans compromis.*  
*Taste. Without compromise.*

## Technologies

- **CMS:** WordPress
- **Back-end:** PHP 8.3
- **Front-end:** HTML5, CSS3, Vanilla JavaScript
- **Database:** MySQL 8.4
- **Development environment:** Docker Compose
- **Version control:** Git
- **Development tools:** VS Code, Composer (WordPress stubs)

## Features

### Homepage
- Editorial hero section
- Curated collection of culinary creations
- Scroll-driven horizontal gallery
- Animated manifesto with progressive text reveals

### La Maison
- Introduction to the brand's identity and philosophy
- Editorial photography gallery
- Scroll-triggered visual animations

### Contact
- Cinematic hero section
- Slot-machine-inspired typography animation
- Reflection effect
- Editorial layout and composition

### Accessibility and Responsive Design
- Responsive layouts for mobile devices
- Semantic navigation
- Support for `prefers-reduced-motion`

## Project Structure

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

## Local Installation

### Prerequisites

- Docker Desktop with Docker Compose
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/Tepoesan/MIETTES.git
cd MIETTES
```

### 2. Configure the Environment

Copy `.env.example` to `.env`.

Replace the `CHANGE_ME` placeholders with your own secure passwords.

Never commit or publish the `.env` file.

### 3. Start Docker

```bash
docker compose up -d
```

### 4. Access the Website

Open the following address in your browser:

http://localhost:8080/

On first launch, complete the WordPress installation process and activate the **MIETTES** theme from the WordPress administration dashboard.

**Important:** This repository contains the custom WordPress theme and its Docker configuration, but does not include a database export. WordPress pages and content must therefore be recreated or imported separately.

## CSS Architecture

The theme follows a modular CSS architecture designed to improve readability, maintainability, and separation of concerns.

Stylesheets are organized according to their responsibilities, including global styles, navigation, footer, homepage, collection, manifesto, and individual page layouts.

Asset loading is managed through `functions.php` using native WordPress functions.

Page-specific stylesheets are conditionally loaded to avoid unnecessary resources.

## Animations

All interactions are developed using Vanilla JavaScript, without external animation libraries.

Main animation scripts:

- `collection-scroll.js`
- `manifesto-scroll.js`
- `maison-scroll.js`
- `contact-slot.js`

These scripts provide scroll-driven interactions, progressive content reveals, photographic transitions, and animated typography.

## Project Status

- Custom WordPress theme development completed.
- Modular CSS refactoring completed.
- Source code published on GitHub.
- Documentation and installation reproducibility improvements ongoing.

## Author

**Tepoe'San**

Personal project focused on web development, creative front-end experiences, and art direction.