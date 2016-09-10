         
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
            <!-- Ambassadeur Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur First Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_fname" placeholder="Ambassadeur First Name" value="<?php echo set_value('ambassadeur_fname');?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Other Names</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_onames" placeholder="Ambassadeur Other Names" value="<?php echo set_value('ambassadeur_onames');?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Email</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_email" placeholder="Ambassadeur Email" value="<?php echo set_value('ambassadeur_email');?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Ambassadeur Phone</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="ambassadeur_phone" placeholder="Ambassadeur Phone" value="<?php echo set_value('ambassadeur_phone');?>" required>
                </div>
            </div>
            <!-- Ambassadeur Preffix -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Referral Code</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="referral_code" placeholder="Referral Code" value="<?php echo set_value('referral_code');?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Ambassadeur?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" checked value="1" name="ambassadeur_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" value="0" name="ambassadeur_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add Ambassadeur
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>