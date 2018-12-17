<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 11:11 AM
 */

namespace app\Policy\Rules;

use app\Policy\Contracts\RuleContract;

final class Tax implements RuleContract
{
    private $base;

    private $percent;

    public function __construct($base, $percent)
    {
        $this->base = $base;
        $this->percent = $percent;
    }

    public function calc()
    {
        return ceil($this->base * $this->percent);
    }
}