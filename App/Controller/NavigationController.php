<?php

namespace App\Controller;


class NavigationController
{
    protected $fileReader;
    protected $algorithm;
    protected $communicate;

    public function __construct()
    {
        $this->communicate = new CommunicateWithUser();
        $this->fileReader = new FileController($this->communicate->chooseJsonFile());
        $this->algorithm = new AlgorithmController();
    }

    public function index()
    {
        $smsList = $this->fileReader->getSmsList();
        $requiredIncome = $this->fileReader->getRequiredIncome();
        $result = $this->algorithm->findBestSmsCombination($smsList, $requiredIncome);

        print_r($result);
    }
}