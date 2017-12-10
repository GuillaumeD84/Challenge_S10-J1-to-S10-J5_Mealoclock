<?php
namespace Mealoclock\Model;

class CoreModel
{
  /**
   * On définie une constante 'TABLE' qui ne changera pas pendant l'éxécution.
   * Mais sa valeur sera différente dans chacun des Models.
   * Elle permet de désigner la table qui lui est attribuée en BD.
   */
  const TABLE = '';

  /**
   * Retourne toute la table demandée
   * SELECT * FROM `table`
   */
  public static function findAll()
  {
    // Connexion à la BD grâce à la classe Database
    // On veut le nom de table défini dans la classe ENFANT
    // afin de compléter la requête dynamiquement (const TABLE)
    $query = Database::getDB()->query('SELECT * FROM '.static::TABLE);

    // Retourne tous les résultats --sous forme d'objets--
    // (PDO::FETCH_CLASS)
    return $query->fetchAll(\PDO::FETCH_CLASS, static::class);
  }

  /**
   * Retourne un élément de la table demandée via l'id
   * SELECT * FROM `table` WHERE `id` = $id
   */
  public static function find($id)
  {
    // Préparation de la requête
    $query = Database::getDB()->prepare('SELECT * FROM '.static::TABLE.' WHERE `id` = :id');

    // On associe à :id la valeur $id
    $query->bindValue(':id', $id, \PDO::PARAM_INT);

    // On éxécute la requête
    $query->execute();

    // On retourne le résultat sous la forme d'un objet
    return $query->fetchObject(static::class);
  }
}
