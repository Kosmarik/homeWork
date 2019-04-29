<?php
/**
 * Created by PhpStorm.
 * User: ivasko
 * Date: 29/04/2019
 * Time: 00:38
 */

namespace App\Controller;


class AlgorithmController
{
    public function findBestSmsCombination($smsList, $requiredIncome)
    {
        $sortedSmsListByPrice = $this->sortSmsListByPrice($smsList);
        $smsCombination = [];

        foreach ($sortedSmsListByPrice as $sms) {
            while ($requiredIncome >= $sms['income']) {
                $smsCombination['price'][] = $sms['price'];
                $requiredIncome = $requiredIncome - $sms['income'];
                $smsCombination['required_income'][] = $requiredIncome;
            }
        }

        if ($requiredIncome > 0) {
            $sortedSmsListLast = count($sortedSmsListByPrice) - 1;
            $smsCombination['price'][] = $sortedSmsListByPrice[$sortedSmsListLast]['price'];
            $requiredIncome = $requiredIncome - $sortedSmsListByPrice[$sortedSmsListLast]['income'];
            $smsCombination['required_income'][] = $requiredIncome;
        }

        return $smsCombination['price'];
    }

    private function sortSmsListByPrice($array)
    {
        foreach ($array as $sms) {
            $sortedSmsListByPrice[$sms['price']] = $sms;
        }
        rsort($sortedSmsListByPrice);

        return $sortedSmsListByPrice;
    }
}