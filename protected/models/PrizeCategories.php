<?php

/**
 * This is the model class for table "prize_categories".
 *
 * The followings are the available columns in table 'prize_categories':
 * @property string $id
 * @property string $category_name
 * @property string $seo_name
 */
class PrizeCategories extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prize_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_name', 'required'),
			array('category_name, seo_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_name, seo_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_name' => 'Category Name',
			'seo_name' => 'Seo Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('seo_name',$this->seo_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
	 * Returns the list of the prize categories (for DropDown)
	 * @return PrizeCategories list 
	 */
	public function getPrizeCatList()
	{
		$prizeCatList=$this->findAll();
                return $prizeCatList;
	}

        /**
	 * Returns the list of the prize categories (for DropDown)
	 * @return PrizeCategories list 
	 */
	public function getPrizeCatMenu($action)
	{
		$prizeCatList=$this->findAll();
                $catList=array();
                $catList[]=array('label'=>'All Categories', 'url'=>array('lotteries/'.$action));
                foreach($prizeCatList as $cat){
                    $catList[]=array('label'=>$cat->category_name, 'url'=>array('lotteries/'.$action.'?prizeCategory='.$cat->id));
                }
                return $catList;
	}

	public function getPrizeCatCheckbox()
	{
		$prizeCatList=$this->findAll();
                $catList=array();
                foreach($prizeCatList as $cat){
                    $catList[$cat->id]=$cat->category_name;
                }
                return $catList;
	}

        /**
	 * Returns the list of the prize categories (for DropDown)
	 * @return PrizeCategories list 
	 */
	public function getPrizeCatNameById($id)
	{
                $text="";
                $first=true;
            	$prizeCat=$this->findAllByPk($id);
                foreach ($prizeCat as $cat) {
                    $text.=($first ? "" : ", ").$cat->category_name;
                    $first=false;
                }
                return $text;
	}
        
        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrizeCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
