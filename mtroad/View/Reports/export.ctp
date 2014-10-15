<div class="sessionTokens">
<h2><?php  echo __('Reports');?></h2>

	<h1><?php echo $last_week;?> to <?php echo $today;?></h1>

<br /><br />


	<h2>Overall Reporting</h2> 

	<h3>Total Number of Subscribers</h3>
	<p><?php echo $total_subscribers; ?></p>
	<p><?php echo $total_subscribers_string; ?></p>

	<h3>Total Number of Active Subscribers</h3>
	<p><?php echo $active_subscribers; ?></p>
	<p><?php echo $active_subscribers_string; ?></p>

	<h3>Total Number of Inactive Subscribers test</h3>
	<p><?php echo $total_inactive_subscribers; ?></p>
	<p><?php echo $total_inactive_subscribers_string; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - <?php echo $inactive_subscribers_below_seven; ?></p>
	<p><?php echo $inactive_subscribers_below_seven_string; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - <?php echo $inactive_subscribers_beyond_seven; ?></p>
	<p><?php echo $inactive_subscribers_beyond_seven_string; ?></p>
	<br /><br /><br />

	<h2>Subscriber Growth (supply daily and weekly reports)</h2>
	
	<h3>Total number of new registration</h3>
	<p><?php echo $weekly_new_registration; ?></p>
	<p><?php echo $weekly_new_registration_string; ?></p>

	<h3>Total number of new subscriptions</h3>
	<p><?php echo $weekly_new_subscribers; ?></p>
	<p><?php echo $weekly_new_subscribers_string; ?></p>

	<h3>Total Weekly New Number Subscription</h3>
	<!--<p><?php //echo $weekly_new_number_subscription; ?></p>-->

	<p class="report-text-indent">By Daily Basic - <?php echo (!empty($weekly_new_number_subscription_by_daily_basic))? $weekly_new_number_subscription_by_daily_basic : 0; ?></p>
	<p><?php echo $weekly_new_number_subscription_by_daily_basic_string; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo (!empty($weekly_new_number_subscription_by_daily_premium))? $weekly_new_number_subscription_by_daily_premium : 0; ?></p>
	<p><?php echo $weekly_new_number_subscription_by_daily_premium_string; ?></p>
	
	<p class="report-text-indent">By Weekly Basic - <?php echo (!empty($weekly_new_number_subscription_by_weekly_basic))? $weekly_new_number_subscription_by_weekly_basic : 0; ?></p>
	<p><?php echo $weekly_new_number_subscription_by_weekly_basic_string; ?></p>
	
	<p class="report-text-indent">By Weekly Premium - <?php echo (!empty($weekly_new_number_subscription_by_weekly_premium))? $weekly_new_number_subscription_by_weekly_premium : 0; ?></p>
	<p><?php echo $weekly_new_number_subscription_by_weekly_premium_string; ?></p>
	
	<br /><br /><br />

	<h2>Subscriptions (supply daily and weekly reports)</h2>
	

	<h3>Total number of active subscriptions</h3>
	<!-- <p><?php //echo $weekly_subscriptions_active; ?></p> -->

	<p class="report-text-indent">By Daily Basic - <?php echo $weekly_subscriptions_active_daily_basic; ?></p>
	<p><?php echo $weekly_subscriptions_active_daily_basic_string; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo $weekly_subscriptions_active_daily_premium; ?></p>
	<p><?php echo $weekly_subscriptions_active_daily_premium_string; ?></p>

	<p class="report-text-indent">By Weekly Basic - <?php echo $weekly_subscriptions_active_weekly_basic; ?></p>
	<p><?php echo $weekly_subscriptions_active_weekly_basic_string; ?></p>

	<p class="report-text-indent">By Weekly Premium - <?php echo $weekly_subscriptions_active_weekly_premium; ?></p>
	<p><?php echo $weekly_subscriptions_active_weekly_premium_string; ?></p>

	<h3>Total number of renewals</h3>
	<!-- <p><?php //echo $weekly_total_renewal; ?></p>-->

	<p class="report-text-indent">By Daily Basic - <?php echo $weekly_total_renewal_daily_basic; ?></p>
	<p><?php echo $weekly_total_renewal_daily_basic_string; ?></p>

	<p class="report-text-indent">By Daily Premium - <?php echo $weekly_total_renewal_daily_premium; ?></p>
	<p><?php echo $weekly_total_renewal_daily_premium_string; ?></p>

	<p class="report-text-indent">By Weekly Basic - <?php echo $weekly_total_renewal_weekly_basic; ?></p>
	<p><?php echo $weekly_total_renewal_weekly_basic_string; ?></p>

	<p class="report-text-indent">By Weekly Premium - <?php echo $weekly_total_renewal_weekly_premium; ?></p>
	<p><?php echo $weekly_total_renewal_weekly_premium_string; ?></p>
<!--
	<h3>Total Number of Inactive Subscribers</h3>
	<p><?php //echo $inactive_subscribers; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired below 7 days - <?php echo $inactive_subscribers_below_seven; ?></p>

	<p class="report-text-indent">Inactive Subscribers - expired beyond 7 days - <?php echo $inactive_subscribers_beyond_seven; ?></p>

-->
	<br /><br /><br />



	<!-- <h3>Total Weekly Unique Users</h3>
	<p><?php //echo $weekly_unique_users; ?></p> -->
</div>


