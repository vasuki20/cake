<body>
    <div style="margin-right: 33%;color: rgb(40, 60, 123); font-size: 150%;">
        Featured Image Values
    </div>
    <?php echo"<br>"; ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Image URL</th>
            <th>Movie Id</th>
            <th>Delete<th>            
        </tr>

        <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?php echo h($movie['FeaturedImage']['id']); ?></td>
                <td><?php echo h($movie['FeaturedImage']['img_url']); ?></td>
                <td><?php echo $movie['FeaturedImage']['movie_id']; ?></td>
                <td>
                        <?php
                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $movie['FeaturedImage']['id']), null, __('Are you sure you want to delete # %s?', $movie['FeaturedImage']['movie_id']));
                        ?>
                    </td>
            </tr>
        <?php endforeach; ?>
        <?php unset($movie); ?>
    </table>
</body>
<?php
// Shows the next and previous links
echo '<div id="prev_btn">';
echo $this->Paginator->prev(
        '« Previous', null, null, array('class' => 'disabled')
);
echo '</div>';
echo '<div id="page_numbers">';
// Shows the page numbers
echo $this->Paginator->numbers();
echo '</div>';
echo '<div id="next_btn">';

echo $this->Paginator->next(
        'Next »', null, null, array('class' => 'disabled')
);
echo '</div>';
?>
<?php unset($movie); ?>

