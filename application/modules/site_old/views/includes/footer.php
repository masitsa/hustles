<script type="text/javascript">
    $(document).on("submit","form#book_form",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
           var job_id = $(this).attr('job_id');
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
           
            if(data.result == "success")
            {
                alert('You have successfully booked the meeting.');
                 parent.location ='<?php echo base_url(); ?>job-seeker-dashboard';   
            }
            else
            {
                alert('Sorry, something went wrong all the fields are filled.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });
        $(document).on("submit","form#change_password",function(e)
         {
          e.preventDefault();
          
          var formData = new FormData(this);
          
          $.ajax({
           type:'POST',
           url: $(this).attr('action'),
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(data){
            
           
            if(data.result == "success")
            {
                alert('You have successfully change the password.');
                 parent.location ='<?php echo base_url(); ?>my-account';   
            }
            else
            {
                alert('Sorry, something went wrong all the fields are filled.');
            }
           },
           error: function(xhr, status, error) {
            alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
           
           }
          });
          return false;
         });
</script>

 <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-4">
                    <div class="widget">
                        <div class="widget-content">
                            <img class="logo" src="img/header-logo.png" alt="">
                            <p>2SMALLHUSTLES.COM is a business that revolves around the use of current technologies to build a community encompassing small job holders and small job seekers in the current growing Kenyan economy</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-4">
                    <div class="widget">
                        <h6 class="widget-title">Navigation</h6>

                        <div class="widget-content">
                            <div class="row">
                                <div class="col-xs-6 col-sm-12 col-md-6">
                                    <ul class="footer-links">
                                        <li><a href="">Home</a></li>
                                        <li><a href="">Jobs</a></li>
                                        <li><a href="">Partners</a></li>
                                    </ul>
                                </div>
                                <div class="col-xs-6 col-sm-12 col-md-6">
                                     <ul class="footer-links">
                                    <?php
                                        if($this->session->userdata('job_seeker_login_status'))
                                        {
                                        ?>
                                            <li><a href="<?php echo site_url().'job-seeker-dashboard';?>">Go to Dashboard</a></li>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <li><a href="">Job Seeker Login</a></li>
                                            <?php
                                        }
                                        ?>
                                         <li><a href="<?php echo site_url().'login-provider';?>" target="_blank">Job Provider Login</a></li> 
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-2">
                    <div class="widget">
                        <h6 class="widget-title">Follow Us</h6>

                        <div class="widget-content">
                            <ul class="footer-links">
                                <li><a href="index.html#">Blog</a></li>
                                <li><a href="index.html#">Twitter</a></li>
                                <li><a href="index.html#">Facebook</a></li>
                                <li><a href="index.html#">Youtube</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-2">
                    <div class="widget">
                        <h6 class="widget-title">Quick Links</h6>

                        <div class="widget-content">
                            <ul class="footer-links">
                                <li><a href="<?php echo base_url();?>about/terms">Terms & Conditions</a></li>
                                <li><a href="<?php echo base_url();?>about/policy">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            <div class="container">
                <p>&copy; Copyright 2014 <a href="">HUSTLES</a> | All Rights Reserved | Powered by </p>

                <ul class="footer-social">
                    <li><a href="index.html#" class="fa fa-facebook"></a></li>
                    <li><a href="index.html#" class="fa fa-twitter"></a></li>
                    <li><a href="index.html#" class="fa fa-linkedin"></a></li>
                    <li><a href="index.html#" class="fa fa-google-plus"></a></li>
                    <li><a href="index.html#" class="fa fa-pinterest"></a></li>
                    <li><a href="index.html#" class="fa fa-dribbble"></a></li>
                </ul>
            </div>
        </div>
    </footer> <!-- end #footer -->