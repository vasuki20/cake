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

	
</body>
</html>

