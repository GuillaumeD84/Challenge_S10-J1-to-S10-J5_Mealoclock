<?php
namespace Mealoclock\Controller;

class MainController extends CoreController
{
  public function home()
  {
    //////////////// PROVISOIRE ////////////////
    echo 'Hello World !';
    echo '<br>';
    echo static::class;

    echo '<br>';
    echo '<br>';

    $link = $this->router->generate('event_list');
    echo '<a href='.$link.'>Events list</a>';

    echo '<br>';

    $link = $this->router->generate('event_create');
    echo '<a href='.$link.'>New event</a>';

    echo '<br>';
    echo '<br>';

    $link = $this->router->generate('community_show', ['id' => 3]);
    echo '<a href='.$link.'>Community 3</a>';

    echo '<br>';

    $link = $this->router->generate('event_show', ['id' => 5]);
    echo '<a href='.$link.'>Event 5</a>';

    dump(\Mealoclock\Model\CommunityModel::findAll());
    dump(\Mealoclock\Model\EventModel::findAll());
    dump(\Mealoclock\Model\EventModel::getNextFive());
  }
}
