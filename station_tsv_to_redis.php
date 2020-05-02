<?php date_default_timezone_set('Asia/Tokyo');

$file = new SplFileObject('station20151215free.txt', 'r');
$file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD);
$file->setCsvControl("\t");

$i = 0;

foreach ($file as $line)
{
    $fields[] = $line;
}

$n = count($fields);
$i = 9; // fields[9]からが実データ

for( ; $i < $n; $i++ ){

    // fields[i][10]=経度,[11]=緯度,[3]=駅名
    echo "GEOADD ekipos " .
    $fields[$i][10] . " " .
    $fields[$i][11] . " " .
    "\"" . $fields[$i][3] . "\"\n";

}
