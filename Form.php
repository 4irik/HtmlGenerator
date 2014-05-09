<?php

/**
 * генерация разметки элементов html-формы
 * Class Form
 */
class Form extends Html {
    /**
     * Открывающий тег формы
     * @param string $action URL-адрес
     * @param string $method способ отправки данных (GET/POST)
     * @param array $options дополнительные параметры формы
     * @return string
     * @link http://htmlbook.ru/html/form
     */
    public static function formStart($action='', $method='', $options=array()){
        $options['action'] = $action;
        $options['method'] = $method;

        return self::tag('form', '', $options, false);
    }

    /**
     * Закрывающий тег формы
     * @return string
     */
    public static function formEnd(){
        return return self::closeTag('form');
    }

    protected static function input($type, $options, $closeFlag = true){
        $options['type'] = $type;
        return self::tag('input', '', $options, $closeFlag);
    }

    /**
     * Разметка поля ввода текста
     * @param string $name имя поля
     * @param string $value значение поля
     * @param array $options дополнительные параметры
     * @return string
     * @link http://htmlbook.ru/html/input
     */
    public static function text($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('text', $options);
    }
    public static function password($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('password', $options);
    }
    public static function hidden($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('hidden', $options);
    }
    public static function button($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('button', $options);
    }
    public static function submit($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('submit', $options);
    }
    public static function image($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('image', $options);
    }
    public static function file($name, $value='', $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;

        return self::input('file', $options);
    }
    public static function checkbox($name, $value='', $checked=false, $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;
        $options['checked'] = ($checked) ? 'checked' : '';

        if(is_array($value)){
            $options['name'] = $name.'[]';

            $html = '';
            foreach($value as $item){
                $html .= return self::input('checkbox', $options);
            }

            return $html;
        }

        return self::input('checkbox', $options);
    }
    public static function radio($name, $value='', $checked=false, $options=array()){
        $options['name'] = $name;
        $options['value'] = $value;
        $options['checked'] = ($checked) ? 'checked' : '';

        if(is_array($value)){
            $options['name'] = $name.'[]';

            $html = '';
            foreach($value as $item){
                $html .= return self::input('radio', $options);
            }

            return $html;
        }

        return self::input('radio', $options);
    }

} 