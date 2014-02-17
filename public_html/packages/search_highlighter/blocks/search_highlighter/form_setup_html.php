<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

$uh = Loader::helper('concrete/urls');
$fh = Loader::helper('form/color');

?>

<div id="ccm-pagelistPane-add" class="ccm-pagelistPane">


    <ul id="ccm-blockEditPane-tabs" class="ccm-dialog-tabs">
        <li class="ccm-nav-active"><a id="ccm-blockEditPane-tab-images" href="javascript:void(0);"><?php    echo t('Colors') ?></a></li>
    </ul>

   	<div id="ccm-blockEditPane-images" class="ccm-blockEditPane">


        <div class="ccm-block-field-group">
          <p><?php   echo t('Select the colors that will highlight the separate search terms') ?></p>
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td width="50%" valign="top" align="left">
          <h2><?php   echo t('Color 1') ?></h2>
          <?php    echo $fh->output( 'color1', '', $controller->color1 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 2') ?></h2>
          <?php    echo $fh->output( 'color2', '', $controller->color2 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 3') ?></h2>
          <?php    echo $fh->output( 'color3', '', $controller->color3 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 4') ?></h2>
          <?php    echo $fh->output( 'color4', '', $controller->color4 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 5') ?></h2>
          <?php    echo $fh->output( 'color5', '', $controller->color5 ) ?>
          <div class="ccm-spacer"></div>

          </td>
          <td width="50%" valign="top" align="left">

          <h2><?php   echo t('Color 6') ?></h2>
          <?php    echo $fh->output( 'color6', '', $controller->color6 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 7') ?></h2>
          <?php    echo $fh->output( 'color7', '', $controller->color7 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 8') ?></h2>
          <?php    echo $fh->output( 'color8', '', $controller->color8 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 9') ?></h2>
          <?php    echo $fh->output( 'color9', '', $controller->color9 ) ?>
          <div class="ccm-spacer"></div>

          <h2><?php   echo t('Color 10') ?></h2>
          <?php    echo $fh->output( 'color10', '', $controller->color10 ) ?>
          <div class="ccm-spacer"></div>

          </td>
          </tr>
          </table>
        </div>

	</div>

</div>