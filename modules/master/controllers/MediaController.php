<?php

namespace app\modules\master\controllers;

use Yii;
use common\models\Media;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MediaController implements the CRUD actions for Media model.
 */
class MediaController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return false|string
     * @throws HttpException
     * @throws Exception
     * @throws ExitException
     */
    public function actionTinymce()
    {        
        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "content/images";

        reset($_FILES);
        $temp = current($_FILES);

        if (is_uploaded_file($temp['tmp_name'])) {
            /*if (isset($_SERVER['HTTP_ORIGIN']))
            {
              // same-origin requests won't set an origin. If the origin is set, it must be valid.
              if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
              } else {
                header("HTTP/1.1 403 Origin Denied");
                Yii::$app->end();
              }
            }*/

            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            /*if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                Yii::$app->end();
            }*/

            $extension = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
            // Verify extension
            if (!in_array($extension, array("gif", "jpg", "png", 'jpeg'))) {
                header("HTTP/1.1 400 Invalid extension.");
                Yii::$app->end();
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . DIRECTORY_SEPARATOR . Yii::$app->security->generateRandomString() . '.' . $extension;

            //$stream = fopen($temp['tmp_name'], 'r+');
            /*Yii::$app->publicStorage->writeStream($filetowrite, $stream);*/

            /*fclose($stream);

            $ip = Yii::$app->request->userIP;

            if ($ip != '127.0.0.1')
                $url = str_replace('http://127.0.0.1:9000', 'https://storage.admkrsk.ru', Yii::$app->publicStorage->getPublicUrl($filetowrite));
            else
                $url = Yii::$app->publicStorage->getPublicUrl($filetowrite);

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}*/
            
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return json_encode(array('location' => '/'.$filetowrite));

        } else {
            // Notify editor that the upload failed
            throw new HttpException(500, 'Server Error');
        }
        return Yii::$app->end();
    }

    public function actionUpload()
    {
        $allowedExtensions = array();
        // max file size in bytes
        $sizeLimit = 100 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

        /*if (!empty($_GET['image']))
            $result = $uploader->handleUpload('content/images/');
        elseif (!empty($_GET['file']))
            $result = $uploader->handleUpload('content/files/');
        else*/
            $result = $uploader->handleUpload('upload/');

        // to pass data through iframe you will need to encode all html tags
        return json_encode($result);
    }

}

class qqUploadedFileXhr {
/**
 * Save the file to the specified path
 * @return boolean TRUE on success
 */
function save($path) {
        $input = fopen("php://input", "r");
        /*$temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()){
            return false;
        }*/

        $target = fopen($path, "w");
        //fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($input, $target);
        fclose($target);

        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */

    protected $varname;

    function __construct($varname='qqfile')
    {
        $this->varname = $varname;
    }

    function save($path) {
        if(!move_uploaded_file($_FILES[$this->varname]['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES[$this->varname]['name'];
    }
    function getSize() {
        return $_FILES[$this->varname]['size'];
    }
}

class qqFileUploader
{
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 100485760){
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        //$this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } elseif (isset($_FILES['file'])) {
            $this->file = new qqUploadedFileForm('file');
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings()
    {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));
    }

    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){

        if (!is_writable($uploadDirectory))
            return array('error' => "Server error. Upload directory isn't writable.");

        if (!$this->file)
            return array('error' => 'No files were uploaded.');

        $size = $this->file->getSize();

        if ($size == 0)
            return array('error' => 'File is empty');

        if ($size > $this->sizeLimit)
            return array('error' => 'File is too large');

        $pathinfo = pathinfo($this->file->getName());
        $filename = md5(uniqid());
        $ext = strtolower($pathinfo['extension']);

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        if (!$replaceOldFile){
            while (file_exists($uploadDirectory . $filename . '.' . $ext))
                $filename .= rand(10, 999);
        }

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext))
        {
            $size = getimagesize($uploadDirectory . $filename . '.' . $ext);

            if (isset($size[1]))
                return array(
                    'success'=>true,
                    'file'=>"/". $uploadDirectory . $filename . '.' . $ext,
                    'height'=>$size[0],
                    'width'=>$size[1],
                    'filename'=> $this->file->getName()
                );
            else
                return array(
                    'success'=>true,
                    'file'=>"/". $uploadDirectory . $filename . '.' . $ext,
                    'filename'=> $this->file->getName()
                );
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }
}
