<?php
	$completed_jobs = $this->reports_model->get_completed_jobs();
	$total_payments = number_format($this->reports_model->get_total_payments(), 0, '.', ',');
    $amount_paid = 0.01 * $total_payments;
    $total_payments = $total_payments - $amount_paid;
    $total_jobs = number_format($this->reports_model->get_total_jobs(), 0, '.', ',');


    $job_providers = $this->reports_model->get_job_providers();
    $job_seekers = $this->reports_model->get_job_seekers();
    $active_job_seekers = $this->reports_model->get_active_job_seekers();
    $active_job_providers = $this->reports_model->get_active_job_providers();
    $non_activated_members = $this->reports_model->get_non_active_job_providers();
    $non_activated_seekers = $this->reports_model->get_non_active_job_seekers();
    $deactivated_seekers = $this->reports_model->get_diactivated_job_seekers();

    $job_distribution = ($total_jobs/$job_providers) *100;

?>
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-title">
                    <h3>Hustles</h3>
                    <span>
					<?php 
					//salutation
					if(date('a') == 'am')
					{
						echo 'Good morning, ';
					}
					
					else if((date('H') >= 12) && (date('H') < 17))
					{
						echo 'Good afternoon, ';
					}
					
					else
					{
						echo 'Good evening, ';
					}
					echo $this->session->userdata('first_name');
					?>
                    </span>
                </div>
                <ul class="page-stats">
                    <li>
                        <div class="summary">
                            <span>Total Jobs</span>
                            <h3><?php echo $total_jobs;?></h3>
                        </div>
                        <span id="sparklines1"></span>
                    </li>
                    <li>
                        <div class="summary">
                            <span>Completed Jobs</span>
                            <h3><?php echo $completed_jobs;?></h3>
                        </div>
                        <span id="sparklines1"></span>
                    </li>
                    <li>
                        <div class="summary">
                            <span>Total Payments</span>
                            <h3>KES <?php echo $total_payments;?></h3>
                        </div>
                        <span id="sparklines2"></span>
                    </li>
                    <li>
                        <div class="summary">
                            <span>Total Profits 10%</span>
                            <h3>KES <?php echo $amount_paid;?></h3>
                        </div>
                        <span id="sparklines2"></span>
                    </li>
                </ul>
            </div>
            <!-- Page header ends -->

                <div class="row statistics">
                  <div class="col-md-6 col-sm-6">
                        <h4>Job Providers Summary</h4>
                       <table class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Item Title</th>
                                    <th>Counters.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>No. of Registrants</th>
                                    <td><?php echo $job_providers;?></td>
                                </tr>
                                <tr>
                                    <th>Active Job Providers</th>
                                    <td><?php echo $active_job_providers;?></td>
                                </tr>
                                <tr>
                                    <th>Pending Accounts</th>
                                    <td><?php echo $non_activated_members;?></td>
                                </tr>
                                <tr>
                                    <th>Job Rate Distribution</th>
                                    <td><?php echo $job_distribution;?>%</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
              <div class="col-md-6 col-sm-6">
                 <h4>Job Seekers Summary</h4>
                 <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Item Title</th>
                                <th>Counters</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Total Job seekers</th>
                                <td><?php echo $job_seekers?></td>
                            </tr>
                            <tr>
                                <th>Active Job Seekers</th>
                                <td><?php echo $active_job_seekers;?></td>
                            </tr>
                            <tr>
                                <th>Pending Accounts</th>
                                <td><?php echo $non_activated_members;?></td>
                            </tr>
                            <tr>
                                <th>Deleted Accounts</th>
                                <td><?php echo $deactivated_seekers;?></td>
                            </tr>
                            
                        </tbody>
                    </table>
              </div>
          </div>
          