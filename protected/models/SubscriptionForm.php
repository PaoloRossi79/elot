<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SubscriptionForm extends CFormModel
{
	public $categories;
	public $others;
        public $catSelections;
        public $othSelections;
        public $privacyOk;
        public $termsOk;
        const bestseller = 0;
        const nearest = 1;
        const newest = 2;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			
		);
	}
        
        /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'categories'=> Yii::t('wonlot','Categories'),
			'others'=> Yii::t('wonlot','Other newsletters'),
			'privacyOk'=> Yii::t('wonlot','Accept privacy policy?'),
			'termsOk'=> Yii::t('wonlot','Accept terms & conditions?'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
        public function __construct($scenario='')
	{
                $user = Users::model()->findByPk(Yii::app()->user->id);
                $this->termsOk = $user->newsletter_terms;
                $this->privacyOk = $user->newsletter_privacy;
                $this->categories=PrizeCategories::model()->getPrizeCatCheckbox();
		$this->others = array(
                    SubscriptionForm::bestseller => Yii::t('wonlot','Best Sellers'),
                    SubscriptionForm::nearest => Yii::t('wonlot','Nearest to you'),
                    SubscriptionForm::newest => Yii::t('wonlot','Newest lottery'),
                );
                $this->catSelections = array();
                $this->othSelections = array();
                /*$newsletters = Subscriptions::model()->findAll('user_id = '.Yii::app()->user->id);
                foreach($newsletters as $k => $news) {
                    if($news->nl_type == "cat"){
                        $this->catSelections[] = $news->nl_type_id;
                    } elseif($news->nl_type == "oth"){
                        $this->othSelections[] = $news->nl_type_id;
                    }
                }*/
                parent::__construct($scenario);
	}
}