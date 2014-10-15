<!-- File: /app/View/MtTbls/index.ctp -->
<?php echo $this->Html->link(
    'Add MtTbl',
    array('controller' => 'MtTbls', 'action' => 'add')
); ?>

<h2>MtTbls</h2>
<table>
    <tr>
        <th>Id</th>
        <th>Telco_ID</th>
        <th>Subscriber_ID</th>
		<th>msisdn</th>
		<th>mt_id</th>
		<th>mo_id</th>
		<th>mo_link_id</th>
		<th>dn_id</th>
		<th>api_user_id</th>
		<th>txn_id</th>
		<th>keyword</th>
		<th>request</th>
		<th>response</th>
		<th>created</th>
		
    </tr>

    <!-- Here is where we loop through our $MtTbls array, printing out MtTbl info -->

    <?php foreach ($MtTbls as $MtTbl): ?>
    <tr>
        <td><?php echo $MtTbl['MtTbl']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($MtTbl['MtTbl']['telcoId'],
array('controller' => 'MtTbls', 'action' => 'view', $MtTbl['MtTbl']['id'])); ?>
        </td>
        <td><?php echo $MtTbl['MtTbl']['subscriberId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['msisdn']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['mtId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['moId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['moLinkId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['dnId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['apiUserId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['txnId']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['keyword']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['request']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['response']; ?></td>
		<td><?php echo $MtTbl['MtTbl']['created']; ?></td>
    </tr>
	
    <?php endforeach; ?>
    <?php unset($MtTbl); ?>
</table>