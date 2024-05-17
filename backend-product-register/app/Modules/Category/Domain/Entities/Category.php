<?php

namespace App\Modules\Category\Domain\Entities;

class Category
{
    private $id;
    private $name;
    private $situation;
    private $created_at;
    private $updated_at;

    public function __construct($name, $situation)
    {
        $this->name = $name;
        $this->situation = $situation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSituation()
    {
        return $this->situation;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
