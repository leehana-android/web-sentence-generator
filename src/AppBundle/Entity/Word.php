<?php
/**
 * Created by PhpStorm.
 * User: Hana
 * Date: 2015-08-21
 * Time: 오전 12:22
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WordRepository")
 * @ORM\Table(name="sg_word")
 */
class Word
{
    /**
     * @var integer
     *
     * @ORM\Column(name="_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $word;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $wordType;

    /**
     * @var integer
     *
     * @ORM\Column(name="genre", type="integer")
     */
    private $genreType;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $backup;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     * @return Word
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set wordType
     *
     * @param integer $wordType
     * @return Word
     */
    public function setWordType($wordType)
    {
        $this->wordType = $wordType;

        return $this;
    }

    /**
     * Get wordType
     *
     * @return integer
     */
    public function getWordType()
    {
        return $this->wordType;
    }

    /**
     * Set genreType
     *
     * @param integer $genreType
     * @return Word
     */
    public function setGenreType($genreType)
    {
        $this->genreType = $genreType;

        return $this;
    }

    /**
     * Get genreType
     *
     * @return integer
     */
    public function getGenreType()
    {
        return $this->genreType;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Word
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set backup
     *
     * @param integer $backup
     * @return Word
     */
    public function setBackup($backup)
    {
        $this->backup = $backup;

        return $this;
    }

    /**
     * Get backup
     *
     * @return integer
     */
    public function getBackup()
    {
        return $this->backup;
    }
}