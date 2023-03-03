<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add item details</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	@media print { .invoice-text { display: none; } }
	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div align="center" class="invoice-text">
<h1>Add Your Items</h1>
<label><span>Name :</span></label> <input type="text" id="pname"></br></br>
<label><span>Quantity: </span></label><input type="text" id="quantity"></br></br>
<label><span>Unit Price($): </span></label><input type="text" id="price"></br></br>
<label><span>Tax: </span></label><select name="tax" id="tax">
  <option value="0">0%</option>
  <option value="1">1%</option>
  <option value="5">5%</option>
  <option value="10">10%</option>
</select></br></br>
<input type="submit" value="Add Item" onclick="add_item()";></br></br>
<button onclick="window.print()";>Genereate Invoice</button>
</div>


<div align="center" id="item_details" >
	
	<table>
		<tbody>
			<th>Name</th>
			<th>Quantity</th>
			<th>Unit Price</th>
			<th>Tax</th>
			<th>Total</th>
			<?php foreach($datavalue as $key=>$value):?>
				<?php 
				if($key=='items'){ ?>
				<tr>
				<?php foreach($value as $items):?>
					<tr>
					<?php foreach($items as $item):?>
					<td><?php print_r ($item); ?>
					<?php endforeach;?></tr>
					<?php endforeach;?>
				</tr>
				<?php }  
				 if($key=='subtotal') { ?>

<tr><td colspan='4'>Subtotal without tax</td><td> <?php print_r($value);?></td></tr>
				<?php } 
				 if($key=='subtotaltax') { ?>
				 <tr class="invoice-text"><td>Apply Discount:</td><td>
				 <select name="tax" id="percentage">
  <option value="0">percentage</option>
  <option value="1">amount</option>
  
</select></td>
<td><input type="text" id="disvalue"></td><td><button onclick="applydiscount()">apply</button></td></tr>
<tr><td colspan='4'>Subtotal with tax</td><td> <input type= "text" value=<?php print_r($value);?> id="dis"></td></tr>
				<?php } ?>
				
					<?php endforeach;?>
</tbody>
	
</table>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
function add_item()
{
	var pname= $('#pname').val();
	var quantity=$('#quantity').val();
	var price =$('#price').val();
	var tax =$('#tax').val();

	if(pname =="")
	{
	alert("Please enter the Product name.");
	return false;
	}
	if(quantity =="")
	{
		alert("Please enter the quantity.");
	return false;
	}
	if(!$.isNumeric(quantity))
	{
		alert("Please enter a valid quantity.");
	return false;
	}
	if(price =="")
	{
		alert("Please enter the price.");
	return false;
	}
	if(!$.isNumeric(price))
	{
		alert("Please enter a valid quantity.");
	return false;
	}

	$.ajax({
			 url : '<?php echo base_url();?>index.php/index/additemprocess',
			type : 'POST',
			data : {
			'pname' : pname,'quantity' : quantity,'price': price,'tax' :tax 
			},
    
    success : function(data) {              
        //alert(data);
		if(data==1)
		{
			alert("Please fill all the fields");
		return false;
		}
		else{
			//alert(data);
			$('#item_details').show();
			$('#item_details').append(data);
			return true;
		}
    },
    /*error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }*/
		});

}
function applydiscount()
{
	var percentage=$('#percentage').val();
	var dis=$('#dis').val();
	var disvalue=$('#disvalue').val();
	var dvalue=dis;
	if(percentage==0)
	{
		 dvalue=dis-(dis*(disvalue/100));
	}
	else
	{
		dvalue=dis-disvalue;
	}
	$('#dis').val(dvalue);
}
</script>