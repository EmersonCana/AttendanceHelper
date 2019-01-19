<?php 
include '../core/db.php';
include '../core/Info.php';

$set_new_block = new Information;

$block = $_POST['block'];
$grade = $_POST['grade'];

$set_new_block->addBlock($block, $grade);

echo '<option>---Please Select Block---</option>';
foreach($set_new_block->listBlocks() as $block) {
	echo '<option value="'.$block->id.'">'.$block->block_name.'</option>';
}
?>