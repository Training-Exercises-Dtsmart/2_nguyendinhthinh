<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use app\models\User;

class UserController extends Controller{
    private $username = 'dinhthinh';
    private $password = 'e10adc3949ba59abbe56e057f20f883e'; #123456

    public function actionIndex(){
        $user = new User();
        return $user->find()->all();
    }

    public function actionCreate(){
        $user = new User();
        $data = Yii::$app->request->post();
        $username = $data['username'];
        $password = $data['password'];

        if( User::find()->where(['username' => $username])->one() ){
            return [
                "status" => false,
                "data" => [
                    "now" => date("d/m/Y")
                ],
                "message" => "Username already exists"
            ];
        }

        $user->username = $username;
        $user->password = md5($password);
        if($user->save()){
            return [
                "status" => true,
                "data" => [
                    "now" => date("d/m/Y")
                ],
                "message" => "Success"
            ];
        }
    }

    public function actionLogin(){
        if(Yii::$app->request->method != "POST"){
            throw new NotFoundHttpException('The requested resource was not found.',404);
        }
        $data = Yii::$app->request->post();
        $username = $data['username'];
        $password = $data['password'];

        if($username != $this->username or md5($password) != $this->password){
            return [
                "status" => false,
                "data" => [
                    "now" => date("d/m/Y")
                ],
                "message" => "Username or password wrong"
            ];
        }

        return [
            "status" => true,
            "data" => [
                "now" => date("d/m/Y")
            ],
            "message" => "Success"
        ];
    }

}

