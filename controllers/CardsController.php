<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class CardsController extends Controller
{
    public function actionGetcards($id){
        if (Yii::$app->request->isAjax) {
            
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $shipments = json_decode(file_get_contents(Yii::$app->basePath . "/controllers/json/cards.json"), true);
            $html = "";
            $data = $shipments['cards'][$id];
            for ($i = 0; $i < 20; $i+=2){
                $html .= '<li>
                    <a href="javascript:void(0)">
                        <div class="card-wrapper">
                            <img src="img/cards/'.$data[$i]["url"].'" alt="'.$data[$i]["alt"].'">
                        </div>
                        <div class="card-wrapper card-translate">
                            <img src="img/cards/'.$data[$i + 1]["url"].'" alt="'.$data[$i + 1]["alt"].'">
                        </div>
                    </a>
                </li>';
            }
            $response->data = $html;
            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }
}