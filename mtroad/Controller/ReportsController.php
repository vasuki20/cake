<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class ReportsController extends AppController {

    public $uses = array('Subscription', 'Subscriber', 'ApiUser', 'Log', 'Receipt');
    
    /*
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index");
    }*/

    public function index() {
        
        $apiz = 0;
        $telcoz = 0;
        $response = array("role"=>$apiz, "telco_normal"=>$telcoz);        

        $result = $response;//$this->ApiUser->checkAdminPowers();
        //$result = 1;
        
        //Initialize date and time
        $today = date('d-m-Y', strtotime("-1 days")) . " 00:00:00";
        $this->log($this->request->data, 'debug');
        $cd = strtotime($today);
        $last_week = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd), date('d', $cd) - 7, date('Y', $cd))) . " 23:59:59";

        if (!empty($this->request->data)) {
            $last_week = date('Y-m-d', strtotime($this->request->data('report_start_date')));
            $today = date('Y-m-d', strtotime($this->request->data('report_end_date')));
            $this->set("posted_date", 1); //Check if date posted.
        }

        $this->set("today", $today);
        $this->set("last_week", $last_week);

        //End of initialization
        //if( $result == 1 )
        if ($result["role"] == "1" or $result["role"] == "2")
        {
            $total_subscribers = $this->Subscriber->find("count", array('conditions' => array('Subscriber.telco_id' => 1 ))); //$_SESSION["Auth"]["User"]["telco_id"])));
            $this->set("total_subscribers", $total_subscribers);

            $inactive_subscribers = $this->Subscriber->find("count", array(
                'fields' => "DISTINCT Subscriber.id",
                'joins' => array(
                    array(
                        'table' => 'subscriptions',
                        'alias' => 'Subscription',
                        'type' => 'LEFT',
                        'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                    )
                ),
                'conditions' => array(
                    'OR' => array(
                        array('Subscription.status' => 'inactive'),
                        array('Subscription.status' => null)
                    ),
                    'AND' => array(
                        array('Subscription.telco_id' => 1) ///$_SESSION["Auth"]["User"]["telco_id"])
                    )
            )));
            $this->set("inactive_subscribers", $inactive_subscribers);



            $active_subscribers = $this->Subscriber->find("count", array(
                'fields' => "DISTINCT Subscriber.id",
                'joins' => array(
                    array(
                        'table' => 'subscriptions',
                        'alias' => 'Subscription',
                        'type' => 'INNER',
                        'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                    )
                ),
                'conditions' => array(
                    'Subscription.status' => 'active',
                    'Subscription.telco_id' => 1 //$_SESSION["Auth"]["User"]["telco_id"]
                )
            ));
            $this->set("active_subscribers", $active_subscribers);

            
//            'fields' => "Subscription.subscription_channel, Subscription.subscription_name, count(Subscriber.id) as counter, (SELECT COUNT(DISTINCT Subscriber.id) AS `count` FROM `registration`.`Subscribers` AS `Subscriber` LEFT JOIN `registration`.`subscriptions` AS `Subscription1` ON (`Subscriber`.`id` = `Subscription1`.`Subscriber_id`) LEFT JOIN `registration`.`telcos` AS `Telco` ON (`Subscriber`.`telco_id` = `Telco`.`id`) WHERE ((`Subscription1`.`status` = 'inactive') OR (`Subscription1`.`status` IS NULL)) and `Subscription`.`subscription_channel` = `Subscription1`.`subscription_channel` and `Subscriber`.`telco_id` = " . $_SESSION["Auth"]["User"]["telco_id"] . ") as counter_inactive, (SELECT COUNT(DISTINCT Subscriber.id) AS `count` FROM `registration`.`Subscribers` AS `Subscriber` INNER JOIN `registration`.`subscriptions` AS `Subscription2` ON (`Subscriber`.`id` = `Subscription2`.`Subscriber_id`) LEFT JOIN `registration`.`telcos` AS `Telco` ON (`Subscriber`.`telco_id` = `Telco`.`id`) WHERE `Subscription2`.`status` = 'active' and `Subscription`.`subscription_channel` = `Subscription2`.`subscription_channel` and `Subscriber`.`telco_id` = " . $_SESSION["Auth"]["User"]["telco_id"] . ") as counter_active",
            
            
            $all_subscribers_by_channel = $this->Subscriber->find("all", array(
                
                'fields' => "Subscription.subscription_channel, Subscription.subscription_name, count(Subscriber.id) as counter, (SELECT COUNT(DISTINCT Subscriber.id) AS `count` FROM `registration`.`Subscribers` AS `Subscriber` LEFT JOIN `registration`.`subscriptions` AS `Subscription1` ON (`Subscriber`.`id` = `Subscription1`.`Subscriber_id`) LEFT JOIN `registration`.`telcos` AS `Telco` ON (`Subscriber`.`telco_id` = `Telco`.`id`) WHERE ((`Subscription1`.`status` = 'inactive') OR (`Subscription1`.`status` IS NULL)) and `Subscription`.`subscription_channel` = `Subscription1`.`subscription_channel` and `Subscriber`.`telco_id` = " . 1 . ") as counter_inactive, (SELECT COUNT(DISTINCT Subscriber.id) AS `count` FROM `registration`.`Subscribers` AS `Subscriber` INNER JOIN `registration`.`subscriptions` AS `Subscription2` ON (`Subscriber`.`id` = `Subscription2`.`Subscriber_id`) LEFT JOIN `registration`.`telcos` AS `Telco` ON (`Subscriber`.`telco_id` = `Telco`.`id`) WHERE `Subscription2`.`status` = 'active' and `Subscription`.`subscription_channel` = `Subscription2`.`subscription_channel` and `Subscriber`.`telco_id` = " . 1 . ") as counter_active",
                'joins' => array(
                    array(
                        'table' => 'subscriptions',
                        'alias' => 'Subscription',
                        'type' => 'LEFT',
                        'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                    )
                ),
                'group' => array('Subscription.subscription_channel')
            ));
            $this->set("all_subscribers_by_channel", $all_subscribers_by_channel);
        } else {



            if (!empty($this->request->data)) {

                $total_subscribers = $this->Subscriber->find("count");
                $this->set("total_subscribers", $total_subscribers);

                $inactive_subscribers = $this->Subscriber->find("count", array(
                    'fields' => "DISTINCT Subscriber.id",
                    'joins' => array(
                        array(
                            'table' => 'subscriptions',
                            'alias' => 'Subscription',
                            'type' => 'LEFT',
                            'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                        )
                    ),
                    'conditions' => array(
                        'OR' => array(
                            array('Subscription.status' => 'inactive'),
                            array('Subscription.status' => null)
                        )
                )));
                $this->set("inactive_subscribers", $inactive_subscribers);

                $inactive_subscribers_below_seven = $this->Subscriber->find("count", array(
                    'fields' => "DISTINCT Subscriber.id",
                    'joins' => array(
                        array(
                            'table' => 'subscriptions',
                            'alias' => 'Subscription',
                            'type' => 'LEFT',
                            'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                        )
                    ),
                    'conditions' => array(
                        'AND' => array(
                            array('Subscription.status' => 'inactive'),
                            array('Subscription.subscription_end_date <  "' . $today . '" + INTERVAL 7 DAY'),
                            array('Subscription.subscription_end_date > "' . $today . '"')
                        )
                )));
                $this->set("inactive_subscribers_below_seven", $inactive_subscribers_below_seven);


                $inactive_subscribers_beyond_seven = $this->Subscriber->find("count", array(
                    'fields' => "DISTINCT Subscriber.id",
                    'joins' => array(
                        array(
                            'table' => 'subscriptions',
                            'alias' => 'Subscription',
                            'type' => 'LEFT',
                            'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                        )
                    ),
                    'conditions' => array(
                        'AND' => array(
                            array('Subscription.status' => 'inactive'),
                            array('Subscription.subscription_end_date > "' . $today . '" + INTERVAL 7 DAY')
                        )
                )));
                $this->set("inactive_subscribers_beyond_seven", $inactive_subscribers_beyond_seven);


                $active_subscribers = $this->Subscriber->find("count", array(
                    'fields' => "DISTINCT Subscriber.id",
                    'joins' => array(
                        array(
                            'table' => 'subscriptions',
                            'alias' => 'Subscription',
                            'type' => 'INNER',
                            'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                        )
                    ),
                    'conditions' => array(
                        'Subscription.status' => 'active'
                    )
                ));
                $this->set("active_subscribers", $active_subscribers);


                /* Start of Subscriber Growth */

                $weekly_new_subscribers = $this->Subscriber->find("count", array(
                    'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
                ));


                $this->set("weekly_new_subscribers", $weekly_new_subscribers);

                $new_subscribers = $this->Subscriber->find("all", array(
                    'fields' => "Subscriber.id",
                    'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
                ));

                unset($subscriber_array);
                foreach ($new_subscribers as $subscriber) {
                    $subscriber_array[] = $subscriber["Subscriber"]["id"];
                }

                if (!empty($subscriber_array)) {

                    $weekly_new_number_subscription = $this->Subscription->find("count", array(
                        'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array)
                    ));

                    $this->set("weekly_new_number_subscription", $weekly_new_number_subscription);

                    $weekly_new_number_subscription_by_daily_basic = $this->Subscription->find("count", array(
                        'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAD')
                    ));

                    $this->set("weekly_new_number_subscription_by_daily_basic", $weekly_new_number_subscription_by_daily_basic);

                    $weekly_new_number_subscription_by_daily_premium = $this->Subscription->find("count", array(
                        'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRD')
                    ));

                    $this->set("weekly_new_number_subscription_by_daily_premium", $weekly_new_number_subscription_by_daily_premium);

                    $weekly_new_number_subscription_by_weekly_basic = $this->Subscription->find("count", array(
                        'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAW')
                    ));

                    $this->set("weekly_new_number_subscription_by_weekly_basic", $weekly_new_number_subscription_by_weekly_basic);

                    $weekly_new_number_subscription_by_weekly_premium = $this->Subscription->find("count", array(
                        'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRW')
                    ));

                    $this->set("weekly_new_number_subscription_by_weekly_premium", $weekly_new_number_subscription_by_weekly_premium);
                } //If not empty subscriber
                //List of subscriber MSISDN
                $list_subscribers_msisdn = $this->Subscriber->find("all", array(
                    'fields' => "Subscriber.id,Subscriber.msisdn",
                    'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
                ));

                $this->set("list_subscribers_msisdn", $list_subscribers_msisdn);

                /* End of Subscriber Growth */


                /* Start Subscriptions */
                /* $weekly_subscriptions = $this->Subscription->find("count",array(
                  'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week)

                  ));

                  $this->set("weekly_subscriptions", $weekly_subscriptions); */

                $weekly_subscriptions_active = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active')
                ));

                $this->set("weekly_subscriptions_active", $weekly_subscriptions_active);

                $weekly_subscriptions_active_daily_basic = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON BAD')
                ));

                $this->set("weekly_subscriptions_active_daily_basic", $weekly_subscriptions_active_daily_basic);

                $weekly_subscriptions_active_daily_premium = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON PRD')
                ));

                $this->set("weekly_subscriptions_active_daily_premium", $weekly_subscriptions_active_daily_premium);

                $weekly_subscriptions_active_weekly_basic = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON BAW')
                ));

                $this->set("weekly_subscriptions_active_weekly_basic", $weekly_subscriptions_active_weekly_basic);

                $weekly_subscriptions_active_weekly_premium = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON PRW')
                ));

                $this->set("weekly_subscriptions_active_weekly_premium", $weekly_subscriptions_active_weekly_premium);

                $weekly_total_renewal = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword !=' => "ON TP1")
                ));

                $this->set("weekly_total_renewal", $weekly_total_renewal);

                $weekly_total_renewal_daily_basic = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAD')
                ));

                $this->set("weekly_total_renewal_daily_basic", $weekly_total_renewal_daily_basic);

                $weekly_total_renewal_daily_premium = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRD')
                ));

                $this->set("weekly_total_renewal_daily_premium", $weekly_total_renewal_daily_premium);

                $weekly_total_renewal_weekly_basic = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAW')
                ));

                $this->set("weekly_total_renewal_weekly_basic", $weekly_total_renewal_weekly_basic);

                $weekly_total_renewal_weekly_premium = $this->Subscription->find("count", array(
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRW')
                ));

                $this->set("weekly_total_renewal_weekly_premium", $weekly_total_renewal_weekly_premium);

                /* End of Subscriptions */

                $weekly_unique_users = $this->Subscription->find("count", array(
                    'fields' => "DISTINCT Subscription.subscriber_id",
                    'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week)
                ));

                $this->set("weekly_unique_users", $weekly_unique_users);
            }
        }
    }

    public function atomic_put_contents($filename, $data) {
        // Copied largely from http://php.net/manual/en/function.flock.php
        $fp = fopen($filename, "w");
        //$this->log($this->request->$fp, 'debug');
        if (flock($fp, LOCK_EX)) {
            fwrite($fp, $data);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

    public function export_day() {
        //Initialize date and time
        $today = date('Y-m-d', strtotime("-1 days")) . " 23:59:59"; //changed to day before date
        $today_start = date('Y-m-d', strtotime("-1 days")) . " 00:00:00";
        $cd = strtotime($today);
     
        $chargeable_keywords = array('ON BAD', 'ON BAW', 'ON PRD', 'ON PRW', 'ON TP1');

        $last_month = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd) - ((date('d', $cd) - 1 == date('d', 1) ? 1 : 0) ), date('d', 1), date('Y', $cd))) . " 00:00:00";

        $telco_id = 1; //default this to 1 for maxis

        $this->set("today", $today);
        $this->set("today_start", $today_start);


        $total_subscribers_list = $this->Subscriber->find("all", array('conditions' => array('Subscriber.telco_id' => $telco_id)));

        unset($subscriber_date_created_array);
        unset($existing_subscriber_ids);

        if ($total_subscribers_list) {
            foreach ($total_subscribers_list as $subscriber) {
                $subscriber_date_created_array[$subscriber["Subscriber"]["id"]] = $subscriber["Subscriber"]["date_created"];
                $existing_subscriber_ids[] = $subscriber["Subscriber"]["id"];
            }
        } else {
            $subscriber_date_created_array = array();
        }


        $all_subscriptions_list = $this->Log->find("all", array(
            'fields' => array('Log.telco_id', 'Log.subscriber_id', 'Log.msisdn', 'Log.mo_id', 'Log.msg_org_lnk_id', 'Log.mt_id', 'Log.keyword', 'Log.request', 'Log.timestamp', 'Receipt.dn_id', 'Receipt.response'),
            'recursive' => -1, //int
            'joins' => array(
                array(
                    'table' => 'receipts',
                    'alias' => 'Receipt',
                    'type' => 'INNER',
                    'conditions' => array('Log.mt_id = Receipt.mt_id')
                )
            ),
            'conditions' => array(
                array('Log.mt_id !=' => ''),
                array('Log.telco_id' => $telco_id),
                array('Log.request LIKE' => '%/gateway/%'),
                array('Log.subscriber_id' => $existing_subscriber_ids),
                array('Log.keyword' => $chargeable_keywords),
                array('Log.timestamp >=' => $last_month),
                array('Log.timestamp <=' => $today)
            )
        ));

        unset($daily);
        $pricing = array('ON BAD' => 1.0, 'ON BAW' => 2.0, 'ON PRD' => 2.0, 'ON PRW' => 5.0, 'ON TP1' => 1.0, 'TOTAL' => 0);
        $daily = array(
            'ON BAD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON BAW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON TP1' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'NEW' => array('ON BAD' => array(), 'ON BAW' => array(), 'ON PRD' => array(), 'ON PRW' => array()),
            'EARNING' => array('ON BAD' => 0.0, 'ON BAW' => 0.0, 'ON PRD' => 0.0, 'ON PRW' => 0.0, 'ON TP1' => 0.0, 'TOTAL' => 0.0)
        );

        foreach ($all_subscriptions_list as $subscription) {
            $daily[$subscription['Log']['keyword']][$subscription['Receipt']['response']] += 1;
            if ($subscription['Receipt']['response'] == 1) {
                if ($subscription['Log']['timestamp'] >= $today_start) {
                    $daily['EARNING'][$subscription['Log']['keyword']] += $pricing[$subscription['Log']['keyword']];
                    $daily['EARNING']['TOTAL'] += $pricing[$subscription['Log']['keyword']];
                }
            } else {
                if ($subscription['Log']['timestamp'] >= $today_start) {
                    $daily[$subscription['Log']['keyword']]['Err'] += 1;
                }
            }

            if ($subscriber_date_created_array[$subscription['Log']['subscriber_id']] >= $today_start) {
                if ($subscription['Receipt']['response'] == 1) {
                    $daily["NEW"][$subscription['Log']['keyword']][$subscription['Log']['subscriber_id']] = 1;
                }
            }
        }

        $content = "All Subscription\n" . "\n" .
                "Daily " . $today_start . " to " . $today . "\n" .
                ", Qty, Earning\n" .
                "ON BAD, " . $daily["ON BAD"]['1'] . ", " . sprintf('%.2f', $daily["EARNING"]["ON BAD"]) . "\n" .
                "ON PRD, " . $daily["ON PRD"]['1'] . ", " . sprintf('%.2f', $daily["EARNING"]["ON PRD"]) . "\n" .
                "ON BAW, " . $daily["ON BAW"]['1'] . ", " . sprintf('%.2f', $daily["EARNING"]["ON BAW"]) . "\n" .
                "ON PRW, " . $daily["ON PRW"]['1'] . ", " . sprintf('%.2f', $daily["EARNING"]["ON PRW"]) . "\n" .
                "ON TP1, " . $daily["ON TP1"]['1'] . ", " . sprintf('%.2f', $daily["EARNING"]["ON TP1"]) . "\n" .
                "Total, , " . sprintf('%.2f', $daily["EARNING"]["TOTAL"]) . "\n" . "\n" .
                "Unsuccessful Subscription\n" . "\n" .
                "Daily " . $today_start . " to " . $today . "\n" .
                ", Total, MT Delivery failure (2), Insufficient Balance (11), Gateway Errors (12), LDAP errors (21), Barred (22), Suspended (23), Deactivated (24), Block (55)\n" .
                "ON BAD, " . $daily["ON BAD"]['Err'] . ", " . $daily["ON BAD"]['2'] . ", " . $daily["ON BAD"]['11'] . ", " . $daily["ON BAD"]['12'] . ", " . $daily["ON BAD"]['21'] . ", " . $daily["ON BAD"]['22'] . ", " . $daily["ON BAD"]['23'] . ", " . $daily["ON BAD"]['24'] . ", " . $daily["ON BAD"]['55'] . "\n" .
                "ON PRD, " . $daily["ON PRD"]['Err'] . ", " . $daily["ON PRD"]['2'] . ", " . $daily["ON PRD"]['11'] . ", " . $daily["ON PRD"]['12'] . ", " . $daily["ON PRD"]['21'] . ", " . $daily["ON PRD"]['22'] . ", " . $daily["ON PRD"]['23'] . ", " . $daily["ON PRD"]['24'] . ", " . $daily["ON PRD"]['55'] . "\n" .
                "ON BAW, " . $daily["ON BAW"]['Err'] . ", " . $daily["ON BAW"]['2'] . ", " . $daily["ON BAW"]['11'] . ", " . $daily["ON BAW"]['12'] . ", " . $daily["ON BAW"]['21'] . ", " . $daily["ON BAW"]['22'] . ", " . $daily["ON BAW"]['23'] . ", " . $daily["ON BAW"]['24'] . ", " . $daily["ON BAW"]['55'] . "\n" .
                "ON PRW, " . $daily["ON PRW"]['Err'] . ", " . $daily["ON PRW"]['2'] . ", " . $daily["ON PRW"]['11'] . ", " . $daily["ON PRW"]['12'] . ", " . $daily["ON PRW"]['21'] . ", " . $daily["ON PRW"]['22'] . ", " . $daily["ON PRW"]['23'] . ", " . $daily["ON PRW"]['24'] . ", " . $daily["ON PRW"]['55'] . "\n" .
                "ON TP1, " . $daily["ON TP1"]['Err'] . ", " . $daily["ON TP1"]['2'] . ", " . $daily["ON TP1"]['11'] . ", " . $daily["ON TP1"]['12'] . ", " . $daily["ON TP1"]['21'] . ", " . $daily["ON TP1"]['22'] . ", " . $daily["ON TP1"]['23'] . ", " . $daily["ON TP1"]['24'] . ", " . $daily["ON TP1"]['55'] . "\n" . "\n" .
                "New Subscription\n" . "\n" .
                "Daily " . $today_start . " to " . $today . "\n" .
                ", Qty\n" .
                "ON BAD, " . sizeof($daily['NEW']["ON BAD"]) . "\n" .
                "ON PRD, " . sizeof($daily['NEW']["ON PRD"]) . "\n" .
                "ON BAW, " . sizeof($daily['NEW']["ON BAW"]) . "\n" .
                "ON PRW, " . sizeof($daily['NEW']["ON PRW"]) . "\n" . "\n";

        $this->atomic_put_contents('/var/www/html/log/reports/daily/'. date("m_d_y") . 'subscription_daily.csv', $content . PHP_EOL);
        ///$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'] . '/reports/' . date("m_d_y") . 'subscription_daily.csv', $content . PHP_EOL);

        $get_parameter = $this->params['pass'];

        if (isset($get_parameter[0]) && $get_parameter[0] == "display") {
            $this->set("daily", $daily);
        } else {
            $this->layout = false;
            $this->render(false);
        }
    }

//    public function export_day_csv() {
//    $this->viewClass = 'Media';
//    // Render app/webroot/files/example.docx
//    $this->log('debug log', 'debug');
//    $dailyFileName=$this->getLatestFileName('daily');
//    $this->log($dailyFileName, 'debug');
//    $params = array(
//        'id'        => $dailyFileName,
//        'name'      => $dailyFileName,
//        'extension' => 'csv',
//        'mimeType'  => array(
//            'csv' => ''
//        ),
//        'path'      => 'C:\xampp\htdocs\log\reports'.DS
//    );
//    $this->set($params);
//    
//}
    public function export_week() {
        //Initialize date and time
        $today = date('Y-m-d', strtotime("-3 days")) . " 23:59:59"; //Changed to last week 
        $day = date('D');
        $today_start = date('Y-m-d') . " 00:00:00";
        $cd = strtotime($today);
        $last_week = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd), date('d', $cd) - 6, date('Y', $cd))) . " 00:00:00";
        $last_week_short = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd), date('d', $cd) - 6, date('Y', $cd)));

        $last_month = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd) - ((date('d', $cd) == date('d', 1) ? 1 : 0) ), date('d', 1), date('Y', $cd))) . " 00:00:00";

        $chargeable_keywords = array('ON BAD', 'ON BAW', 'ON PRD', 'ON PRW', 'ON TP1');

        $telco_id = 1; //default this to 1 for maxis

        $this->set("today", $today);
        $this->set("today_start", $today_start);
        $this->set("last_week", $last_week);

        $total_subscribers_list = $this->Subscriber->find("all", array('conditions' => array('Subscriber.telco_id' => $telco_id)));

        unset($subscriber_date_created_array);
        unset($existing_subscriber_ids);

        if ($total_subscribers_list) {
            foreach ($total_subscribers_list as $subscriber) {
                $subscriber_date_created_array[$subscriber["Subscriber"]["id"]] = $subscriber["Subscriber"]["date_created"];
                $existing_subscriber_ids[] = $subscriber["Subscriber"]["id"];
            }
        } else {
            $subscriber_date_created_array = array();
        }


        $all_subscriptions_list = $this->Log->find("all", array(
            'fields' => array('Log.telco_id', 'Log.subscriber_id', 'Log.msisdn', 'Log.mo_id', 'Log.msg_org_lnk_id', 'Log.mt_id', 'Log.keyword', 'Log.request', 'Log.timestamp', 'Receipt.dn_id', 'Receipt.response'),
            'recursive' => -1, //int
            'joins' => array(
                array(
                    'table' => 'receipts',
                    'alias' => 'Receipt',
                    'type' => 'INNER',
                    'conditions' => array('Log.mt_id = Receipt.mt_id')
                )
            ),
            'conditions' => array(
                array('Log.mt_id !=' => ''),
                array('Log.telco_id' => $telco_id),
                array('Log.request LIKE' => '%/gateway/%'),
                array('Log.subscriber_id' => $existing_subscriber_ids),
                array('Log.keyword' => $chargeable_keywords),
                array('Log.timestamp >=' => $last_month),
                array('Log.timestamp <=' => $today)
            )
        ));

        unset($monthly);
        unset($weekly);
        unset($daily);
        $pricing = array('ON BAD' => 1.0, 'ON BAW' => 2.0, 'ON PRD' => 2.0, 'ON PRW' => 5.0, 'ON TP1' => 1.0, 'TOTAL' => 0);
        $weekly = array(
            'ON BAD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON BAW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON TP1' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'NEW' => array('ON BAD' => array(), 'ON BAW' => array(), 'ON PRD' => array(), 'ON PRW' => array()),
            'EARNING' => array('ON BAD' => 0.0, 'ON BAW' => 0.0, 'ON PRD' => 0.0, 'ON PRW' => 0.0, 'ON TP1' => 0.0, 'TOTAL' => 0.0)
        );

        foreach ($all_subscriptions_list as $subscription) {
            $weekly[$subscription['Log']['keyword']][$subscription['Receipt']['response']] += 1;
            if ($subscription['Receipt']['response'] == 1) {
                if ($subscription['Log']['timestamp'] >= $last_week) {
                    $weekly['EARNING'][$subscription['Log']['keyword']] += $pricing[$subscription['Log']['keyword']];
                    $weekly['EARNING']['TOTAL'] += $pricing[$subscription['Log']['keyword']];
                }
            } else {
                if ($subscription['Log']['timestamp'] >= $last_week) {
                    $weekly[$subscription['Log']['keyword']]['Err'] += 1;
                }
            }

            if ($subscriber_date_created_array[$subscription['Log']['subscriber_id']] >= $last_week) {
                if ($subscription['Receipt']['response'] == 1) {
                    $weekly["NEW"][$subscription['Log']['keyword']][$subscription['Log']['subscriber_id']] = 1;
                }
            }
        }

        $content = "All Subscription\n" . "\n" .
                "Weekly " . $last_week . " to " . $today . "\n" .
                ", Qty, Earning\n" .
                "ON BAD, " . $weekly["ON BAD"]['1'] . ", " . sprintf('%.2f', $weekly["EARNING"]["ON BAD"]) . "\n" .
                "ON PRD, " . $weekly["ON PRD"]['1'] . ", " . sprintf('%.2f', $weekly["EARNING"]["ON PRD"]) . "\n" .
                "ON BAW, " . $weekly["ON BAW"]['1'] . ", " . sprintf('%.2f', $weekly["EARNING"]["ON BAW"]) . "\n" .
                "ON PRW, " . $weekly["ON PRW"]['1'] . ", " . sprintf('%.2f', $weekly["EARNING"]["ON PRW"]) . "\n" .
                "ON TP1, " . $weekly["ON TP1"]['1'] . ", " . sprintf('%.2f', $weekly["EARNING"]["ON TP1"]) . "\n" .
                "Total, , " . sprintf('%.2f', $weekly["EARNING"]["TOTAL"]) . "\n" . "\n" .
                "Unsuccessful Subscription\n" . "\n" .
                "Weekly " . $last_week . " to " . $today . "\n" .
                ", Total, MT Delivery failure (2), Insufficient Balance (11), Gateway Errors (12), LDAP errors (21), Barred (22), Suspended (23), Deactivated (24), Block (55)\n" .
                "ON BAD, " . $weekly["ON BAD"]['Err'] . ", " . $weekly["ON BAD"]['2'] . ", " . $weekly["ON BAD"]['11'] . ", " . $weekly["ON BAD"]['12'] . ", " . $weekly["ON BAD"]['21'] . ", " . $weekly["ON BAD"]['22'] . ", " . $weekly["ON BAD"]['23'] . ", " . $weekly["ON BAD"]['24'] . ", " . $weekly["ON BAD"]['55'] . "\n" .
                "ON PRD, " . $weekly["ON PRD"]['Err'] . ", " . $weekly["ON PRD"]['2'] . ", " . $weekly["ON PRD"]['11'] . ", " . $weekly["ON PRD"]['12'] . ", " . $weekly["ON PRD"]['21'] . ", " . $weekly["ON PRD"]['22'] . ", " . $weekly["ON PRD"]['23'] . ", " . $weekly["ON PRD"]['24'] . ", " . $weekly["ON PRD"]['55'] . "\n" .
                "ON BAW, " . $weekly["ON BAW"]['Err'] . ", " . $weekly["ON BAW"]['2'] . ", " . $weekly["ON BAW"]['11'] . ", " . $weekly["ON BAW"]['12'] . ", " . $weekly["ON BAW"]['21'] . ", " . $weekly["ON BAW"]['22'] . ", " . $weekly["ON BAW"]['23'] . ", " . $weekly["ON BAW"]['24'] . ", " . $weekly["ON BAW"]['55'] . "\n" .
                "ON PRW, " . $weekly["ON PRW"]['Err'] . ", " . $weekly["ON PRW"]['2'] . ", " . $weekly["ON PRW"]['11'] . ", " . $weekly["ON PRW"]['12'] . ", " . $weekly["ON PRW"]['21'] . ", " . $weekly["ON PRW"]['22'] . ", " . $weekly["ON PRW"]['23'] . ", " . $weekly["ON PRW"]['24'] . ", " . $weekly["ON PRW"]['55'] . "\n" .
                "ON TP1, " . $weekly["ON TP1"]['Err'] . ", " . $weekly["ON TP1"]['2'] . ", " . $weekly["ON TP1"]['11'] . ", " . $weekly["ON TP1"]['12'] . ", " . $weekly["ON TP1"]['21'] . ", " . $weekly["ON TP1"]['22'] . ", " . $weekly["ON TP1"]['23'] . ", " . $weekly["ON TP1"]['24'] . ", " . $weekly["ON TP1"]['55'] . "\n" . "\n" .
                "New Subscription\n" . "\n" .
                "Weekly " . $last_week . " to " . $today . "\n" .
                ", Qty\n" .
                "ON BAD, " . sizeof($weekly['NEW']["ON BAD"]) . "\n" .
                "ON PRD, " . sizeof($weekly['NEW']["ON PRD"]) . "\n" .
                "ON BAW, " . sizeof($weekly['NEW']["ON BAW"]) . "\n" .
                "ON PRW, " . sizeof($weekly['NEW']["ON PRW"]) . "\n" . "\n";

        $this->atomic_put_contents('/var/www/html/log/reports/weekly/'. $last_week_short . 'subscription_weekly.csv', $content . PHP_EOL);
        //$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'] . '/reports/' . $last_week_short . 'subscription_weekly.csv', $content . PHP_EOL);

        $get_parameter = $this->params['pass'];

        if (isset($get_parameter[0]) && $get_parameter[0] == "display") {
            $this->set("weekly", $weekly);
        } else {
            $this->layout = false;
            $this->render(false);
        }
    }

//     public function export_weekly_csv() {
//    $this->viewClass = 'Media';
//    // Render app/webroot/files/example.docx
//    $this->log('debug log', 'debug');
//    $weeklyFileName=$this->getLatestFileName('weekly');
//    $this->log($weeklyFileName, 'debug');
//    $params = array(
//        'id'        => $weeklyFileName,
//        'name'      => $weeklyFileName,
//        'extension' => 'csv',
//        'mimeType'  => array(
//            'csv' => ''
//        ),
//        'path'      => 'C:\xampp\htdocs\log\reports'.DS
//    );
//    $this->set($params);
//    
//}


    public function export_month() {
        //Initialize date and time
        $today = date('Y-m-d') . " 23:59:59";
        $day = date('D');
        $cd = strtotime($today);

        $last_month_end = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd), date('d', 1) - 1, date('Y', $cd))) . " 23:59:59";
        $last_month = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd) - 1, date('d', 1), date('Y', $cd))) . " 00:00:00";
        $last_month_short = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd) - 1, date('d', 1), date('Y', $cd)));


        $chargeable_keywords = array('ON BAD', 'ON BAW', 'ON PRD', 'ON PRW', 'ON TP1');

        $telco_id = 1; //default this to 1 for maxis

        $this->set("today", $last_month_end);
        $this->set("last_month", $last_month);


        $total_subscribers_list = $this->Subscriber->find("all", array('conditions' => array('Subscriber.telco_id' => $telco_id)));

        unset($subscriber_date_created_array);
        unset($existing_subscriber_ids);

        if ($total_subscribers_list) {
            foreach ($total_subscribers_list as $subscriber) {
                $subscriber_date_created_array[$subscriber["Subscriber"]["id"]] = $subscriber["Subscriber"]["date_created"];
                $existing_subscriber_ids[] = $subscriber["Subscriber"]["id"];
            }
        } else {
            $subscriber_date_created_array = array();
        }


        $all_subscriptions_list = $this->Log->find("all", array(
            'fields' => array('Log.telco_id', 'Log.subscriber_id', 'Log.msisdn', 'Log.mo_id', 'Log.msg_org_lnk_id', 'Log.mt_id', 'Log.keyword', 'Log.request', 'Log.timestamp', 'Receipt.dn_id', 'Receipt.response'),
            'recursive' => -1, //int
            'joins' => array(
                array(
                    'table' => 'receipts',
                    'alias' => 'Receipt',
                    'type' => 'INNER',
                    'conditions' => array('Log.mt_id = Receipt.mt_id')
                )
            ),
            'conditions' => array(
                array('Log.mt_id !=' => ''),
                array('Log.telco_id' => $telco_id),
                array('Log.request LIKE' => '%/gateway/%'),
                array('Log.subscriber_id' => $existing_subscriber_ids),
                array('Log.keyword' => $chargeable_keywords),
                array('Log.timestamp >=' => $last_month),
                array('Log.timestamp <=' => $last_month_end)
            )
        ));

        unset($monthly);
        unset($weekly);
        unset($daily);
        $pricing = array('ON BAD' => 1.0, 'ON BAW' => 2.0, 'ON PRD' => 2.0, 'ON PRW' => 5.0, 'ON TP1' => 1.0, 'TOTAL' => 0);
        $monthly = array(
            'ON BAD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON BAW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRD' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON PRW' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'ON TP1' => array('1' => 0, '2' => 0, '11' => 0, '12' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '55' => 0, 'Err' => 0),
            'NEW' => array('ON BAD' => array(), 'ON BAW' => array(), 'ON PRD' => array(), 'ON PRW' => array()),
            'EARNING' => array('ON BAD' => 0.0, 'ON BAW' => 0.0, 'ON PRD' => 0.0, 'ON PRW' => 0.0, 'ON TP1' => 0.0, 'TOTAL' => 0.0)
        );

        foreach ($all_subscriptions_list as $subscription) {
            $monthly[$subscription['Log']['keyword']][$subscription['Receipt']['response']] += 1;
            if ($subscription['Receipt']['response'] == 1) {
                $monthly['EARNING'][$subscription['Log']['keyword']] += $pricing[$subscription['Log']['keyword']];
                $monthly['EARNING']['TOTAL'] += $pricing[$subscription['Log']['keyword']];
            } else {
                $monthly[$subscription['Log']['keyword']]['Err'] += 1;
            }

            if ($subscriber_date_created_array[$subscription['Log']['subscriber_id']] >= $last_month) {
                if ($subscription['Receipt']['response'] == 1) {
                    $monthly["NEW"][$subscription['Log']['keyword']][$subscription['Log']['subscriber_id']] = 1;
                }
            }
        }

        $content = "All Subscription\n" . "\n" .
                "Monthly " . $last_month . " to " . $last_month_end . "\n" .
                ", Qty, Earning\n" .
                "ON BAD, " . $monthly["ON BAD"]['1'] . ", " . sprintf('%.2f', $monthly["EARNING"]["ON BAD"]) . "\n" .
                "ON PRD, " . $monthly["ON PRD"]['1'] . ", " . sprintf('%.2f', $monthly["EARNING"]["ON PRD"]) . "\n" .
                "ON BAW, " . $monthly["ON BAW"]['1'] . ", " . sprintf('%.2f', $monthly["EARNING"]["ON BAW"]) . "\n" .
                "ON PRW, " . $monthly["ON PRW"]['1'] . ", " . sprintf('%.2f', $monthly["EARNING"]["ON PRW"]) . "\n" .
                "ON TP1, " . $monthly["ON TP1"]['1'] . ", " . sprintf('%.2f', $monthly["EARNING"]["ON TP1"]) . "\n" .
                "Total, , " . sprintf('%.2f', $monthly["EARNING"]["TOTAL"]) . "\n" . "\n" . "\n" .
                "Unsuccessful Subscription\n" . "\n" .
                "Monthly " . $last_month . " to " . $last_month_end . "\n" .
                ", Total, MT Delivery failure (2), Insufficient Balance (11), Gateway Errors (12), LDAP errors (21), Barred (22), Suspended (23), Deactivated (24), Block (55)\n" .
                "ON BAD, " . $monthly["ON BAD"]['Err'] . ", " . $monthly["ON BAD"]['2'] . ", " . $monthly["ON BAD"]['11'] . ", " . $monthly["ON BAD"]['12'] . ", " . $monthly["ON BAD"]['21'] . ", " . $monthly["ON BAD"]['22'] . ", " . $monthly["ON BAD"]['23'] . ", " . $monthly["ON BAD"]['24'] . ", " . $monthly["ON BAD"]['55'] . "\n" .
                "ON PRD, " . $monthly["ON PRD"]['Err'] . ", " . $monthly["ON PRD"]['2'] . ", " . $monthly["ON PRD"]['11'] . ", " . $monthly["ON PRD"]['12'] . ", " . $monthly["ON PRD"]['21'] . ", " . $monthly["ON PRD"]['22'] . ", " . $monthly["ON PRD"]['23'] . ", " . $monthly["ON PRD"]['24'] . ", " . $monthly["ON PRD"]['55'] . "\n" .
                "ON BAW, " . $monthly["ON BAW"]['Err'] . ", " . $monthly["ON BAW"]['2'] . ", " . $monthly["ON BAW"]['11'] . ", " . $monthly["ON BAW"]['12'] . ", " . $monthly["ON BAW"]['21'] . ", " . $monthly["ON BAW"]['22'] . ", " . $monthly["ON BAW"]['23'] . ", " . $monthly["ON BAW"]['24'] . ", " . $monthly["ON BAW"]['55'] . "\n" .
                "ON PRW, " . $monthly["ON PRW"]['Err'] . ", " . $monthly["ON PRW"]['2'] . ", " . $monthly["ON PRW"]['11'] . ", " . $monthly["ON PRW"]['12'] . ", " . $monthly["ON PRW"]['21'] . ", " . $monthly["ON PRW"]['22'] . ", " . $monthly["ON PRW"]['23'] . ", " . $monthly["ON PRW"]['24'] . ", " . $monthly["ON PRW"]['55'] . "\n" .
                "ON TP1, " . $monthly["ON TP1"]['Err'] . ", " . $monthly["ON TP1"]['2'] . ", " . $monthly["ON TP1"]['11'] . ", " . $monthly["ON TP1"]['12'] . ", " . $monthly["ON TP1"]['21'] . ", " . $monthly["ON TP1"]['22'] . ", " . $monthly["ON TP1"]['23'] . ", " . $monthly["ON TP1"]['24'] . ", " . $monthly["ON TP1"]['55'] . "\n" . "\n" . "\n" .
                "New Subscription\n" . "\n" .
                "Monthly " . $last_month . " to " . $last_month_end . "\n" .
                ", Qty\n" .
                "ON BAD, " . sizeof($monthly['NEW']["ON BAD"]) . "\n" .
                "ON PRD, " . sizeof($monthly['NEW']["ON PRD"]) . "\n" .
                "ON BAW, " . sizeof($monthly['NEW']["ON BAW"]) . "\n" .
                "ON PRW, " . sizeof($monthly['NEW']["ON PRW"]) . "\n";
        // $this->log($content, 'debug');
        // $this->log($this->request->$fp, 'debug');
        
        //$this->atomic_put_contents($_SERVER['DOCUMENT_ROOT'] . '/reports/' . $last_month_short . 'subscription_monthly.csv', $content . PHP_EOL);
        $this->atomic_put_contents('/var/www/html/log/reports/monthly' . $last_month_short . 'subscription_monthly.csv', $content . PHP_EOL);
        
        
        $this->log($this->atomic_put_contents, 'debug');
        $get_parameter = $this->params['pass'];

        if (isset($get_parameter[0]) && $get_parameter[0] == "display") {
            $this->set("monthly", $monthly);
        } else {
            $this->layout = false;
            $this->render(false);
        }
    }

//    public function export_monthly_csv() {
//    $this->viewClass = 'Media';
//    // Render app/webroot/files/example.docx
//    $this->log('debug log', 'debug');
//    $monthlyFileName=$this->getLatestFileName('monthly');
//    $this->log($monthlyFileName, 'debug');
//    $params = array(
//        'id'        => $monthlyFileName,
//        'name'      => $monthlyFileName,
//        'extension' => 'csv',
//        'mimeType'  => array(
//            'csv' => ''
//        ),
//        'path'      => 'C:\xampp\htdocs\log\reports'.DS
//    );
//    $this->set($params);
//    
//}

    public function export() {
        // Suspend the need to login
        //$result=$this->ApiUser->checkAdminPowers();
        //Initialize date and time
        $today = date('Y-m-d') . " 00:00:00";
        $cd = strtotime($today);
        $last_week = date('Y-m-d', mktime(date('h', $cd), date('i', $cd), date('s', $cd), date('m', $cd), date('d', $cd) - 7, date('Y', $cd))) . " 23:59:59";

        $telco_id = 1; //default this to 1 for maxis

        $this->set("today", $today);
        $this->set("last_week", $last_week);

        //End of initialization


        $this->log($this->request->data, 'debug');

        $total_subscribers_list = $this->Subscriber->find("all", array('conditions' => array('Subscriber.telco_id' => $telco_id)));

        unset($total_subscribers_array);
        unset($total_subscribers_string);

        if ($total_subscribers_list) {
            foreach ($total_subscribers_list as $subscriber) {
                $total_subscribers_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $total_subscribers_string = join(", ", $total_subscribers_array);
            $total_subscribers = sizeof($total_subscribers_array);
        } else {
            $total_subscribers_string = "";
            $total_subscribers = 0;
        }

        $this->set("total_subscribers_string", $total_subscribers_string);
        $this->set("total_subscribers", $total_subscribers);
        /*
          $total_subscribers = $this->Subscriber->find("count");
          $this->set("total_subscribers", $total_subscribers);
         */

        $active_subscribers_list = $this->Subscriber->find("all", array(
            'fields' => array("DISTINCT Subscriber.id", "Subscriber.msisdn"),
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'INNER',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'OR' => array(
                    array('Subscription.subscription_end_date >=' => $today),
                    array('Subscription.status' => null)
                ),
                'AND' => array(
                    array('Subscription.telco_id' => $telco_id)
                )
        )));

        unset($active_subscribers_array);
        unset($active_subscribers_string);

        if ($active_subscribers_list) {
            foreach ($active_subscribers_list as $subscriber) {
                $active_subscribers_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $active_subscribers_string = join(", ", $active_subscribers_array);
            $active_subscribers = sizeof($active_subscribers_array);
        } else {
            $active_subscribers_string = "";
            $active_subscribers = 0;
        }

        $this->set("active_subscribers_string", $active_subscribers_string);
        $this->set("active_subscribers", $active_subscribers);

        /*
          $active_subscribers = $this->Subscriber->find("count", array(
          'fields' => "DISTINCT Subscriber.id",
          'joins' => array(
          array(
          'table'=>'subscriptions',
          'alias'=>'Subscription',
          'type'=>'INNER',
          'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
          )
          ),
          'conditions' => array(
          'Subscription.status' => 'active'
          )
          ));
          $this->set("active_subscribers", $active_subscribers);
         */



        $total_inactive_subscribers_list = $this->Subscriber->find("all", array(
            'fields' => array("DISTINCT Subscriber.id", "Subscriber.msisdn"),
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'OR' => array(
                    array('Subscription.subscription_end_date <' => $today),
                    array('Subscription.subscription_end_date' => null)
                ),
                'AND' => array(
                    array('Subscriber.telco_id' => $telco_id)
                )
        )));

        unset($total_inactive_subscribers_array);
        unset($total_inactive_subscribers_string);

        if ($total_inactive_subscribers_list) {
            foreach ($total_inactive_subscribers_list as $subscriber) {
                $total_inactive_subscribers_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $total_inactive_subscribers_string = join(", ", $total_inactive_subscribers_array);
            $total_inactive_subscribers = sizeof($total_inactive_subscribers_array);
        } else {
            $total_inactive_subscribers_string = '';
            $total_inactive_subscribers = 0;
        }

        $this->set("total_inactive_subscribers_string", $total_inactive_subscribers_string);
        $this->set("total_inactive_subscribers", $total_inactive_subscribers);


        /*
          $inactive_subscribers = $this->Subscriber->find("count", array(
          'fields' => "DISTINCT Subscriber.id",
          'joins' => array(
          array(
          'table'=>'subscriptions',
          'alias'=>'Subscription',
          'type'=>'LEFT',
          'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
          )
          ),
          'conditions' => array(
          'OR' => array(
          array('Subscription.status' => 'inactive'),
          array('Subscription.status' => null)
          )
          )));
          $this->set("inactive_subscribers", $inactive_subscribers);
         */

        $inactive_subscribers_below_seven_list = $this->Subscriber->find("all", array(
            'fields' => array("DISTINCT Subscriber.id", "Subscriber.msisdn"),
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'AND' => array(
                    array('Subscription.subscription_end_date <' => $today),
                    array('Subscription.subscription_end_date >' => $last_week),
                    array('Subscriber.telco_id' => $telco_id)
                )
        )));

        unset($inactive_subscribers_below_seven_array);
        unset($inactive_subscribers_below_seven_string);

        if ($inactive_subscribers_below_seven_list) {
            foreach ($inactive_subscribers_below_seven_list as $subscriber) {
                $inactive_subscribers_below_seven_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $inactive_subscribers_below_seven_string = join(", ", $inactive_subscribers_below_seven_array);
            $inactive_subscribers_below_seven = sizeof($inactive_subscribers_below_seven_array);
        } else {
            $inactive_subscribers_below_seven = 0;
            $inactive_subscribers_below_seven_string = "";
        }

        $this->set("inactive_subscribers_below_seven_string", $inactive_subscribers_below_seven_string);
        $this->set("inactive_subscribers_below_seven", $inactive_subscribers_below_seven);


        $inactive_subscribers_beyond_seven_list = $this->Subscriber->find("all", array(
            'fields' => array("DISTINCT Subscriber.id", "Subscriber.msisdn"),
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'or' => array(
                    array('Subscription.subscription_end_date <' => $last_week),
                    array('Subscription.subscription_end_date' => NULL)
                ),
                'AND' => array(
                    array('Subscriber.telco_id' => $telco_id)
                )
        )));

        unset($inactive_subscribers_beyond_seven_array);
        unset($inactive_subscribers_beyond_seven_string);

        if ($inactive_subscribers_beyond_seven_list) {
            foreach ($inactive_subscribers_beyond_seven_list as $subscriber) {
                $inactive_subscribers_beyond_seven_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $inactive_subscribers_beyond_seven_string = join(", ", $inactive_subscribers_beyond_seven_array);
            $inactive_subscribers_beyond_seven = sizeof($inactive_subscribers_beyond_seven_array);
        } else {
            $inactive_subscribers_beyond_seven = 0;
            $inactive_subscribers_beyond_seven_string = "";
        }

        $this->set("inactive_subscribers_beyond_seven_string", $inactive_subscribers_beyond_seven_string);
        $this->set("inactive_subscribers_beyond_seven", $inactive_subscribers_beyond_seven);



        //==================================================================================================================================================	
        // Start of Subscriber Growth 

        $weekly_new_registration_list = $this->Subscriber->find("all", array(
            'conditions' => array('Subscriber.date_created <=' => $today, 'Subscriber.date_created >' => $last_week)
        ));

        unset($weekly_new_registration_array);
        unset($weekly_new_registration_string);

        if ($weekly_new_registration_list) {
            foreach ($weekly_new_registration_list as $subscriber) {
                $weekly_new_registration_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $weekly_new_registration_string = join(", ", $weekly_new_registration_array);
            $weekly_new_registration = sizeof($weekly_new_registration_array);
        } else {
            $weekly_new_registration = 0;
            $weekly_new_registration_string = "";
        }

        $this->set("weekly_new_registration_string", $weekly_new_registration_string);
        $this->set("weekly_new_registration", $weekly_new_registration);

        $weekly_new_subscribers_list = $this->Subscriber->find("all", array(
            'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
        ));

        unset($weekly_new_subscribers_array);
        unset($weekly_new_subscribers_string);

        if ($weekly_new_subscribers_list) {
            foreach ($weekly_new_subscribers_list as $subscriber) {
                $weekly_new_subscribers_array[] = $subscriber["Subscriber"]["msisdn"];
            }

            $weekly_new_subscribers_string = join(", ", $weekly_new_subscribers_array);
            $weekly_new_subscribers = sizeof($weekly_new_subscribers_array);
        } else {
            $weekly_new_subscribers = 0;
            $weekly_new_subscribers_string = "";
        }

        $this->set("weekly_new_subscribers_string", $weekly_new_subscribers_string);
        $this->set("weekly_new_subscribers", $weekly_new_subscribers);


        $new_subscribers = $this->Subscriber->find("all", array(
            'fields' => array("Subscriber.id", "Subscriber.msisdn"),
            'conditions' => array('Subscriber.date_created <=' => $today, 'Subscriber.date_created >' => $last_week)
        ));

        unset($subscriber_array);
        unset($subscriber_msisdn_array);
        $subscriber_array[] = 0; //prevents an empty array
        foreach ($new_subscribers as $subscriber) {
            $subscriber_array[] = $subscriber["Subscriber"]["id"];
            $subscriber_msisdn_array[$subscriber["Subscriber"]["id"]] = $subscriber["Subscriber"]["msisdn"];
        }

        /*
          $weekly_new_number_subscription =  $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week, 'Subscription.subscriber_id' => $subscriber_array)

          ));

          $this->set("weekly_new_number_subscription",$weekly_new_number_subscription);
         */

        $weekly_new_number_subscription_by_daily_basic_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_start_date <=' => $today,
                'Subscription.subscription_start_date >' => $last_week,
                'Subscription.subscriber_id' => $subscriber_array,
                'Subscription.keyword' => 'ON BAD',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_new_number_subscription_by_daily_basic_array);
        unset($weekly_new_number_subscription_by_daily_basic_string);

        if ($weekly_new_number_subscription_by_daily_basic_list) {
            foreach ($weekly_new_number_subscription_by_daily_basic_list as $subscription) {
                $weekly_new_number_subscription_by_daily_basic_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_new_number_subscription_by_daily_basic_string = join(", ", $weekly_new_number_subscription_by_daily_basic_array);
            $weekly_new_number_subscription_by_daily_basic = sizeof($weekly_new_number_subscription_by_daily_basic_array);
        } else {
            $weekly_new_number_subscription_by_daily_basic = 0;
            $weekly_new_number_subscription_by_daily_basic_string = "";
        }

        $this->set("weekly_new_number_subscription_by_daily_basic_string", $weekly_new_number_subscription_by_daily_basic_string);
        $this->set("weekly_new_number_subscription_by_daily_basic", $weekly_new_number_subscription_by_daily_basic);

        $weekly_new_number_subscription_by_daily_premium_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_start_date <=' => $today,
                'Subscription.subscription_start_date >' => $last_week,
                'Subscription.subscriber_id' => $subscriber_array,
                'Subscription.keyword' => 'ON PRD',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_new_number_subscription_by_daily_premium_array);
        unset($weekly_new_number_subscription_by_daily_premium_string);

        if ($weekly_new_number_subscription_by_daily_premium_list) {
            foreach ($weekly_new_number_subscription_by_daily_premium_list as $subscription) {
                $weekly_new_number_subscription_by_daily_premium_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_new_number_subscription_by_daily_premium_string = join(", ", $weekly_new_number_subscription_by_daily_premium_array);
            $weekly_new_number_subscription_by_daily_premium = sizeof($weekly_new_number_subscription_by_daily_premium_array);
        } else {
            $weekly_new_number_subscription_by_daily_premium = 0;
            $weekly_new_number_subscription_by_daily_premium_string = "";
        }

        $this->set("weekly_new_number_subscription_by_daily_premium_string", $weekly_new_number_subscription_by_daily_premium_string);
        $this->set("weekly_new_number_subscription_by_daily_premium", $weekly_new_number_subscription_by_daily_premium);

        $weekly_new_number_subscription_by_weekly_basic_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_start_date <=' => $today,
                'Subscription.subscription_start_date >' => $last_week,
                'Subscription.subscriber_id' => $subscriber_array,
                'Subscription.keyword' => 'ON BAW',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_new_number_subscription_by_weekly_basic_array);
        unset($weekly_new_number_subscription_by_weekly_basic_string);

        if ($weekly_new_number_subscription_by_weekly_basic_list) {
            foreach ($weekly_new_number_subscription_by_weekly_basic_list as $subscription) {
                $weekly_new_number_subscription_by_weekly_basic_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_new_number_subscription_by_weekly_basic_string = join(", ", $weekly_new_number_subscription_by_weekly_basic_array);
            $weekly_new_number_subscription_by_weekly_basic = sizeof($weekly_new_number_subscription_by_weekly_basic_array);
        } else {
            $weekly_new_number_subscription_by_weekly_basic = 0;
            $weekly_new_number_subscription_by_weekly_basic_string = "";
        }

        $this->set("weekly_new_number_subscription_by_weekly_basic_string", $weekly_new_number_subscription_by_weekly_basic_string);
        $this->set("weekly_new_number_subscription_by_weekly_basic", $weekly_new_number_subscription_by_weekly_basic);

        $weekly_new_number_subscription_by_weekly_premium_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_start_date <=' => $today,
                'Subscription.subscription_start_date >' => $last_week,
                'Subscription.subscriber_id' => $subscriber_array,
                'Subscription.keyword' => 'ON PRW',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_new_number_subscription_by_weekly_premium_array);
        unset($weekly_new_number_subscription_by_weekly_premium_string);

        if ($weekly_new_number_subscription_by_weekly_premium_list) {
            foreach ($weekly_new_number_subscription_by_weekly_premium_list as $subscription) {
                $weekly_new_number_subscription_by_weekly_premium_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_new_number_subscription_by_weekly_premium_string = join(", ", $weekly_new_number_subscription_by_weekly_premium_array);
            $weekly_new_number_subscription_by_weekly_premium = sizeof($weekly_new_number_subscription_by_weekly_premium_array);
        } else {
            $weekly_new_number_subscription_by_weekly_premium = 0;
            $weekly_new_number_subscription_by_weekly_premium_string = "";
        }

        $this->set("weekly_new_number_subscription_by_weekly_premium_string", $weekly_new_number_subscription_by_weekly_premium_string);
        $this->set("weekly_new_number_subscription_by_weekly_premium", $weekly_new_number_subscription_by_weekly_premium);



        /*
          $weekly_new_number_subscription_by_daily_basic =  $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAD')

          ));

          $this->set("weekly_new_number_subscription_by_daily_basic",$weekly_new_number_subscription_by_daily_basic);

          $weekly_new_number_subscription_by_daily_premium =  $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRD')

          ));

          $this->set("weekly_new_number_subscription_by_daily_premium",$weekly_new_number_subscription_by_daily_premium);

          $weekly_new_number_subscription_by_weekly_basic =  $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAW')

          ));

          $this->set("weekly_new_number_subscription_by_weekly_basic",$weekly_new_number_subscription_by_weekly_basic);

          $weekly_new_number_subscription_by_weekly_premium =  $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRW')

          ));

          $this->set("weekly_new_number_subscription_by_weekly_premium",$weekly_new_number_subscription_by_weekly_premium);




          //List of subscriber MSISDN
          $list_subscribers_msisdn = $this->Subscriber->find("all",array(
          'fields' => "Subscriber.id,Subscriber.msisdn",
          'conditions' => array('Subscriber.date_join <=' =>  $today, 'Subscriber.date_join >' =>  $last_week)
          ));

          $this->set("list_subscribers_msisdn",$list_subscribers_msisdn);
         */
        // End of Subscriber Growth 
        // Start Subscriptions 
        // $weekly_subscriptions = $this->Subscription->find("count",array(
        //	'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week)
        // ));
        // $this->set("weekly_subscriptions", $weekly_subscriptions);
        /*
          $weekly_subscriptions_active = $this->Subscription->find("count",array(
          'conditions' => array(
          'Subscription.subscription_end_date >=' =>  $today,
          'Subscription.keyword' => 'ON BAD',
          'Subscriber.telco_id' => $telco_id
          )

          ));

          $this->set("weekly_subscriptions_active", $weekly_subscriptions_active);
         */


        $all_subscribers_list = $this->Subscriber->find("all", array(
            'fields' => array("Subscriber.id", "Subscriber.msisdn")
        ));


        unset($subscriber_msisdn_array);
        foreach ($all_subscribers_list as $subscriber) {
            $subscriber_msisdn_array[$subscriber["Subscriber"]["id"]] = $subscriber["Subscriber"]["msisdn"];
        }

        $weekly_subscriptions_active_daily_basic_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_end_date >=' => $today,
                'Subscription.keyword' => 'ON BAD',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_subscriptions_active_daily_basic_array);
        unset($weekly_subscriptions_active_daily_basic_string);

        if ($weekly_subscriptions_active_daily_basic_list) {
            foreach ($weekly_subscriptions_active_daily_basic_list as $subscription) {
                $weekly_subscriptions_active_daily_basic_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_subscriptions_active_daily_basic_string = join(", ", $weekly_subscriptions_active_daily_basic_array);
            $weekly_subscriptions_active_daily_basic = sizeof($weekly_subscriptions_active_daily_basic_array);
        } else {
            $weekly_subscriptions_active_daily_basic = 0;
            $weekly_subscriptions_active_daily_basic_string = "";
        }

        $this->set("weekly_subscriptions_active_daily_basic_string", $weekly_subscriptions_active_daily_basic_string);
        $this->set("weekly_subscriptions_active_daily_basic", $weekly_subscriptions_active_daily_basic);

        $weekly_subscriptions_active_daily_premium_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_end_date >=' => $today,
                'Subscription.keyword' => 'ON PRD',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_subscriptions_active_daily_premium_array);
        unset($weekly_subscriptions_active_daily_premium_string);

        if ($weekly_subscriptions_active_daily_premium_list) {
            foreach ($weekly_subscriptions_active_daily_premium_list as $subscription) {
                $weekly_subscriptions_active_daily_premium_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_subscriptions_active_daily_premium_string = join(", ", $weekly_subscriptions_active_daily_premium_array);
            $weekly_subscriptions_active_daily_premium = sizeof($weekly_subscriptions_active_daily_premium_array);
        } else {
            $weekly_subscriptions_active_daily_premium = 0;
            $weekly_subscriptions_active_daily_premium_string = "";
        }

        $this->set("weekly_subscriptions_active_daily_premium_string", $weekly_subscriptions_active_daily_premium_string);
        $this->set("weekly_subscriptions_active_daily_premium", $weekly_subscriptions_active_daily_premium);

        $weekly_subscriptions_active_weekly_basic_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_end_date >=' => $today,
                'Subscription.keyword' => 'ON PRD',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_subscriptions_active_weekly_basic_array);
        unset($weekly_subscriptions_active_weekly_basic_string);

        if ($weekly_subscriptions_active_weekly_basic_list) {
            foreach ($weekly_subscriptions_active_weekly_basic_list as $subscription) {
                $weekly_subscriptions_active_weekly_basic_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_subscriptions_active_weekly_basic_string = join(", ", $weekly_subscriptions_active_weekly_basic_array);
            $weekly_subscriptions_active_weekly_basic = sizeof($weekly_subscriptions_active_weekly_basic_array);
        } else {
            $weekly_subscriptions_active_weekly_basic = 0;
            $weekly_subscriptions_active_weekly_basic_string = "";
        }

        $this->set("weekly_subscriptions_active_weekly_basic_string", $weekly_subscriptions_active_weekly_basic_string);
        $this->set("weekly_subscriptions_active_weekly_basic", $weekly_subscriptions_active_weekly_basic);

        $weekly_subscriptions_active_weekly_premium_list = $this->Subscription->find("all", array(
            'conditions' => array(
                'Subscription.subscription_end_date >=' => $today,
                'Subscription.keyword' => 'ON PRW',
                'Subscription.telco_id' => $telco_id
            )
        ));

        unset($weekly_subscriptions_active_weekly_premium_array);
        unset($weekly_subscriptions_active_weekly_premium_string);

        if ($weekly_subscriptions_active_weekly_premium_list) {
            foreach ($weekly_subscriptions_active_weekly_premium_list as $subscription) {
                $weekly_subscriptions_active_weekly_premium_array[] = $subscriber_msisdn_array[$subscription["Subscription"]["subscriber_id"]];
            }

            $weekly_subscriptions_active_weekly_premium_string = join(", ", $weekly_subscriptions_active_weekly_premium_array);
            $weekly_subscriptions_active_weekly_premium = sizeof($weekly_subscriptions_active_weekly_premium_array);
        } else {
            $weekly_subscriptions_active_weekly_premium = 0;
            $weekly_subscriptions_active_weekly_premium_string = "";
        }

        $this->set("weekly_subscriptions_active_weekly_premium_string", $weekly_subscriptions_active_weekly_premium_string);
        $this->set("weekly_subscriptions_active_weekly_premium", $weekly_subscriptions_active_weekly_premium);

//===============================================================================================================
        $weekly_total_renewal = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword !=' => "ON TP1")
        ));

        $this->set("weekly_total_renewal", $weekly_total_renewal);

        $weekly_total_renewal_daily_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAD')
        ));

        $this->set("weekly_total_renewal_daily_basic", $weekly_total_renewal_daily_basic);

        $weekly_total_renewal_daily_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRD')
        ));

        $this->set("weekly_total_renewal_daily_premium", $weekly_total_renewal_daily_premium);

        $weekly_total_renewal_weekly_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAW')
        ));

        $this->set("weekly_total_renewal_weekly_basic", $weekly_total_renewal_weekly_basic);

        $weekly_total_renewal_weekly_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRW')
        ));

        $this->set("weekly_total_renewal_weekly_premium", $weekly_total_renewal_weekly_premium);

        // End of Subscriptions 

        $weekly_unique_users = $this->Subscription->find("count", array(
            'fields' => "DISTINCT Subscription.subscriber_id",
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week)
        ));

        $this->set("weekly_unique_users", $weekly_unique_users);
    }

// end of export() function
    public function overallReportPdf() {

        $total_subscribers = $this->Subscriber->find("count");
        $this->set("total_subscribers", $total_subscribers);

        $inactive_subscribers = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'OR' => array(
                    array('Subscription.status' => 'inactive'),
                    array('Subscription.status' => null)
                )
        )));
        $this->set("inactive_subscribers", $inactive_subscribers);

        $inactive_subscribers_below_seven = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'AND' => array(
                    array('Subscription.status' => 'inactive'),
                    array('Subscription.subscription_end_date < NOW() + INTERVAL 7 DAY'),
                    array('Subscription.subscription_end_date > NOW()')
                )
        )));
        $this->set("inactive_subscribers_below_seven", $inactive_subscribers_below_seven);


        $inactive_subscribers_beyond_seven = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'AND' => array(
                    array('Subscription.status' => 'inactive'),
                    array('Subscription.subscription_end_date > NOW() + INTERVAL 7 DAY')
                )
        )));
        $this->set("inactive_subscribers_beyond_seven", $inactive_subscribers_beyond_seven);


        $active_subscribers = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'INNER',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'Subscription.status' => 'active'
            )
        ));
        $this->set("active_subscribers", $active_subscribers);

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();
    }

    public function subscriberGrowth($today, $last_week) {
        /* Start of Subscriber Growth */

        $weekly_new_subscribers = $this->Subscriber->find("count", array(
            'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
        ));


        $this->set("weekly_new_subscribers", $weekly_new_subscribers);

        $new_subscribers = $this->Subscriber->find("all", array(
            'fields' => "Subscriber.id",
            'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
        ));

        unset($subscriber_array);
        foreach ($new_subscribers as $subscriber) {
            $subscriber_array[] = $subscriber["Subscriber"]["id"];
        }

        if (!empty($subscriber_array)) {
            $weekly_new_number_subscription = $this->Subscription->find("count", array(
                'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array)
            ));

            $this->set("weekly_new_number_subscription", $weekly_new_number_subscription);

            $weekly_new_number_subscription_by_daily_basic = $this->Subscription->find("count", array(
                'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAD')
            ));

            $this->set("weekly_new_number_subscription_by_daily_basic", $weekly_new_number_subscription_by_daily_basic);

            $weekly_new_number_subscription_by_daily_premium = $this->Subscription->find("count", array(
                'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRD')
            ));

            $this->set("weekly_new_number_subscription_by_daily_premium", $weekly_new_number_subscription_by_daily_premium);

            $weekly_new_number_subscription_by_weekly_basic = $this->Subscription->find("count", array(
                'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON BAW')
            ));

            $this->set("weekly_new_number_subscription_by_weekly_basic", $weekly_new_number_subscription_by_weekly_basic);

            $weekly_new_number_subscription_by_weekly_premium = $this->Subscription->find("count", array(
                'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.subscriber_id' => $subscriber_array, 'Subscription.keyword' => 'ON PRW')
            ));

            $this->set("weekly_new_number_subscription_by_weekly_premium", $weekly_new_number_subscription_by_weekly_premium);
        } //If not empty subscriber.
        //List of subscriber MSISDN
        $list_subscribers_msisdn = $this->Subscriber->find("all", array(
            'fields' => "Subscriber.id,Subscriber.msisdn",
            'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
        ));

        $this->set("list_subscribers_msisdn", $list_subscribers_msisdn);

        /* End of Subscriber Growth */

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();
    }

    public function subscriptionsPdf($today, $last_week) {
        //List of subscriber MSISDN
        $list_subscribers_msisdn = $this->Subscriber->find("all", array(
            'fields' => "Subscriber.id,Subscriber.msisdn",
            'conditions' => array('Subscriber.date_join <=' => $today, 'Subscriber.date_join >' => $last_week)
        ));

        $this->set("list_subscribers_msisdn", $list_subscribers_msisdn);

        /* End of Subscriber Growth */


        /* Start Subscriptions */
        /* $weekly_subscriptions = $this->Subscription->find("count",array(
          'conditions' => array('Subscription.subscription_start_date <=' =>  $today, 'Subscription.subscription_start_date >' =>  $last_week)

          ));

          $this->set("weekly_subscriptions", $weekly_subscriptions); */

        $weekly_subscriptions_active = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active')
        ));

        $this->set("weekly_subscriptions_active", $weekly_subscriptions_active);

        $weekly_subscriptions_active_daily_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON BAD')
        ));

        $this->set("weekly_subscriptions_active_daily_basic", $weekly_subscriptions_active_daily_basic);

        $weekly_subscriptions_active_daily_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON PRD')
        ));

        $this->set("weekly_subscriptions_active_daily_premium", $weekly_subscriptions_active_daily_premium);

        $weekly_subscriptions_active_weekly_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON BAW')
        ));

        $this->set("weekly_subscriptions_active_weekly_basic", $weekly_subscriptions_active_weekly_basic);

        $weekly_subscriptions_active_weekly_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.status' => 'active', 'Subscription.keyword' => 'ON PRW')
        ));

        $this->set("weekly_subscriptions_active_weekly_premium", $weekly_subscriptions_active_weekly_premium);

        $weekly_total_renewal = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword !=' => "ON TP1")
        ));

        $this->set("weekly_total_renewal", $weekly_total_renewal);

        $weekly_total_renewal_daily_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAD')
        ));

        $this->set("weekly_total_renewal_daily_basic", $weekly_total_renewal_daily_basic);

        $weekly_total_renewal_daily_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRD')
        ));

        $this->set("weekly_total_renewal_daily_premium", $weekly_total_renewal_daily_premium);

        $weekly_total_renewal_weekly_basic = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON BAW')
        ));

        $this->set("weekly_total_renewal_weekly_basic", $weekly_total_renewal_weekly_basic);

        $weekly_total_renewal_weekly_premium = $this->Subscription->find("count", array(
            'conditions' => array('Subscription.subscription_start_date <=' => $today, 'Subscription.subscription_start_date >' => $last_week, 'Subscription.date_created <' => $last_week, 'Subscription.keyword' => 'ON PRW')
        ));

        $this->set("weekly_total_renewal_weekly_premium", $weekly_total_renewal_weekly_premium);


        $inactive_subscribers_below_seven = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'AND' => array(
                    array('Subscription.status' => 'inactive'),
                    array('Subscription.subscription_end_date < NOW() + INTERVAL 7 DAY'),
                    array('Subscription.subscription_end_date > NOW()')
                )
        )));
        $this->set("inactive_subscribers_below_seven", $inactive_subscribers_below_seven);


        $inactive_subscribers_beyond_seven = $this->Subscriber->find("count", array(
            'fields' => "DISTINCT Subscriber.id",
            'joins' => array(
                array(
                    'table' => 'subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'LEFT',
                    'conditions' => array('Subscriber.id = Subscription.Subscriber_id')
                )
            ),
            'conditions' => array(
                'AND' => array(
                    array('Subscription.status' => 'inactive'),
                    array('Subscription.subscription_end_date > NOW() + INTERVAL 7 DAY')
                )
        )));
        $this->set("inactive_subscribers_beyond_seven", $inactive_subscribers_beyond_seven);
        /* End of Subscriptions */

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();
    }

    public function viewPdf($id = null) {

        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render();
    }

//     public function getLatestFileName($type)
//     {
//        $dir = new Folder('C:\xampp\htdocs\log\reports');
//        $files = $dir->find('.*'.$type.'.csv');
//        $latestdate=0;
//        $latestFile='';
//        $this->log($files, 'debug');
//        foreach ($files as $fileString) {
//            $file = new File($dir->pwd() . DS . $fileString);
//            $currentFileDate = $file->lastChange();
//            if($currentFileDate > $latestdate)
//            {
//             $latestdate = $currentFileDate;
//             $latestFile = $fileString;
//            }  
//            $file->close(); // Be sure to close the file when you're done
//        }
//        return $latestFile;
//     }
//     
}
