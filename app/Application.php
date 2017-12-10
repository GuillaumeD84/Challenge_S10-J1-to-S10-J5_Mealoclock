<?php
namespace Mealoclock;

class Application
{
  private $router;

  /**
   * Initialisation de l'application
   */
  public function __construct()
  {
    // Instanciation du router
    $this->router = new \AltoRouter();

    /**
     * Configuration du chemin de base
     * $_SERVER['DOCUMENT_ROOT'] = /var/www/html
     * getcwd() = /var/www/html/Projets/S10-Meal-OClock
     */
    $basePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd());
    $basePath = str_replace(' ', '%20', $basePath);

    $this->router->setBasePath($basePath);

    // Définition des routes du site
    $this->defineRoutes();
  }

  /**
  * Configuration des routes
  */
  private function defineRoutes()
  {
    // Route de la page d'accueil du site
    $this->router->map('GET', '/', ['MainController', 'home'], 'home');

    // Routes relatives aux communautés
    $this->router->map('GET', '/community/[i:id]', ['CommunityController', 'show'], 'community_show');

    // Routes relatives aux événements
    $this->router->map('GET', '/events', ['EventController', 'list'], 'event_list');
    $this->router->map('GET', '/events/[i:id]', ['EventController', 'show'], 'event_show');
    $this->router->map('GET|POST', '/events/create', ['EventController', 'create'], 'event_create');

    // Routes relatives à l'administration
    $this->router->map('GET|POST', '/admin/events/[i:id]/delete', ['EventController', 'delete'], 'event_delete');
  }

  /**
   * Exécution de l'application
   * le FrontController reçoit la requête
   * match la route puis dispatch
   */
  public function run()
  {
    // Match de la route demandée
    $match = $this->router->match();

    // On test si une route a bien été trouvée
    if ($match === false) {
      echo 'Page not found.';
    }
    // Si oui on récupère et traite les infos retournées par AltoRouter
    else {
      // Le nom du Controller à appeler se trouve dans $match['target'][0]
      $controllerName = 'Mealoclock\\Controller\\'.$match['target'][0];
      // La méthode du Controller à appeler dans $match['target'][1]
      $actionName = $match['target'][1];
      // Les paramètres dans l'URL (ex: id, slug, ...)
      $params = $match['params'];

      // On instancie le Controller
      $controller = new $controllerName($this->router);
      // On appelle la méthode
      $controller->$actionName($params);
    }
  }
}
