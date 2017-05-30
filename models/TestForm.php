<?php

namespace app\models;
use yii\base\Model;

class TestForm extends Model
{
    public $name;           // У нас будут 3 поля, поэтому в модели 3 свойства
    public $email;
    public $text;

    public function attributeLabels()       // Данный метод возвращает массив c именами лейблов
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст сообщения',
        ];
    }

    public function rules()             // Возвращает массив с правилами для всех полей
    {
        return [
            [['name', 'email'], 'required', 'message' => 'Поле обязательно'],       // Если не будет message, то сообщения на английском
            ['email', 'email'],                                                      // Можем в 'config/web.php/'  добавить настройку  'language' => 'ru', тогда станет на русском
//            ['name', 'string', 'min' => 2, 'tooShort' => 'Мало'],                 // поле name текстовое и минимум 2 символа. 'toShort' задает текст сообщения предупреждения
//            ['name', 'string', 'max' => 5, 'tooLong' => 'Много']
            ['name', 'string', 'length' => [2, 5] ],                             // Если текст предупреждения по умолчанию нас устраивает, то длину можем задать в одном правиле
            ['name', 'myRule' ],                                                 // Задаем свое правило валидации, которое будет задано отдельной функцией ниже.
            ['text', 'trim']                                      // Псевдо валидатор (будет автоматом обрезать пробелы спереди и сзади.
        ];
    }

    public function myRule($attr)                                // Наше правило валидации. Причем проверяться оно будет на сервере, а не в браузере у клиента
    {
        if (!in_array($this->$attr, ['hello', 'world']) ) {
            $this->addError($attr, 'Wrong!');
        }
    }
}
