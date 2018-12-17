<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 11:11 AM
 */

namespace app\Policy\Rules;

class Tax
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
        return $this->base * $this->percent;
    }
}