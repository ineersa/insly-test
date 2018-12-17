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

    /**
     * @var CalculatorResult
     */
    private $result;

    /**
     * @var CalculatorResult[]
     */
    private $installmentPayments;

    /**
     * InstallmentsCalculator constructor.
     * @param Calculator $calculator
     * @param CalculatorResult $result
     * @throws \Exception
     */
    public function __construct(Calculator $calculator, CalculatorResult $result)
    {
        $this->calculator = $calculator;
        $this->result = $result;

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
            $installmentPayments[] = [
                'basePrice' => floor($this->result->getBasePrice()->getBasePrice() / $this->calculator->getInstallments()),
                'tax' => floor($this->result->getTax() / $this->calculator->getInstallments()),
                'commission' => floor($this->result->getCommission() / $this->calculator->getInstallments()),
                'total' => floor($this->result->getTotal() / $this->calculator->getInstallments())
            ];
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

        $totalBasePrice = $totalCommission = $totalTax = $total = 0;
        foreach ($this->getInstallments() as $installment) {
            $totalBasePrice += $installment['basePrice'];
            $totalCommission += $installment['commission'];
            $totalTax += $installment['tax'];
            $total += $installment['total'];
        }

        if ($totalBasePrice != $result->getBasePrice()->getBasePrice()) {
            $this->installmentPayments[0]['basePrice'] =
                $this->installmentPayments[0]['basePrice'] + ($result->getBasePrice()->getBasePrice() - $totalBasePrice)
            ;
        }
        if ($totalCommission != $result->getCommission()) {
            $this->installmentPayments[0]['commission'] =
                $this->installmentPayments[0]['commission'] + ($result->getCommission() - $totalCommission)
            ;
        }
        if ($totalTax != $result->getTax()) {
            $this->installmentPayments[0]['tax'] =
                $this->installmentPayments[0]['tax'] + ($result->getTax() - $totalTax)
            ;
        }
        if ($total != $result->getTotal()) {
            $this->installmentPayments[0]['total'] =
                $this->installmentPayments[0]['total'] + ($result->getTotal() - $total)
            ;
        }
    }


    public function getInstallments()
    {
        return $this->installmentPayments;
    }
}