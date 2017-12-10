<?php
namespace Mealoclock\Model;

class EventModel extends CoreModel
{
  // Définition de la 'TABLE' pour le Model Event
  const TABLE = 'events';

  protected $id;
  protected $title;
  protected $description;
  protected $price;
  protected $date_event;
  protected $nb_guests;
  protected $status;
  protected $address;
  protected $city;
  protected $zipcode;
  protected $is_virtual;
  protected $virtual_address;
  protected $organizer_id;

  /**
   * Méthode qui renvoie les 5 prochains évènements
   * cad avec une date supérieure à celle d'ajourd'hui
   */
  public static function getNextFive($communityId = null)
  {
    // Connexion à la BD grâce à la classe Database
    $db = Database::getDB();

    // On récupère les infos venant de 2 tables : events et event_community
    // ET on indique sur quelle condition se fait le lien entre les 2 tables
    $sql = 'SELECT `events`.* FROM `event_community`, `events`'
              .' WHERE date_event > NOW()'
              .' AND `event_community`.`event_id` = `events`.`id`';

    // Si $communityId n'est pas null, on ajoute la condition 'pour la communauté X'
    // $communityId permet de cibler une communauté en particulier
    if(isset($communityId)) {
      $sql .= ' AND `community_id` = :comId';
    }

    // Dans tous les cas, on précise :
    // - qu'on ne veut voir apparaître chaque évènement que UNE fois même s'il appartient à plusieurs communautés (GROUP BY)
    // - qu'on veut prendre les PROCHAINS events (donc commencer par les dates les plus basses grâce à ASC)
    // - qu'on veut un max de 5 résultats (LIMIT)
    $sql .= ' GROUP BY `events`.`id`'
              .' ORDER BY `date_event` ASC'
              .' LIMIT 5';

    // Si $communityId n'est pas 'null', on a un paramètre ':comId' à préparer
    $query = $db->prepare($sql);

    // Si la communauté est specifiée, on LIE le paramètre ':comId' à sa valeur : l'id de la communauté passé en parametre
    if(isset($communityId)) {
      $query->bindValue(':comId', $communityId);
    }

    // Exécution de la requête
    $query->execute();

    // On retourne le résultat sous la forme d'un objet
    return $query->fetchAll(\PDO::FETCH_CLASS, static::class);
  }

  /**
   * Active record
   * Permet de mettre à jour/créer un Event
   */
  public function save()
  {
    // Connexion à la BD
    $db = Database::getDB();

    // On créé la requête d'ajout/modification
    $sql = 'REPLACE INTO `events` (id, title, description, price, date_event, nb_guests, status, address, city, zipcode, is_virtual, virtual_address, organizer_id) VALUES (:id, :title, :description, :price, :date_event, :nb_guests, :status, :address, :city, :zipcode, :is_virtual, :virtual_address, :organizer_id)';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);
    $statement->bindValue(':title', $this->title, \PDO::PARAM_STR);
    $statement->bindValue(':description', $this->description, \PDO::PARAM_STR);
    $statement->bindValue(':price', $this->price, \PDO::PARAM_INT);
    $statement->bindValue(':date_event', $this->date_event, \PDO::PARAM_STR);
    $statement->bindValue(':nb_guests', $this->nb_guests, \PDO::PARAM_INT);
    $statement->bindValue(':status', $this->status, \PDO::PARAM_INT);
    $statement->bindValue(':address', $this->address, \PDO::PARAM_STR);
    $statement->bindValue(':city', $this->city, \PDO::PARAM_STR);
    $statement->bindValue(':zipcode', $this->zipcode, \PDO::PARAM_INT);
    $statement->bindValue(':is_virtual', $this->is_virtual, \PDO::PARAM_INT);
    $statement->bindValue(':virtual_address', $this->virtual_address, \PDO::PARAM_STR);
    $statement->bindValue(':organizer_id', $this->organizer_id, \PDO::PARAM_INT);

    // On éxécute la requête
    $statement->execute();
  }

  /**
   * Permet de supprimer un Event via son id
   */
  public function delete($id)
  {
    echo 'Vous supprimez l\'event '.$id.' !';

    // Connexion à la BD
    $db = Database::getDB();

    // On créé la requête de suppression
    $sql = 'DELETE FROM `events` WHERE `id` = :id';

    // On prépare la requête
    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

    // On éxécute la requête
    $statement->execute();
  }


  /**
   * Get the value of Id
   *
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the value of Title
   *
   * @return mixed
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of Title
   *
   * @param mixed title
   *
   * @return self
   */
  public function setTitle($title)
  {
    if(empty($title)) {
      return false;
    }
    else {
      $this->title = $title;
      return $this;
    }
  }

  /**
   * Get the value of Description
   *
   * @return mixed
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of Description
   *
   * @param mixed description
   *
   * @return self
   */
  public function setDescription($description)
  {
    if(empty($description)) {
      return false;
    }
    else {
      $this->description = $description;
      return $this;
    }
  }

  /**
   * Get the value of Price
   *
   * @return mixed
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set the value of Price
   *
   * @param mixed price
   *
   * @return self
   */
  public function setPrice($price)
  {
    if(empty($price)) {
      return false;
    }
    else {
      $this->price = $price;
      return $this;
    }
  }

  /**
   * Get the value of Date Event
   *
   * @return mixed
   */
  public function getDateEvent()
  {
    return $this->date_event;
  }

  /**
   * Set the value of Date Event
   *
   * @param mixed date_event
   *
   * @return self
   */
  public function setDateEvent($date_event)
  {
    if(empty($date_event)) {
      return false;
    }
    else {
      $this->date_event = $date_event;
      return $this;
    }
  }

  /**
   * Get the value of Nb Guests
   *
   * @return mixed
   */
  public function getNbGuests()
  {
    return $this->nb_guests;
  }

  /**
   * Set the value of Nb Guests
   *
   * @param mixed nb_guests
   *
   * @return self
   */
  public function setNbGuests($nb_guests)
  {
    if(empty($nb_guests)) {
      return false;
    }
    else {
      $this->nb_guests = $nb_guests;
      return $this;
    }
  }

  /**
   * Get the value of Status
   *
   * @return mixed
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set the value of Status
   *
   * @param mixed status
   *
   * @return self
   */
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get the value of Address
   *
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * Set the value of Address
   *
   * @param mixed address
   *
   * @return self
   */
  public function setAddress($address)
  {
    if(empty($address)) {
      return false;
    }
    else {
      $this->address = $address;
      return $this;
    }
  }

  /**
   * Get the value of City
   *
   * @return mixed
   */
  public function getCity()
  {
    return $this->city;
  }

  /**
   * Set the value of City
   *
   * @param mixed city
   *
   * @return self
   */
  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  /**
   * Get the value of Zipcode
   *
   * @return mixed
   */
  public function getZipcode()
  {
    return $this->zipcode;
  }

  /**
   * Set the value of Zipcode
   *
   * @param mixed zipcode
   *
   * @return self
   */
  public function setZipcode($zipcode)
  {
    $this->zipcode = $zipcode;

    return $this;
  }

  /**
   * Get the value of Is Virtual
   *
   * @return mixed
   */
  public function getIsVirtual()
  {
    return $this->is_virtual;
  }

  /**
   * Set the value of Is Virtual
   *
   * @param mixed is_virtual
   *
   * @return self
   */
  public function setIsVirtual($is_virtual)
  {
    if($is_virtual != 0 && $is_virtual != 1) {
      return false;
    }
    else {
      $this->is_virtual = $is_virtual;
      return $this;
    }
  }

  /**
   * Get the value of Virtual Address
   *
   * @return mixed
   */
  public function getVirtualAddress()
  {
    return $this->virtual_address;
  }

  /**
   * Set the value of Virtual Address
   *
   * @param mixed virtual_address
   *
   * @return self
   */
  public function setVirtualAddress($virtual_address)
  {
    $this->virtual_address = $virtual_address;

    return $this;
  }

  /**
   * Get the value of Organizer Id
   *
   * @return mixed
   */
  public function getOrganizerId()
  {
    return $this->organizer_id;
  }

  /**
   * Set the value of Organizer Id
   *
   * @param mixed organizer_id
   *
   * @return self
   */
  public function setOrganizerId($organizer_id)
  {
    if(empty($organizer_id)) {
      return false;
    }
    else {
      $this->organizer_id = $organizer_id;
      return $this;
    }
  }
}
