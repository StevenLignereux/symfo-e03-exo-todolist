# Projet Todolist

## Objectifs

- Etudier/concevoir l'application à créer (papier/crayon, .md, Google Draw au choix).
- Installation Symfony (encore).
- Créer le ou les contrôleurs nécessaires.
- Configurer les routes, les actions (méthodes de contrôleurs).
- Utiliser le modèle de données fourni `TodoModel.php` OU créez-le vous même depuis l'exemple `TodoModel-exemple.png` (si vous avez le temps après avoir avancé sur le reste).
- Créer les templates.

## Contraintes supplémentaires

### Contrôleurs

- **Une action = une méthode de contrôleur** : créer autant de routes que possible afin d'avoir des tâches bien distinctes dans le contrôleur (tant que possible bien sûr).
- **Autorisez l'usage de la méthode GET ou POST (ou les deux) pour chaque action de contrôleur**, voir [SensioFrameworkExtraBundle => Route Method](https://symfony.com/doc/3.0/bundles/SensioFrameworkExtraBundle/annotations/routing.html).
- **Pour récupérer les paramètres** GET ou POST (formulaire nouvelle tâche), [**passez par l'objet Request**](http://symfony.com/doc/3.4/controller.html#the-request-and-response-object) => _n'utilisez pas les formulaires Symfony pour le moment_.
- **Pour définir le statut d'une tâche (disons _done_ et _undone_), créer une seule méthode** qui prend en paramètre l'id et le nouveau statut _todoSetStatusAction($id, $status)_. Contraindre la valeur de l'action aux 2 paramètres _done_ et _undone_ seulement sur la route qui définit un statut (via les _requirements_).
- ** Ajouter des _[Flash Messages](https://symfony.com/doc/3.4/controller.html#flash-messages)_ ** dans le contrôleur sur les actions de changements de statut d'une tâche, de suppression d'une tâche, de création d'une tâche ou autre _(les messages flash sont des variables stockées en session. Leur particularité est que, dès qu’ils ont été récupérés, ils sont aussitôt supprimés de la session. Parfait pour envoyer une notification juste après une opération)_.
    - Puis [rediriger vers la liste des tâches via la méthode appropriée](https://symfony.com/doc/3.4/controller.html#redirecting).
    - Afficher les flash messages sur cette page de redirection. Tenter d'appliquer le style [Alert Bootstrap](https://getbootstrap.com/docs/4.0/components/alerts/) correspondant.
- **Effectuer les vérifications de validité de certaines actions** (comme _/todo/show/4_ par ex.) : renvoyer une 404 si la tâche demandée n'existe pas. Identifier toutes les routes où la 404 peut être envoyée.
- Pour l'action _delete_ **utiliser une méthode POST** (un formulaire donc).

### Templates

Pour manipuler l'héritage :

- Vous êtes bien sûr invités à [utiliser l'include](https://symfony.com/doc/3.4/templating.html#including-other-templates) pour mutualiser le formulaire d'ajout d'une tâche (sur les pages d'accueil et de liste).
- Mettre un titre de page différent à chaque page.
- Sur le template _base.html.twig_ : créer un block Twig pour le footer, qui contient un texte par défaut disons `Made with &hearts; by (votre pseudo ici)`.
  - Dans les templates enfants (accueil, liste, détail), conserver ce pied de page dans le block footer [grâce à la fonction Twig](https://symfony.com/doc/3.4/templating.html#template-inheritance-and-layouts) `parent()`. Y ajouter l'information supplémentaire `Page (nom de la page courante) générée en 0.2 ms`.

### Model

- Ajouter la méthode `reset()` au modèle Todo, afin de remettre les données par défaut du modèle (on vide la session donc et on remet les données de base).
  - Lien _Réinitialiser les tâches (dev)_ : Ajouter la route sous la liste et créer l'action de contrôleur correspondante. Ajouter éventuellement un message flash pour cette action.

#### Bonus Model

Pour mieux comprendre ce qu'on fait dans ce modèle et utiliser le composant Symfony qui va bien.

- On pourra utiliser le composant `HttpFoundation/Session` de Symfony au sein de notre modèle => convertir le code existant en remplaçant `$_SESSION` par l'usage de `SessionInterface`.
- PS : quand on travaille avec la session, il est parfois nécessaire de supprimer la session précédente via l'inspecteur web > `Onglet Application > Menu Storage > Cookies > 127.0.0.1 > Supprimer la clé 'PHPSESSID'` (ne serait-ce que pour tester l'initialisation d'une nouvelle session, par exemple).

**=> Ressources Session**

- [Session Basics](http://symfony.com/doc/3.4/controller.html#managing-the-session)
- [Session Management](https://symfony.com/doc/3.4/components/http_foundation/sessions.html)
