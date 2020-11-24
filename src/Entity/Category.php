<?php


namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $color;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="date")
     */
    private $publication_date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publish;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * @param mixed $publication_date
     */
    public function setPublicationDate($publication_date): void
    {
        $this->publication_date = $publication_date;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish): void
    {
        $this->publish = $publish;
    }


}