<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 11:11 AM
 */
namespace app\Policy\Rules;

use app\Policy\Contracts\RuleContract;

final class Commission implements RuleContract
{
    private $base;

    const PERCENT = 0.17;

    public function __construct($base)
    {
        $this->base = $base;
    }

    public function calc()
    {
        return ceil($this->base * self::PERCENT);
    }
}