<?php

class Address
{
    protected string $line_1;

    protected string $line_2;

    protected string $city;

    protected string $state;

    protected string $zip;

    /**
     * @param string $line_1
     * @param string $line_2
     * @param string $city
     * @param string $state
     * @param string $zip
     */
    public function __construct(string $line_1, string $line_2, string $city, string $state, string $zip)
    {
        $this->line_1 = $line_1;
        $this->line_2 = $line_2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    public function getLine1(): string
    {
        return $this->line_1;
    }

    public function setLine1(string $line_1): void
    {
        $this->line_1 = $line_1;
    }

    public function getLine2(): string
    {
        return $this->line_2;
    }

    public function setLine2(string $line_2): void
    {
        $this->line_2 = $line_2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

}