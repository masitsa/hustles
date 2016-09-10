<?php	
		$result = '<a href="'.site_url().'add-advert" class="btn btn-success pull-right">Add advert</a>';
		$success = $this->session->userdata('success_message');
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		
		//if advert exist display them
		if ($advert->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Advert title</th>
					  <th>Date Created</th>
					  <th>Status</th>
					  <th colspan="6">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			foreach ($advert->result() as $row)
			{
				$advert_id = $row->advert_id;
				$advert_title = $row->advert_title;
				$advert_web_name = $this->site_model->create_web_name($advert_title);
				//create deadvert_status status display
				if($row->advert_status == 0)
				{
					$status = '<span class="label label-important">Deactivate</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'admin/advertising/activate_advert/'.$advert_id.'" onclick="return confirm(\'Do you want to activate '.$advert_title.'?\');">Activate</a>';
				}
				//create advert_status status display
				else if($row->advert_status == 1)
				{
					$status = '<span class="label label-primary">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'admin/advertising/deactivate_advert/'.$advert_id.'" onclick="return confirm(\'Do you want to deactivate '.$advert_title.'?\');">Deactivate</a>';
				}
				else if($row->advert_status == 2)
				{
					$status = '<span class="label label-warning">invoiced</span>';
					$button = '<a class="btn btn-warning fa fa-print " href="'.site_url().'admin/advertising/deactivate_advert/'.$advert_id.'" onclick="return confirm(\'Do you want to deactivate '.$advert_title.'?\');">Print</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$row->advert_title.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-advert/'.$advert_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td><a href="'.site_url().'close-advert/'.$advert_id.'" class="btn btn-sm btn-primary" onclick="return confirm(\'Do you really want invoice for '.$advert_title.' advertiment?\');">Close</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-advert/'.$advert_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$advert_title.'?\');">Delete</a></td>
						<td>'.form_open('advert-notification/'.$advert_id).'<input type="hidden" name="advert_title" value="'.$advert_title.'"> <button type="submit" class="btn btn-sm btn-warning" onsubmit="return confirm(\'Do you really want to send notifications for '.$advert_title.'?\');">Notify</button>'.form_close().'</td>
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
			$result .= "There are no advert";
		}
		
		echo $result;
?>