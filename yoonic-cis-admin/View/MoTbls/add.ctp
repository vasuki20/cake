<!-- File: /app/View/Posts/add.ctp -->

<h1>Add MoTbl</h1>
<?php
echo $this->Form->create('MoTbl');
echo $this->Form->input('telcoId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('subscriberId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('msisdn',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('moId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('moLinkId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('apiUserId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('txnId',array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));

echo $this->Form->input('keyword',array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->input('request', array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->input('response', array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->end('Save MoTbl');
?>

