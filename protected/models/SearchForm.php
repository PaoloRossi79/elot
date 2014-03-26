<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SearchForm extends CFormModel
{
	// COMMON
        public $searchText;
	public $Categories;
	public $Category;
	public $lists;
        
        // FOR LOTTERIES ONLY
        public $LotStatus;
        public $LotStartStatus = 1;
	public $date;
	public $searchStartDate;
	public $searchEndDate;
	public $geo;
	public $geoLat;
	public $geoLng;
	public $ticketPrice;
	public $prizePrice;
	public $keyword;
	public $minTicketPriceRange;
	public $maxTicketPriceRange;
	public $minPrizePriceRange;
	public $maxPrizePriceRange;
        
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
			'searchText'=>'Search...',
			'searchStartDate'=>'Start Date',
			'searchEndDate'=>'End Date',
			'geo'=>'Location',
			'ticketPrice'=>'Ticket Price',
			'prizePrice'=>'Prize Price',
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function setSeachAttributes($data)
	{
		$this->searchText=$data['searchText'];
		$this->Categories=$data['Categories'];
		$this->Category=$data['Category'];
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
	}
}