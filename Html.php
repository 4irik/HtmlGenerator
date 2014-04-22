<?php

class Html {
    /**
     * @var string текущая кодовая таблицы
     * TODO: возможно надо перенести в отдельный класс занимающийся кодовыми таблицами
     */
    protected static $encode = 'utf-8';

    /**
     * Устанавливает для класса кодовую таблицу символов
     * @param string $encode
     */
    public static function setEncode($encode){
        if(!$encode){
            return;
        }

        self::$encode = $encode;
    }

    /**
     * Возвращает установленню для класса кодовую таблицу символов
     * @return string
     */
    public static function getEncode(){
        return self::$encode;
    }

    /**
     * Обёртка над htmlspecialchars
     * Преобразует специальные символы в HTML-сущности
     * @param string $content
     * @param int $flags битовая маска, по-умолчанию "ENT_QUOTES"
     * @param string $encoding кодировка
     * @param bool $doubleEncode
     * @return string
     * @see http://www.php.net/manual/ru/function.htmlspecialchars.php
     */
    public static function encode($content, $flags = ENT_QUOTES, $encoding = '', $doubleEncode = true){
        if(!$encoding){
            $encoding = self::getEcnode();
        }
        return htmlspecialchars($content, $flags, $encoding, $doubleEncode);
    }
    /**
     * Обёртка над htmlspecialchars_decode
     * Преобразует специальные HTML-сущности обратно в соответствующие символы
     * @param string $content
     * @param int $flags битоваая маска, по-умолчанию "ENT_QUOTES"
     * @return string
     * @see encode()
     * @link http://www.php.net/manual/ru/function.htmlspecialchars-decode.php
     */
    public static function decode($content, $flags = ENT_QUOTES){
        return htmlspecialchars_decode($content, $flags);
    }

    /**
     * Генерация марикированного списка
     * @param array $items элементы списка (тэг "li")
     * @param array $options аттрибуты тэга "ul"
     * @return string
     * @see buildList() чтобы узнать как генерируется html-код
     */
    public static function ul($items, $options=array()){
        return self::buildList('ul', $items, $options);
    }

    /**
     * Генерация нумерованного списка
     * @param array $items элементы списка (тэг "li")
     * @param array $options аттрибуты тэга "ol"
     * @return string
     * @see buildList() чтобы узнать как генерируется html-код
     */
    public static function ol($items, $options=array()){
        return self::buildList('ol', $items, $options);
    }

    /**
     * Генерация кода списка маркированного/нумерованного
     * @param string $type ul|ol
     * @param array $items элементы списка
     * @param array $options атрибуты списка
     * @return string
     */
    protected static function buildList($type, $items, $options){
        $item = array();
        foreach($items as $li){
            $item[] = self::tag('li', $li);
        }

        return self::tag($type, implode("\n\t", $item), $options);
    }

    /**
     * Генерация таблицы
     * @param array $data данные строк таблицы (двумерный массив)
     * @param array $head данные заголовка таблицы (одномерный массив)
     * @param array $options аттрибуты таблицы
     * @return string
     */
    public static function table($data, $head=array(), $options=array()){
        $table = self::tag('table', '',$options, false) . "\n";

        // заголовок
        if($head){
            $table .= self::tag('thead', '', array(), false) . "\n";
                $table .= "\t" . self::tag('tr', '', array(), false) . "\n";
                foreach($head as $headItem){
                    $table .= "\t\t" . self::tag('th', $headItem) . "\n";
                }
                $table .= "\t" . self::closeTag('tr') . "\n";
            $table .= self::closeTag('thead') . "\n";
        }

        // тело
        $table .= self::tag('tbody', '', array(), false) . "\n";
        foreach($data as $tr){
            $table .= "\t" . self::tag('tr', '', array(), false) . "\n";
            foreach($tr as $td){
                $table .= "\t\t" . self::tag('td', $td) . "\n";
            }
            $table .= "\t" . self::closeTag('tr') . "\n";
        }
        $table .= self::closeTag('tbody') . "\n";

        $table .= self::closeTag('table');

        return $table;
    }

    /**
     * Генерирует HTML-код тэга
     * @param string $name имя html-тэга
     * @param string $content содержимое тэга
     * @param array $options аттрибуты тэга
     * @param bool $closeTag флаг наличия закрывающиего тэга
     * @return string
     * @see generateAttribute() детали генерации атрибутов тэга
     */
    public static function tag($name, $content='', $options=array(), $closeTag=true){
        $html = '<' . $name . self::generateAttribute($options) .'>';

        if($content){
            $html .= $content;
        }

        return ($closeTag) ? $html. self::closeTag($name) : $html;
    }

    /**
     * Генерирует html-разметку закрывающего тэга
     * @param string $name имя html-тэга
     * @return string
     */
    public static function closeTag($name){
        return '</'.$name.'>';
    }

    /**
     * Генерирует строку с атрибутами html-тэга
     * тэг "value" предварительно обрабатывается - html заменяется специальными HTML-сущностями
     * @param array $options параметры html-тэга
     * @return string
     * @see encode()
     */
    protected static function generateAttribute($options){
        $attribute = '';
        foreach($options as $key=>$value){
            // значение атрибута "value" следуюет предварительно обработать
            if($key == 'value' && $value){
                $attribute .= ' ' . $key . '=' . '"'. self::encode($value) .'"';

                continue;
            }

            $attribute .= ' ' . $key . '=' . '"'. $value .'"';
        }

        return $attribute;
    }
}