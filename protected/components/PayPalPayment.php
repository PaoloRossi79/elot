<?php
class PayPalPayment {

   protected $_errors = array();
   protected $_credentials = array();
   protected $_endPoint;
   protected $_version = '74.0';

   public function request($method,$params=array()) {

      $this->_credentials = array(
         'USER' => Yii::app()->params['PP_USER'],
         'PWD' => Yii::app()->params['PP_PWD'],
         'SIGNATURE' => Yii::app()->params['PP_SIGNATURE']
      );
      $this->_endPoint = Yii::app()->params['PP_ENDPOINT'];

      $this->_errors = array();
      if(empty($method)) {
         $this->_errors = array('Manca il metodo API da invocare.');
         return false;
      }

      //Parametri
      $requestParams = array(
         'METHOD' => $method,
         'VERSION' => $this->_version
      ) + $this->_credentials;

      //Costruiamo la stringa NVP
      $request = http_build_query($requestParams + $params);

      //File con il cerificato cURL
      if (substr(dirname(__FILE__),0,2)=='C:') $ds = '\\'; else $ds = '/';
      $cert = dirname(__FILE__).$ds.'cacert.pem';
      
      $curlOptions = array (
         CURLOPT_URL => $this->_endPoint,
         CURLOPT_VERBOSE => 1,
         CURLOPT_SSL_VERIFYPEER => true,
         CURLOPT_SSL_VERIFYHOST => 2,
         CURLOPT_CAINFO => $cert,
         CURLOPT_RETURNTRANSFER => 1,
         CURLOPT_POST => 1,
         CURLOPT_POSTFIELDS => $request
      );

      $ch = curl_init();
      curl_setopt_array($ch,$curlOptions);

      //Mandiamo la richiesta
      $response = curl_exec($ch);

      //Controlliamo se ci sono errori cURL
      if (curl_errno($ch)) {
         $this->_errors = curl_error($ch);
         curl_close($ch);
         return false;
      } else {
         curl_close($ch);
         $responseArray = array();
         parse_str($response,$responseArray);
         return $responseArray;
      }
   }

}
?>
