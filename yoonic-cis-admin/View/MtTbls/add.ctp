<!-- File: /app/View/MtTbls/add.ctp -->

<h1>Add MtTbl</h1>
<?php
echo $this->Form->create('MtTbl');
echo $this->Form->input('telcoId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('subscriberId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('msisdn',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('mtId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('moId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('moLinkId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('dnId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('apiUserId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('txnId',array('type'=>'text','maxlength'=>'8','style'=>'width:70px; height:7px;'));
echo $this->Form->input('keyword',array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->input('request', array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->input('response', array('type'=>'text','maxlength'=>'8','style'=>'width:200px; height:7px;'));
echo $this->Form->end('Save MtTbl');
?>

