<?php

namespace app\service;

use app\models\HsTicketCustm;
use app\service\CommonService;
use Yii;
use yii\db\Exception;
class TicketCustmService extends CommonService{
    
    //更新
    public function update($params){
        //添加菜单操作
        $tr = Yii::$app->db->beginTransaction();//事务开始
        try {
            if(empty($params['id'])){
                $module=new HsTicketCustm();
            }else{
                $module= HsTicketCustm::findOne($params['id']);
            }
            
            foreach ($params as $key=>$val){
                if(!empty($params[$key])) $module->$key=$params[$key];
            }
            
            if($module->save()){
                $this->result['status']=200;
                $this->result['info']="更新成功！";
            }else{
                $this->result['status']=500;
                $this->result['info']="更新失败！";
            }
            $tr->commit();//事务提交
        } catch (Exception $e) {
            $tr->rollBack();//事务回滚
        }
        return $this->result;
    }
    
    //删除
    public function delete($params){
        //删除菜单操作
        $tr = Yii::$app->db->beginTransaction();//事务开始
        try {

            $retInfo=HsTicketCustm::deleteAll(["in",'id',$params['id']]); 
            if($retInfo){
                $this->result['status']=200;
                $this->result['info']="删除成功！";
            }else{
                $this->result['status']=500;
                $this->result['info']="删除失败！";
            }
            $tr->commit();//事务提交
        } catch (Exception $e) {
            $tr->rollBack();//事务回滚
        }
        
        return $this->result;
    }
    
    //列表
    public function pageList($params){
        $this->sqlFrom=" hs_ticket_custm ";        
        $this->sqlField=" * ";       
        $this->sqlWhere=" (1=1) ";
        $this->bindValues=array();
        
        if(!empty($params['page'])) $this->page = $params['page'];
        if(!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];
       
        //搜索信息筛选
        if(!empty($params['custmname'])){
            $this->sqlWhere.=" and custmname like '%:custmname%'   ";
            $this->bindValues[':custmname'] = $params['custmname'];
        }

        return $this->getPageList();
    }
    
    
    public function getTop($limit=10){
        $this->sqlFrom=" hs_ticket_custm ";        
        $this->sqlField=" * ";       
        $this->sqlWhere=" (1=1) ";
        $this->sqlLimit=" limit {$limit} ";
        
        return $this->getAll();
    }
    

    
}
