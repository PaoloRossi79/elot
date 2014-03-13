<?php
/**
 * MyImageDataProvider class file.
 *
 * @author Paolo Rossi <paolorossi79@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2014 Paolo Rossi
 * @license http://www.yiiframework.com/license/
 */


class MyImageDataProvider extends CDataProvider
{
	/**
	 * @var CActiveRecord the AR finder instance (eg <code>Post::model()</code>).
	 * This property can be set by passing the finder instance as the first parameter
	 * to the constructor. For example, <code>Post::model()->published()</code>.
	 * @since 1.1.3
	 */
	public $model;
	public $id;
        
	private $_data;
	private $_sort=false;
	private $_pagination=false;
	
        /**
	 * Constructor.
	 * @param mixed $modelClass the model class (e.g. 'Post') or the model finder instance
	 * (e.g. <code>Post::model()</code>, <code>Post::model()->published()</code>).
	 * @param array $config configuration (name=>value) to be applied as the initial property values of this class.
	 */
	public function __construct($model)
	{
                $this->id = strtolower(get_class($model));
                $this->_data = Controller::getImageList($model->id);
	}

        /**
	 * Sets the data items for this provider.
	 * @param array $value put the data items into this provider.
	 */
	public function setData($value)
	{
		$this->_data=$value;
	}
        
	/**
	 * Fetches the data from the persistent data storage.
	 * @return array list of data items
	 */
	protected function fetchData()
	{
                return $this->_data;
	}

	/**
	 * Fetches the data item keys from the persistent data storage.
	 * @return array list of data item keys.
	 */
	protected function fetchKeys()
	{
		return array_keys($this->_data);
	}

	/**
	 * Calculates the total number of data items.
	 * @return integer the total number of data items.
	 */
	protected function calculateTotalItemCount()
	{
		return count($this->_data);
	}
}
