<?php
/**
 * Шаблон «Адаптер» позволяет помещать несовместимый объект в обёртку, чтобы он оказался совместимым с другим классом.
 */

interface Lion
{
    public function roar();
}

class AfricanLion implements Lion
{
    public function roar()
    {
        echo "AfricanLion";
    }
}

class AsianLion implements Lion
{
    public function roar()
    {
        echo "AsianLion";
    }
}


class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
    }
}


// Это нужно добавить
class WildDog
{
    public function bark()
    {
        echo "Wild dog";
    }
}

// Адаптер вокруг собаки сделает её совместимой с охотником
class WildDogAdapter implements Lion
{
    protected $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }
}


$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);

$lion = new AfricanLion();
$hunter->hunt($lion);