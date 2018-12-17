<?php
echo <<<EOF
<form method="POST" action="/task2">
    Estimated value of the car (100 - 100 000 EUR):<br>
  <input type="number" min="100" max="100000" name="car_value" required><br>
    Tax percentage %:<br>
  <input type="number" min="0" max="100" name="tax_percentage" required>
    <br>Number of instalments %:<br>
  <input type="hidden" id="user-time" name="user_time" value="">  
EOF;
echo '<select name="installments" id="installments" required>';
    foreach (range(1,12) as $i) {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
echo '</select><br><br>';

echo '<button type="submit"> Calculate </button>';

echo '</form>';
echo <<<EOF
<script type="text/javascript">
    var date = new Date();
    console.log(date);
    var el = document.getElementById('user-time');
    el.value = date;
</script>
EOF;
