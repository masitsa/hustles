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
            <?php
			 if($advert->num_rows() > 0)
            {
                foreach ($advert->result() as $key) {
                    # code...

                    $advert_id = $key->advert_id;
                    $advert_link = $key->advert_link;
                    $advert_status = $key->advert_status;
                    $company_id = $key->company_id;
                    $advert_amount = $key->advert_amount;
                    $advert_time = $key->advert_time/3600;
                    $advert_title = $key->advert_title;
                    $created = $key->created;
                ?>
                <div class="row">
                    <div class="row ">
                        <div class="col-lg-10">
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Company</label>
		                    <div class="col-lg-8">
		                        <select class="form-control" name="company_id">
                                	<?php
									if($companies->num_rows() > 0)
									{
										foreach($companies->result() as $res)
										{
											$company_id_db = $res->company_id;
											$company_name = $res->company_name;
											
											if($company_id == $company_id_db)
											{
											?>
                                            <option value="<?php echo $company_id_db;?>" selected="selected"><?php echo $company_name;?></option>
                                            <?php
											}
											
											else
											{
											?>
                                            <option value="<?php echo $company_id_db;?>"><?php echo $company_name;?></option>
                                            <?php
											}
										}
									}
									?>
                                </select>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Title</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_title" class="form-control" placeholder="Advert Title" value="<?php echo $advert_title;?>"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Video ID</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_link" class="form-control" placeholder="Video ID" value="<?php echo $advert_link;?>"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Amount</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_amount" class="form-control" placeholder="Advert Amount" value="<?php echo $advert_amount;?>"/>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-lg-4 control-label">Advert Length (Minutes)</label>
		                    <div class="col-lg-8">
		                        <input type="text" name="advert_time" class="form-control" placeholder="Advert Length" value="<?php echo $advert_time;?>"/>
		                    </div>
		                </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Activate Advert?</label>
                                <div class="col-lg-8">

                                    <div class="radio">
                                        <label>
                                            <?php
                                            if($advert_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="advert_status">';}
                                            else{echo '<input id="optionsRadios1" type="radio" value="1" name="advert_status">';}
                                            ?>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <?php
                                            if($advert_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="advert_status">';}
                                            else{echo '<input id="optionsRadios1" type="radio" value="0" name="advert_status">';}
                                            ?>
                                            No
                                        </label>
                                    </div>
                                </div>
                             </div>
                            <div class="form-actions center-align">
                                <button class="submit btn btn-success" type="submit">
                                   Update recorded video

                                </button>
                            </div>
                          
                        </div>
                        <div class="col-lg-6">
                            <!-- post category -->
                            <!-- First Name -->
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <iframe width="100%" height="315" src="http://www.youtube.com/embed/<?php echo $advert_link;?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                <?php

            	}
            }
            else
            {
            }
            ?>
             <?php echo form_close();?>
		  </div>
    </div>
</div>
