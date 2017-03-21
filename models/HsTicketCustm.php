<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hs_ticket_custm".
 *
 * @property integer $id
 * @property integer $ticket
 * @property string $brand
 * @property integer $buynum
 * @property integer $storecode
 * @property string $storename
 * @property string $zonename
 * @property string $regionname
 * @property string $physicalcity
 * @property string $custmtype
 * @property string $custmname
 * @property string $signdate
 */
class HsTicketCustm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hs_ticket_custm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket'], 'required'],
            [['ticket', 'buynum', 'storecode'], 'integer'],
            [['signdate'], 'safe'],
            [['brand', 'storename', 'zonename', 'regionname', 'physicalcity', 'custmtype', 'custmname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket' => 'Ticket',
            'brand' => 'Brand',
            'buynum' => 'Buynum',
            'storecode' => 'Storecode',
            'storename' => 'Storename',
            'zonename' => 'Zonename',
            'regionname' => 'Regionname',
            'physicalcity' => 'Physicalcity',
            'custmtype' => 'Custmtype',
            'custmname' => 'Custmname',
            'signdate' => 'Signdate',
        ];
    }
}
