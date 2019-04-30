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
    public function findBestSmsCombination(array $smsList, $requiredIncome)
    {
        $sortedSmsListByPrice = $this->sortSmsListByPrice($smsList);
        $sortedListLength = count($sortedSmsListByPrice) - 1; //this number is a max position in sms array
        $smsCombination = []; //this array for suitable sms
        $epsilon = 0.00001; //this number to test for equality with abs

        for ($i = 0; $i < $sortedListLength; $i++) {
            while ($requiredIncome >= $sortedSmsListByPrice[$i]['income'] && $requiredIncome > $sortedSmsListByPrice[$i+1]['income']) {
                $smsCombination['smsPrice'][] = $sortedSmsListByPrice[$i]['price'];
                $requiredIncome = $requiredIncome - $sortedSmsListByPrice[$i]['income'];
                $smsCombination['requiredIncome'][] = $requiredIncome;
            }
        }

        //check if there is a residue and if there is, then remove it
        if ($requiredIncome > 0 && $requiredIncome <= $sortedSmsListByPrice[$sortedListLength]['income']
            or abs($requiredIncome - $sortedSmsListByPrice[$sortedListLength]['income']) < $epsilon) {
                $smsCombination['smsPrice'][] = $sortedSmsListByPrice[$sortedListLength]['price'];
                $requiredIncome = $requiredIncome - $sortedSmsListByPrice[$sortedListLength]['income'];
                $smsCombination['requiredIncome'][] = $requiredIncome;
        } elseif ($requiredIncome > 0 && $requiredIncome > $sortedSmsListByPrice[$sortedListLength]['income']) {
            $smsCombination['smsPrice'][] = $sortedSmsListByPrice[$sortedListLength - 1]['price'];
            $requiredIncome = $requiredIncome - $sortedSmsListByPrice[$sortedListLength - 1]['income'];
            $smsCombination['requiredIncome'][] = $requiredIncome;
        }

        return $smsCombination;
    }

    private function sortSmsListByPrice(array $array)
    {
        foreach ($array as $sms) {
            $sortedSmsListByPrice[$sms['price']] = $sms;
        }
        rsort($sortedSmsListByPrice);

        return $sortedSmsListByPrice;
    }
}