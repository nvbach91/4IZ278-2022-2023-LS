<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class UserAccount
{

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    use Id;

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

}
