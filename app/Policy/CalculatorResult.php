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

    private $basePrice;

    private $isPremium = true;

    private $tax;

    private $commission;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calc()
    {
        $this->calculateBasePrice();

        $this->applyRules();

        return $this;
    }

    private function calculateBasePrice()
    {
        if ($this->calculator->getUserTime()->format("D") == 'Fri'
            && $this->calculator->getUserTime()->format("H") >= 15
            && $this->calculator->getUserTime()->format("H") <= 20) {

            $this->setIsPremium(false);
        }

        if ($this->isPremium()) {
            $this->basePrice = $this->calculator->getCarValue() * 0.11;
        } else {
            $this->basePrice = $this->calculator->getCarValue() * 0.13;
        }
    }

    private function applyRules()
    {
        $this->tax = (new Tax($this->basePrice, $this->calculator->getTaxPercentage()))->calc();
        $this->commission = (new Commission($this->basePrice))->calc();

    }

    /**
     * @return mixed
     */
    public function isPremium()
    {
        return $this->isPremium;
    }

    /**
     * @param mixed $isPremium
     */
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @return mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }
}