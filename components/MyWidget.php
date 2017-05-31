<?php

/**
 * Created by PhpStorm.
 * User: PavelL
 * Date: 31.05.2017
 * Time: 14:21
 */
namespace app\components;
use yii\base\Widget;

class MyWidget extends Widget
{
    public $name;                   // чтобы использовать параметры мы должны объявить их как публичное свойство

    public function init()          // Метод init() занимается нормализацией свойств виджета
    {
        parent::init();             // Мы обязательно должны выполнить родительский метод.
        // if ($this->name === null) $this->name = 'Гость';    // Проверяем задано ли свойство, если нет то задаем значение по умолчанию.
        ob_start();                 // Буферизируем весь вывод
    }

    public function run()
    {
        $content = ob_get_clean();
        $content = mb_strtoupper($content, 'utf-8');                     // Все что в буфере вывода будет переведено в нижний регистр
        return $this->render('my', compact($content));
//        return "<h1>{$this->name}, это твой день, мир!</h1>";
//        return $this->render('my', ['name' => $this->name]);
    }
}