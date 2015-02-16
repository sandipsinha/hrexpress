<div id="header">
<div id="logo">
<h2><?php echo $title ?></h2>
</div>
</div>
<div id="container">

<?php foreach ($records as $row){
	$links=anchor('temps/edit/'.$row['id'],'Edit').' / ';
	$links.=anchor('temps/delete/'.$row['id'].'/'.$row['effdt'],'Delete',array('onClick' => "return confirm('Are you sure you want to delete?')"));
	$this->table->add_row($row['Name'],$row['action_type'],$row['effdt'],$row['classification'],$row['location'],$row['dept'],$row['financial_org'],$links);
}
?>

<?php echo $this->table->generate();?>

 
</div>