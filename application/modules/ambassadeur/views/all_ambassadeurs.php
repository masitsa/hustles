<?php
		
		$result = '<a href="'.site_url().'ambassadeur/add_ambassadeur" class="btn btn-success pull-right">Add Ambassadeur</a>';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>First Name</th>
					  <th>Other Names</th>
					  <th>Email</th>
					  <th>Phone</th>
					  <th>Referral Code</th>
					  <th>Status</th>
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
				$ambassadeur_id = $row->ambassadeur_id;
				$ambassadeur_fname = $row->ambassadeur_fname;
				$ambassadeur_onames = $row->ambassadeur_onames;
				$ambassadeur_status = $row->ambassadeur_status;
				$ambassadeur_phone = $row->ambassadeur_phone;
				$ambassadeur_email = $row->ambassadeur_email;
				$referral_code = $row->referral_code;
				
				//create deactivated status display
				if($ambassadeur_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'ambassadeur/activate_ambassadeur/'.$ambassadeur_id.'" onclick="return confirm(\'Do you want to activate '.$ambassadeur_fname.'?\');">Activate</a>';
				}
				//create activated status display
				else if($ambassadeur_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'ambassadeur/deactivate_ambassadeur/'.$ambassadeur_id.'" onclick="return confirm(\'Do you want to deactivate '.$ambassadeur_fname.'?\');">Deactivate</a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$ambassadeur_fname.'</td>
						<td>'.$ambassadeur_onames.'</td>
						<td>'.$ambassadeur_email.'</td>
						<td>'.$ambassadeur_phone.'</td>
						<td>'.$referral_code.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'ambassadeur/edit_ambassadeur/'.$ambassadeur_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'ambassadeur/delete_ambassadeur/'.$ambassadeur_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$ambassadeur_fname.'?\');">Delete</a></td>
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
			$result .= "There are no ambassadeurs";
		}
		
		echo $result;
?>