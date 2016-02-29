<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="'.site_url().'all-companies/company_name/'.$order_method.'/'.$page.'">Company name</a></th>
						<th><a href="'.site_url().'all-companies/company_contact_person_name/'.$order_method.'/'.$page.'">Contact person</a></th>
						<th><a href="'.site_url().'all-companies/company_contact_person_phone1/'.$order_method.'/'.$page.'">Primary phone</a></th>
						<th><a href="'.site_url().'all-companies/company_contact_person_email1/'.$order_method.'/'.$page.'">Primary email</a></th>
						<th><a href="'.site_url().'all-companies/last_modified/'.$order_method.'/'.$page.'">Last modified</a></th>
						<th><a href="'.site_url().'all-companies/modified_by/'.$order_method.'/'.$page.'">Modified by</a></th>
						<th><a href="'.site_url().'all-companies/company_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			//get all administrators
			$administrators = $this->users_model->get_all_administrators();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$company_id = $row->company_id;
				$company_name = $row->company_name;
				$company_contact_person_name = $row->company_contact_person_name;
				$company_contact_person_phone1 = $row->company_contact_person_phone1;
				$company_contact_person_phone2 = $row->company_contact_person_phone2;
				$company_contact_person_email1 = $row->company_contact_person_email1;
				$company_contact_person_email2 = $row->company_contact_person_email2;
				$company_description = $row->company_description;
				$company_status = $row->company_status;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				
				//create deactivated status display
				if($company_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-company/'.$company_id.'" onclick="return confirm(\'Do you want to activate '.$company_name.'?\');" title="Activate '.$company_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($company_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-company/'.$company_id.'" onclick="return confirm(\'Do you want to deactivate '.$company_name.'?\');" title="Deactivate '.$company_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				
				//creators & editors
				if($admins != NULL)
				{
					foreach($admins as $adm)
					{
						$user_id = $adm->user_id;
						
						if($user_id == $created_by)
						{
							$created_by = $adm->personnel_fname;
						}
						
						if($user_id == $modified_by)
						{
							$modified_by = $adm->personnel_fname;
						}
					}
				}
				
				else
				{
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$company_name.'</td>
						<td>'.$company_contact_person_name.'</td>
						<td>'.$company_contact_person_phone1.'</td>
						<td>'.$company_contact_person_email1.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->last_modified)).'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-company/'.$company_id.'" class="btn btn-sm btn-success" title="Edit '.$company_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-company/'.$company_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$company_name.'?\');" title="Delete '.$company_name.'"><i class="fa fa-trash"></i></a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no companies";
		}
?>

<div class="padd">
	<div class="row" style="margin-bottom:20px;">
        <div class="col-lg-12">
        	<a href="<?php echo site_url();?>add-company" class="btn btn-success pull-right btn-sm">Add Company</a>
        </div>
    </div>
    <?php
	$error = $this->session->userdata('error_message');
	$success = $this->session->userdata('success_message');
	
	if(!empty($success))
	{
		echo '
			<div class="alert alert-success">'.$success.'</div>
		';
		$this->session->unset_userdata('success_message');
	}
	
	if(!empty($error))
	{
		echo '
			<div class="alert alert-danger">'.$error.'</div>
		';
		$this->session->unset_userdata('error_message');
	}
	?>
	<div class="table-responsive">
    	
		<?php echo $result;?>

    </div>
</div>
