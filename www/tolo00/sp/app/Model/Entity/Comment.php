<?php

namespace App\Model\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class Comment
{

    public const LOADED_COMMENTS_DEFAULT_LIMIT = 2;
    public const LOADED_REPLIES_DEFAULT_LIMIT = 1;

    use Id;

    /** @ORM\ManyToOne(targetEntity="Post", inversedBy="comments") */
    public Post $post;

    /** @ORM\OneToMany(targetEntity="CommentLike", mappedBy="comment", cascade={"remove"}) */
    public Collection $likes;

    /** @ORM\ManyToOne(targetEntity="UserAccount") */
    public UserAccount $userAccount;

    /** @ORM\ManyToOne(targetEntity="Comment", inversedBy="childrenComments") */
    public ?Comment $parentComment = null;

    /** @ORM\OneToMany(targetEntity="Comment", mappedBy="parentComment", cascade={"remove"}) */
    public Collection $childrenComments;

    /** @ORM\Column(type="text") */
    public string $text;

    /** @ORM\Column(type="datetime") */
    public DateTimeInterface $dateCreated;

    public function __construct()
    {
        $this->likes = new ArrayCollection;
        $this->childrenComments = new ArrayCollection;
    }

}
