<?php

namespace App\Model\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class Post
{

    use Id;

    /**
     * @ORM\ManyToMany(targetEntity="PostTopic")
     * @ORM\JoinTable(name="post_to_topic")
     */
    public Collection $topics;

    /** @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"remove"}) */
    public Collection $comments;

    /** @ORM\OneToMany(targetEntity="PostLike", mappedBy="post", cascade={"remove"}) */
    public Collection $likes;

    /** @ORM\ManyToOne(targetEntity="UserAccount") */
    public UserAccount $userAccount;

    /** @ORM\Column(type="string") */
    public string $postPhoto;

    /** @ORM\Column(type="text") */
    public string $text;

    /** @ORM\Column(type="datetime") */
    public DateTimeInterface $dateCreated;

    public function __construct()
    {
        $this->topics = new ArrayCollection;
        $this->comments = new ArrayCollection;
        $this->likes = new ArrayCollection;
    }

}
