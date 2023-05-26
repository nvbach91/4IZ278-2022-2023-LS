<?php

namespace App\Model\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class CommentLike
{

    use Id;

    /** @ORM\ManyToOne(targetEntity="Comment", inversedBy="likes") */
    public Comment $comment;

    /** @ORM\ManyToOne(targetEntity="UserAccount") */
    public UserAccount $userAccount;

    /** @ORM\Column(type="datetime") */
    public DateTimeInterface $dateCreated;

}
