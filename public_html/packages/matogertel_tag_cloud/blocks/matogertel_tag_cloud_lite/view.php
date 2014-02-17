<ul class="matogertel_tag_cloud">
<?php 

if (is_array($tags)) {
   foreach ($tags as $key => $value)
   {
		echo ' <li class="word size'.$value['range'].'">'.$value['word'].'</li>';	
   }
}
			
?>
</ul>