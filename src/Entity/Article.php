<?php


namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(
     *     message="Merci de remplir le titre"
     * )
     *
     * @Assert\Length(
     *     min=4,
     *     max=50,
     *     minMessage="Pas assez de caractères",
     *     maxMessage="Trop de caractères"
     * )
     *
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank (
     *     message="Merci de remplir le contenu"
     * )
     *
     * @Assert\Length(
     *     min=4,
     *     max=500,
     *     minMessage="Pas assez de caractères",
     *     maxMessage="Trop de caractères"
     * )
     *
     *
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $picture;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date(
     *     message="Merci de remplir une dâte"
     * )
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull(
     *     message="Merci de spécifier si l'article doit être publié ou non"
     * )
     *
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
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
