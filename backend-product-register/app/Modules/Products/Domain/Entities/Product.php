<?php

namespace App\Modules\Products\Domain\Entities;

class Product
{
    private $id;
    private $name;
    private $price;
    private $image;
    private $category_id;
    private $situation;
    private $created_at;
    private $updated_at;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->image = $data['image'];
        $this->category_id = $data['category_id'];
        $this->situation = $data['situation'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCategoryId()
    {
        return $this->category_id;
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
