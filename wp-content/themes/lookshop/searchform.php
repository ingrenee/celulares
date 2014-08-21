<?php $s = ''; ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<input onblur="if(this.value =='') this.value='search the shop'" onfocus="if (this.value == 'search the shop') this.value=''"  value="<?php if (esc_html($s)) echo esc_html($s); else echo 'search the shop'; ?>" type="text" name="s" id="s"   />
	<button id="searchsubmit" class="reverse"><span><?php _e('Go','lookshop'); ?></span></button>
</form>
