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
$i = 9; // fields[9]���炪���f�[�^

for( ; $i < $n; $i++ ){

    // fields[i][10]=�o�x,[11]=�ܓx,[3]=�w��
    echo "GEOADD ekipos " .
    $fields[$i][10] . " " .
    $fields[$i][11] . " " .
    "\"" . $fields[$i][3] . "\"\n";

}
