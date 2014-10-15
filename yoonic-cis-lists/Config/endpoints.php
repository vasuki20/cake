<?php

Configure::write('http.mode', 'dev');
Configure::write('reg.email', "hazrul@e1.sg");
Configure::write('dev.smsc', "http://dev.e1.sg:13010/cgi-bin/sendsms?");
Configure::write('stg.smsc', "http://staging.e1.sg:13010/cgi-bin/sendsms?");
Configure::write('prelive.smsc', "http://180.87.184.90:13010/cgi-bin/sendsms?");
Configure::write('dev.txn', "http://dev.e1.sg:2284/yoonic-txn/transactions/add.xml");
Configure::write('stg.txn', "http://staging.e1.sg:2294/yoonic-txn/transactions/add.xml");
Configure::write('prelive.txn', "http://180.87.184.90/yoonic-txn/transactions/add.xml");
Configure::write('dev.cis', "http://dev.e1.sg:2284/yoonic-cis/");
Configure::write('stg.cis', "http://staging.e1.sg:2294/yoonic-cis/");
Configure::write('prelive.cis', "http://180.87.184.90/yoonic-cis/");
Configure::write('platform.id', "1000"); // yoonic 1.0

?>