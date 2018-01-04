<?php
/*
 * 1. Створити абстрактний клас “фігура”
 * 2. Створити трейт і інтерфейс під нього для встановлення і получення назви фігури (string),
 *    підключити їх в аострактний клас з пункту 1
 * 3. Створити інтерфейси “площа” (описує функцію обрахунку площі фігури), “довжина”
 *    (описує функцію обрахунку довжини контурів фігури), “кількість кутів” (описує функцію виводу кількості кутів)
 * 4. Cтворити класи “куб”, “трикутник”, “коло” (їх початкові параметри задаються в конструкторі),
 *    які наслідують клас “фігура” і реалізовуються інтерфейси з пункту 3
 * 5. Створити список з випадкових об’єктів (з пункта 4) і функцію яка б “пробігалась” по цьому списку і
 *    відсортовувала б всі елементи на 3 групи, і потім по кожній взнали загальну площу, довжину, кількість кутів
 * */
abstract class Figure implements iName, iSquare, iLength, iConers
{
    protected $name = "";
    use traiteFigure;
}
class Cube extends Figure
{
    private $numberSides = 4;
    private $sideLength;

    public function __construct($length)
    {
        $this->sideLength = $length;
    }

    public function calcSquare()
    {
        return pow($this->sideLength, 2);
    }

    public function calcLength()
    {
        return $this->numberSides * $this->sideLength;
    }

    public function calcConersNumber()
    {
        return $this->numberSides;
    }
}
class Triangle extends Figure
{
    private $numberSides = 3;
    private $sideLength;

    public function __construct($length)
    {
        $this->sideLength = $length;
    }

    /**
     * calc area of an equilateral triangle
     * @return float
     */
    public function calcSquare()
    {
        return (pow($this->sideLength, 2)*sqrt(3))/4;
    }

    public function calcLength()
    {
        return $this->numberSides * $this->sideLength;
    }

    public function calcConersNumber()
    {
        return $this->numberSides;
    }
}
class Circle extends Figure
{
    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function calcSquare()
    {
        return (3.14 * pow($this->radius,2));
    }

    public function calcLength()
    {
        return 2*3.14*$this->radius;
    }

    public function calcConersNumber()
    {
        return 0;
    }
}

class FiguresGroup implements iSquare, iLength, iConers
{
    private $figures = array();

    function addFigure (Figure $figure){
        array_push($this->figures, $figure);
    }

    public function calcSquare()
    {
        $result = 0;
        foreach ($this->figures as $figure) {
            $result += $figure->calcSquare();
        }
        return $result;
    }

    public function calcLength()
    {
        $result = 0;
        foreach ($this->figures as $figure) {
            $result += $figure->calcLength();
        }
        return $result;
    }

    public function calcConersNumber()
    {
        $result = 0;
        foreach ($this->figures as $figure) {
            $result += $figure->calcConersNumber();
        }
        return $result;
    }
}
interface iName
{
    public function setName(string $name);
    public function getName();
}

interface iSquare
{
    public function calcSquare();
}
interface iLength
{
    public function calcLength();
}
interface iConers
{
    public function calcConersNumber();
}
trait traiteFigure {

    function setName(string $name)
    {
        $this->name = $name;
    }

    function getName() : string
    {
        return $this->name;
    }
}

/**
 * Створити список з випадкових об’єктів (з пункта 4) і функцію яка б “пробігалась” по цьому списку і
 * відсортовувала б всі елементи на 3 групи, і потім по кожній взнали загальну площу, довжину, кількість кутів
 * @param array $classesNames - массив назв классів, для яких будуть сворені обєкти
 * @param int $objectNumber - кількість обєктів
 * @return array - массив результату
 */
function controller(array $classesNames, int $objectNumber) : array
{
    $objects = array();
    $result = array();

    /* рандомно створюємо обєкти із списку класів */
    for ($counter = 0; $counter < $objectNumber; $counter++){
        $className = $classesNames[mt_rand(0,count($classesNames)-1)];
        $objects[] = new $className(mt_rand(5,20));
    }

    /* створимо обєкти для груп фігур */
    foreach ($classesNames as $className){
        $result[$className]['object'] = new FiguresGroup();
    }

    /* створимо обєкти для груп фігур */
    foreach ($objects as $figure){
        $className = get_class($figure);
        $result[$className]['object']->addFigure($figure);
    }

    /* порахуємо площу, довжину, кути */
    foreach ($result as &$group){
        $group['square'] = $group['object']->calcSquare();
        $group['length'] = $group['object']->calcLength();
        $group['coners'] = $group['object']->calcConersNumber();
    }

    return $result;
}

$result = controller(["Cube", "Triangle", "Circle"], 15);
echo "<pre>";
print_r($result);
echo "</pre>";