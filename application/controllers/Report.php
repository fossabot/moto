<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Report extends MY_controller
{
	private $shop_id;
	private $data_2;

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('company_model');
		$this->load->model('distributor_model');
		$this->load->model('purchase_model');
		$this->load->model('customer_model');
		$this->shop_id = $this->tank_auth->get_shop_id();
	}

	public function is_logged_in()
	{
		if(!$this->tank_auth->is_logged_in())
		{
			redirect('auth/login');
		}
	}
	
	public function stock_report()
	{
	  $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['company'] = $this->company_model->all();
			$data['product'] = $this->product_model->all();
			$data['catagory'] = $this->category_model->all();
			$data['product_specification'] = $this->product_model->product_specification();
			$data['total_stock_price'] = $this->site_model->total_stock_price();
			$data['total_stock_sale_price'] = $this->site_model->total_stock_sale_price();
			$data['total_stock_quantity'] = $this->site_model->total_stock_quantity();
			$data['product_type'] = $this->product_model->product_type();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['posts']= array();
			$data['vuejscomp'] = 'all_stock_report_new.js';
			$this->__renderview('Report/all_stock_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function  all_stock_report_find()
	{	
		$catagory_id= $this->input->post('catagory_id');
		$product_id= $this->input->post('product_id');
		$company_id=$this->input->post('company_id');
		$type_wise=$this->input->post('type_wise');
		$product_amount=$this->input->post('product_amount');
		$category1 = rawurldecode($catagory_id);
		$company1 = rawurldecode($company_id);
		$temp = $this->report_model->get_stock_info_by_multi($category1,$product_id,$company1,$type_wise,$product_amount);
		echo json_encode($temp->result());
	}

	public function  stock_report_print()
	{	
		 $category_id='';
		 $product_id='';
		 $company_id='';
		 $type='';
		 $category_id = $this->uri->segment(3);
		 $product_id = $this->uri->segment(4);
		 $company_id = $this->uri->segment(5);
		 $type = $this->uri->segment(6);
		 $product_amount='';
		 $data['temp'] = $this->report_model->get_stock_info_by_multi($category_id,$product_id,$company_id,$type,$product_amount);
		 $this->__renderviewprint('Prints/report/stock_report', $data);
	}

	public function stock_details()
	{
		$data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
      $data['bd_date'] = $bd_date;
      $data['sale_status'] = '';
      $data['alarming_level'] = FALSE;
      $data['last_id'] = $this->product_model->getLastInserted();
      $data['user_name'] = $this->tank_auth->get_username();
      $data['status'] = '';
      $data['company'] = $this->company_model->all();
      $data['product'] = $this->product_model->all();
      $data['catagory'] = $this->category_model->all();
      $data['product_specification'] = $this->product_model->product_specification();
      $data['total_stock_price'] = $this->site_model->total_stock_price();
      $data['total_stock_sale_price'] = $this->site_model->total_stock_sale_price();
      $data['total_stock_quantity'] = $this->site_model->total_stock_quantity();
      $data['product_type'] = $this->product_model->product_type();
      $data['unit_name'] = $this->product_model->unit_name();
      $data['posts']= array();
			$data['reportdata']=$this->report_model->stock_details();
			$data['vuejscomp'] = 'stock_details.js';
			$this->__renderview('Report/stock_details', $data);
		}
		else redirect('Product/product/noaccess');
	}

  public function stock_details_json()
  {
    $catagory_id= $this->input->post('catagory_id');
    $product_id= $this->input->post('product_id');
    $company_id=$this->input->post('company_id');
    $reportdata=$this->report_model->stock_details($catagory_id,$product_id,$company_id);
    echo json_encode($reportdata);
  }

	public function stock_details_print()
	{
		$data['reportdata']=$this->report_model->stock_details();
		$this->__renderviewprint('Prints/report/stock_details', $data);
	}

	public function  purchase_report()
	{
	  $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['distributor_info'] = $this->distributor_model->all();
			$data['company'] = $this->company_model->all();
			$data['catagory'] = $this->category_model->all();
			$data['product_type'] = $this->product_model->product_type();
			$data['receipt_status'] = $this->product_model->receipt_status();
			$data['purchase_receipt'] = $this->purchase_model->all();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'all_purchase_report_new.js';
			$this->__renderview('Report/all_purchase_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function  all_purchase_report_find()
	{
		$receipt_id= $this->input->post('receipt_id');
		$product_id= $this->input->post('product_id');
		$catagory_name= $this->input->post('catagory_id');
		$company_name=$this->input->post('company_id');
		$distributor_id=$this->input->post('distributor_id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$category1 = rawurldecode($catagory_name);
		$company1 = rawurldecode($company_name);
		$temp1 = $this->report_model->get_purchase_info_by_multi($receipt_id,$product_id,$distributor_id,$start_date,$end_date,$category1,$company1);
		echo json_encode($temp1->result());
	}

	public function download_data_purchase()
	{	
		$receipt = $this->uri->segment(3);
		$product = $this->uri->segment(4);
		$category = $this->uri->segment(5);
		$company = $this->uri->segment(6);
		$distributor_id = $this->uri->segment(7);
		$start_date = $this->uri->segment(8);
		$end_date = $this->uri->segment(9);
		$data['purchase_data'] = $this->report_model->get_purchase_info_by_multi($receipt,$product,$distributor_id,$start_date,$end_date,$category,$company);
		$this->__renderviewprint('Prints/accountreport/purchase_print',$data); 
	}

	public function sale_report()
	{
	    $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['customer_name'] = $this->customer_model->all();
			$data['product_info'] = $this->product_model->all();
			$data['product_specification'] = $this->product_model->product_specification();
			$data['product_type'] = $this->product_model->product_type();
			$data['seller'] = $this->login_model->alluser();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'all_sale_report_new.js';
			$this->__renderview('Report/all_sale_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function all_sale_report_find()
	{
		$invoice_id= $this->input->post('invoice_id');
		$customer_id= $this->input->post('customer_id');
		$product_id= $this->input->post('product_id');
		$seller_id=$this->input->post('id');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$temp2 = $this->report_model->get_sale_info_by_multi($invoice_id,$customer_id,$product_id,$seller_id,$start_date,$end_date);
		echo json_encode($temp2);
	}

	public function download_data_sale($value='')
	{
		$invoice_id = $this->uri->segment(3);
		$customer_id = $this->uri->segment(4);
		$product_id = $this->uri->segment(5);
		$seller_id = $this->uri->segment(6);
		$start_date = $this->uri->segment(7);
		$end_date = $this->uri->segment(8);
		$data['data'] = $this->report_model->get_sale_info_by_multi($invoice_id,$customer_id,$product_id,$seller_id,$start_date,$end_date);
		$this->__renderviewprint('Prints/report/sale_print', $data);
	}

	public function installment_report($value='')
	{
		$data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['product_specification'] = $this->product_model->product_specification();
			$data['vuejscomp'] = 'installment_report.js';
			$this->__renderview('Report/installment_report', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function installment_report_response()
	{
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$temp2 = $this->report_model->installment_report_response($start_date,$end_date);
		echo json_encode($temp2);
	}

    public function deleteinstallment($id='')
    {
        $this->db->set('status',0);
        $this->db->where('all_installment_id', $id);
        $this->db->update('all_installment');
        return redirect('report/installment_report','refresh');
    }

	public function installment_report_print($value='')
	{	
		$start_date= $this->uri->segment(3);
		$end_date=$this->uri->segment(4);
		$data['temp2'] = $this->report_model->installment_report_response($start_date,$end_date);
		$this->__renderviewprint('Prints/report/installment_report', $data);
	}

	public function overdueinstallment()
	{
		$date=date("Y-m-d");
		$result=$this->report_model->overdueinstallment($date);
		echo json_encode($result);
	}

  public function customer_sale_report()
  {
    $data['user_type'] = $this->tank_auth->get_usertype();
    if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
    {
      $bd_date = date('Y-m-d');
      $data['bd_date'] = $bd_date;
      $data['sale_status'] = '';
      $data['alarming_level'] = FALSE;
      $data['last_id'] = $this->product_model->getLastInserted();
      $data['user_name'] = $this->tank_auth->get_username();
      $data['status'] = '';
      $data['product_specification'] = $this->product_model->product_specification();
      $data['vuejscomp'] = 'customer_report.js';
      $data['customer']=$this->customer_model->all();
      $this->__renderview('Report/customer_sale_report', $data);
    }
  }

  public function customer_report_response()
  {
    $customer_id=$this->input->post('customer_id');
    $temp2 = $this->report_model->customer_report_response($customer_id);
    echo json_encode($temp2);
  }

  public function income_report()
  {
    $data['user_type'] = $this->tank_auth->get_usertype();
    if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
    {
      $bd_date = date('Y-m-d');
      $data['bd_date'] = $bd_date;
      $data['sale_status'] = '';
      $data['alarming_level'] = FALSE;
      $data['last_id'] = $this->product_model->getLastInserted();
      $data['user_name'] = $this->tank_auth->get_username();
      $data['status'] = '';
      $data['product_specification'] = $this->product_model->product_specification();
      $data['vuejscomp'] = 'income_report.js';
      $this->__renderview('Report/income_report', $data);
    }
    else redirect('Product/product/noaccess');
  }

  public function income_report_response()
  {
    $start_date=$this->input->post('start_date');
    $end_date=$this->input->post('end_date');
    $temp2 = $this->report_model->income_report_response($start_date,$end_date);
    echo json_encode($temp2);
  }

	













	// old report code not clean yet
	public function scb_report()
	{
		$data['bd_date'] = date ('Y-m-d');
		$bd_date = date ('Y-m-d');
		$data['sale_status'] = '';
	    $data['status'] = '';
	    $data['user_type'] = $this->tank_auth->get_usertype();
	    $data['user_name'] = $this->tank_auth->get_username();
		$start_date = $this->uri->segment(3);
	    $end_date = $this->uri->segment(4);		
	    if(($start_date!=''&& $end_date=='null'))
	    {
			$start_date = $start_date;
			$end_date = $start_date;
	    }
		else if($start_date=='' && $end_date=='')
	    {
			$start_date = $bd_date;
			$end_date = $bd_date;
	    }
		else
		{
			$start_date = $start_date;
			$end_date = $end_date;
		}
		//Stock Report Start//
		$data['opening_stock'] = $this->report_model->stock_status_on_specific_date($start_date,$bd_date);
		$temp_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end_date)) . " +1 day"));
		$pre_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($start_date)) . " -1 day"));
		$data['closing_stock'] = $this->report_model->stock_status_on_specific_date($temp_date,$bd_date);
		$data['payable_receivable_financial_statement'] = $this->report_model->payable_receivable_financial_statement($start_date,$end_date);
		$data['sale_price_info'] = $this->report_model->todays_sale($start_date,$end_date);
		$data['sale_return_info'] = $this-> report_model->sale_return_info($start_date,$end_date);
		$data['purchase_return_info'] = $this->report_model->purchase_return_info($start_date,$end_date);
		$data['from_bank_opening'] = $this->report_model->from_bank_opening($pre_date);
		$data['to_bank_opening'] = $this->report_model->to_bank_opening($pre_date);
		$data['from_owner_opening'] = $this->report_model->from_owner_opening($pre_date);
		$data['to_owner_opening'] = $this->report_model->to_owner_opening($pre_date);
		$data['cash_sale_opening'] = $this->report_model->cash_sale_opening($pre_date);
		$data['cash_delivery_charge_opening'] = $this->report_model->cash_delivery_charge_opening($pre_date);
		$data['cash_credit_collection_opening'] = $this->report_model->cash_credit_collection_opening($pre_date);
		$data['cash_sale_return_opening'] = $this->report_model->cash_sale_return_opening($pre_date);
		$data['cash_purchase_payment_opening'] = $this->report_model->cash_purchase_payment_opening($pre_date);
		$data['cash_expense_payment_opening'] = $this->report_model->cash_expense_payment_opening($pre_date);
		$data['from_bank'] = $this->report_model->from_bank($start_date,$end_date);
		$data['to_bank'] = $this->report_model->to_bank($start_date,$end_date);
		$data['from_owner'] = $this->report_model->from_owner($start_date,$end_date);
		$data['to_owner'] = $this->report_model->to_owner($start_date,$end_date);
		$data['cash_sale'] = $this->report_model->cash_sale($start_date,$end_date);
		$data['cash_delivery_charge'] = $this->report_model->cash_delivery_charge($start_date,$end_date);
		$data['cash_credit_collection'] = $this->report_model->todays_credit_collection_cash($start_date,$end_date);
		$data['cash_sale_return'] = $this->report_model->cash_sale_return($start_date,$end_date);
		$data['cash_purchase_payment'] = $this->report_model->todays_purchase_payment_cash($start_date,$end_date);
		$data['cash_expense_payment'] = $this->report_model->todays_expense_payment_cash($start_date,$end_date);
		//Cash Book Report End//
		
		//Bank Book Report Start//
		$data['from_owner_bank_opening'] = $this->report_model->from_owner_bank_opening($pre_date);
		$data['to_owner_bank_opening'] = $this->report_model->to_owner_bank_opening($pre_date);
		$data['card_sale_opening'] = $this->report_model->cash_sale_opening($pre_date);
		$data['card_delivery_charge_opening'] = $this->report_model->card_delivery_charge_opening($pre_date);
		$data['bank_credit_collection_opening'] = $this->report_model->bank_credit_collection_opening($pre_date);
		$data['bank_sale_return_opening'] = $this->report_model->bank_sale_return_opening($pre_date);
		$data['bank_purchase_payment_opening'] = $this->report_model->bank_purchase_payment_opening($pre_date);
		$data['bank_expense_payment_opening'] = $this->report_model->bank_expense_payment_opening($pre_date);
		$data['from_owner_bank'] = $this->report_model->from_owner_bank($start_date,$end_date);
		$data['to_owner_bank'] = $this->report_model->to_owner_bank($start_date,$end_date);
		$data['card_sale'] = $this->report_model->card_sale($start_date,$end_date);
		$data['card_delivery_charge'] = $this->report_model->card_delivery_charge($start_date,$end_date);
		$data['bank_sale_return'] = $this->report_model->bank_sale_return($start_date,$end_date);
		$data['bank_expense_payment' ] = $this->report_model->todays_expense_payment_bank($start_date,$end_date);
		$data['bank_purchase_payment'] = $this->report_model->todays_purchase_payment_bank($start_date,$end_date);
		$data['bank_credit_collection'] = $this->report_model->todays_credit_collection_bank($start_date,$end_date);
		$data['vuejscomp'] = 'scb_report.js';
	    $this->__renderview('Report/scb_report', $data);
	}

	public function download_scb_report()
	{
		$timezone = "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$this->data['bd_date'] = date ('Y-m-d');
		$bd_date = date ('Y-m-d');
		$data['sale_status'] = '';
	    $data['status'] = '';
	    $data['user_type'] = $this->tank_auth->get_usertype();
	    $data['user_name'] = $this->tank_auth->get_username();
	    
		$start_date = $this->uri->segment(3);
	    $end_date = $this->uri->segment(4);
		
	    if(($start_date!=''&& $end_date=='null'))
	    {
			$start_date = $start_date;
			$end_date = $start_date;
	    }
		else if($start_date=='' && $end_date=='')
	    {
			$start_date = $bd_date;
			$end_date = $bd_date;
	    }
		else
		{
			$start_date = $start_date;
			$end_date = $end_date;
		}
		//Stock Report Start//
		$this->data['opening_stock'] = $this->report_model->stock_status_on_specific_date($start_date,$bd_date);
		$temp_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($end_date)) . " +1 day"));
		$pre_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($start_date)) . " -1 day"));
		$this->data['closing_stock'] = $this->report_model->stock_status_on_specific_date($temp_date,$bd_date);
		$this->data['payable_receivable_financial_statement'] = $this->report_model->payable_receivable_financial_statement($start_date,$end_date);
		$this->data['sale_price_info'] = $this->report_model->todays_sale($start_date,$end_date);
		$this->data['sale_return_info'] = $this-> report_model->sale_return_info($start_date,$end_date);
		$this->data['purchase_return_info'] = $this->report_model->purchase_return_info($start_date,$end_date);
		//Stock Report End//
		
		//Cash Book Report Start//
		$this->data['from_bank_opening'] = $this->report_model->from_bank_opening($pre_date);
		$this->data['to_bank_opening'] = $this->report_model->to_bank_opening($pre_date);
		$this->data['from_owner_opening'] = $this->report_model->from_owner_opening($pre_date);
		$this->data['to_owner_opening'] = $this->report_model->to_owner_opening($pre_date);
		$this->data['cash_sale_opening'] = $this->report_model->cash_sale_opening($pre_date);
		$this->data['cash_delivery_charge_opening'] = $this->report_model->cash_delivery_charge_opening($pre_date);
		$this->data['cash_credit_collection_opening'] = $this->report_model->cash_credit_collection_opening($pre_date);
		$this->data['cash_sale_return_opening'] = $this->report_model->cash_sale_return_opening($pre_date);
		$this->data['cash_purchase_payment_opening'] = $this->report_model->cash_purchase_payment_opening($pre_date);
		$this->data['cash_expense_payment_opening'] = $this->report_model->cash_expense_payment_opening($pre_date);
		
		
		$this->data['from_bank'] = $this->report_model->from_bank($start_date,$end_date);
		$this->data['to_bank'] = $this->report_model->to_bank($start_date,$end_date);
		$this->data['from_owner'] = $this->report_model->from_owner($start_date,$end_date);
		$this->data['to_owner'] = $this->report_model->to_owner($start_date,$end_date);
		$this->data['cash_sale'] = $this->report_model->cash_sale($start_date,$end_date);
		$this->data['cash_delivery_charge'] = $this->report_model->cash_delivery_charge($start_date,$end_date);
		$this->data['cash_credit_collection'] = $this->report_model->todays_credit_collection_cash($start_date,$end_date);
		$this->data['cash_sale_return'] = $this->report_model->cash_sale_return($start_date,$end_date);
		$this->data['cash_purchase_payment'] = $this->report_model->todays_purchase_payment_cash($start_date,$end_date);
		$this->data['cash_expense_payment'] = $this->report_model->todays_expense_payment_cash($start_date,$end_date);
		//Cash Book Report End//
		
		//Bank Book Report Start//
		$this->data['from_owner_bank_opening'] = $this->report_model->from_owner_bank_opening($pre_date);
		$this->data['to_owner_bank_opening'] = $this->report_model->to_owner_bank_opening($pre_date);
		$this->data['card_sale_opening'] = $this->report_model->cash_sale_opening($pre_date);
		$this->data['card_delivery_charge_opening'] = $this->report_model->card_delivery_charge_opening($pre_date);
		$this->data['bank_credit_collection_opening'] = $this->report_model->bank_credit_collection_opening($pre_date);
		$this->data['bank_sale_return_opening'] = $this->report_model->bank_sale_return_opening($pre_date);
		$this->data['bank_purchase_payment_opening'] = $this->report_model->bank_purchase_payment_opening($pre_date);
		$this->data['bank_expense_payment_opening'] = $this->report_model->bank_expense_payment_opening($pre_date);
		
		
		$this->data['from_owner_bank'] = $this->report_model->from_owner_bank($start_date,$end_date);
		$this->data['to_owner_bank'] = $this->report_model->to_owner_bank($start_date,$end_date);
		$this->data['card_sale'] = $this->report_model->card_sale($start_date,$end_date);
		$this->data['card_delivery_charge'] = $this->report_model->card_delivery_charge($start_date,$end_date);
		$this->data['bank_sale_return'] = $this->report_model->bank_sale_return($start_date,$end_date);
		$this->data['bank_expense_payment' ] = $this->report_model->todays_expense_payment_bank($start_date,$end_date);
		$this->data['bank_purchase_payment'] = $this->report_model->todays_purchase_payment_bank($start_date,$end_date);
		$this->data['bank_credit_collection'] = $this->report_model->todays_credit_collection_bank($start_date,$end_date);
		//Bank Book Report End//
		
	    $html=$this->load->view('Download/download_scb_report',$this->data, true); 

		$this->load->library('m_pdf');
		ob_start();
		$this->m_pdf->pdf 	= new mPDF('utf-8', 'A4');
		$this->m_pdf->pdf->SetProtection(array('print'));
		$this->m_pdf->pdf->SetTitle("SCB Report");
		$this->m_pdf->pdf->SetAuthor("Dokani");
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		
		$this->m_pdf->pdf->AddPageByArray(array(
		'orientation' => '',
		'mgl' => '10','mgr' => '10','mgt' => '45','mgb' => '20','mgh' => '10','mgf' => '5',
		//margin left,margin right,margin top,margin bottom,margin header,margin footer
		));
		//$this->m_pdf->pdf->SetColumns(2);
		$this->m_pdf->pdf->WriteHTML($html);
		ob_clean();
		$this->m_pdf->pdf->Output();
		ob_end_flush();
		exit;
	}

	public function  all_warranty_stock_report_find()
	{
		$temp = array();
		$temp = $this->report_model->get_warranty_stock_info_by_multi();
		$temp = $temp->result_array();
		$i=0;
		foreach($temp as $tmp)
		{
			$product_id = $tmp['product_id'];
			$warranty_name = $this->report_model->get_warranty_stock($product_id);
			$temp[$i]['warranty_name'] = $warranty_name->result_array();
			$i++;
		}
		echo json_encode(array("pro_list"=>$temp));
	}

	public function  delivery_charge_report()
	{
	   $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['company_name'] = $this->product_model->company_name();
			$data['catagory_name'] = $this->product_model->catagory_name();
			$data['product_specification'] = $this->product_model->product_specification();
			$this->load->model('product_model');
			$data['product_type'] = $this->product_model->product_type();
			$data['seller'] = $this->product_model->seller();
			
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'delivery_charge_report.js';
			$this->__renderview('Report/delivery_charge_report', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function all_delivery_charge_report_find()
	{
		$temp3 = $this->report_model->get_delivery_charge_info_by_multi();
		echo json_encode($temp3->result());
	}


	public function product_exchange_report_new()
	{
	   $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['purchase_receipt_info'] = $this->product_model->fatch_all_purchase_receipt_id();
			$data['distributor_info'] = $this->product_model->distributor_info();
			$data['company_name'] = $this->product_model->company_name();
			$data['catagory_name'] = $this->product_model->catagory_name();
			$data['distributor_name'] = $this->product_model->distributor_name();
			$data['product_specification'] = $this->product_model->product_specification();
			$this->load->model('product_model');
			$data['product_type'] = $this->product_model->product_type();
			$data['purchase_receipt'] = $this->product_model->purchase_receipt();
			$data['seller'] = $this->product_model->seller();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'product_exchange_report_new.js';
			$this->__renderview('Report/product_exchange_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function  damage_report()
	{
	    $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['purchase_receipt_info'] = $this->product_model->fatch_all_purchase_receipt_id();
			$data['distributor_info'] = $this->product_model->distributor_info();
			$data['company_name'] = $this->product_model->company_name();
			$data['catagory_name'] = $this->product_model->catagory_name();
			$data['distributor_name'] = $this->product_model->distributor_name();
			$data['product_specification'] = $this->product_model->product_specification();
			$this->load->model('product_model');
			$data['product_type'] = $this->product_model->product_type();
			$data['purchase_receipt'] = $this->product_model->purchase_receipt();
			$data['seller'] = $this->product_model->seller();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'all_damage_report_new.js';
			$this->__renderview('Report/all_damage_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function  all_damage_report_find()
	{
		$temp3 = $this->report_model->get_damage_info_by_multi();
		echo json_encode($temp3->result());
	}
	
	public function download_data_damage()
	{
		date_default_timezone_set("Asia/Dhaka");
		$bd_date = date('Y-m-d',time());
			
		$data['download_data_damage'] = $this -> report_model -> print_data_damage();
		$html=$this->load->view('Download/download_data_damage',$data, true); 

		$this->load->library('m_pdf');
		ob_start();
		$this->m_pdf->pdf 	= new mPDF('utf-8', 'A4');
		$this->m_pdf->pdf->SetProtection(array('print'));
		$this->m_pdf->pdf->SetTitle("Damage Report");
		$this->m_pdf->pdf->SetAuthor("Dokani");
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		
		$this->m_pdf->pdf->AddPageByArray(array(
		'orientation' => '',
		'mgl' => '10','mgr' => '10','mgt' => '35','mgb' => '20','mgh' => '10','mgf' => '5',
		//margin left,margin right,margin top,margin bottom,margin header,margin footer
		));
		//$this->m_pdf->pdf->SetColumns(2);
		$this->m_pdf->pdf->WriteHTML($html);
		ob_clean();
		$this->m_pdf->pdf->Output();
		ob_end_flush();
		exit;
	}

	public function  sale_return_report_new()
	{
	   $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['purchase_receipt_info'] = $this->product_model->fatch_all_purchase_receipt_id();
			$data['distributor_info'] = $this->product_model->distributor_info();
			$data['company_name'] = $this->product_model->company_name();
			$data['catagory_name'] = $this->product_model->catagory_name();
			$data['distributor_name'] = $this->product_model->distributor_name();
			$data['product_specification'] = $this->product_model->product_specification();
			$this->load->model('product_model');
			$data['product_type'] = $this->product_model->product_type();
			$data['purchase_receipt'] = $this->product_model->purchase_receipt();
			$data['seller'] = $this->product_model->seller();
			$data['unit_name'] = $this->product_model->unit_name();
			$data['vuejscomp'] = 'all_sale_return_report_new.js';
			$this->__renderview('Report/all_sale_return_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function all_sale_return_report_find()
	{
		$temp3 = $this->report_model->get_return_info_by_multi();
		echo json_encode($temp3->result());
	}

	public function purchase_return_report_new()
	{
		$data['user_type'] = $this->tank_auth->get_usertype();
		$timezone = "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$bd_date = date('Y-m-d');
		$data['bd_date'] = $bd_date;
		$data['alarming_level'] = FALSE;
		$data['user_name'] = $this->tank_auth->get_username();
		$data['status'] = '';
		$data['return_main_product'] = '';
		$data['distributor_info'] = $this->product_model->distributor_info();
		$distributor_id= $this->uri->segment(3);
		$start_date=$this->uri->segment(4);
		$end_date=$this->uri->segment(5);
		if($distributor_id!='' || $start_date!='' || $end_date!='')
		{
			$data['return_main_product'] = $this->report_model->get_purchase_return_info_by_multi($distributor_id,$start_date,$end_date);
			$i=1;
			foreach($data['return_main_product']->result() as $tmp)
			{
				$data['return_warranty_product'][$i] 	= $this->report_model->return_warranty_product($tmp->product_id,$tmp->prmp_id);
				$i++;
			}
		}
		$data['vuejscomp'] = 'all_purchase_return_report_new.js';
		$this->__renderview('Report/all_purchase_return_report_new', $data);
	}

	public function credit_collection_report_new()
	{
	    $data['user_type'] = $this->tank_auth->get_usertype();
		if($this->access_control_model->my_access($data['user_type'], 'Product', 'product_entry'))
		{
			$bd_date = date('Y-m-d');
			$data['bd_date'] = $bd_date;
			$data['sale_status'] = '';
			$data['alarming_level'] = FALSE;
			$data['last_id'] = $this->product_model->getLastInserted();
			$data['user_name'] = $this->tank_auth->get_username();
			$data['status'] = '';
			$data['vuejscomp'] = 'all_credit_collection_report_new.js';
			$this->__renderview('Report/all_credit_collection_report_new', $data);
		}
		else redirect('Product/product/noaccess');
	}

	public function  all_credit_collection_report_find()
	{
		$temp3 = $this->report_model->get_credit_collection_info_by_multi();
		echo json_encode($temp3->result());
	}

	public function download_credit_collection()
	{
		date_default_timezone_set("Asia/Dhaka");
		$bd_date = date('Y-m-d',time());
	    $data['all_credit_collection'] = $this->report_model->all_credit_collection();
		$html=$this->load->view('Download/download_credit_collection',$data, true); 
		$this->load->library('m_pdf');
		ob_start();
		$this->m_pdf->pdf 	= new mPDF('utf-8', 'A4');
		$this->m_pdf->pdf->SetProtection(array('print'));
		$this->m_pdf->pdf->SetTitle("Credit Collection Report");
		$this->m_pdf->pdf->SetAuthor("Dokani");
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		$this->m_pdf->pdf->AddPageByArray(array(
		'orientation' => '',
		'mgl' => '10','mgr' => '10','mgt' => '35','mgb' => '20','mgh' => '10','mgf' => '5',
		));
		$this->m_pdf->pdf->WriteHTML($html);
		ob_clean();
		$this->m_pdf->pdf->Output();
		ob_end_flush();
		exit;
	}
	
	function get_other_expense_details(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data = $this -> report_model -> get_other_expense_details($start_date,$end_date);
		echo json_encode($data->result());
	}
}