<?php
/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 1.0
 * @package Clearbooks
 * @subpackage Soap/1
 */
class ClearbooksSoap extends \SoapClient
{
    protected $apiKey;
    protected $namespace;

    public function __construct( $apiKey, $wsdl = '', $options = array() )
    {
        if ( !$apiKey ) {
            throw new \Exception( 'An API Key must be specified' );
        }

        $this->apiKey = $apiKey;

        if ( !$wsdl ) {
            $wsdl = 'https://secure.clearbooks.co.uk/api/accounting/wsdl/';
        }

        if ( !is_array( $options ) ) {
            $options = array();
        }

        if ( !array_key_exists( 'trace', $options ) ) {
            $options['trace'] = 1;
        }

        foreach ( self::$classMap as $key => $value ) {
            if ( !isset( $options['classmap'][$key] ) ) {
                $options['classmap'][$key] = $value;
            }
        }

        parent::__construct( $wsdl, $options );

        $this->namespace = str_replace( 'wsdl', 'soap', $wsdl );

        $header = new SoapHeader( $this->namespace, 'authenticate', array( 'apiKey' => $this->apiKey ) );
        $this->__setSoapHeaders( array( $header ) );
    }

    /**
     * @param AllocateQuery $query
     * @return ResponseStatus
     */
    public function allocatePayment( AllocateQuery $query )
    {
        return $this->_call( 'allocatePayment', $query );
    }

    /**
     * @param AccountCodeRequest $code
     * @return AccountCodeResult
     */
    public function createAccountCode( AccountCodeRequest $code )
    {
        return $this->_call( 'createAccountCode', $code );
    }

    /**
     * @param Entity $entity
     * @return int
     */
    public function createEntity( Entity $entity )
    {
        return $this->_call( 'createEntity', $entity );
    }

    /**
     * @param Invoice $invoice
     * @return InvoiceReturn
     */
    public function createInvoice( Invoice $invoice )
    {
        return $this->_call( 'createInvoice', $invoice );
    }

    /**
     * @param Invoice[] $invoices
     * @return InvoiceReturn[]
     */
    public function createInvoices( array $invoices )
    {
        return $this->_call( 'createInvoices', $invoices );
    }

    /**
     * @param Journal $project
     * @return JournalReturn
     */
    public function createJournal( Journal $project )
    {
        return $this->_call( 'createJournal', $project );
    }

    /**
     * @param Payment $payment
     * @return PaymentReturn
     */
    public function createPayment( Payment $payment )
    {
        return $this->_call( 'createPayment', $payment );
    }

    /**
     * @param Payment[] $payments
     * @return PaymentReturn
     */
    public function createPayments( array $payments )
    {
        return $this->_call( 'createPayments', $payments );
    }

    /**
     * @param Project $project
     * @return ProjectReturn
     */
    public function createProject( Project $project )
    {
        return $this->_call( 'createProject', $project );
    }

    /**
     * @param int $entityId
     * @return bool
     */
    public function deleteEntity( $entityId )
    {
        return $this->_call( 'deleteEntity', $entityId );
    }

    /**
     * @param int $journalId
     * @return bool
     */
    public function deleteJournal( $journalId )
    {
        return $this->_call( 'deleteJournal', $journalId );
    }

    /**
     * @param string $externalId
     * @return int
     */
    public function getEntityIdFromExternalId( $externalId )
    {
        return $this->_call( 'getEntityIdFromExternalId', $externalId );
    }

    /**
     * @param int $entityId
     * @param string $type
     * @return EntityOutstandingBalance
     */
    public function getEntityOutstandingBalance( $entityId, $type )
    {
        return $this->_call( 'getEntityOutstandingBalance', $entityId, $type );
    }

    /**
     * @param ExchangeRateRequest $request
     * @return float
     */
    public function getExchangeRate( $request )
    {
        return $this->_call( 'getExchangeRate', $request );
    }

    /**
     * @param string $type
     * @param string $invoicePrefix
     * @param string $invoiceNumber
     * @return int
     */
    public function getInvoiceIdFromInvoiceNumber( $type, $invoicePrefix, $invoiceNumber )
    {
        return $this->_call( 'getInvoiceIdFromInvoiceNumber', $type, $invoicePrefix, $invoiceNumber );
    }

    /**
     * @param string $externalId
     * @return int
     */
    public function getPaymentIdFromExternalId( $externalId )
    {
        return $this->_call( 'getPaymentIdFromExternalId', $externalId );
    }

    /**
     * @return AccountCodeHeading[]
     */
    public function listAccountCodeHeadings()
    {
        return $this->_call( 'listAccountCodeHeadings' );
    }

    /**
     * @return AccountCode[]
     */
    public function listAccountCodes()
    {
        return $this->_call( 'listAccountCodes' );
    }

    /**
     * @return ListBankAccountsReturn
     */
    public function listBankAccounts()
    {
        return $this->_call( 'listBankAccounts' );
    }

    /**
     * @return Currency[]
     */
    public function listCurrencies()
    {
        return $this->_call( 'listCurrencies' );
    }

    /**
     * @param EntityQuery $query
     * @return Entity[]
     */
    public function listEntities( EntityQuery $query = null )
    {
        return $this->_call( 'listEntities', $query );
    }

    /**
     * @param InvoiceQuery $query
     * @return Invoice[]
     */
    public function listInvoices( InvoiceQuery $query )
    {
        return $this->_call( 'listInvoices', $query );
    }

    /**
     * @param string $type
     * @param int $limit
     * @return ListOutstandingBalancesReturn[]
     */
    public function listOutstandingBalances( $type, $limit = 10 )
    {
        return $this->_call( 'listOutstandingBalances', $type, $limit );
    }

    /**
     * @param int $offset
     * @return Project[]
     */
    public function listProjects( $offset = 0 )
    {
        return $this->_call( 'listProjects', $offset );
    }

    /**
     * @return Theme[]
     */
    public function listThemes()
    {
        return $this->_call( 'listThemes' );
    }

    /**
     * @param int $codeId
     * @param AccountCodeRequest $code
     * @return AccountCodeResult
     */
    public function updateAccountCode( $codeId, AccountCodeRequest $code )
    {
        return $this->_call( 'updateAccountCode', $codeId, $code );
    }

    /**
     * @param int $entityId
     * @param Entity $entity
     * @return int
     */
    public function updateEntity( $entityId, Entity $entity )
    {
        return $this->_call( 'updateEntity', $entityId, $entity );
    }

    /**
     * @param int $projectId
     * @param Project $project
     * @return ProjectReturn
     */
    public function updateProject( $projectId, Project $project )
    {
        return $this->_call( 'updateProject', $projectId, $project );
    }

    /**
     * @param InvoiceRef $invoice
     * @return ResponseStatus
     */
    public function voidInvoice( InvoiceRef $invoice )
    {
        return $this->_call( 'voidInvoice', $invoice );
    }

    /**
     * @param RemovePayment $payment
     * @return ResponseStatus
     */
    public function voidPayment( RemovePayment $payment )
    {
        return $this->_call( 'voidPayment', $payment );
    }

    /**
     * @param CreditQuery $query
     * @return CreditResponseStatus
     */
    public function writeOff( CreditQuery $query )
    {
        return $this->_call( 'writeOff', $query );
    }

    /**
     * {@inheritDoc}
     */
    public function __getLastResponse()
    {
        return $this->_formatXml( parent::__getLastResponse() );
    }

    /**
     * {@inheritDoc}
     */
    public function __getLastRequest()
    {
        return $this->_formatXml( parent::__getLastRequest() );
    }

    /**
     * @param $name
     * @param null $parameter
     * @param null $_
     * @return mixed
     */
    protected function _call( $name, $parameter = null, $_ = null )
    {
        $args = func_get_args();
        array_shift( $args );
        return $this->__soapCall( $name, $args, array( 'uri' => $this->namespace, 'soapaction' => '#' . $name ) );
    }

    /**
     * @param $string
     * @return string
     */
    private function _formatXml( $string )
    {
        $doc = new \DomDocument( '1.0' );
        $doc->loadXML( $string );
        $doc->formatOutput = true;
        return $doc->saveXML();
    }
}
//EOF 0.php