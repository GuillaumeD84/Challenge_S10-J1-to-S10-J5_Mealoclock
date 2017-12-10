<?php
namespace Mealoclock\Controller;

use Mealoclock\Model\EventModel;

class EventController extends CoreController
{
  /**
   * Echo la liste de tous les Events
   */
  public function list()
  {
    dump(EventModel::findAll());
    echo '<br>';
    $link = $this->router->generate('home');
    echo '<a href='.$link.'>Home</a>';
  }

  /**
   * Méthode appelée lorsque la route correspond à : /events/[i:id]
   * La méthode reçoit l'id de l'event à afficher en paramètre ($params)
   */
  public function show($params)
  {
    echo '<br>';
    echo 'Vous souhaitez consulter l\'événement n° '.$params['id'].'.';
    echo '<br>';
    echo static::class;
    echo '<br>';
    echo '<br>';

    // On récupère l'event ayant l'id '$params['id']'
    $event = EventModel::find($params['id']);

    // Si l'event $id éxiste alors on l'affiche
    if ($event) {
      dump($event);
    }
    else {
      echo 'Ressource non trouvée.';
    }

    echo '<br>';
    $link = $this->router->generate('home');
    echo '<a href='.$link.'>Home</a>';
  }

  /**
   * Méthode appelée lorsque la route correspond à : /events/create
   * La route peut être appelée en GET ou en POST.
   * La méthode permet d'accéder au formulaire de création d'un nouvel event
   */
  public function create()
  {
    // Si le form a été soumis (route POST)
    // On traite les infos
    if(!empty($_POST)) {
      // Vérification des données
      dump($_POST);

      // On créé un objet Event
      $newEvent = new EventModel;

      // Array contenant la liste des champs avec une erreur
      $errors = [];

      // On set les attributs de l'Event grâce aux données du POST
      $set = $newEvent->setTitle($_POST['title']);
      if(!$set)
        $errors[] = 'vérifiez le titre';

      $set = $newEvent->setDescription($_POST['description']);
      if(!$set)
        $errors[] = 'vérifiez la description';

      $set = $newEvent->setPrice($_POST['price']);
      if(!$set)
        $errors[] = 'vérifiez le prix';

      $set = $newEvent->setDateEvent($_POST['date_event']);
      if(!$set)
        $errors[] = 'vérifiez la date';

      $set = $newEvent->setNbGuests($_POST['nb_guests']);
      if(!$set)
        $errors[] = 'vérifiez le nb d\'invités';

      $newEvent->setStatus(1);

      $set = $newEvent->setAddress($_POST['address']);
      if(!$set)
        $errors[] = 'vérifiez l\'addresse';

      $set = $newEvent->setIsVirtual($_POST['is_virtual']);
      if(!$set)
        $errors[] = 'vérifiez le type d\'event';

      ////////////////// PROVISOIRE //////////////////
      $set = $newEvent->setOrganizerId($_POST['organizer_id']);
      if(!$set)
        $errors[] = 'vérifiez l\'id de l\'organisateur';
      ////////////////// PROVISOIRE //////////////////

      // S'il n'y a pas d'erreur : on enregistre l'event et on redirige vers la page de l'event créé
      if(empty($errors)) {
        // Active record
        $newEvent->save();

        // TEST
        echo 'Pas d\'erreurs, event enregistré !';
        dump($newEvent);

        // On redirige vers la page du nouvel Event
        // $this->redirect('event_show', ['id', $event->getId()]);
      }
    }

    // S'il y a des erreurs => on affiche les erreurs et on réaffiche le form
    if(!empty($errors)) {
      dump($errors);
    }

    // On accède à la page en GET (ou si erreur en POST)
    echo '
    <form method="POST">
      <p>
        <label for="title">title</label>
        <input id="title" name="title" value="'.
          (isset($_POST["title"]) ? $_POST["title"] : "")
        .'">
      </p>
      <p>
        <label for="description">description</label>
        <input id="description" name="description" value="'.
          (isset($_POST["description"]) ? $_POST["description"] : "")
        .'">
      </p>
      <p>
        <label for="price">price</label>
        <input id="price" name="price" value="'.
          (isset($_POST["price"]) ? $_POST["price"] : "")
        .'">
      </p>
      <p>
        <label for="date_event">date_event</label>
        <input id="date_event" name="date_event" type="date" value="'.
          (isset($_POST["date_event"]) ? $_POST["date_event"] : "")
        .'">
      </p>
      <p>
        <label for="nb_guests">nb_guests</label>
        <input id="nb_guests" name="nb_guests" value="'.
          (isset($_POST["nb_guests"]) ? $_POST["nb_guests"] : "")
        .'">
      </p>
      <p>
        <label for="is_address">
          <input id="is_address" name="is_virtual" type="radio" value="0"'.
            (isset($_POST["is_virtual"]) && $_POST["is_virtual"] ? "" : " checked")
          .'>
          is_address
        </label>
        <label for="is_virtual">
          <input id="is_virtual" name="is_virtual" type="radio" value="1"'.
            (isset($_POST["is_virtual"]) && $_POST["is_virtual"] ? " checked" : "")
          .'>
          is_virtual
        </label>
      </p>
      <p>
        <label for="address">address</label>
        <input id="address" name="address" value="'.
          (isset($_POST["address"]) ? $_POST["address"] : "")
        .'">
      </p>
      <p>
        <label for="organizer_id">organizer_id (PROVISOIRE)</label>
        <input id="organizer_id" name="organizer_id" value="'.
          (isset($_POST["organizer_id"]) ? $_POST["organizer_id"] : "")
        .'">
      </p>
      <input type="submit" value="Enregistrer">
    </form>
    <br>
    <a href='.$this->router->generate('home').'>Home</a>
    ';
  }

  /**
   * Méthode appelée lorsque la route correspond à : /admin/events/[i:id]/delete
   * La route peut être appelée en GET ou en POST.
   * La méthode permet de supprimer un event via son id
   */
  public function delete($params)
  {
    echo '<br>';
    echo static::class;
    echo '<br>';
    echo '<br>';
    echo 'Vous souhaitez supprimer l\'événement n° '.$params['id'].'.';

    // On récupère l'event ayant l'id '$params['id']'
    $event = EventModel::find($params['id']);

    // Si l'event $id éxiste alors on l'affiche
    if ($event) {
      dump($event);

      // Si on est en POST c'est que l'on à supprimé l'event
      if(isset($_POST['event_delete'])) {
        echo 'POST<br>';
        $event->delete($event->getId());
        // $this->redirect('event_list');
      }
      // Sinon on est en GET et on affiche un bouton de validation
      else {
        echo '
        <form method="POST">
          <label for="event_delete">event_delete</label>
          <input type="submit" id="event_delete" name="event_delete" value="yes">
        </form>
        ';
      }
    }
    else {
      echo '<br>Ressource non trouvée.';
    }

    echo '<br>';
    $link = $this->router->generate('home');
    echo '<a href='.$link.'>Home</a>';
  }
}
