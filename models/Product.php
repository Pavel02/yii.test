<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord{
    public static function tableName(){
        return 'products';
    }

    public function getCategories() {
        return $this->hasOne(Category::className(), ['id' => 'parent']);         // Здесь один продукт к одной категории
    }
}