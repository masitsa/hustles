<?php
$result = '';

if($transactions_details->num_rows() > 0)
{
	foreach($transactions_details->result() AS $key)
	{
		$member_invoice_number = $key->member_invoice_number;
		$amount_requested = $key->amount_requested;
		$date_requested = $key->date_requested;
		$member_invoice_status = $key->member_invoice_status;
		
		if($member_invoice_status == 1)
		{
			$status = '<h4 style="background-color: orange;color: #fff;font-size: 11px;font-style: normal;padding: 4px;text-align: center;">Pending</h4>';
		
		}
		else
		{
			$status = '<h4 style="background-color: orange;color: #fff;font-size: 11px;font-style: normal;padding: 4px;text-align: center;">Approved</h4>';
		}
		
	
		$result .='
			    <li >
			          <div class="row">
			            <div class="col-25">'.$member_invoice_number.'</div>
			            <div class="col-25">'.$date_requested.'</div>
			            <div class="col-25">KES. '.$amount_requested.'</div>
			            <div class="col-25">
						'.$status.'	
				     </div>
			          </div>
			        </li>';
	}
}
else
{
	$result .='
		<li class="item-content">
	          <div class="item-inner">
	            No Transaction done
	          </div>
	        </li>
		';

}

echo $result;

?>