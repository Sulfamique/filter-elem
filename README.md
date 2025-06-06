# Filter Elem

Ce dépôt contient un plugin WordPress minimal pour Elementor qui ajoute un widget permettant d'afficher les articles filtrés par catégorie ou par toute taxonomie disponible.

## Installation

1. Copiez le dossier du plugin dans le répertoire `wp-content/plugins/` de votre site WordPress.
2. Activez le plugin "Filter Elem" depuis l'interface d’administration WordPress.

## Utilisation

Après activation, un nouveau widget nommé **Filter Elem** apparaît dans l’éditeur Elementor. Choisissez un type de filtre (catégorie ou taxonomie), puis la catégorie ou le terme souhaité pour afficher automatiquement la liste correspondante.

Un élément de menu **Filter Elem** est également disponible dans l’administration WordPress. Il ouvre un tableau de bord simple où vous pourrez ajouter de futures options de configuration.

## Développement

Le code suit les normes WordPress (fonctionnement sans `>`). Les fichiers principaux sont :

- `filter-elem.php` : fichier principal du plugin.
- `widgets/class-filter-elem-widget.php` : définition du widget Elementor.
- `includes/class-filter-elem-admin.php` : création du tableau de bord du plugin.

N'hésitez pas à adapter le code ou à ajouter des fonctionnalités supplémentaires selon vos besoins.
