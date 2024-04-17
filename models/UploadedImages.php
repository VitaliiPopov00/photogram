<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploaded_images".
 *
 * @property int $id
 * @property string $file_name
 * @property string $upload_time
 */
class UploadedImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploaded_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['upload_time'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'Имя файла',
            'upload_time' => 'Дата загрузки',
        ];
    }
}
