<?php

namespace App\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nettrine\ORM\Entity\Attributes\Id;

/** @ORM\Entity */
class PostTopic
{

    use Id;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="topics")
     */
    public Collection $posts;

    /** @ORM\Column(type="string") */
    public string $title;

    /** @ORM\Column(type="string") */
    public string $color;

    public function __construct()
    {
        $this->posts = new ArrayCollection;
    }

}
