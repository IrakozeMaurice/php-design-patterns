<?php

require 'functions.php';

interface CarService
{
    public function getCost();
    public function getDescription();
}

class BasicInspection implements CarService
{
    public function getCost()
    {
        return 25;
    }
    public function getDescription()
    {
        return 'Basic Inspection';
    }
}

class OilChange implements CarService
{
    protected $carService;

    public function __construct($carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return $this->carService->getCost() + 29;
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ', and Oil Change';
    }
}

class TireRotation implements CarService
{
    protected $carService;

    public function __construct($carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return $this->carService->getCost() + 15;
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ', and Tire Rotation';
    }
}

$service = new BasicInspection();
dd($service->getCost());
dd($service->getDescription());

$service = new OilChange(new BasicInspection());
dd($service->getCost());
dd($service->getDescription());

$service = new TireRotation(new OilChange(new BasicInspection()));
dd($service->getCost());
dd($service->getDescription());

$service = new TireRotation(new BasicInspection());
dd($service->getCost());
dd($service->getDescription());
