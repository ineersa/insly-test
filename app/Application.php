<?php
/**
 * Created by PhpStorm.
 * User: ineersa
 * Date: 12/17/18
 * Time: 9:37 AM
 */

namespace app;

use app\Policy\Calculator;

class Application
{
    public function __construct()
    {
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        $this->routeRequest();
        die();

    }

    /**
     * @throws \Exception
     */
    private function routeRequest()
    {
        switch ($_SERVER['REQUEST_URI']) {
            case '':
            case '/':
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    require __DIR__ . '/../views/index.php';
                    break;
                }
            case '/task1':
                require __DIR__ . '/../views/task1.php';
                break;
            case '/task2':
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    require __DIR__ . '/../views/task2-form.php';
                    break;
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $calculator = new Calculator(
                        $_POST['car_value'],
                        $_POST['tax_percentage'],
                        $_POST['installments'],
                        $_POST['user_time']
                    );
                    $result = $calculator->build();

                    require __DIR__ . '/../views/task2-result.php';
                    break;
                }
            default:
                die("No route");
        }
    }
}