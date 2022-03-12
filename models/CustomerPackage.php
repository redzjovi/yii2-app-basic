<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_packages".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $package_id
 * @property string|null $package_name
 * @property float|null $package_price
 * @property int $quantity
 *
 * @property Customer $customer
 * @property Package $package
 */
class CustomerPackage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'package_id', 'quantity'], 'required'],
            [['customer_id', 'package_id', 'quantity'], 'integer'],
            [['package_price'], 'number'],
            [['package_name'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Package::className(), 'targetAttribute' => ['package_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'package_id' => 'Package ID',
            'package_name' => 'Package Name',
            'package_price' => 'Package Price',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Package]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Package::className(), ['id' => 'package_id']);
    }
}
