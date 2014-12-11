<?php
/* display message saved in session if any */
echo $this->Session->flash();
?>
<div> 
<div class="images-form">
<?php echo $this->Form->create('Upload Image', array('type' => 'file','name'=>'imgfile')); ?>
    <fieldset>
        <legend><?php echo __('Add Image'); ?></legend>
        <?php
       
        echo $this->Form->input('image', array('type' => 'file'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Save')); ?>

</div>
<div class="image-display">
<?php 

//if is set imageName show uploaded picture

if(isset($imageName)) {
echo $this->Html->image('/upload/'.$imageName, array('alt' => 'uploaded image'));
}
?>
</div>
</div>