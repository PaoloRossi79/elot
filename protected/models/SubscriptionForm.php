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
        public $selections;
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
			'categories'=>'Categories',
			'others'=>'Other newsletters',
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
        public function __construct($scenario='')
	{
            
                $this->categories=PrizeCategories::model()->getPrizeCatCheckbox();
		$this->others = array(
                    SubscriptionForm::bestseller => 'Best Sellers',
                    SubscriptionForm::nearest => 'Nearest to you',
                    SubscriptionForm::newest => 'Newest lottery',
                );
                parent::__construct($scenario);
	}
}