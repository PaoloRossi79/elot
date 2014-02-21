<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
        
        public $catList;
        public $lotteryStatusList;
        public $ticketStatusList;
        
        public $upForm;
        public $locationForm;
        
        public $image_sub_folder;
        public $imgList;
        public $filterModel;
        public $sideView;
        
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array category items. This property will be assigned to {@link CMenu::items}.
	 */
	public $catItems=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function isAdmin(){
            return Yii::app()->user->isAdmin();
        }
        
        public function getTmpFolderPath(){
            return $this->getBaseImgFolderPath()."U-".Yii::app()->user->id."/";
        }
        
        public function getBaseImgFolderPath(){
            return Yii::app()->getBasePath() . "/../images/".$this->id."/";
        }
        
        public function cleanTmpFolder(){
            //delete old temp folder
            $tmpPath=$this->getTmpFolderPath();
            if (is_dir($tmpPath)) {
                $res=$this->rmdir_recurse($tmpPath);
            }
        }
        
        public function renameTmpFolder($id){
            //delete old temp folder
            $tmpPath=$this->getTmpFolderPath();
            if (is_dir($tmpPath)) {
                // Identify directories
                $source = $tmpPath;
                $destination = $this->getBaseImgFolderPath().$id."/";
                $errCount=0;
                if(is_dir($destination)){
                    $errCount+=$this->recursiveFileMove($source,$destination);
                    if($errCount==0){
                        $delRes=rmdir($tmpPath);
                    } else {
                        
                    }
                } else {
                    $res=rename($tmpPath,$this->getBaseImgFolderPath().$id);
                }
            }
        }
        
        public function allowOnlyOwner(){
            $id=$_GET['id'];
            $modelName=ucFirst(Yii::app()->controller->id);
            $model=new $modelName();
            $entity=$model->findByPk($id);
            $check=Yii::app()->user->id==$entity->owner_id;
            return $check;
        }
        
        public function getImageUrl($entity,$thumbSize=null){
            $img_path="/images/".strtolower(get_class($entity))."/".$entity->id."/";
            if(!empty($thumbSize)){
                $fileUrl=$img_path.$thumbSize."/".$entity->prize_img;
            } else {
                $fileUrl=$img_path.$entity->prize_img;
            }
            $path = realpath(Yii::app()->getBasePath( )."/..".$fileUrl);
            if($path){
                return $fileUrl;
            } else {
                return 'images/site/no-image-thumb.png';
            }
        }
        
        public function getImageList($entityId){
            $subPath="/images/".$this->id."/".$entityId."/";
            $img_path=Yii::app()->basePath."/..".$subPath;
            $fileList=array();
            if(is_dir($img_path)){
                $dirIter=new DirectoryIterator($img_path);
                while( $dirIter->valid()) {
                    if($dirIter->isFile()){
                        $newFile=new stdClass;
                        $newFile->file=$dirIter->getFilename();
                        $newFile->entityId=$entityId;
                        $newFile->entityType=$this->id;
                        $fileList[]=$newFile;
                    }
                    /*** move to the next element ***/
                    $dirIter->next();
                }
            }
            return $fileList;
        }
        
        public function actions()
        {
            return array(
                'upload'=>array(
                    'class'=>'xupload.actions.XUploadAction',
                    'path' =>Yii::app()->getBasePath() . "/../images/".$this->id,
                    'publicPath' => Yii::app()->getBaseUrl() . "/images/".$this->id,
                    'thumbSize' => "smallThumb",
                    'subfolderVar' => (!empty($this->image_sub_folder)) ? $this->image_sub_folder : 'U-'.Yii::app()->user->id,
                ),
            );
        }
        
        private function rmdir_recurse($path) {
            $path = rtrim($path, '/').'/';
            $handle = opendir($path);
            while(false !== ($file = readdir($handle))) {
                if($file != '.' and $file != '..' ) {
                    $fullpath = $path.$file;
                    if(is_dir($fullpath)) $this->rmdir_recurse($fullpath); else unlink($fullpath);
                }
            }
            closedir($handle);
            return rmdir($path);
        }
        
        protected function beforeRender($view) {
            if($view==="error"){
                return;
            }
            $this->filterModel=new SearchForm;
            $this->filterModel->LotStatus = array('1');
            if(in_array($view,array('index','userIndex'))){
                $this->catList = PrizeCategories::model()->getPrizeCatCheckbox($this->action->id);
                $this->lotteryStatusList = $this->generateMenuCheckList('lotterySearchStatusConst');
                $this->ticketStatusList = $this->generateMenuCheckList('ticketStatusConst');
            } else {
                $this->catList = PrizeCategories::model()->getPrizeCatCheckbox('index');
                $this->lotteryStatusList = $this->generateMenuCheckList('lotterySearchStatusConst','index');
                $this->ticketStatusList = $this->generateMenuCheckList('ticketStatusConst','index');
            }
            switch ($this->id){
                case "lotteries":
                    $this->filterModel->lists["Categories"]=$this->catList;
                    $this->filterModel->lists["LotStatus"]=$this->lotteryStatusList;
                    break;
                case "site":
                    $this->filterModel->lists["Categories"]=$this->catList;
                    break;
                case "tickets":
                    $this->filterModel->lists["Categories"]=$this->catList;
                    $this->filterModel->lists["TicketStatus"]=$this->ticketStatusList;
                    $this->filterModel->lists["Lotteries"]=Lotteries::model()->getBoughtLotMenu();
                    break;
                case "users":
                    $this->filterModel->lists["Categories"]=$this->catList;
                    break;
                default:
                    $this->filterModel->lists=array();
                    break;
            }
            if($_POST['SearchForm']){
               $this->filterModel->setSeachAttributes($_POST['SearchForm']);
            }
            return parent::beforeRender($view);
        }
        
        private function generateMenuList($constArrayName,$action="") {
            if(!$action){
                $action=$this->action->id;
            }
            $constList=Yii::app()->params[$constArrayName];
            $menuList=array();
            $menuList[]=array('label'=>'All Statuses', 'url'=>CController::createUrl("/".$this->id."/".$action));
            foreach ($constList as $const=>$id) {
                $menuList[]=array('label'=>$const, 'url'=>CController::createUrl("/".$this->id."/".$action."?".$constArrayName."=".$const));
            }
            return $menuList;
        }
        
        private function generateMenuCheckList($constArrayName) {
            $constList=Yii::app()->params[$constArrayName];
            $menuList=array();
            foreach ($constList as $const=>$id) {
                $menuList[$id]=$const;
            }
            return $menuList;
        }
        
        private function sendEmailFromTemplate($template,$data) {
            // TODO: merge template and data
            Yii::app()->mailer->Host = '192.168.2.11';
            Yii::app()->mailer->IsSMTP();
            Yii::app()->mailer->From = 'wei@pradosoft.com';
            Yii::app()->mailer->FromName = 'Wei';
            Yii::app()->mailer->AddReplyTo('wei@pradosoft.com');
            Yii::app()->mailer->AddAddress('paolorossi79@gmail.com');
            Yii::app()->mailer->Subject = 'Yii rulez!';
            Yii::app()->mailer->Body = $message;
            Yii::app()->mailer->Send();
        }
        
        private function recursiveFileMove($source,$destination) {
            $files = scandir($source);
            // Cycle through all source files
            $errCount=0;
            foreach ($files as $file) {
              if (in_array($file, array(".",".."))) continue;
              // If we copied this successfully, mark it for deletion
              if(is_dir($source.$file)){
                  $errCount+=$this->recursiveFileMove($source.$file."/",$destination.$file."/");
                  rmdir($source.$file);
              } else {
                if (copy($source.$file, $destination.$file)) {
                    unlink($source.$file);
                } else {
                    $errCount+=1;
                }
              }
            }
            rmdir($source.$file);
            return $errCount;
        }
        
        protected function saveLocation($data) {
            // check if already exist
            $locCond = new CDbCriteria();
            $locCond->addCondition('addressLat='.number_format((float)$data['addressLat'],6));
            $locCond->addCondition('addressLng='.number_format((float)$data['addressLng'],6));
            $check = Locations::model()->find($locCond);
            if($check){
                return $check->id;
            } else { //new location
                $newLoc = new Locations;
                $newLoc->address = $data['address'];
                $newLoc->addressLat = number_format($data['addressLat'],6);
                $newLoc->addressLng = number_format($data['addressLng'],6);
                if($newLoc->save()){
                    return $newLoc->id;
                } else {
                    return null;
                }
            }
        }
}