<div class="sessionTokens">
<h2><?php  echo __('Reports');?></h2>

<form name="report_date" id="report_date" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
Start Date: <input type="text" name="report_start_date" id="report_start_date" class="report-date-picker"> End Date: <input type="text" name="report_end_date" id="report_end_date" class="report-date-picker">
<button id="report_form_submit" class="generate_report_button">Generate</button>
<span id="report_error" style="display:none;">Please input Start Date and End Date before generating reports </span>
</form>

<br /><br />


	<?php if(!empty($posted_date)): //To display when date is posted/submitted. ?>
	<h2>Overall Reporting</h2> 

	<h3>Total Number of Subscribers</h3>
	<p><?php echo $total_subscribers; ?></p>

	<h3>Total Number of Active Subscribers</h3>
	<p><?php echo $active_subscribers; ?></p>

	<h3>Total Number of Inactive Subscribers</h3>
	<!--<p><?php //echo $inactive_subscribers; ?></p>-->

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - <?php echo $inactive_subscribers_below_seven; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - <?php echo $inactive_subscribers_beyond_seven; ?></p>
	<br />
	<a href="<?php echo $_SERVER['REQUEST_URI'];?>/overallReportPdf/<?php echo $today.'/'.$last_week; ?>" class="pdf-button" >Download Overall Reporting PDF</a>
	<br /><br /><br />

	<h2>Subscriber Growth</h2>

	<h3>Total Weekly new subscribers</h3>
	<p><?php echo $weekly_new_subscribers; ?></p>

	<h3>Total Weekly New Number Subscription</h3>
	<!--<p><?php //echo $weekly_new_number_subscription; ?></p>-->

	<p class="report-text-indent">By Daily Basic - <?php echo (!empty($weekly_new_number_subscription_by_daily_basic))? $weekly_new_number_subscription_by_daily_basic : 0; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo (!empty($weekly_new_number_subscription_by_daily_premium))? $weekly_new_number_subscription_by_daily_premium : 0; ?></p>

	<p class="report-text-indent">By Weekly Basic - <?php echo (!empty($weekly_new_number_subscription_by_weekly_basic))? $weekly_new_number_subscription_by_weekly_basic : 0; ?></p>

	<p class="report-text-indent">By Weekly Premium - <?php echo (!empty($weekly_new_number_subscription_by_weekly_premium))? $weekly_new_number_subscription_by_weekly_premium : 0; ?></p>

	<br />
	<a href="<?php echo $_SERVER['REQUEST_URI'];?>/subscriberGrowth/<?php echo $today.'/'.$last_week; ?>" class="pdf-button" >Download Subscriber Growth PDF</a>
	<br /><br /><br />

	<h2>Subscriptions</h2>
	

	<h3>Total Weekly Active Subscriptions</h3>
	<!-- <p><?php //echo $weekly_subscriptions_active; ?></p> -->

	<p class="report-text-indent">By Daily Basic - <?php echo $weekly_subscriptions_active_daily_basic; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo $weekly_subscriptions_active_daily_premium; ?></p>

	<p class="report-text-indent">By Weekly Basic - <?php echo $weekly_subscriptions_active_weekly_basic; ?></p>

	<p class="report-text-indent">By Weekly Premium - <?php echo $weekly_subscriptions_active_weekly_premium; ?></p>

	<h3>Total Weekly Renewal</h3>
	<!-- <p><?php //echo $weekly_total_renewal; ?></p>-->

	<p class="report-text-indent">By Daily Basic - <?php echo $weekly_total_renewal_daily_basic; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo $weekly_total_renewal_daily_premium; ?></p>

	<p class="report-text-indent">By Weekly Basic - <?php echo $weekly_total_renewal_weekly_basic; ?></p>

	<p class="report-text-indent">By Weekly Premium - <?php echo $weekly_total_renewal_weekly_premium; ?></p>

	<h3>Total Number of Inactive Subscribers</h3>
	<!--<p><?php //echo $inactive_subscribers; ?></p>-->

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - <?php echo $inactive_subscribers_below_seven; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - <?php echo $inactive_subscribers_beyond_seven; ?></p>


	<br />
	<a href="<?php echo $_SERVER['REQUEST_URI'];?>/subscriptionsPdf/<?php echo $today.'/'.$last_week; ?>" class="pdf-button" >Download Subscriptions PDF</a>
	<br /><br /><br />

	<?php endif; //To display when date is posted/submitted. ?>


	<!-- <h3>Total Weekly Unique Users</h3>
	<p><?php //echo $weekly_unique_users; ?></p> -->
</div>


<script>
$(document).ready(function(){
  $("#report_start_date").datepicker();
  $("#report_end_date").datepicker();

  $("#report_form_submit").click(function(e){
	e.preventDefault();
	if( $("#report_start_date").val() == ""){
		$("#report_error").show();
		return false;
	}

	if( $("#report_end_date").val() == ""){
		$("#report_error").show();
		return false;
	}

	$("#report_date").submit();
	
  });
});
</script>
