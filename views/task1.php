<?php
$binStr = "01110000 01110010 01101001 01101110 01110100 00100000 01101111 01110101 01110100 00100000 01111001 01101111 01110101 01110010 00100000 01101110 01100001 01101101 01100101 00100000 01110111 01101001 01110100 01101000 00100000 01101111 01101110 01100101 00100000 01101111 01100110 00100000 01110000 01101000 01110000 00100000 01101100 01101111 01101111 01110000 01110011";

$str = "";
$bytesArray = explode(" ", $binStr);
foreach ($bytesArray as $byte) {
    $str .= chr(bindec($byte));
}

echo $str;

echo <<<EOF
    <br>
    <p>Decoding - convert binary to decimal and then take ascii code of symbol</p>
    <br>
    <br>
    <hr>
EOF;

for ($i=0; $i<1; $i++) {
    print "My name is Illya Vasylevskyi";
}
