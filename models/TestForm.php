<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.03.2016
 * Time: 9:32
 */

namespace app\models;
use yii\base\Model;
use yii\db\ActiveRecord;


class TestForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

//    public $name;                 // когда   extends Model  то поля формы ввода должны быть объявлены как свойсва
//    public $email;                //  иначе будет ошибка. А вот в случае с ActiveRecord  это можно не делать. Yii  сделает это автоматически
//    public $text;

    public function attributeLabels(){
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст сообщения',
        ];
    }

    public function rules(){
        return [
            [ ['name', 'text'], 'required' ],
            [ 'email', 'email' ],
//            [ 'name', 'string', 'min' => 2, 'tooShort' => 'Мало' ],
//            [ 'name', 'string', 'max'=> 5, 'tooLong' => 'Много' ]
//            [ 'name', 'string', 'length' => [2,5] ],
//            [ 'name', 'myRule' ],

        ];
    }
//
//    public function myRule($attr){
//        if( !in_array($this->$attr, ['hello', 'world']) ){
//            $this->addError($attr, 'Wrong!');
//        }
//    }

} 