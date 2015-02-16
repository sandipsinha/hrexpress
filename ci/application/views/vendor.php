<div id="container">
<h1>Vendor Pagination Form</h1>
<?php foreach ($records as $row){
	$links=anchor('vendor/edit/'.$row['id'],'Edit').' / ';
	$links.=anchor('vendor/delete/'.$row['id'],'Delete',array('onClick' => "return confirm('Are you sure you want to delete?')"));
	$this->table->add_row($row['name'],$row['effdt'],$row['comments'],$row['Count'],$links);
}
?>

<?php echo $this->table->generate();?>
<?php echo $this->pagination->create_links();?> 
 
</div>
