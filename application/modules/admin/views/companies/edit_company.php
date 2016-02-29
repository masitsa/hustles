
          <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
            
                    <h2 class="panel-title"><?php echo $title;?></h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url();?>all-companies" class="btn btn-info pull-right">Back to companies</a>
                        </div>
                    </div>
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			$row = $company_array;
			//the company details
			$company_id = $row->company_id;
			$company_name = $row->company_name;
			$company_contact_person_name = $row->company_contact_person_name;
			$company_contact_person_phone1 = $row->company_contact_person_phone1;
			$company_contact_person_phone2 = $row->company_contact_person_phone2;
			$company_contact_person_email1 = $row->company_contact_person_email1;
			$company_contact_person_email2 = $row->company_contact_person_email2;
			$company_description = $row->company_description;
			$company_status = $row->company_status;
            $pricing_rate = $row->pricing_rate;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$company_id = set_value('$row->company_id');
				$company_name = set_value('$row->company_name');
				$company_contact_person_name = set_value('$row->company_contact_person_name');
				$company_contact_person_phone1 = set_value('$row->company_contact_person_phone1');
				$company_contact_person_phone2 = set_value('$row->company_contact_person_phone2');
				$company_contact_person_email1 = set_value('$row->company_contact_person_email1');
				$company_contact_person_email2 = set_value('$row->company_contact_person_email2');
				$company_description = set_value('$row->company_description');
				$company_status = set_value('$row->company_status');
                $pricing_rate = set_value('$row->pricing_rate');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                    	<div class="col-sm-6">
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Company Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="<?php echo $company_name;?>">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Concact Person Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_contact_person_name" placeholder="Concact Person Name" value="<?php echo $company_contact_person_name;?>">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Contact Person Phone 1</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_contact_person_phone1" placeholder="Contact Person Phone 1" value="<?php echo $company_contact_person_phone1;?>">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Contact Person Phone 2</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_contact_person_phone2" placeholder="Contact Person Phone 2" value="<?php echo $company_contact_person_phone2;?>">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-lg-4 control-label">Activate Company?</label>
                                <div class="col-lg-8">
                                    <?php
                                        if($company_status == 1)
                                        {
                                            ?>
                                            <div class="radio">
                                                <label>
                                                    <input id="optionsRadios1" type="radio" checked value="1" name="company_status">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input id="optionsRadios2" type="radio" value="0" name="company_status">
                                                    No
                                                </label>
                                            </div>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="radio">
                                                <label>
                                                    <input id="optionsRadios1" type="radio"  value="1" name="company_status">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input id="optionsRadios2" type="radio" checked value="0" name="company_status">
                                                    No
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                   
                                </div>
                            </div>
                        </div>
                        
                    	<div class="col-sm-6">
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Contact Person email 1</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_contact_person_email1" placeholder="Contact Person email 1" value="<?php echo $company_contact_person_email1;?>">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Contact Person email 2</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="company_contact_person_email2" placeholder="Contact Person email 2" value="<?php echo $company_contact_person_email2;?>">
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Company Description</label>
                                <div class="col-lg-8">
                                	<textarea name="company_description" class="form-control" rows="5" placeholder="Company Description"><?php echo $company_description;?></textarea>
                                </div>
                            </div>
                            <!-- Activate checkbox -->

                            <div class="form-group">
                                <label class="col-lg-4 control-label">Pricing rate?</label>
                                <div class="col-lg-8">
                                    <?php
                                    if($pricing_rate == 1)
                                    {
                                        ?>
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios1" type="radio"  value="2" name="pricing_rate">
                                                Insuarance Rate
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios2" type="radio" checked value="1" name="pricing_rate">
                                                Cash paying Rate
                                            </label>
                                        </div>
                                        <?php

                                    }
                                    else
                                    {
                                        ?>
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios1" type="radio" checked value="2" name="pricing_rate">
                                                Insuarance Rate
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input id="optionsRadios2" type="radio"  value="1" name="pricing_rate">
                                                Cash paying Rate
                                            </label>
                                        </div>
                                        <?php

                                    }
                                    ?>
                                    
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="form-actions center-align">
                        <button class="submit btn btn-primary" type="submit">
                            Edit company
                        </button>
                    </div>
                    <br />
                    <?php echo form_close();?>
                </div>
            </section>