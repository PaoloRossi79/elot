<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MyLotFilterForm extends CFormModel
{
	// COMMON
        public $searchText;
	public $Categories;
	public $Category;
	public $lists;
        
        // FOR AUCTIONS ONLY
        public $LotStatus;
        public $LotStartStatus = 1;
	public $date;
	public $searchStartDate;
	public $searchEndDate;
	public $geo;
	public $geoLat;
	public $geoLng;
	public $geoCity;
	public $geoState;
	public $geoCountry;
	public $ticketPrice;
	public $prizePrice;
	public $keyword;
	public $minTicketPriceRange;
	public $maxTicketPriceRange;
	public $minPrizePriceRange;
	public $maxPrizePriceRange;
	public $favorite;
	public $userGuaranted;
	public $userMinRating;
	public $onlyPrivate;
	public $onlyCompany;
	public $onlyNew;
	public $onlyUsed;
        
        // FOR TICKETS ONLY
	public $lottery;
        public $TicketStatus;

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
			'searchText'=>Yii::t('wonlot','Cerca...'),
			'searchStartDate'=>Yii::t('wonlot','Data di apertura'),
			'searchEndDate'=>Yii::t('wonlot','Data di estrazione'),
			'geo'=>Yii::t('wonlot','Località'),
			'ticketPrice'=>Yii::t('wonlot','Prezzo del Ticket'),
			'prizePrice'=>Yii::t('wonlot','Valore del premio'),
			'userMinRating'=>Yii::t('wonlot','Affidabilità venditore'),
			'favorite'=>Yii::t('wonlot','Solo preferite'),
			'userGuaranted'=>Yii::t('wonlot','Venditore garantito'),
			'onlyPrivate'=>Yii::t('wonlot','Solo privati'),
			'onlyCompany'=>Yii::t('wonlot','Solo aziende'),
			'onlyNew'=>Yii::t('wonlot','Solo nuovo'),
			'onlyUsed'=>Yii::t('wonlot','Solo usato'),
			//''=>Yii::t('wonlot',''),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function setSearchAttributes($data)
	{
		$this->searchText=$data['searchText'];
                if($data['Category'] && empty($data['Categories'])){
                    $this->Categories=$data['Category'];
                    $this->Category=$data['Category'];
                } else {
                    $this->Categories=$data['Categories'];
                }
		$this->LotStatus=$data['LotStatus'];
		$this->LotStartStatus=$data['LotStartStatus'];
		$this->minTicketPriceRange=$data['minTicketPriceRange'];
		$this->maxTicketPriceRange=$data['maxTicketPriceRange'];
		$this->minPrizePriceRange=$data['minPrizePriceRange'];
		$this->maxPrizePriceRange=$data['maxPrizePriceRange'];
		$this->searchStartDate=$data['searchStartDate'];
		$this->searchEndDate=$data['searchEndDate'];
		$this->geo=$data['geo'];
		$this->geoLat=$data['geoLat'];
		$this->geoLng=$data['geoLng'];
		$this->geoCity=$data['geoCity'];
		$this->geoState=$data['geoState'];
		$this->geoCountry=$data['geoCountry'];
		$this->favorite=$data['favorite'];
		$this->userGuaranted=$data['userGuaranted'];
		$this->userMinRating=$data['userMinRating'];
	}
}