<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\TestForm;
use yii;

class PostController extends Controller
{
    public function actionIndex()
    {
        $model = new TestForm();        // Создаем объект модели
                                        // Мы должны загрузить данные в эту модель. Есть 2 способа: заполнять в модели свойства
                                        // либо использовать массовую загрузку
        if ($model->load(Yii::$app->request->post())) {                 // Данные загружены
            if ($model->validate()) {                                   // и данные провалидированы, то мы что-то делаем.
                Yii::$app->session->setFlash('success', 'Данные приняты');       // Используем флеш-сообщения в сессии
                return $this->refresh(); 							// В форме по умолчанию сохраняются данные, для их очистки нужен  перезапрос страницы.
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка!');                // Задаем в сессию ФлешСообщение с ключом 'error' (по этому ключу сможем обратиться к этому флешсообщению)
            };
        };

        return $this->render('test', compact('model'));     // В вид передаем данные из нашей модели (весь объект передали)
    }
}