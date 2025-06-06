# Filter Elem

Ce dépôt contient un plugin WordPress minimal pour Elementor qui ajoute un widget permettant d'afficher les articles filtrés par catégorie.

## Installation

1. Copiez le dossier du plugin dans le répertoire `wp-content/plugins/` de votre site WordPress.
2. Activez le plugin "Filter Elem" depuis l'interface d'administration WordPress.

## Utilisation

Après activation, un nouveau widget nommé **Filter Elem** apparaît dans l'éditeur Elementor. Choisissez une catégorie d'articles dans les options du widget pour afficher automatiquement la liste correspondante.

## Développement

Le code suit les normes WordPress (fonctionnement sans `?>`). Les fichiers principaux sont :

- `filter-elem.php` : fichier principal du plugin.
- `widgets/class-filter-elem-widget.php` : définition du widget Elementor.

N'hésitez pas à adapter le code ou à ajouter des fonctionnalités supplémentaires selon vos besoins.
