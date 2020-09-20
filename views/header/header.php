<!DOCTYPE html>
<html lang="ar">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php echo $this->curr_title;?></title>
	<meta name="descriptison" content="<?php echo $this->description;?>">
	<meta name="keywords" content="<?php echo $this->keywords;?>">
	<link href="<?php echo URL ?>public/IMG/logo.png" rel="icon">
	<link href="<?php echo URL ?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL ?>public/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?php echo URL ?>public/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="<?php echo URL ?>public/CSS/style.css" rel="stylesheet">
	
	<?php
		if(isset($this->EXT_CSS))
		{
			foreach($this->EXT_CSS as $v)
			{
				echo '<link rel="stylesheet" href="'.$v.'">';
			}
		}
		if(isset($this->CSS))
		{
			foreach($this->CSS as $v)
			{
				echo '<link rel="stylesheet" href="'.URL.$v.'">';
			}
		}
		
	?>
</head>
<body>

