<?php

class Zend_Service_PayPal_Data_MassPayReceiver
{
    /**
     * Receiver type constants
     */
    const TYPE_EMAIL  = 'EmailAddress'; // Receiver identified by e-mail address 
  
    const TYPE_USERID = 'UserID'; // Receiver identified by PayPal user ID 
    
    /**
     * Receiver identifier(email address or PayPal ID)
     *
     * @var string
     */
    protected $_receiver;
    
    /**
     * Receiver ID type - one of the two type constants
     *
     * @var string
     */
    protected $_receiverType;
    
    /**
     * Amount to pay(currency is defined in transaction)
     *
     * @var float
     */
    protected $_amount;
    
    /**
     * Optional unique transaction ID
     *
     * @var string
     */
    protected $_uniqueid;
    
    /**
     * Optional customer-specific note
     *
     * @var string
     */
    protected $_note;
    
    /**
     * Create a new receiver info object
     * 
     * @todo should we really validate the email address here?
     *
     * @param float  $amount   Amount to pay(> 0)
     * @param string $rcpt      Unique receiver identifier
     * @param string $rcpt_type One of the two type constants
     */
    public function __construct($amount, $receiver, $receiverType = self::TYPE_EMAIL)
    {
        $this->_amount = $amount;
        
        
        if ( self::TYPE_EMAIL == $receiverType ) {
            $validator = new Zend_Validate_EmailAddress();
            if ( !$validator->isValid( $receiver ) ) {
                require_once 'Zend/Service/PayPal/Data/Exception';
                throw new Zend_Service_PayPal_Data_Exception(
                        'Invalid email address specified for reciever' );
            }
        }
    
        
        $this->receiver = $receiver;
        $this->receiverType
    }
    
    /**
     * Set the optional unique receiver ID
     *
     * @param  string $id
     * @return Zend_Service_PayPal_Data_MassPayReceiver
     */
    public function setUniqueId($id);
    
    /**
     * Get the optional recipient unique ID
     *
     * @return string
     */
    public function getUniqueId();
    
    /**
     * Set receiver specific custom note
     *
     * @param  string $note
     * @return Zend_Service_PayPal_Data_MassPayReceiver
     */
    public function setNote($note);
    
    /**
     * Return the customer-specific optional custom note
     *
     * @return string
     */
    public function getNote();
    
    /**
     * Get the amount to pay(currency is determined by the transaction)
     *
     * @return float
     */
    public function getAmount();
    
    /**
     * Get the receiver ID(email address or PayPal ID)
     *
     * @return string
     */
    public function getReceiverId();
    
    /**
     * Get the receiver type(must match transaction-global type)
     *
     * @return string
     */
    public function getReceiverType();
    
    /**
     * Validate that the receiver ID is well-formed according to it's type
     *
     * @param  string $value
     * @param  string $type  Either ::RT_EMAIL or ::RT_USERID
     * @return boolean
     */
    static public function validateReceiverType($value, $type);
} 