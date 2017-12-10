<?php
namespace Mealoclock\Controller;

use \Mealoclock\Model\CommunityModel;
use \Mealoclock\Model\EventModel;

class CommunityController extends CoreController
{
  /**
   * Méthode appelée lorsque la route correspond à : /community/[i:id]
   * La méthode reçoit l'id de la communauté à afficher en paramètre ($params)
   */
  public function show($params)
  {
    // On récupère le paramètre de la route. Il s'agit ici de l'id de la communauté demandée
    $id_community = $params['id'];
    // On demande à la classe CommunityModel de nous renvoyer l'OBJET (community) via l'id
    $community = CommunityModel::find($id_community);
    // La variable $community contient donc un OBJET de la classe CommunityModel
    // Je peux donc appeler les méthodes d'objet, par exemple un getter
    echo '<h2>Prochains events de la communauté '. $community->getCommunityName() .' </h2>';

    // On récupère auprès du Model des Events, les 5 prochains events de la categorie $params['id']
    $nextEvents = EventModel::getNextFive($community->getId());
    dump($nextEvents);
    
    echo '<br>';
    $link = $this->router->generate('home');
    echo '<a href='.$link.'>Home</a>';
  }
}
