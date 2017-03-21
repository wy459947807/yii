<?php

namespace app\controllers;

use app\common\ValidateCode;
class SiteController extends CommonController implements CommonInterface{

    public function init(){
        parent::init();
        //注册服务11333333
        
    } 
    
    
    public function actionIndex(){

        
        $dataInfo=array();
        return $this->render('index.tpl',$dataInfo);
    }
   
    
    //测试页面
    public function actionTest() {
        echo "vvv";
        return;
    }

    //错误页面
    public function actionError(){
        //return $this->render('error.tpl',array());
    }

    //验证码
    public function actionCaptcha(){
        $ValidateCode = new ValidateCode();  //实例化一个对象
        $ValidateCode->doimg(); 
        \Yii::$app->session['ValidateCode']=$ValidateCode->getCode();
    }

    //获取参数规则
    public function getRulesArray($ruleIndex){
        $result['index']=array(   
           
        );
        
        return $result[$ruleIndex];
    }
   
}
