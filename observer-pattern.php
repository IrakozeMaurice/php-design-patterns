<?php

require 'functions.php';

interface Subject
{
    public function attach($observable);
    public function detach($index);
    public function notify();
}

interface Observer
{
    public function handle();
}

class Login implements Subject
{
    protected $observers = [];

    public function attach($observable)
    {
        if (is_array($observable)) {
            return $this->attachObservers($observable);
        }

        $this->observers[] = $observable;
        return $this;
    }
    private function attachObservers($observable)
    {
        foreach ($observable as $observer) {
            if (!$observer instanceof Observer) {
                throw new Exception;
            }
            $this->attach($observer);
        }
    }

    public function detach($index)
    {
        unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->handle();
        }
    }

    public function fire()
    {
        // perform login
        // ....

        // notify any registered listeners
        $this->notify();
    }
}

class LogHandler implements Observer
{
    public function handle()
    {
        dd('log something important');
    }
}

class EmailNotifier implements Observer
{
    public function handle()
    {
        dd('fire of an email');
    }
}
class LoginReporter implements Observer
{
    public function handle()
    {
        dd('do some form of reporting');
    }
}


$login = new Login;

$login->attach([
    new LogHandler,
    new EmailNotifier,
    new LoginReporter,
]);

$login->fire();
