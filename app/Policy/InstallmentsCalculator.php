<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 1:22 PM
 */

namespace App\Policy;

final class InstallmentsCalculator
{
    private $calculator;

    private $installmentValue;

    /**
     * @var CalculatorResult[]
     */
    private $installmentPayments;

    /**
     * InstallmentsCalculator constructor.
     * @param Calculator $calculator
     * @throws \Exception
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
        $this->installmentValue = round(ceil($calculator->getCarValue() / $calculator->getInstallments()) / 100, 2);

        $this->build();
        $this->checkSum();
    }

    /**
     * @throws \Exception
     */
    private function build()
    {
        $installmentPayments = [];

        foreach(range(1, $this->calculator->getInstallments()) as $i) {
            $calculator = new Calculator(
                $this->installmentValue,
                $this->calculator->getTaxPercentage() * 100,
                1,
                $this->calculator->getUserTime()->format(DATE_ATOM)
            );
            $installmentPayments[] = $calculator->build();
        }

        $this->installmentPayments = $installmentPayments;
    }

    /**
     * @throws \Exception
     */
    private function checkSum()
    {
        //TODO refactor
        $this->calculator->setInstallments(1);
        $result = $this->calculator->build();

        $totalBasePrice = $totalCommission = $totalTax = 0;
        foreach ($this->getInstallments() as $installment) {
            $totalBasePrice += $installment->getBasePrice();
            $totalCommission += $installment->getCommission();
            $totalTax += $installment->getTax();
        }

        if ($totalBasePrice != $result->getBasePrice()->getBasePrice()) {
            $this->installmentPayments[0]->getBasePrice()->setBasePrice(
                $this->installmentPayments[0]->getBasePrice()->getBasePrice() +
                ($result->getBasePrice() - $totalBasePrice)
            );
        }

        if ($totalCommission != $result->getCommission()) {
            $this->installmentPayments[0]->setCommission(
                $this->installmentPayments[0]->getCommission() +
                ($result->getCommission() - $totalCommission)
            );
        }
        if ($totalTax != $result->getTax()) {
            $this->installmentPayments[0]->setTax(
                $this->installmentPayments[0]->getTax() +
                ($result->getTax() - $totalTax)
            );
        }
    }


    public function getInstallments()
    {
        return $this->installmentPayments;
    }
}