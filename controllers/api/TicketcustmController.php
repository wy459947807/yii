<?php

namespace app\controllers\api;

use app\common\InstanceFactory;
use app\common\ValidateCode;
use app\controllers\CommonController;
use app\controllers\CommonInterface;

class TicketcustmController extends CommonController implements CommonInterface {

    public function init() {
        parent::init();
        //注册服务
        $this->serviceList['TicketCustmService']=InstanceFactory::getInstance("app\service\TicketCustmService");
    }

    public function actionIndex() {
        return;
    }
    
    public function actionAdd(){
        $params=$this->getValidateParams('add');
        if($params['status']!=200){
            $resultArray['success']='0';
            $resultArray['data']=$params['info'];
            return $this->asJson($resultArray);
        }
        $this->result = $this->serviceList['TicketCustmService']->updateTicketCustm($params['data']);
        if($this->result['status']!=200){
            $resultArray['success']='0';
            $resultArray['data']="提交失败";
            return $this->asJson($resultArray);
        }
        return $this->asJson(array("success"=>"1","msg"=>"ok"));
    }

    //测试页面
    public function actionTest() {
        return;
        //return $this->render('test.tpl',array());
    }

    //错误页面
    public function actionError() {
        return;
    }

    //验证码
    public function actionCaptcha() {
        $ValidateCode = new ValidateCode();  //实例化一个对象
        $ValidateCode->doimg();
        \Yii::$app->session['ValidateCode'] = $ValidateCode->getCode();
    }

    //获取参数规则
    public function getRulesArray($ruleIndex) {

        $result['add'] = array(
            array('ticket', 'required', 'message' => 'ticket字段必须.'),
        );
        return $result[$ruleIndex];
    }

}
