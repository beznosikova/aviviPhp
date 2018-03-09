<?php
/**
 * Объекты создаются посредством вызова не конструктора, а генерирующего метода
 * определённого в интерфейсе и реализованного дочерними классами либо реализованного в базовом классе
 *
 * Паттерн Factory Method позволяет системе оставаться независимой
 * как от самого процесса порождения объектов, так и от их типов.
 *
 */

/** Одна кадровичка не в силах провести собеседования со всеми кандидатами на все должности.
 * В зависимости от вакансии она может делегировать разные этапы собеседований разным сотрудникам.
 *
 * Это способ делегирования логики создания объектов (instantiation logic) дочерним классам.
 */
interface Interviewer
{
    public function askQuestions();
}

class Developer implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}

class CommunityExecutive implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}



abstract class HiringManager
{

    // Фабричный метод
    abstract public function makeInterviewer(): Interviewer;

    public function takeInterview()
    {
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}

class DevelopmentManager extends HiringManager
{
    public function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}

class MarketingManager extends HiringManager
{
    public function makeInterviewer(): Interviewer
    {
        return new CommunityExecutive();
    }
}


$devManager = new DevelopmentManager();
$devManager->takeInterview();

$marketingManager = new MarketingManager();
$marketingManager->takeInterview();
