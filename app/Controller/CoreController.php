<?php
namespace Mealoclock\Controller;

class CoreController
{
  // Routeur de l'application
  protected $router;

  // Config de l'application
  protected $config;

  // protected $templatesEngine;
  // protected $user;

  /**
   * CoreController étant le parent de tous les Controllers,
   * ce constructeur sera appelé lors de tout dispatch.
   * ATTENTION le CoreController n'est jamais instancié !
   * Par contre ses enfants hérites de toutes ses méthodes.
   */
  public function __construct($router)
  {
    // On donne accès à tous les Controllers les infos concernant la route matchée
    echo 'Constructeur défini dans le CoreController, appelé pour '.static::class;
    $this->router = $router;
  }

  /**
   * Permet aux Controllers de rediriger l'utilisateur
   */
  public function redirect($routeName, $params = [])
  {
    header('Location: '.$this->router->generate($routeName, $params));
  }
}
