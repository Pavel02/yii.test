<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.03.2016
 * Time: 9:32
 */

namespace app\models;
use yii\base\Model;


class TestForm extends Model{

    public $name;
    public $email;
    public $text;

    public function attributeLabels(){
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст сообщения',
        ];
    }

    public function rules(){
        return [
            [ ['name', 'email'], 'required' ],
            [ 'email', 'email' ],
//            [ 'name', 'string', 'min' => 2, 'tooShort' => 'Мало' ],
//            [ 'name', 'string', 'max'=> 5, 'tooLong' => 'Много' ]
            [ 'name', 'string', 'length' => [2,5] ],
            [ 'name', 'myRule' ],
            [ 'text', 'trim' ],
        ];
    }

    public function myRule($attr){
        if( !in_array($this->$attr, ['hello', 'world']) ){
            $this->addError($attr, 'Wrong!');
        }
    }

} 