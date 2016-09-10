          <link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			
			//the ambassadeur details
			$ambassadeur_id = $ambassadeur[0]->ambassadeur_id;
			$ambassadeur_fname = $ambassadeur[0]->ambassadeur_fname;
			$ambassadeur_onames = $ambassadeur[0]->ambassadeur_onames;
			$ambassadeur_status = $ambassadeur[0]->ambassadeur_status;
			$ambassadeur_phone = $ambassadeur[0]->ambassadeur_phone;
			$ambassadeur_email = $ambassadeur[0]->ambassadeur_email;
			$referral_code = $ambassadeur[0]->referral_code;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$ambassadeur_id = set_value('ambassadeur_id');
				$ambassadeur_fname = set_value('ambassadeur_fname');
				$ambassadeur_onames = set_value('ambassadeur_onames');
				$ambassadeur_status = set_value('ambassadeur_status');
				$ambassadeur_phone = set_value('ambassadeur_phone');
				$ambassadeur_email = set_value('ambassadeur_email');
				$referral_code = set_value('referral_code');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- Ambassadeur Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur First Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_fname" placeholder="Ambassadeur First Name" value="<?php echo $ambassadeur_fname;?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Other Names</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_onames" placeholder="Ambassadeur Other Names" value="<?php echo $ambassadeur_onames;?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Email</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_email" placeholder="Ambassadeur Email" value="<?php echo $ambassadeur_email;?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Phone</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_phone" placeholder="Ambassadeur Phone" value="<?php echo $ambassadeur_phone;?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Referral Code</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="referral_code" placeholder="Referral Code" value="<?php echo $referral_code;?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Ambassadeur?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                        	<?php
                            if($ambassadeur_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="ambassadeur_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="1" name="ambassadeur_status">';}
							?>
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<?php
                            if($ambassadeur_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="ambassadeur_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="0" name="ambassadeur_status">';}
							?>
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit Ambassadeur
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>