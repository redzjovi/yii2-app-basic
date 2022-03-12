<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 *
 * @property CustomerPackage[] $customerPackages
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[CustomerPackages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPackages()
    {
        return $this->hasMany(CustomerPackage::className(), ['package_id' => 'id']);
    }
}
