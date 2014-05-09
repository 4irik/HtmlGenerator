<?php
/**
 * Проверка генерации таблиц
 */

include '../Html.php';

$head = array(
    'id',
    'Имя',
    'Фамилия',
    'Зарплата',
);
$data = array(
    array(1,'Иван','Иванов',5500.78),
    array(2,'Петр','Петров',8797.99),
    array(1,'Сидр','Сидоров',5463.10),
    array(1,'Николай','Николаев',9819.93),
);

echo Html::table($data, $head, array('class'=>'first_table'));

echo "\n<hr>\n";

echo Html::table($data, array(), array('class'=>'first_table'));