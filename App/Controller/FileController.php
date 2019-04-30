<?php
/**
 * Created by PhpStorm.
 * User: ivasko
 * Date: 28/04/2019
 * Time: 23:22
 */

namespace App\Controller;


class FileController
{
    private $filePath;

    public function __construct($path)
    {
        if (file_exists($path)) {
            $this->filePath = $path;
        } else {
            die('File (' . $path . ')  not exist' . "\n");
        }
    }

    private function getAssocArrayFromJsonFile()
    {
        $fileData = file_get_contents($this->filePath);
        $fileDataToArray = json_decode($fileData, true);

        return $fileDataToArray;
    }

    public function getRequiredIncome()
    {
        $data = $this->getAssocArrayFromJsonFile();
        $requiredIncome = $data['required_income'];

        if (is_numeric($requiredIncome)) {
            return $requiredIncome;
        } else {
            die ("Required income must be numeric. \n");
        }
    }

    public function getSmsList()
    {
        $data = $this->getAssocArrayFromJsonFile();
        $smsList = $data['sms_list'];

        if (is_array($smsList)) {
            return $smsList;
        } else {
            die ("Sms list must be array. \n");
        }
    }
}