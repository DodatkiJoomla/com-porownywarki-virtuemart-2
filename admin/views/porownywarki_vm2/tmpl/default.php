<?php defined('_JEXEC') or die('Restricted access'); 
JHTML::_('behavior.framework', true);
$host = JURI::base();
$document =& JFactory::getDocument();
$document->addStyleSheet($host.'components/'.$_REQUEST['option'].'/assets/default.css');
?>

<div class="adminform">
	<div class="cpanel-left">
		<div class="cpanel">
			<?php
			
			// wyświetlanie dostępnych pluginów porównywarek
			if(!empty($this->plugins))
			{
				foreach($this->plugins as $plugin)
				{
					$porownywarka_name = strtolower(substr($plugin->name, strrpos($plugin->name, '_')+1));
					?>
					<div class="icon-wrapper">
						<div class="icon">
							<a href="index.php?option=com_porownywarki_vm2&controller=ceneo">
								<img src="<?php echo JURI::base(); ?>components/com_porownywarki_vm2/assets/<?php echo $porownywarka_name; ?>.jpg" style="width: 90px;" alt="">
								<span><?php echo ucfirst($porownywarka_name);?></span>
							</a>
						</div>
					</div>
					
					<?php
				}
			}
			// END wyświetlanie dostępnych pluginów porównywarek
			
			
			?>
			
			<div class="icon-wrapper">
				<div class="icon">
					<a href="index.php?option=com_installer&view=manage&filters[type]=plugin&filters[search]=porownywarki">
						<img src="<?php echo JURI::base(); ?>components/com_porownywarki_vm2/assets/pluginy.png" alt="">
						<span>Twoje pluginy porównywarek</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="cpanel-right">
		<div id="panel-sliders" class="pane-sliders" style="margin-top: 0px;">
			<div class="panel">
				<h3 class="title pane-toggler" id="cpanel-panel-logged">
					<a href="javascript:void(0);"><span>Aktualności - Porównywarki dla Virtuemart 2</span></a>
				</h3>
				<div class="pane-slider content pane-hide" >
					<iframe src="http://dodatkijoomla.pl/index.php?option=com_k2&view=itemlist&layout=category&task=category&id=16&tmpl=component" style="width: 100%; max-height: 250px;"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="clear: both;"></div> 		
<div style="text-align: center;">     
	<br> <br>Stworzone przez:<br>   
	<a target="_blank" href="http://dodatkijoomla.pl/index.php?in=porownywarki_vm2">
		<img border="0" src="http://dodatkijoomla.pl/images/logo_podpis_site_mini.png">
	</a>
	<p> Szukaj najlepszych rozszerzeń dla Joomla na <a target="_blank" href="http://dodatkijoomla.pl/index.php?in=porownywarki_vm2">DodatkiJoomla.pl</a>  
	</p>    
</div>
<script type="text/javascript">
window.addEvent('domready', function(){ new Fx.Accordion($$('div#panel-sliders.pane-sliders > .panel > h3.pane-toggler'), $$('div#panel-sliders.pane-sliders > .panel > div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_panel-sliders',$$('div#panel-sliders.pane-sliders > .panel > h3').indexOf(toggler));},onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');i.removeClass('pane-down');if($$('div#panel-sliders.pane-sliders > .panel > h3').length==$$('div#panel-sliders.pane-sliders > .panel > h3.pane-toggler').length) Cookie.write('jpanesliders_panel-sliders',-1);},duration: 300,opacity: false,alwaysHide: true}); });
</script>

