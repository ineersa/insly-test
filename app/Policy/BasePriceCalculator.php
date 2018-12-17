<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 1:03 PM
 */

namespace app\Policy;

final class BasePriceCalculator
{
    private $basePercent;

    private $basePrice;

    const PERCENT_PREMIUM = 0.11;
    const PERCENT_NON_PREMIUM = 0.13;

    /**
     * @var Calculator
     */
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
        $this->setBasePercent();
        $this->calcBasePrice();
    }

    /**
     * @return mixed
     */
    public function getBasePercent()
    {
        return $this->basePercent;
    }

    private function setBasePercent()
    {
        if ($this->calculator->getUserTime()->format("D") == 'Fri'
            && $this->calculator->getUserTime()->format("H") >= 15
            && $this->calculator->getUserTime()->format("H") <= 20) {

            $this->basePercent = self::PERCENT_NON_PREMIUM;
        } else {
            $this->basePercent = self::PERCENT_PREMIUM;
        }

    }

    /**
     * @return mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    public function setBasePrice(int $basePrice) : void
    {
        $this->basePrice = $basePrice;
    }

    private function calcBasePrice()
    {
        $this->basePrice = ceil($this->calculator->getCarValue() * $this->getBasePercent());
    }
}