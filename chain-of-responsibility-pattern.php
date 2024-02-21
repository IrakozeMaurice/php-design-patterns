<?php

abstract class HomeChecker
{
    protected $successor;

    public abstract function check(HomeStatus $home);

    public function succeedWith(HomeChecker $successor)
    {
        $this->successor = $successor;
    }

    public function next(HomeStatus $home)
    {
        if ($this->successor) {
            $this->successor->check($home);
        }
    }
}

class Locks extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if (!$home->locked) {
            throw new Exception('The Doors not locked.abort abort!!!!');
        }

        $this->next($home);
    }
}

class Lights extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if (!$home->lightsOff) {
            throw new Exception('The Lights are still on.abort abort!!!!');
        }

        $this->next($home);
    }
}

class Alarm extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if (!$home->alarmOn) {
            throw new Exception('The Alarm is not set.abort abort!!!!');
        }

        $this->next($home);
    }
}

class HomeStatus
{
    public $alarmOn = true;
    public $locked = true;
    public $lightsOff = true;
}

// client
$locks = new Locks();
$alarm = new Alarm();
$lights = new Lights();

$locks->succeedWith($alarm);
$alarm->succeedWith($lights);

$locks->check(new HomeStatus);
