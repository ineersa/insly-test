<?php
/**
 * @var \app\Policy\CalculatorResult $result
 * @var \App\Policy\CalculatorResult $installment
 */
echo '
<table border="1" width="100%">
   <tr>
    <th></th>
    <th>Policy</th>';
    foreach($result->getInstallments() as $k => $installment) {
        echo '<th>'.($k+1).' installment</th>';
    }
   echo '</tr>';
   echo '<tr>
    <td>Value</td>
    <td>'.round($result->getCarValue() / 100, 2).'</td>';
    foreach($result->getInstallments() as $installment) {
        echo '<td>&nbsp;</td>';
    }
   echo '</tr>';
   echo '<tr>
    <td>Base premium ('.($result->getBasePrice()->getBasePercent() * 100).'%)</td>
    <td>'.round($result->getBasePrice()->getBasePrice() / 100, 2).'</td>';
    foreach($result->getInstallments() as $installment) {
        echo '<td>'.round($installment['basePrice']/100,2).'</td>';
    }
    echo '</tr>';
    echo '<tr>
        <td>Commission ('.($result->getCommissionPercent() * 100).'%)</td>
        <td>'.round($result->getCommission() / 100, 2).'</td>';
    foreach($result->getInstallments() as $installment) {
        echo '<td>'.round($installment['commission'] / 100 ,2).'</td>';
    }
    echo '</tr>';
    echo '<tr>
        <td>Tax ('.($result->getTaxPercent() * 100).'%)</td>
        <td>'.round($result->getTax() / 100, 2).'</td>';
    foreach($result->getInstallments() as $installment) {
        echo '<td>'.round($installment['tax'] / 100, 2).'</td>';
    }
    echo '</tr>';
    echo '<tr>
        <td>TOTAL cost</td>
        <td>'.round($result->getTotal() / 100, 2).'</td>';
    foreach($result->getInstallments() as $installment) {
        echo '<td>'.round($installment['total'] / 100, 2).'</td>';
    }
    echo '</tr>';
echo '</table>';
