<?php
/**
 * Created by PhpStorm.
 * User: ivasko
 * Date: 29/04/2019
 * Time: 09:16
 */

namespace App\Controller;


class CommunicateWithUser
{
    private function displayInputBoxToUser()
    {
        return trim(fgets(STDIN, 1024));
    }

    private function displayFilePathQuestionToUser()
    {
        echo "Choose file:  \n";
    }

    public function chooseJsonFile()
    {
        $this->displayFilePathQuestionToUser();
        $fileName = $this->displayInputBoxToUser();
        $fileName = FILES . $fileName;

        return $fileName;
    }
}