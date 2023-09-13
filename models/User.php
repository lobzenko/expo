<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\helpers\Html;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    //public $image;
    public $profile;
    public $role;
    public $newpassword;
    public $curpassword;
    public $repassword;

    public $count;

    const salt = "asdhjhas./11`23k~ыоалдфжы";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['login', 'email'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login','email','phone'], 'unique'],
            [['email'], 'required'],
            [['phone','login'], 'required','on'=>'create'],
            [['lastvisited','type','inn','kpp'], 'integer'],
            [['email'], 'email'],
            [['curpassword'], 'checkPassword'],
            [['email','phone','firstname','lastname','inn','company'], 'required', 'on'=>'registration'],
            [['newpassword','repassword'], 'required', 'on'=>'registration'],
            ['repassword', 'compare', 'compareAttribute'=>'newpassword', 'message'=>"Пароли не совпадают",'on'=>'registration'],
            [['login', 'password', 'email', 'firstname', 'url', 'role','phone','curpassword','rank','company'], 'string', 'max' => 255],
            [['newpassword','repassword'], 'string', 'max' => 20],
            //[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),'on'=>'registration']
        ];
    }

    public function checkPassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if ($this->password = sha1($this->curpassword.self::salt))
            {
                $this->addError($attribute, 'Текущий пароль введен неправильно');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'lastvisited' => 'Последнее посещение',
            'firstname' => 'Имя',
            'newpassword' => 'Новый пароль',
            'repassword' => 'Повторить пароль',
            'type'=>'Юр.лицо / Физ. лицо',
            'url' => 'Url',
            'lastname'=>'Фамилия',
            'company'=>'Компания',
            'curpassword'=>'Текущий пароль',
            'rank'=>'Должность',
            'inn' => 'ИНН',            
            'kpp' => 'КПП',
            'role' => 'Права',
            'phone' => 'Телефон',
            'date_create'=>'Дата регистрации',
        ];
    }

    public function beforeValidate()
    {
        // если нет спец логина то он равен email
        if (empty($this->login))
            $this->login = $this->phone; //str_replace(' ', '_', $this->name).substr(md5(time()),0,10);

        if (!empty($this->newpassword))
            $this->password = sha1($this->newpassword.self::salt);

        $this->clearPhone();

        return parent::beforeValidate();
    }

    public function clearPhone()
    {
        $this->phone = preg_replace("/[^0-9]/", '', $this->phone);
    }

    public function behaviors()
    {
        return [
            'multiupload' => [
                'class' => \app\extensions\multifile\MultiUploadBehavior::className(),
                //'class' => \lobzenko\multifile\MultiFileBehavior::className(),
                'relations'=>
                [
                    'media'=>[
                        'model'=>'Media',
                        'fk_cover' => 'id_media',
                        'cover' => 'media',
                    ],
                ],
                'cover'=>'media'
            ],
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!empty($this->role))
        {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->revokeAll($this->id_user);
            $auth->assign($role , $this->id_user);
        }

        return true;
    }

   /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByEAuth($service)
    {
        if (!$service->getIsAuthenticated())
            throw new ErrorException('EAuth user should be authenticated before creating identity.');

        $id = $service->getServiceName().'-'.$service->getId();

        // ищем этого юзера в базе
        $user = static::findByUsername($id);

        if (empty($user))
        {
            $user = new User;
            $user->name =  $service->getAttribute('firstname');
        }

        $user->avatar = $service->getAttribute('image');
        $user->login = $id;

        // сохраняем аватар в медиа
        /*if (!empty($user->avatar) && empty($user->id_media))
        {
            $media = new Media;
            $media->file_path = $user->avatar;

            if ($media->save())
            {
                $media->saveFile();
                $media->getImageAttributes($media->getFilePath());
                $media->save();
                $user->id_media = $media->id_media;
            }
        }*/
        $user->save();

        $attributes = array(
            //'id' => $id,
            'id_user' => $user->id_user,
            'firstname' => $user->name,
            'auth_key' => md5($id),
            'image' => $user->avatar,
            'profile' => $service->getAttributes(),
        );

        $attributes['profile']['service'] = $service->getServiceName();

        Yii::$app->getSession()->set('user-'.$id, $attributes);

        return new self($attributes);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
       return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password.self::salt);
    }

    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /*public function getAvatar($options,$gravatar=false)
    {
        if (!empty($this->id_media))
            return $this->media->showThumb($options);
        elseif (!empty($gravatar))
            return 'https://www.gravatar.com/avatar/'.md5($this->email).'.jpg';
        else
            return ($this->avatar)?$this->avatar:'/i/anon.png';
    }*/

    public function getProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['id_user' => 'id_user']);
    }

    public function getRoles()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])
                    ->viaTable('auth_assignment', ['user_id' => 'id_user']);
    }

    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id_media' => 'id_media']);
    }

    public function getTitle()
    {
        return $this->name;
    }

    public function getHideLabel()
    {
        return  preg_replace('/(?<=.).(?=.*@)/u','*',$this->email);
    }

    public function getFullName()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function checkUserBlock()
    {
        if ($this->reports>1)
        {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole("user");
            $auth->revokeAll($this->id_user);
            $auth->assign($role , $this->id_user);

            return true;
        }

        return false;
    }
}