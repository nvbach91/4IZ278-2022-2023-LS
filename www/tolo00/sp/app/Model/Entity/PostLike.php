<?php

namespace App\Model\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class PostLike
{

    use Id;

    /** @ORM\ManyToOne(targetEntity="Post", inversedBy="likes") */
    public Post $post;

    /** @ORM\ManyToOne(targetEntity="UserAccount") */
    public UserAccount $userAccount;

    /** @ORM\Column(type="datetime") */
    public DateTimeInterface $dateCreated;

}
