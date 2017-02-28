<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Site Header Content //-->
<?php
$main_css_file = realpath(dirname(__FILE__)) . '/../main.css';
$css_version = filemtime($main_css_file);
?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('main.css')?>?v=<?php echo $css_version ?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('typography.css')?>" />

<meta name="google-site-verification" content="qfC566teKoCT1-T_S3lIR6U8EAgM5DHHe0D8T5BvEB8" />

<?php  Loader::element('header_required'); ?>

</head>
<body>
