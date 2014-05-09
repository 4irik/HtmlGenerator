<?php
/**
 * тест генерации html-разметки
 * списки (ul\li)
 */

include '../Html.php';

$dataSource = array(
    'Николай Бабинов',
    'Анастасия Бабичева',
    'Салим Бабуллаоглу',
    'Владимир Абашев',
    'Валентин Абабков',
);
$param = array('id'=>'id_1', 'class'=>'class_1', 'style'=>'color: red;');

echo "-- OL --\n";
echo Html::ol($dataSource, $param);
echo "\n-- UL --\n";
echo Html::ul($dataSource,$param);
