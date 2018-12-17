<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 11:11 AM
 */
namespace app\Policy\Rules;

final class Commission
{
    private $base;

    const PERCENT = 0.17;

    public function __construct($base)
    {
        $this->base = $base;
    }

    public function calc()
    {
        return $this->base * self::PERCENT;
    }
}