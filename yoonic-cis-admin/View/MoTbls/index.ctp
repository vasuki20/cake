<!-- File: /app/View/MoTbls/index.ctp -->
<?php echo $this->Html->link(
    'Add MoTbl',
    array('controller' => 'MoTbls', 'action' => 'add')
); ?>
<h2>MoTbls</h2>
<table>
    <tr>
        <th>Id</th>
        <th>Telco_ID</th>
        <th>Subscriber_ID</th>
		<th>msisdn</th>
		<th>mo_id</th>
		<th>mo_link_id</th>
		<th>api_user_id</th>
		<th>txn_id</th>
		<th>keyword</th>
		<th>request</th>
		<th>response</th>
		<th>created</th>
		
    </tr>

    <!-- Here is where we loop through our $MoTbls array, printing out MoTbl info -->
    <?php foreach ($MoTbls as $MoTbl): ?>
    <tr>
        <td><?php echo $MoTbl['MoTbl']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($MoTbl['MoTbl']['telcoId'],
array('controller' => 'MoTbls', 'action' => 'view', $MoTbl['MoTbl']['id'])); ?>
        </td>
        <td><?php echo $MoTbl['MoTbl']['subscriberId']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['msisdn']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['moId']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['moLinkId']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['apiUserId']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['txnId']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['keyword']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['request']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['response']; ?></td>
		<td><?php echo $MoTbl['MoTbl']['created']; ?></td>
    </tr>
	
    <?php endforeach; ?>
    <?php unset($MoTbl); ?>
</table>