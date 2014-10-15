<h1>List of <?php echo $count ?> Movies</h1>
<table>
    <tr>
        <th>Syqic Movie Id</th>
        <th>Title</th>
        <th>Channel</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo h($movie['VodTbl']['syqic_movie_id']); ?></td>

            <td>
                <?php echo $this->Html->link($movie['VodTbl']['movie_title'], array('controller' => 'vodtbls', 'action' => 'view', $movie['VodTbl']['syqic_movie_id']));
                ?>
            </td>
            <td>
                <?php
                echo $movie['VodTbl']['channel_dir'];
                ?>
            </td>
            <td>
                <?php
                if ($movie['VodTbl']['published'] == 0) {
                    $status = 'Unpublished';
                } else {
                    $status = 'Published';
                }
                echo $status;
                ?>
            </td>
            <td>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $movie['VodTbl']['syqic_movie_id']));
                ?> |
                <?php
                echo $this->Form->postLink('Delete', array('action' => 'delete', $movie['VodTbl']['syqic_movie_id']), array('confirm' => 'Are you sure you want to delete movie, ' . $movie['VodTbl']['movie_title'] . '?'));
                ?>       
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php unset($movie); ?>