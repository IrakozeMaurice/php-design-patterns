<?php

require 'functions.php';

interface BookInterface
{
    public function open();
    public function turnPage();
}

interface eReaderInterface
{
    public function turnOn();
    public function pressNextButton();
}

class Book implements BookInterface
{
    public function open()
    {
        dd('opening the book...');
    }

    public function turnPage()
    {
        dd('turning the page...');
    }
}

class Kindle implements eReaderInterface
{
    public function turnOn()
    {
        dd('turning the kindle on...');
    }

    public function pressNextButton()
    {
        dd('pressing the next button on the kindle...');
    }
}

class Nook implements eReaderInterface
{
    public function turnOn()
    {
        dd('turning the Nook on...');
    }

    public function pressNextButton()
    {
        dd('pressing the next button on the Nook...');
    }
}

class eReaderAdapter implements BookInterface
{
    protected eReaderInterface $reader;

    public function __construct(eReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    public function open()
    {
        $this->reader->turnOn();
    }
    public function turnPage()
    {
        $this->reader->pressNextButton();
    }
}

class Person
{
    public function read(BookInterface $book)
    {
        $book->open();
        $book->turnPage();
    }
}

(new Person)->read(new Book);
(new Person)->read(new eReaderAdapter(new Kindle));
(new Person)->read(new eReaderAdapter(new Nook));
