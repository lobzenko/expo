<?php

namespace app\models;

use Yii;

use yii\imagine\Image;
use app\helpers\helper\Helper;


/**
 * This is the model class for table "cnt_media".
 *
 * @property integer $id_media
 * @property integer $date
 * @property integer $type
 * @property string $size
 * @property integer $width
 * @property integer $height
 * @property integer $duration
 * @property string $mime
 * @property string $name
 * @property string $value
 * @property string $url
 * @property string $extension
 * @property integer $ord
 * @property string $description
 * @property string $preview
 */
class Media extends \yii\db\ActiveRecord
{

    public $file_path;
    public $cover;

    const TYPE_MUSIC = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnt_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'type', 'width', 'height', 'duration', 'ord', 'size'], 'integer'],
            [['mime', 'name', 'value', 'url', 'preview', 'file_path'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 10],
            [['description'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_media' => 'Id Media',
            'date' => 'Date',
            'type' => 'Type',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'duration' => 'Duration',
            'mime' => 'Mime',
            'name' => 'Name',
            'value' => 'Value',
            'url' => 'Url',
            'extension' => 'Extension',
            'ord' => 'Ord',
            'description' => 'Description',
            'preview' => 'Preview',
        ];
    }

    public function getImageAttributes($file,$post=array())
    {
        $root = Yii::getAlias('@webroot');

        // получаем атрибуты изображения
        if (is_file($root.$file))
            $file = $root.$file;

        $size = getimagesize($file);
        $ext = Helper::getImageExtention($size['mime']);

        if (empty($ext))
            $ext = substr($file, strrpos($file, '.')+1);

        $this->width = $size[0];
        if ($size[1]>2147483647)
            $size[1] = 2147483647*2-$size[1];
        $this->height = abs($size[1]);
        $this->mime = $size['mime'];
        $this->extension = $ext;
        $this->size = filesize($file);
        $this->ord = (isset($post['ord']))?(int)$post['ord']:'';
        $this->cover = (isset($post['cover']))?(int)$post['cover']:'';
        $this->value = (isset($post['value']))?$post['value']:'';
        $this->type = (isset($post['value']))?2:1;
        $this->preview = (isset($post['preview']))?$post['preview']:'';
        $this->file_path = $file;
    }

    /**
    *   Сохраняет файл в папку согласно хешу
    **/
    public function saveFile()
    {
        $root = Yii::getAlias('@webroot');

        //$this->extension = substr($this->file_path,strrpos($this->file_path,'.')+1);
        if (strpos($this->file_path, '://')==false)
        {
            if (is_file($this->file_path))
                copy($this->file_path,$root.$this->getFilePath());
        }
        else
        {
            copy($this->file_path,$root.$this->getFilePath());
        }
    }


    public function getFilePath($full=false)
    {
        $root = Yii::getAlias('@webroot');
        // если это еще не сохраненное изображение
        if ($this->isNewRecord)
            return str_replace($root,'',$this->file_path);

        $url_piece = '/content/media/';
        $dir = $root.$url_piece;

        $file = md5($this->id_media);

        // разбиваем на вложенные две папки
        $level1 = substr($file,0,2);
        if (!is_dir($dir.$level1))
            mkdir($dir.$level1);

        $level2 = substr($file,2,2);
        if (!is_dir($dir.$level1.'/'.$level2))
            mkdir($dir.$level1.'/'.$level2);

        $filename = $this->id_media.'.'.$this->extension;

        if ($full)
            return $root.$url_piece.$level1.'/'.$level2.'/'.$filename;
        else 
            return $url_piece.$level1.'/'.$level2.'/'.$filename;
    }

    public function showThumb($option)
    {
        if (!empty($this->url)&&empty($this->size))
            return $this->url;

        if (!empty($option))
            return $this->makeThumb($this->getFilePath(),$option);
        else
            return $this->getFilePath();
    }

    public static function appendImages($ids,$text)
    {
        $root = Yii::getAlias('@webroot');

        $imagepath = '/content/rubs/'.implode('_', $ids).'.png';

        if (is_file($root.$imagepath))
            return $imagepath;

        $medias = Media::find()->where(['id_media'=>$ids])->indexBy('id_media')->all();

        /* Создаем новый объект imagick */
        $im = new \Imagick();

        $total_width = 0;

        if (empty($medias))
            return false;

        $coverMedia = null;

        foreach ($ids as $key => $id)
        {
            $media = $medias[$id];

            if (empty($coverMedia))
                $coverMedia = $media;

            $total_width+=$media->width;

            $im->readImage($root.$media->getFilePath());

            $width = round(400*$media->width/$media->height);
            $height = 400;

            $im->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 0.9, TRUE);
            $im->borderImage("black",1,1);

            if ($key==2)
            {
                $draw = new \ImagickDraw();

                $im2 = new \Imagick();
                $draw->setFont("fonts/arial.ttf");
                $draw->setFillColor('white');

                //$draw->setFont('Bookman-DemiItalic');
                $draw->setFontSize(50);

                $im2->newImage($media->width, $media->height, "rgba(0,0,0,0.5)");

                /*if (method_exists($im2,'setImageOpacity'))
                    $im2->setImageOpacity("0.7");*/

                $im->compositeImage($im2, \Imagick::COMPOSITE_DEFAULT , 0, 0);

                $im->annotateImage($draw, round($width/2)-35, round($height/2) , 0, $text);

                /*$im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_EXTRACT);
                $im->setImageBackgroundColor('rgba(0, 0, 0, 0.5)');
                $im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_SHAPE);*/
            }
        }

        /* создаем красное, зеленое и синее изображения */
        /*$im->newImage(100, 50, "red");
        $im->newImage(100, 50, "green");
        $im->newImage(100, 50, "blue");*/

        /* Соединяем все изображения в одно */
        $im->resetIterator();
        $combined = $im->appendImages(false);

        /* Выводим изображение */
        $combined->setImageFormat("png");

        try {
           $combined->writeImage($root.$imagepath);

           //Image::thumbnail($root.$imagepath, $total_width*500/$media->height, 500)->save($root.$imagepath,['quality' => 80]);
        }
        catch (\ImagickException $e) {

        }

        return $imagepath;
    }

    public function makeThumb($source, $options)
    {
        if (empty($options))
            return $source;

        $preview_path = '/assets/preview/';
        $root = Yii::getAlias('@webroot');
        $preview_dir = $root.$preview_path;
        $ext = substr($source,strrpos($source,'.'));

        $source_md5 = md5($source.serialize($options));

        // первые 3 символа
        $level1 = substr($source_md5,0,2);
        if (!is_dir($preview_dir.$level1))
            mkdir($preview_dir.$level1);

        // вторые три символа
        $level2 = substr($source_md5,2,2);
        if (!is_dir($preview_dir.$level1.'/'.$level2))
            mkdir($preview_dir.$level1.'/'.$level2);

        $ext = substr($source,strrpos($source,'.'));

        $url =  $level1.'/'.$level2.'/'.$source_md5.$ext;

        $newfile = $preview_dir.$url;

        if (is_file($newfile))
            return $preview_path.$url;

        if (!is_file($root.$source))
            return $preview_path.$url;

        if (empty($options['h']))
            $options['h'] = $this->height*$options['w']/$this->width;

        if (empty($options['w']))
            $options['w'] = $this->width*$options['h']/$this->height;

        /*$exif = exif_read_data($filename);

        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $image = imagerotate($image, 180, 0);
                    break;

                case 6:
                    $image = imagerotate($image, -90, 0);
                    break;

                case 8:
                    $image = imagerotate($image, 90, 0);
                    break;
            }
        }*/

        if ($this->height<=$options['h'] && $this->width<=$options['w'])
            return $this->getFilePath();

        Image::thumbnail(Image::autorotate($root.$source), $options['w'], $options['h'])->save($newfile,['quality' => 80]);

        return $preview_path.$url;
    }

    public function isImage()
    {
        return (!empty($this->width));
    }
}
