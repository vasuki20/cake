<?php

Configure::write('http.mode', 'dev');
Configure::write('reg.email', "shum@e1.sg");
Configure::write('dev.smsc', "http://dev.e1.sg:13010/cgi-bin/sendsms?");
Configure::write('dev.smsc', "http://54.254.240.107/gateway/index.php/deliverKWMessage?applicationid=27783&login=SyQ145929&password=ciqsy!%40%23&authcode=1001");

//http://180.87.42.234/gateway/index.php/deliverKWMessage?applicationid=27783&login=1327&password=1327&authcode=1001&keyword=YOONIC&msisdn=60127860072&vcode=A23D
Configure::write('live.smsc', "http://stg.e1.sg:13010/cgi-bin/sendsms?");
Configure::write('dev.txn', "http://dev.e1.sg:2284/yoonic-txn/transactions/add.xml");
//Configure::write('dev.txn', "http://localhost:8888/yoonic-txn/transactions/add.xml");
Configure::write('live.txn', "http://localhost/yoonic-txn/transactions/add.xml");


//Configure::write('live.txn_counter', "http://localhost/yoonic-cis-utils/gentxnid/index.php/api/keyword/");
Configure::write('live.txn_counter', "http://localhost/yoonic-cis-utils/gentxnid/index.php/api/keyword/");
Configure::write('platform.id', "1000"); // yoonic 1.0

?>
