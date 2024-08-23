<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	 /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

	 public function accessRules()
		{
			return array(
				array('allow',
					'actions'=>array('index', 'wilayah', 'obat', 'tindakan', 'user'), // Semua tindakan
					'roles'=>array('master'),
				),
				array('allow',
					'actions'=>array('index', 'wilayah', 'obat', 'tindakan'), // Tidak bisa akses 'user'
					'roles'=>array('pegawai'),
				),
				array('allow',
					'actions'=>array('index', 'login'), // Hanya bisa akses 'home' dan 'login'
					'roles'=>array('user'),
				),
				array('deny',
					'users'=>array('*'), // Menolak akses bagi semua pengguna yang tidak sesuai
				),
			);
		}

	 
 
	 /**
	  * Filters
	  */
	//  public function filters()
	//  {
	// 	 return array(
	// 		 'accessControl', // perform access control for CRUD operations
	// 	 );
	//  }
 
	public function actionPegawaiAction()
	{
		$this->render('home');
	}
	
	public function actionUserAction()
	{
		// Tindakan khusus untuk user
		$this->render('home');
	}	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	// public function actionWilayah()
	// {
	// 	// Mengambil data dari model Wilayah
	// 	$dataProvider = new CActiveDataProvider('Wilayah');
		
	// 	// Merender view 'wilayah' yang berada di folder 'views/site'
	// 	$this->render('wilayah', array(
	// 		'dataProvider' => $dataProvider,
	// 	));
	// }

		public function actionWilayah()
	{
		$model = new Wilayah;

		if (isset($_POST['Wilayah'])) {
			$model->attributes = $_POST['Wilayah'];
			if ($model->save()) {
				$this->redirect(array('site/wilayah'));
			}
		}

		$dataProvider = new CActiveDataProvider('Wilayah');

		$this->render('wilayah', array(
			'model' => $model,
			'dataProvider' => $dataProvider,
		));
	}


		public function actionUpdateWilayah($id)
	{
		$model = $this->loadWilayahModel($id);

		if (isset($_POST['Wilayah'])) {
			$model->attributes = $_POST['Wilayah'];
			if ($model->save()) {
				$this->redirect(array('site/wilayah'));
			}
		}

		$this->render('wilayah', array(
			'model' => $model,
			'dataProvider' => new CActiveDataProvider('Wilayah'),
		));
	}

	public function actionDeleteWilayah($id)
	{
		// if (Yii::app()->request->isPostRequest) {  // Sementara dihapus untuk debug
			$this->loadWilayahModel($id)->delete();
			$this->redirect(array('site/wilayah'));
		// } else {
		//     throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		// }
	}

	protected function loadWilayahModel($id)
	{
		$model = Wilayah::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	// Action untuk menampilkan data user
	public function actionUser()
	{
		$dataProvider = new CActiveDataProvider('User');
		$this->render('user', array('dataProvider' => $dataProvider));
	}

	// Action untuk membuat user baru
	public function actionCreateUser()
	{
		$model = new User;

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save()) {
				$this->redirect(array('site/user'));
			}
		}

		$this->render('createUser', array('model' => $model));
	}

	// Action untuk memperbarui user
	public function actionUpdateUser($id)
	{
		$model = $this->loadUserModel($id);

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save()) {
				$this->redirect(array('site/user'));
			}
		}

		$this->render('updateUser', array('model' => $model));
	}

	// Action untuk menghapus user
	public function actionDeleteUser($id)
	{
		// if (Yii::app()->request->isPostRequest) {
			$this->loadUserModel($id)->delete();
			$this->redirect(array('site/user'));
		// } else {
		// 	throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		// }
	}

	// Load User model
	protected function loadUserModel($id)
	{
		$model = User::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	public function actionObat()
	{
		$dataProvider = new CActiveDataProvider('Obat');
		$this->render('obat', array('dataProvider' => $dataProvider));
	}

	public function actionCreateObat()
	{
		$model = new Obat;

		if (isset($_POST['Obat'])) {
			$model->attributes = $_POST['Obat'];
			if ($model->save()) {
				$this->redirect(array('site/obat'));
			}
		}

		$this->render('createObat', array('model' => $model));
	}

	public function actionUpdateObat($id)
	{
		$model = $this->loadObatModel($id);

		if (isset($_POST['Obat'])) {
			$model->attributes = $_POST['Obat'];
			if ($model->save()) {
				$this->redirect(array('site/obat'));
			}
		}

		$this->render('updateObat', array('model' => $model));
	}

	public function actionDeleteObat($id)
	{
		// if (Yii::app()->request->isPostRequest) {
			$this->loadObatModel($id)->delete();
			$this->redirect(array('site/obat'));
		// } else {
		// 	throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		// }
	}

	protected function loadObatModel($id)
	{
		$model = Obat::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	public function actionTindakan()
	{
		$dataProvider = new CActiveDataProvider('Tindakan');
		$this->render('tindakan', array('dataProvider' => $dataProvider));
	}

	public function actionCreateTindakan()
	{
		$model = new Tindakan;
		
		if (isset($_POST['Tindakan'])) {
			$model->attributes = $_POST['Tindakan'];
			if ($model->save()) {
				$this->redirect(array('site/tindakan'));
			}
		}

		$this->render('createTindakan', array('model' => $model));
	}

	public function actionUpdateTindakan($id)
	{
		$model = $this->loadTindakanModel($id);

		if (isset($_POST['Tindakan'])) {
			$model->attributes = $_POST['Tindakan'];
			if ($model->save()) {
				$this->redirect(array('site/tindakan'));
			}
		}

		$this->render('updateTindakan', array('model' => $model));
	}

	public function actionDeleteTindakan($id)
	{
		// if (Yii::app()->request->isPostRequest) {
			$this->loadTindakanModel($id)->delete();
			$this->redirect(array('site/tindakan'));
		// } else {
		// 	throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		// }
	}

	protected function loadTindakanModel($id)
	{
		$model = Tindakan::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}


}
