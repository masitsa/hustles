 <div class="row">
    <div class="col-lg-12">
          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
			 <div class="row">
		        <div class="row ">
		            <div class="col-lg-10">
		                <!-- post category -->
		                <!-- First Name -->
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Company</label>
		                    <div class="col-lg-8">
		                        <select class="form-control" name="company_id">
                                	<?php
									if($companies->num_rows() > 0)
									{
										foreach($companies->result() as $res)
										{
											$company_id = $res->company_id;
											$company_name = $res->company_name;
											?>
                                            <option value="<?php echo $company_id;?>"><?php echo $company_name;?></option>
                                            <?php
										}
									}
									?>
                                </select>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Title</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_title" class="form-control" placeholder="Advert Title"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Video ID</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_link" class="form-control" placeholder="Video ID"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Amount</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_amount" class="form-control" placeholder="Advert Amount"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Length (Minutes)</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_time" class="form-control" placeholder="Advert Length"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Activate advert?</label>
		                    <div class="col-lg-8">
		                        <input type="radio" name="advert_status"  checked value="1"> Yes
		                        <input type="radio" name="advert_status"  value="0"> No
		                    </div>
		                 </div>
		                <div class="form-actions center-align">
		                    <button class="submit btn btn-success" type="submit">
		                        Add advert
		                    </button>
		                </div>
		              
		            </div>
		        </div>
		      </div>
            <?php echo form_close();?>
		  </div>
    </div>
</div>
