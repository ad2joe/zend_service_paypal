<?php


class Zend_Service_PayPal_Nvp
{
    /**
     * Paypal NVP service URL
     *
     */
    const SERVICE_URI = 'https://api-3t.sandbox.paypal.com/nvp';
    
    /**
     * Authentication info for the PayPal API service
     *
     * @var Zend_Service_PayPal_Data_AuthInfo
     */
    protected $authInfo = null;
    
    /**
     * Zend_Http_Client to use for the service
     *
     * @var Zend_Http_Client
     */
    protected $httpClient = null;
    
    /**
     * Enter description here...
     *
     * @param Zend_Service_PayPal_Data_AuthInfo $auth_info
     * @param Zend_Http_Client                  $httpClient
     */
    public function __construct (Zend_Service_PayPal_Data_AuthInfo $authInfo, $httpClient = null);
    
    /**
     * HTTP client preparation procedures - should be called before every API
     * call.
     *
     * Will clean up the HTTP client parameters, set the request method to POST
     * and add the always-required authentication information
     *
     * @param string $method The API method we are about to use
     * @return void
     */
    protected function prepare ($method);
    
    /**
     * Preform the request and return a response object
     *
     * @return Zend_Service_PayPal_Response
     */
    protected function process (); 
    
    /**
     * Get the HTTP client to be used for this service
     *
     * @return Zend_Http_Client
     */
    public function getHttpClient ();
    /**
     * Preform a DoDirectPayment call
     *
     * This call preforms a direct payment, directly charging a credit card
     * using PayPal's services. It does not require a valid PayPal user name,
     * but does require the credit card details and billing address of the
     * customer.
     *
     * @param  Zend_Service_PayPal_Data_CreditCard $creditCard
     * @param  Zend_Service_PayPal_Data_Address    $address
     * @param  float                               $ammount
     * @param  string                              $remoteAddr
     * @param  string                              $paymentAction
     * @param  array                               $params
     * @return Zend_Service_PayPal_Response
     */
    
    public function doDirectPayment ($creditCard, $address, $ammount, $remoteAddr = null, $paymentAction = 'Sale', $params = array());
    /**
     * Preform a SetExpressCheckout PayPal API call, starting an Express
     * Checkout process.
     *
     * This call is expected to return a token which can be used to redirect
     * the user to PayPal's transaction approval page
     *
     * @param  float  $ammount
     * @param  string $returnUrl
     * @param  string $cancelUrl
     * @param  array  $params    Additional parameters
     * @return Zend_Service_PayPal_Response
     */
    public function setExpressCheckout ($ammount, $returnUrl, $cancelUrl, $params = array());
    
    /**
     * Preform a GetExpressCheckoutDetails PayPal API call, requesting info
     * about a started Express Checkout transaction
     *
     * @param  string $token Transaction identifier token
     * @return Zend_Service_PayPal_Response
     */
    
    public function getExpressCheckoutDetails ($token);
    /**
     * Preform a DoExpressCheckoutPayment PayPal API call, finalizing a
     * transaction.
     *
     * @param  string $token
     * @param  string $payerId
     * @param  string $ammount
     * @param  string $paymentAction Payment action - 'Sale' or 'Authorization'
     * @return Zend_Service_PayPal_Response
     */
    public function doExpressCheckoutPayment ($token, $payerId, $ammount, $paymentAction = 'Sale');
    
    /**
     * Preform a Mass Payment API call
     *
     * @param  array  $receivers    Array of Zend_Service_PayPal_Data_MassPayReceiver objects
     * @param  string $rcpttype     Receiver type
     * @param  string $emailSubject Email subject for all receivers
     * @param  string $currency     3 letter currency code, default is USD
     * @return Zend_Service_PayPal_Response
     */
    public function doMassPay (array $receivers, $rcpttype = Zend_Service_PayPal_Data_MassPayReceiver::RT_EMAIL, $emailSubject = '', $currency = 'USD');
    
    /**
     * Preform a Get Transaction Details API call
     *
     * @param  string $transactionId Transaction ID (17 Alphanumeric single-byte characters)
     * @return Zend_Service_PayPal_Response
     */
    public function doGetTransactionDetails ($transactionId)
    {}
} 