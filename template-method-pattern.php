<?php

require 'functions.php';


abstract class Sub
{
    public function make()
    {
        return $this
            ->layBread()
            ->addLettuce()
            ->addPrimaryToppings()
            ->addSauces();
    }

    public abstract function addPrimaryToppings();

    public function layBread()
    {
        dd('laying down the bread');

        return $this;
    }
    public function addLettuce()
    {
        dd('add some lettuce');

        return $this;
    }
    public function addSauces()
    {
        dd('add some sauces');

        return $this;
    }
}

class Turkey extends Sub
{
    public function addPrimaryToppings()
    {
        dd('add some turkey');

        return $this;
    }
}

class Veggie extends Sub
{
    public function addPrimaryToppings()
    {
        dd('add some veggies');

        return $this;
    }
}

(new Turkey)->make();
dd('-----------------');
(new Veggie)->make();
