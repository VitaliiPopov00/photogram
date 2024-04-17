<?php

namespace app\models;

use DateTimeImmutable;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class UploadImageForm extends Model
{
    public $files;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['files'], 'required'],
            [['files'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 5, 'extensions' => ['png', 'jpg', 'jpeg', 'gif']],
        ];
    }

    public function load($data, $formName = null)
    {
        if (parent::load($data, $formName)) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }

    /**
     * Транслит названия файла
     */
    public static function transliterateFileName($fileName)
    {
        $transliterationTable = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya', ' ' => '_',
        ];

        $fileName = mb_strtolower(strtr($fileName, $transliterationTable));
        return $fileName;
    }

    /**
     * Процесс сохранения файлов на сервере и в БД
     */
    public function saveFile()
    {
        if ($this->files && !$this->hasErrors('files')) {
            $dir = Yii::getAlias('@app') . "/web/gallery";

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            foreach ($this->files as $file) {
                $filename = static::transliterateFileName("{$file->baseName}.{$file->extension}");
                
                if (UploadedImages::findOne(['file_name' => $filename])) {
                    $filename = (new DateTimeImmutable())->format('Uv') . ".{$file->extension}";
                }

                if ($file->saveAs("$dir/$filename")) {
                    $record = new UploadedImages();
                    $record->file_name = $filename;
                    $record->save(false);
                } else {
                    $this->addError('files', 'Произошла ошибка при сохранений файлов');

                    return false;
                }
            }

            return true;
        } else {
            $this->addError('files', 'Произошла ошибка при сохранений файлов');

            return false;
        }
    }
}
