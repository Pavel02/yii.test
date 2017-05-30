<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord{

    public static function tableName(){
        return 'categories';
    }

    public function getPoducts() {      // Метод для связи двух таблиц. Название не важно, но желательно логичное
        return $this->hasMany(Product::className(), ['parent' => 'id']);                     // первый параметр имя класса с которым связываем.
                                                                                            // Второй параметр это массив (ключи из связываемой таблицы, а значение поле из текущей).
    }
}