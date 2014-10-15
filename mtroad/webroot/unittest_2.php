<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript">
		function get_token() {
			var session_token = document.getElementById("apiUserLogin_iframe").contentWindow.document.documentElement.childNodes[1].innerHTML;
			var inputfields = $("input.session_token_field");
			for (i=0; i<inputfields.length; i++) {
				inputfields[i].value = session_token;
			}
		 }

</script>
</head>
<style>
#cssmenu,
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 0;
  display: block;
  position: relative;
  font-family: Capriola, Helvetica, sans-serif;
}
#cssmenu {
  width: auto;
  height: 59px;
  padding-bottom: 4px;
}
#cssmenu.align-right {
  float: right;
}
#cssmenu.align-right ul li {
  float: right;
  margin-right: 0;
  margin-left: 4px;
}
#cssmenu.align-right ul li:first-child,
#cssmenu.align-right ul li:first-child > a {
  border-bottom-right-radius: 3px;
}
#cssmenu #bg-one,
#cssmenu #bg-two,
#cssmenu #bg-three,
#cssmenu #bg-four {
  position: absolute;
  bottom: 0;
  width: 100%;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
}
#cssmenu #bg-one {
  height: 10px;
  background: #0f71ba;
}
#cssmenu #bg-two {
  height: 59px;
  z-index: 2;
  background: url('images/bg.png');
}
#cssmenu #bg-three {
  bottom: 4px;
  height: 55px;
  z-index: 3;
  background: #222222;
  background: -moz-linear-gradient(top, #555555 0%, #222222 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #555555), color-stop(100%, #222222));
  background: -webkit-linear-gradient(top, #555555 0%, #222222 100%);
  background: -o-linear-gradient(top, #555555 0%, #222222 100%);
  background: -ms-linear-gradient(top, #555555 0%, #222222 100%);
  background: linear-gradient(to bottom, #555555 0%, #222222 100%);
}
#cssmenu #bg-four {
  bottom: 4px;
  height: 55px;
  z-index: 4;
  background: url('images/bg.png');
}
#cssmenu ul {
  height: 59px;
}
#cssmenu ul li {
float: left;
margin-right: 1px;
z-index: 5;
background: #868585;
border-radius: 5px;
}
#cssmenu ul li a {
padding: 20px 26px 16px 26px;
margin-bottom: 4px;
border-top-left-radius: 3px;
border-top-right-radius: 3px;
color: #383434;
font-size: 15px;
text-decoration: none;
}
#cssmenu ul li:first-child,
#cssmenu ul li:first-child > 
a {
  border-bottom-left-radius: 3px;
}
#cssmenu ul li:hover,
#cssmenu ul li.active {
  background: #0f71ba;
  background: -moz-linear-gradient(top, #3fa4f0 0%, #0f71ba 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3fa4f0), color-stop(100%, #0f71ba));
  background: -webkit-linear-gradient(top, #3fa4f0 0%, #0f71ba 100%);
  background: -o-linear-gradient(top, #3fa4f0 0%, #0f71ba 100%);
  background: -ms-linear-gradient(top, #3fa4f0 0%, #0f71ba 100%);
  background: rgb(85, 81, 81);
}
#cssmenu ul li a:hover,
#cssmenu ul li.active > a {
  background: url('images/bg.png');
  color: rgb(221, 221, 221);
}
</style>

<body>               
	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/api_users/login.xml - ApiUser Login <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="apiUserLogin_form" action="/yoonic-cis/api_users/login.xml" method="get" target="apiUserLogin_iframe">
		username <input name="username" type="text" value="yoonic-cis"/><br/>
		password <input name="password" type="text" value="5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"/><br/>
		<input type="submit"/>
		<input type="button" value="Set Session Token" onclick="get_token()">
	</form></td>
	<td><iframe name="apiUserLogin_iframe" id="apiUserLogin_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/api_users/check_session.xml - ApiUser Check Session <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="apiUserLogin_form" action="/yoonic-cis/api_users/check_session.xml" method="get" target="apiUserCheckSession_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="apiUserCheckSession_iframe" id="apiUserCheckSession_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscribers/verify_subscriber.xml - Verify Subscriber <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriberVerify_form" action="/yoonic-cis/subscribers/verify_subscriber.xml" method="get" target="subscriberVerify_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		password <input name="password" type="text"  value="3703"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriberVerify_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscribers/add.xml - Add Subscriber <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriberAdd_form" action="/yoonic-cis/subscribers/add.xml" method="post" target="subscriberAdd_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		mo_id <input name="mo_id" type="text" value=""/><br/>
		name <input name="name" type="text"  value="Tom"/><br/>
		email <input name="email" type="text"  value="tom.crusie@e1.sg"/><br/>
		address <input name="address" type="text"  value="ayer rajah"/><br/>
		postal_code <input name="postal_code" type="text"  value="111234"/><br/>
		incomplete <input name="incomplete" type="text"  value="0"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriberAdd_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscribers/edit.xml - Edit Subscriber <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriberEdit_form" action="/yoonic-cis/subscribers/edit.xml" method="post" target="subscriberEdit_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		id <input name="id" type="text" value="49"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		name <input name="name" type="text"  value="Tom"/><br/>
		email <input name="email" type="text"  value="tom.crusie@e1.sg"/><br/>
		address <input name="address" type="text"  value="ayer rajah"/><br/>
		postal_code <input name="postal_code" type="text"  value="111234"/><br/>
		incomplete <input name="incomplete" type="text"  value="0"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriberEdit_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscribers/reset_password.xml - Subscriber Reset Password <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriberResetPassword_form" action="/yoonic-cis/subscribers/reset_password.xml" method="post" target="subscriberResetPassword_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		msisdn <input name="msisdn" type="text" value="601117777947"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriberResetPassword_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscribers/delete.xml - Delete Subscriber <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriberDelete_form" action="/yoonic-cis/subscribers/delete.xml" method="post" target="subscriberDelete_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		id <input name="id" type="text" value="49"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriberDelete_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/index.xml - List Subscriptions <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionIndex_form" action="/yoonic-cis/subscriptions/index.xml" method="get" target="subscriptionIndex_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="49"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionIndex_iframe" id="subscriptionIndex_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	
	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/get_expired_subscriptions.xml - List Expired Subscriptions <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionGetExpiredSubscriptions_form" action="/yoonic-cis/subscriptions/get_expired_subscriptions.xml" method="get" target="subscriptionGetExpiredSubscriptions_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		limit <input name="limit" type="text" value="50"/>Default is 50<br/>
		expiry_date <input name="expiry_date" type="text" value="<?= date("Y-m-d H:i:s") ?>"/>Optional, Default is Today<br/> 
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionGetExpiredSubscriptions_iframe" id="subscriptionGetExpiredSubscriptions_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/view.xml - View Subscription <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionView_form" action="/yoonic-cis/subscriptions/view.xml" method="get" target="subscriptionView_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/><br/>
		id <input name="id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionView_iframe" id="subscriptionView_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/keyword.xml - Subscription Keyword (PHPGATEWAY to CIS)<b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionKeyword_form" action="/yoonic-cis/subscriptions/keyword.xml" method="post" target="subscriptionKeyword_iframe1">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		mo_id <input name="mo_id" type="text" value="1"/><br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		keyword <input name="keyword" type="text" value="ON BAD"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionKeyword_iframe1" id="subscriptionKeyword_iframe1" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/keyword.xml - Subscription Keyword (MOBILE SERVER to CIS)<b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionKeyword_form" action="/yoonic-cis/subscriptions/keyword.xml" method="post" target="subscriptionKeyword_iframe2">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		keyword <input name="keyword" type="text" value="ON BAD"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionKeyword_iframe2" id="subscriptionKeyword_iframe2" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/reminder.xml - Send Subscription Reminder <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionReminder_form" action="/yoonic-cis/subscriptions/reminder.xml" method="post" target="subscriptionReminder_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/> OR<br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionReminder_iframe" id="subscriptionReminder_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/subscriptions/renew.xml - Renew Subscription <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="subscriptionRenew_form" action="/yoonic-cis/subscriptions/renew.xml" method="post" target="subscriptionRenew_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/> OR<br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="subscriptionRenew_iframe" id="subscriptionRenew_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/consumptions/index.xml - List Consumptions <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="consumptionIndex_form" action="/yoonic-cis/consumptions/index.xml" method="get" target="consumptionIndex_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="consumptionIndex_iframe" id="consumptionIndex_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	<tr><td style="font-weight:bold;">/yoonic-cis/consumptions/record.xml - Record Consumption <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="consumptionRecord_form" action="/yoonic-cis/consumptions/record.xml" method="post" target="consumptionRecord_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/> OR<br/>
		msisdn <input name="msisdn" type="text"  value="601117777947"/><br/>
		tittle <input name="tittle" type="text" value=""/><br/>
		url <input name="url" type="text" value=""/><br/>
		duration <input name="duration" type="text" value=""/><br/> 
		<input type="submit"/>
	</form></td>
	<td><iframe name="consumptionRecord_iframe" id="consumptionRecord_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/devices/index.xml - List Devices <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="deviceIndex_form" action="/yoonic-cis/devices/index.xml" method="get" target="deviceIndex_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="deviceIndex_iframe" id="deviceIndex_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/devices/record.xml - Record Device <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="deviceRecord_form" action="/yoonic-cis/devices/record.xml" method="post" target="deviceRecord_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/><br/>
		device_name <input name="device_name" type="text" value=""/><br/>
		device_model <input name="device_model" type="text" value=""/><br/>
		language <input name="language" type="text" value=""/><br/>
		mac_address <input name="mac_address" type="text" value=""/><br/>
		ip_address <input name="ip_address" type="text" value=""/><br/>
		last_login <input name="last_login" type="text" value="<?= date("Y-m-d H:i:s") ?>"/><br/> 
		<input type="submit"/>
	</form></td>
	<td><iframe name="deviceRecord_iframe" id="deviceRecord_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

 	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/receipts/charge_receipt.xml - Charge Receipt <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="chargeReceipt_form" action="/yoonic-cis/receipts/charge_receipt.xml" method="post" target="chargeReceipt_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		mt_id <input name="mt_id" type="text" value=""/><br/>
		dn_id <input name="dn_id" type="text" value=""/><br/>
		request <input name="request" type="text" value=""/><br/>
		response <input name="response" type="text" value=""/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="chargeReceipt_iframe" id="chargeReceipt_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/receipts/reminder_receipt.xml - Reminder Receipt <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="reminderReceipt_form" action="/yoonic-cis/receipts/reminder_receipt.xml" method="post" target="reminderReceipt_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		mt_id <input name="mt_id" type="text" value=""/><br/>
		dn_id <input name="dn_id" type="text" value=""/><br/>
		request <input name="request" type="text" value=""/><br/>
		response <input name="response" type="text" value=""/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="reminderReceipt_iframe" id="reminderReceipt_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>

	<tr><td style="font-weight:bold;">/yoonic-cis/receipts/terminate_receipt.xml - Terminate Receipt <b>POST</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="terminateReceipt_form" action="/yoonic-cis/receipts/terminate_receipt.xml" method="post" target="terminateReceipt_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		telco_id <input name="telco_id" type="text" value="1"/><br/>
		mt_id <input name="mt_id" type="text" value=""/><br/>
		dn_id <input name="dn_id" type="text" value=""/><br/>
		request <input name="request" type="text" value=""/><br/>
		response <input name="response" type="text" value=""/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="terminateReceipt_iframe" id="terminateReceipt_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>

	<HR WIDTH="100%" SIZE="3"> 

	<table>
	<tr><td style="font-weight:bold;">/yoonic-cis/logs/index.xml - List Logs <b>GET</b></td></tr>
	<tr><td style="width: 400px;">
	<form name="logIndex_form" action="/yoonic-cis/logs/index.xml" method="get" target="logIndex_iframe">
		session_token <input class="session_token_field" name="session_token" type="text"/><br/>
		subscriber_id <input name="subscriber_id" type="text" value="1"/><br/>
		<input type="submit"/>
	</form></td>
	<td><iframe name="logIndex_iframe" id="logIndex_iframe" src="" style="width: 600px;"></iframe></td>
	</tr>
	</table>
</body>
</html>

