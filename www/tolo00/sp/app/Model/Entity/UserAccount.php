<?php

namespace App\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class UserAccount
{

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    use Id;

    /** @ORM\OneToMany(targetEntity="PostLike", mappedBy="userAccount") */
    public Collection $postLikes;

    /** @ORM\OneToMany(targetEntity="Comment", mappedBy="userAccount") */
    public Collection $comments;

    /** @ORM\Column(type="string") */
    public string $role;

    /** @ORM\Column(type="string") */
    public string $username;

    /** @ORM\Column(type="string") */
    public string $profilePhoto;

    /** @ORM\Column(type="string") */
    public ?string $email = null;

    /** @ORM\Column(type="string") */
    public ?string $password = null;

    /** @ORM\Column(type="datetime") */
    public \DateTimeInterface $dateCreated;

    public function __construct()
    {
        $this->postLikes = new ArrayCollection;
        $this->comments = new ArrayCollection;
    }

}
