<?php
/**
 * Created by PhpStorm.
 * User: gs
 * Date: 18.04.14
 * Time: 0:40
 */

include '../Html.php';

echo Html::tag('a', 'ссылка', array('href'=>'/about.html', 'class'=>'new_link'));