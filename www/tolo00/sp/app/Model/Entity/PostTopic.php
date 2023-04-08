<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class PostTopic
{

    use Id;

    /** @ORM\Column(type="string") */
    public string $title;

    /** @ORM\Column(type="string") */
    public string $color;

}
