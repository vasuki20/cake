<div id='cssmenu'>
    <ul>
        
        
        <?php echo "<li >" . $this->Html->link(__('Home'), array('controller' => 'reports', 'action' => 'index')); ?> </li>        
        <?php echo "<li class = active >" . $this->Html->link(__('Daily Report'), array('controller' => 'reports', 'action' => 'export_day/display')) . "</li>"; ?></li>
        <?php echo "<li >" . $this->Html->link(__('Weekly Report'), array('controller' => 'reports', 'action' => 'export_week/display')) . "</li>"; ?></li>
        <?php echo "<li >" . $this->Html->link(__('Monthly Report'), array('controller' => 'reports', 'action' => 'export_month/display')) . "</li>"; ?></li>      
        <li> <?php echo $this->Html->link('Archive', 'http://192.168.2.134/log/reports/'); ?></li>        
       
    </ul>
    
</div>
<div class="sessionTokens">
    <h2><?php echo __('Reports'); ?></h2>
    <h2>All Subscription</h2> 
    <h3>Daily <?php echo $today_start; ?> to <?php echo $today; ?></h3>
    <table>
        <th><td>Qty</td><td>Earning</td></th>
        <tr><td>ON BAD</td><td><?php echo $daily["ON BAD"]['1']; ?></td><td><?php echo sprintf('%.2f', $daily["EARNING"]["ON BAD"]); ?></td></tr>
        <tr><td>ON PRD</td><td><?php echo $daily["ON PRD"]['1']; ?></td><td><?php echo sprintf('%.2f', $daily["EARNING"]["ON PRD"]); ?></td></tr>
        <tr><td>ON BAW</td><td><?php echo $daily["ON BAW"]['1']; ?></td><td><?php echo sprintf('%.2f', $daily["EARNING"]["ON BAW"]); ?></td></tr>
        <tr><td>ON PRW</td><td><?php echo $daily["ON PRW"]['1']; ?></td><td><?php echo sprintf('%.2f', $daily["EARNING"]["ON PRW"]); ?></td></tr>
        <tr><td>ON TP1</td><td><?php echo $daily["ON TP1"]['1']; ?></td><td><?php echo sprintf('%.2f', $daily["EARNING"]["ON TP1"]); ?></td></tr>
        <tr><td>Total</td><td>&nbsp;</td><td><?php echo sprintf('%.2f', $daily["EARNING"]["TOTAL"]); ?></td></tr>
    </table>
    <br/>
    <br/>

    <h2>Unsuccessful Subscription</h2>

    <h3>Daily <?php echo $today_start; ?> to <?php echo $today; ?></h3>
    <table>
        <th><td>Total</td><td>MT Delivery failure (2)</td><td>Insufficient Balance (11)</td><td>Gateway Errors (12)</td><td>LDAP errors (21)</td><td>Barred (22)</td><td>Suspended (23)</td><td>Deactivated (24)</td><td>Block (55)</td></th>
        <tr><td>ON BAD</td><td><?php echo $daily["ON BAD"]['Err']; ?></td><td><?php echo $daily["ON BAD"]['2']; ?></td><td><?php echo $daily["ON BAD"]['11']; ?></td><td><?php echo $daily["ON BAD"]['12']; ?></td><td><?php echo $daily["ON BAD"]['21']; ?></td><td><?php echo $daily["ON BAD"]['22']; ?></td><td><?php echo $daily["ON BAD"]['23']; ?></td><td><?php echo $daily["ON BAD"]['24']; ?></td><td><?php echo $daily["ON BAD"]['55']; ?></td></tr>
        <tr><td>ON PRD</td><td><?php echo $daily["ON PRD"]['Err']; ?></td><td><?php echo $daily["ON PRD"]['2']; ?></td><td><?php echo $daily["ON PRD"]['11']; ?></td><td><?php echo $daily["ON PRD"]['12']; ?></td><td><?php echo $daily["ON PRD"]['21']; ?></td><td><?php echo $daily["ON PRD"]['22']; ?></td><td><?php echo $daily["ON PRD"]['23']; ?></td><td><?php echo $daily["ON PRD"]['24']; ?></td><td><?php echo $daily["ON PRD"]['55']; ?></td></tr>
        <tr><td>ON BAW</td><td><?php echo $daily["ON BAW"]['Err']; ?></td><td><?php echo $daily["ON BAW"]['2']; ?></td><td><?php echo $daily["ON BAW"]['11']; ?></td><td><?php echo $daily["ON BAW"]['12']; ?></td><td><?php echo $daily["ON BAW"]['21']; ?></td><td><?php echo $daily["ON BAW"]['22']; ?></td><td><?php echo $daily["ON BAW"]['23']; ?></td><td><?php echo $daily["ON BAW"]['24']; ?></td><td><?php echo $daily["ON BAW"]['55']; ?></td></tr>
        <tr><td>ON PRW</td><td><?php echo $daily["ON PRW"]['Err']; ?></td><td><?php echo $daily["ON PRW"]['2']; ?></td><td><?php echo $daily["ON PRW"]['11']; ?></td><td><?php echo $daily["ON PRW"]['12']; ?></td><td><?php echo $daily["ON PRW"]['21']; ?></td><td><?php echo $daily["ON PRW"]['22']; ?></td><td><?php echo $daily["ON PRW"]['23']; ?></td><td><?php echo $daily["ON PRW"]['24']; ?></td><td><?php echo $daily["ON PRW"]['55']; ?></td></tr>
        <tr><td>ON TP1</td><td><?php echo $daily["ON TP1"]['Err']; ?></td><td><?php echo $daily["ON TP1"]['2']; ?></td><td><?php echo $daily["ON TP1"]['11']; ?></td><td><?php echo $daily["ON TP1"]['12']; ?></td><td><?php echo $daily["ON TP1"]['21']; ?></td><td><?php echo $daily["ON TP1"]['22']; ?></td><td><?php echo $daily["ON TP1"]['23']; ?></td><td><?php echo $daily["ON TP1"]['24']; ?></td><td><?php echo $daily["ON TP1"]['55']; ?></td></tr>
    </table>

    <br/>
    <br/>

    <h2>New Subscribers</h2>
    <h3>Daily <?php echo $today_start; ?> to <?php echo $today; ?></h3>
    <table>
        <th><td>Qty</td></th>
        <tr><td>ON BAD</td><td><?php echo sizeof($daily['NEW']["ON BAD"]); ?></td></tr>
        <tr><td>ON PRD</td><td><?php echo sizeof($daily['NEW']["ON PRD"]); ?></td></tr>
        <tr><td>ON BAW</td><td><?php echo sizeof($daily['NEW']["ON BAW"]); ?></td></tr>
        <tr><td>ON PRW</td><td><?php echo sizeof($daily['NEW']["ON PRW"]); ?></td></tr>
    </table>
</div>
<?php 
//echo $this->Html->link(__('Save as CSV'), array('controller' => 'reports', 'action' => 'export_day_csv'), array('class' => 'saveAsBtn')) ; 
?>
