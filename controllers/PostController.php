<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 14.03.2016
 * Time: 21:17
 */

namespace app\controllers;
use app\models\Category;
use Yii;
use app\models\TestForm;

class PostController extends AppController{

    public $layout = 'basic';

    public function beforeAction($action){
        if( $action->id == 'index' ){
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex(){
        if( Yii::$app->request->isAjax ){
            debug(Yii::$app->request->post());
            return 'test';
        }

//        $posts = TestForm::findOne(3);      // Создаем новый объект с выборкой 3 поста
////        print_r($posts);                  // Распечатываем для себя убедиться
//        $posts->email = '222@555.ru';       // Вручную задаем занчения поля  email  для  3 поста
//        $posts->save();                     // Сохраняем изменение
//
//
//
//        $posts = TestForm::findOne(2);
//        $posts->delete();



        // первый вар сохранения инфо в БД

        $model = new TestForm();
//        $model->name = 'Автор';             // Заполняем данные в модель. Пока что вручную.
//        $model->email = 'mail@mail.com';
//        $model->text = 'Текст сообщения';
//        $model->save();                       // Сохраняет свойства объекта модели в БД

        
//        if( $model->load(Yii::$app->request->post()) ){
//            if( $model->validate() ){
//                Yii::$app->session->setFlash('success', 'Данные приняты');
//                return $this->refresh();
//            }else{
//                Yii::$app->session->setFlash('error', 'Ошибка');
//            }
//        }

        // 2 вариант сохранения в БД.
        if( $model->load(Yii::$app->request->post()) ){
            if( $model->save() ){
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        $this->view->title = 'Все статьи';
        return $this->render('test', compact('model'));
    }

    public function actionShow(){
        $this->view->title = 'Одна статья!';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'ключевики...']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'описание страницы...']);

//        $cats = Category::find()->all();
//        $cats = Category::find()->orderBy(['id' => SORT_DESC])->all();       // По умолчанию прямая сортировка SORT_ASC
//        $cats = Category::find()->asArray()->all();       // Данные из таблицы вернутся массивом. И доступ к ним в представленни будет уже  $cats['title]
//        $cats = Category::find()->asArray()->where('parent=691')->all();        //  1 вариант передачи параметров в ->where() в виде строки.    Все строки где поле parent - 691
//        $cats = Category::find()->asArray()->where(['parent' => '691'])->all();       //  2 вариант передачи параметров в ->where() в виде массива.
//        $cats = Category::find()->asArray()->where(['like', 'title', 'pp'])->all();       //  аналогично    SELECT * FROM `categories` WHERE `title` LIKE '%pp%'
//        $cats = Category::find()->asArray()->where(['<=', 'id', 695])->all();               // аналогично  SELECT * FROM `categories` WHERE `id` <= 695
//        $cats = Category::find()->asArray()->where('parent=691')->limit(2)->all();          //  аналогично SELECT * FROM `categories` WHERE parent=691 LIMIT 2   // Получим первые 2 попавшиеся записи
//        $cats = Category::find()->asArray()->where('parent=691')->one();                    //  Будет выбрана ОДНА запись       // код SELECT * FROM `categories` WHERE parent=691     Здесь в запросе нет  limit . Запрос избыточен. Значит контроллер получит Все записи но в массив положит только одну.
                                                                                            // Это не очень хорошо, рекомендуют делать через    ->limit()
//        $cats = Category::find()->asArray()->where('parent=691')->count();                    //  Получение количества записей.     // аналогично  SELECT COUNT(*) FROM `categories` WHERE parent=691
//        $cats = Category::find()->asArray()->count();                                       // Без условия  where узнаем  сколько всего записей в таблице       // аналогично   SELECT COUNT(*) FROM `categories`

//        $cats = Category::findOne(['parent' => 691]);                       // Метод findOne  вернет только 1 значение
//        $cats = Category::findAll(['parent' => 691]);                          // Метод findAll  вернет все значения соответствующие условию   //    аналогично  SELECT * FROM `categories` WHERE `parent`=691

//        $query = "SELECT * FROM categories WHERE title LIKE '%pp%'";            // строка для запроса
//        $cats = Category::findBySql($query)->all();                             // мы получис аналогично   SELECT * FROM categories WHERE title LIKE '%pp%'
                                                                                // Так мы можем составить SQL запрос любой сложности и отправить его на сервер.
//        $query = "SELECT * FROM categories WHERE title LIKE :search";
//        $cats = Category::findBySql($query, ['search' => '%app%'])->all();         // Запрос будет аналогичен  SELECT * FROM categories WHERE title LIKE '%app%'
                                                                                    // но запрос подготовлен для выполнения, параметры экранированы и запрос безопасен.


//        $cats = Category::findOne(694);                 // здесь ленивая загрузка
//        $cats = Category::find()->with('produts')->where('id=694')->all();                 // здесь жадная  загрузка
//        $cats = Category::find()->all();                      // здесь ленивая загрузка
        $cats = Category::find()->with('products')->all();      // здесь жадная загрузка


        return $this->render('show', compact('cats'));
    }

}