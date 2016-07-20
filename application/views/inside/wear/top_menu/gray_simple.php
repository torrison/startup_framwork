<?php

//print_r ($menu_arr);

?>

<div class="inside_top_menu">

<ul id="nav" class="dropdown dropdown-horizontal">

<li style="width:40px; text-align: center;">?
<ul>
  <li style="width:150px;text-align: left;">
  <nobr>Inside System ver. 3.0.</nobr><br />
  </li>
</ul>
</li>

<?php

foreach ($menu_arr as $row)
{
// No Shift - is row, Shift is open/close parents ul tags
if (!isset($row['shift']))
	{
	// Link or Static block
	if ($row['url'] != '') $text = '<a href="'.$row['url'].'" title="'.$row['name'].'">'.$row['name'].'</a>';
	else $text = $row['name'];
	// Custom Width
	if ($row['width'] > 0) $width = "width: ".$row['width']."px;";
	else $width = "";
	echo '<li style="'.$width.'">'.$text;
	if ($row['haschild'] != 1) echo "</li>";
	else $tmp_width_child = $row['width_child'];
	}
else
	{
	if ($row['action'] == "open")
		{
		// Add Childs Width Style
		if ( (isset($tmp_width_child)) && ($tmp_width_child > 0) ) $width_child = "width: ".$tmp_width_child."px;";
		else $width_child = "";

		echo "\n".'<ul style="'.$width_child.'">'."\n";
		$tmp_width_child = '';
		}
	if ($row['action'] == "close") echo "\n</ul></li>\n";
	}
}
?>


</ul>

</div>