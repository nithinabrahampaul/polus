<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	  public function __construct()
	{
	/*call CodeIgniter's default Constructor*/
	parent::__construct();
	
	/*load database libray manually*/
	$this->load->database();
	$this->load->helper('url');
	
	}
	
	public function index()
	{
		$data=array();
		$this->db->select("pname,quantity,unit_price,tax" );
	$this->db->from('item_details');
	$query = $this->db->get();
	$row=$query->result();
	$datavalue=null;
    if ( $query->num_rows() > 0 )
    {
		
		$subtotal=0;
		$subtotaltax=0;
	foreach ($row as $roww){
		$total=$roww->unit_price*$roww->quantity;
		$linetotal=$total+($total*($roww->tax/100));
		$subtotal=$subtotal+$total;
		$subtotaltax=$subtotaltax+$linetotal;
		array_push($data,array('name' => $roww->pname,
		"quantity"=> $roww->quantity,'unitprice' => $roww->unit_price, "tax" => $roww->tax,
					"linetotal"=>$linetotal));
		/*$str.="Name: .$roww->pname.</br>"; 
   $str.="Line Total:".$linetotal."</br>";
    $str."Sub Total:.$roww->unit_price.</br>";*/

}

 $datavalue['datavalue']=array("items"=>$data,"subtotal"=>$subtotal,"subtotaltax"=>$subtotaltax);
    }
		/*$str.="SubTotal without tax:.$subtotal.</br>";
		$str.="SubTotal with tax:.$subtotaltax.</br>";*/
		
		$this->load->view('index/index',$datavalue);
	}
	
	
	
	function additemprocess()
	{
		$pname=$_POST['pname'];
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];
		$tax=$_POST['tax'];
		if($pname==""||$quantity==""||$price==""||$tax=="")
		{
			echo "1";exit;		
		}
		
		$data=array('pname' => $pname,
					'quantity' => $quantity,
					'unit_price' => $price,
					'tax' =>$tax
					
	);
	$this->db->insert('item_details',$data);
	
	
		echo $str;exit;
	}
}
