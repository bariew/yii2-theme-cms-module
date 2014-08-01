<?php

namespace bariew\themeModule\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class Theme extends Model
{
    const SCENARIO_CREATE = 'create';
    public static $themePath = '@app/web/themes';
    public static $configPath = '@app/config/local/main.php';

    public $id;
    public $path;

    /**
     * @var UploadedFile
     */
    public $file;

    protected static $_models;
    protected $oldAttributes = [];

    public function beforeValidate()
    {
        $file = UploadedFile::getInstance($this, 'file');
        $this->file = $file->tempName ? $file : null;
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'path'], 'string'],
            [['file'], 'required', 'on' => self::SCENARIO_CREATE],
            [['file'], 'file', 'extensions' => ['zip']],
        ];
    }

    public static function listAll()
    {
        if (self::$_models !== null) {
            return self::$_models;
        }
        $result = [];
        $items = glob(Yii::getAlias(self::$themePath.'/*'), GLOB_ONLYDIR);
        foreach ($items as $path) {
            $id = preg_replace('/.*\/(\w+)$/', '$1', $path);
            $result[$id] = $path;
        }
        return self::$_models = $result;
    }

    public function search()
    {
        $allModels = [];
        foreach (self::listAll() as $id => $path) {
            $allModels[$id] = new self(['attributes' => compact('id', 'path')]);
        }
        return new ArrayDataProvider(['allModels'=>$allModels, 'key'=>function($model) {
            return $model->id;
        }]);
    }

    public static function findOne($id)
    {
        if (!isset(self::listAll()[$id])) {
            return null;
        }
        $attributes = ['id' => $id, 'path' => self::listAll()[$id]];
        $model = new self(compact('attributes'));
        $model->oldAttributes = $attributes;
        return $model;
    }

    public function isAttributeChanged($attribute)
    {
        return isset($this->oldAttributes[$attribute])
            && ($this->oldAttributes[$attribute] !== $this->$attribute);
    }

    public function delete()
    {
        return FileHelper::removeDirectory($this->path);
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->path = Yii::getAlias(self::$themePath . '/' . $this->id);
        if ($this->isAttributeChanged('path')) {
            rename($this->oldAttributes['path'], $this->path);
        }
        if ($this->file instanceof UploadedFile) {
            return $this->extract();
        }
        return true;
    }

    protected function extract()
    {
        $zip = new \ZipArchive();
        if ($zip->open($this->file->tempName) !== true) {
            return false;
        }
        $zip->extractTo($this->path);
        $zip->close();
        return true;
    }

    public function getIsSelected()
    {
        if (!isset(Yii::$app->view->theme->basePath)) {
            return false;
        }
        return preg_match('/.*\/'.$this->id.'$/', Yii::$app->view->theme->basePath);
    }

    public function select()
    {
        $themePath = self::$themePath . "/{$this->id}";
        $configPath = Yii::getAlias(self::$configPath);
        $config = file_exists($configPath) ? require $configPath : [];
        $config['components']['view']['theme'] = [
            'pathMap' => [
                '@app/views' => $themePath,
                '@app/modules' => $themePath,
            ],
            'basePath' => $themePath,
            'baseUrl' => str_replace('@app', '@web', $themePath),
        ];
        $data = '<?php return ' . var_export($config, true) . ';';
        file_put_contents($configPath, $data);
    }

}
