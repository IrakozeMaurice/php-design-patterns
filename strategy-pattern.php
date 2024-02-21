<?php

require 'functions.php';

// define a family of algorithms
// encapsulate and make them interchangeable

interface Logger
{
    public function log($data);
}

class LogToFile implements Logger
{
    public function log($data)
    {
        dd('Log to a file ' . $data);
    }
}

class LogToDatabase implements Logger
{
    public function log($data)
    {
        dd('Log to the database ' . $data);
    }
}

class LogToAWS implements Logger
{
    public function log($data)
    {
        dd('Log to aws ' . $data);
    }
}

class App
{
    public function log($data, Logger $logger = null)
    {
        $logger = $logger ?? new LogToFile;
        $logger->log($data);
    }
}

(new App)->log('some information', new LogToFile);
(new App)->log('some information', new LogToDatabase);
(new App)->log('some information', new LogToAWS);
(new App)->log('some information');
