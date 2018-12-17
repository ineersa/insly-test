<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 10:39 AM
 */

namespace app\Policy;

use app\Policy\Rules\Commission;
use app\Policy\Rules\Tax;

final class CalculatorResult
{
    private $calculator;

    /**
     * @var BasePriceCalculator
     */
    private $basePrice;

    /**
     * @var integer
     */
    private $tax;

    /**
     * @var integer
     */
    private $commission;

    /**
     * @var array
     */
    private $installments = [];

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function calc()
    {
        $this->setBasePrice();

        $this->applyRules();

        return $this;
    }

    /**
     * @throws \Exception
     */
    private function applyRules()
    {
        $this->tax = (new Tax($this->getBasePrice()->getBasePrice(), $this->calculator->getTaxPercentage()))->calc();
        $this->commission = (new Commission($this->basePrice->getBasePrice()))->calc();
        if ($this->calculator->getInstallments() > 1) {
            $installmentsCalculator = new InstallmentsCalculator($this->calculator, $this);
            $this->installments = $installmentsCalculator->getInstallments();
        }
    }

    public function setBasePrice()
    {
        $this->basePrice = new BasePriceCalculator($this->calculator);
    }

    /**
     * @return BasePriceCalculator
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @return mixed
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param int $commission
     */
    public function setCommission(int $commission): void
    {
        $this->commission = $commission;
    }

    public function getTotal(): int
    {
        return $this->getBasePrice()->getBasePrice() + $this->getCommission() + $this->getTax();
    }

    /**
     * @param int $tax
     */
    public function setTax(int $tax): void
    {
        $this->tax = $tax;
    }

    /**
     * @return CalculatorResult[]
     */
    public function getInstallments(): array
    {
        return $this->installments;
    }

    public function getCarValue()
    {
        return $this->calculator->getCarValue();
    }

    public function getCommissionPercent()
    {
        return Commission::PERCENT;
    }

    public function getTaxPercent()
    {
        return $this->calculator->getTaxPercentage();
    }

}