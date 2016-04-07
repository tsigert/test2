<?php

class AdminQuotesController extends ModuleAdminController
{
    private $probabilities;
    private $job_specified;
    
    public function __construct()
    {
        $this->probabilities = [
            '0' => $this->l('Not Selected'),
            '1' => $this->l('Very Confident'),
            '2' => $this->l('Confident'),
            '3' => $this->l('Not Confident'),
        ];
        
        $this->job_specified = [
            '0' => $this->l('Not Selected'),
            '1' => $this->l('No'),
            '2' => $this->l('Yes'),
        ];
        
        $this->bootstrap = true;
        $this->table = 'module_quotes';
        $this->className = 'Quotes';
        $this->lang = false;
        $this->_defaultOrderBy = 'id_quote';
        $this->_orderBy = 'id_quote';
        $this->_orderWay = 'DESC';
        $this->identifier = 'id_quote';
        $this->addRowAction('view');
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->initList();
        parent::__construct();
    }
    
    private function initList()
    {
        $this->fields_list = array(
            'id_quote' => array(
                'title' => $this->l('Id Quote'),
                'align' => 'text-center', 
                'class' => 'fixed-width-xs',
            ),
            'bqreference' => array(
                'title' => $this->l('Reference'),
            ),
            'id_customer' => array(
                'title' => $this->l('Customer'),
                'callback' => 'printCustomer',
            ),
            'id_cart' => array(
                'title' => $this->l('Id Cart'),
                'align' => 'text-center', 
                'class' => 'fixed-width-xs',
                
            ),
            'bqemail' => array(
                'title' => $this->l('Email'),
            ),
            'job_specified' => array(
                'title' => $this->l('Job Specified'),
                'align' => 'text-center',
                'type' => 'select',
                'list' => $this->job_specified,
                'filter_key' => 'job_specified',
                'callback' => 'printJobSpecified',
                'class' => 'fixed-width-xs',
            ),
            'estimated_order_date' => array(
                'title' => $this->l('Estimated order date'),
                'type' => 'date',
            ),
            'estimated_delivery_date' => array(
                'title' => $this->l('Estimated delivery date'),
                'type' => 'date',
            ),
            'order_probability' => array(
                'title' => $this->l('Probability'),
                'type' => 'select',
                'list' => $this->probabilities,
                'filter_key' => 'order_probability',
                'callback' => 'printOrderProbability',
            ),
            'date_add' => array(
                'title' => $this->l('Date Added'),
                'type' => 'date',
            ),
        );
        $helper = new HelperList();
         
        $helper->shopLinkType = '';
         
        $helper->simple_header = true;
         
        // Actions to be displayed in the "Actions" column
        $helper->actions = array('edit', 'delete', 'view');
         
        $helper->identifier = 'id_quote';
        $helper->show_toolbar = true;
        $helper->title = 'Quotes';
        $helper->table = 'module_quotes';
         
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        return $helper;
    }
    
    public function printJobSpecified($job_specified)
    {
        return $this->job_specified[$job_specified];
    }
    
    public function printOrderProbability($order_probability)
    {
        return $this->probabilities[$order_probability];
    }
    
    public function printCustomer($id_customer)
    {
        $customer = new Customer($id_customer);
        $customerName = substr($customer->firstname, 0, 1).'. '.$customer->lastname;
        
        return $customerName;
    }
    
    public function renderList()
    {
        return parent::renderList();
    }
    
    public function postProcess()
    {
        parent::postProcess();
    }
}