<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlogRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Blog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     */
    private $title;

    /**
    * @Assert\IsTrue(message="First letter of post must be in upper case!")
    */
    public function isFirstLetterUpper($value=''){
        if ($this->title)
            return ctype_upper($this->title[0]);
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=true)
     */
    private $is_published;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=1500)
     * @Assert\NotBlank
     * @Assert\Length(min=5, max=1500)
     */
    private $content;

    /**
    * @ORM\Column
    */
    private $imagePath;

    /**
    * @Assert\File
    */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="tags", type="integer", nullable=true)
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="tags")
     */
    private $tags;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Blog
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Blog
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Blog
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

     /**
     * Set isPublished
     *
     * @return bool
     */
    public function setIsPublished()
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    

    /**
     * Set tagsId
     *
     * @param integer $tagsId
     *
     * @return Blog
     */
    public function setTagsId($tagsId)
    {
        $this->tagsId = $tagsId;

        return $this;
    }

    /**
     * Get tagsId
     *
     * @return int
     */
    public function getTagsId()
    {
        return $this->tagsId;
    }

    /**
    * @ORM\PrePersist
    */
public function setInitialCreatedAt() 
    {
        $this->createdAt = new \DateTime;
    }


    /**
     * Set imagePath
     *
     * @param string $imagePath
     *
     * @return Blog
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setImageFile($file)
    {
        $this->imageFile = $file;
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set tags
     *
     * @param integer $tags
     *
     * @return Blog
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return integer
     */
    public function getTags()
    {
        return $this->tags;
    }
}
