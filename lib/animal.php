<?php
class Animal
{
    public $limbsNumber;
    public $age;

    public function __construct($age, $limbsNumber)
    {
        $this->age = $age;
        $this->limbsNumber = $limbsNumber;
    }

    protected function live()
    {
        echo "<hr>Animal::live()<br>";
    }

    public function run()
    {
        echo "<hr>Animal::run()<br>";
        $this->live();
        echo "Number of limbs:".$this->limbsNumber."<br>";
    }

    public function comeToMe()
    {
        echo "<hr>Animal::comeToMe()<br>";
        $this->live();
        if ($this->age > 10 || $this->limbsNumber <= 1){
            return false;
        } else {
            $this->run();
            return true;
        }
    }
}

class Snake extends Animal
{
    public function __construct($age)
    {
        parent::__construct($age, $limbsNumber = 0);
    }

    public function run()
    {
        echo "<hr>Snake::run()<br>";
        $this->live();
        $this->snake();
    }

    public function snake()
    {
        echo "<hr>Snake::snake()<br>";
    }
}

class Robot extends Animal
{
    protected function live()
    {
        echo "<hr>Robot::live()<br>";
        echo "killAllHumans<br>";
    }
}