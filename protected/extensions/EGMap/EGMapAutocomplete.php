<?php

/**
 * PlacesAutoComplete wraps Google Places Autocomplete API.
 *
 * PlacesAutoComplete encapsulates the {@link https://developers.google.com/maps/documentation/javascript/places#places_autocomplete
 * Google Places Autocomplete.
 * 
 * To use this widget, you first add this library to extensions directory. And then
 * you can insert the following code in a view:
 * <pre> 
 * $this->widget('ext.gplacesautocomplete.GPlacesAutoComplete', array(
 *    'name' => 'city',
 *    'options' => array(
 *       'types' => array(
 *          '(cities)'
 *       ),
 *       'componentRestrictions' => array(
 *          'country' => 'us',
 *        )
 *    )
 * ));
 * </pre>
 * 
 * To configure the options please see the {@link https://developers.google.com/maps/documentation/javascript/places#adding_autocomplete
 * specification}.
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 * @package ext.placesautocomplete
 * @version 0.1
 */

class EGMapAutocomplete extends CInputWidget {

        /**
         * @var string script executed after the autocomplete is declared.
         */
        public $afterScript = '';

        /**
         * @var string script executed before the autocomplete is declared.
         */
        public $beforeScript = '';

        /**
         * @var string variable name to store the autocomplete object. Will use
         * the widget ID if unset.
         */
        public $objectName = NULL;

        /**
         * @var array Autocomplete options. Refer to {@link https://developers.google.com/maps/documentation/javascript/places#adding_autocomplete}
         */
        public $options = array();

        /**
         * @var boolean whether the Google API libray is registered from this widget.
         */
        public $registerLibrary = true;

        /**
         * @var boolean whether to use sensor.
         */
        public $sensor = true;

        /**
         * Runs the widget.
         */
        public function run() {
                list($name, $id) = $this->resolveNameID();
                if (isset($id))
                        $this->id = $id;

                if (isset($this->htmlOptions['id']))
                        $id = $this->htmlOptions['id'];
                else
                        $this->htmlOptions['id'] = $id;

                if (isset($this->htmlOptions['name']))
                        $name = $this->htmlOptions['name'];

                if (!isset($this->objectName))
                        $this->objectName = $this->id;

                if ($this->hasModel()){
                    echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
                    /*echo CHtml::activeTextField($this->model, $this->attribute.'Lat', array('id'=>$this->htmlOptions['id']."_lat", 'name'=>'SearchForm[geoLat]', 'style'=>'display:none;'));
                    echo CHtml::activeTextField($this->model, $this->attribute.'Lng', array('id'=>$this->htmlOptions['id']."_lng", 'name'=>'SearchForm[geoLng]', 'style'=>'display:none;'));*/
                    echo CHtml::activeTextField($this->model, $this->attribute.'Lat', array('id'=>$this->htmlOptions['id']."_lat", 'style'=>'display:none;'));
                    echo CHtml::activeTextField($this->model, $this->attribute.'Lng', array('id'=>$this->htmlOptions['id']."_lng", 'style'=>'display:none;'));
                } else {
                    echo CHtml::textField($name, $this->value, $this->htmlOptions);
                    echo CHtml::hiddenField($name.'Lat',0, array('id'=>$this->htmlOptions['id']."_lat"));
                    echo CHtml::hiddenField($name.'Lng',0, array('id'=>$this->htmlOptions['id']."_lng"));
                }

                $this->registerScript();
        }

        /**
         * Register the scripts.
         * 
         * This method will register the library needed and the scripts to create
         * the autocomplete.
         */
        public function registerScript() {
                /* @var $cs CClientScript */
                $cs = Yii::app()->clientScript;
                if ($this->registerLibrary)
                        $cs->registerScriptFile('http://maps.googleapis.com/maps/api/js?' . http_build_query(array(
                                        'libraries' => 'places',
                                        'sensor' => $this->sensor ? 'true' : 'false',
                                )));
                $this->afterScript = <<<JS
google.maps.event.addListener({$this->objectName}, 'place_changed', function() {
    var place = {$this->objectName}.getPlace();
    if(place){
        if(place.geometry){
            $('#{$this->htmlOptions['id']}_lat').val(place.geometry.location.lat());
            $('#{$this->htmlOptions['id']}_lng').val(place.geometry.location.lng());
        }
    }
});
JS;
                $options = CJSON::encode($this->options);
                $cs->registerScript(__CLASS__ . '#' . $this->id, <<<JS
(function(){
        var input = document.getElementById('{$this->id}');
        var options = {$options};
        {$this->beforeScript}
        {$this->objectName} = new google.maps.places.Autocomplete(input, options);
        {$this->afterScript}
})();
JS
                );
        }

}
?>
