<?php
namespace Mealoclock\Model;

class CommunityModel extends CoreModel
{
  // Définition de la 'TABLE' pour le Model Community
  const TABLE = 'communities';

  protected $id;
  protected $community_name;
  protected $description;
  protected $image;
  protected $slug;

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
   * Get the value of Community Name
   *
   * @return mixed
   */
  public function getCommunityName()
  {
    return $this->community_name;
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
   * Get the value of Image
   *
   * @return mixed
   */
  public function getImage()
  {
    return $this->image;
  }

  /**
   * Get the value of Slug
   *
   * @return mixed
   */
  public function getSlug()
  {
    return $this->slug;
  }
}
