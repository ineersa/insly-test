<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 10:08 AM
 */
namespace app\Policy;

final class Calculator
{
    private $carValue;
    private $taxPercentage;
    private $installments;
    /**
     * @var \DateTime
     */
    private $userTime;

    /**
     * Calculator constructor.
     * @param $carValue
     * @param $taxPercentage
     * @param $installments
     * @param $userTime
     * @throws \Exception
     */
    public function __construct($carValue, $taxPercentage, $installments, $userTime)
    {
        $this->setCarValue($carValue);
        $this->setTaxPercentage($taxPercentage);
        $this->setInstallments($installments);
        $this->setUserTime($userTime);
    }

    /**
     * @param mixed $installments
     * @throws \Exception
     */
    public function setInstallments($installments)
    {
        $installments = (int) $installments;

        if ($installments < 1 || $installments > 12) {
            throw new \Exception('Installments incorrect');
        }

        $this->installments = $installments;
    }

    /**
     * @param mixed $taxPercentage
     * @throws \Exception
     */
    public function setTaxPercentage($taxPercentage)
    {
        $taxPercentage = (int) $taxPercentage;

        if ($taxPercentage < 0 || $taxPercentage > 100) {
            throw new \Exception('Tax percentage incorrect');
        }

        $this->taxPercentage = $taxPercentage;
    }

    /**
     * @param mixed $carValue
     * @throws \Exception
     */
    public function setCarValue($carValue)
    {
        $carValue = (int) $carValue;

        if ($carValue < 100 || $carValue > 100000) {
            throw new \Exception('Car value incorrect');
        }

        $this->carValue = $carValue;
    }

    public function build()
    {
        return (new CalculatorResult($this))->calc();
    }

    /**
     * @param mixed $userTime
     */
    public function setUserTime($userTime)
    {
        $this->userTime = new \DateTime($userTime);
    }

    /**
     * @return mixed
     */
    public function getInstallments()
    {
        return $this->installments;
    }

    /**
     * @return mixed
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage / 100;
    }

    /**
     * @return mixed
     */
    public function getCarValue()
    {
        return $this->carValue * 100;
    }

    /**
     * @return \DateTime
     */
    public function getUserTime()
    {
        return $this->userTime;
    }
}