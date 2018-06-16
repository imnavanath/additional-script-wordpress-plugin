<div class="wrap">
    <h1 style="text-align: center;">Additional Scripts</h1>

    <?php
    if ( isset( $this->message ) ) {
        ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>
        <?php
    }
    if ( isset( $this->errorMessage ) ) {
        ?>
        <div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>
        <?php
    }
    ?>

    <div id="poststuff">
    	<div id="post-body" class="metabox-holder columns-2">
    		<!-- Content -->
    		<div id="post-body-content">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
	                <div class="postbox" style="font-family: Verdana, Geneva, sans-serif;">
	                    <div class="inside">
		                    <form action="options-general.php?page=additional-scripts" method="post">
		                    	<p for="insert_in_header" style="padding: 0.3em 1em; border-left: 3px solid #05c2ff; border-right: 3px solid #05c2ff; background: #eafaff; color: #646464; padding-left: 15px; letter-spacing: 0.1px;">Scripts from this field will be printed in the <strong> <code>&lt;head&gt;</code> </strong> tag. Do not place plain text in this!</p>
		                    	<p>		                    		
		                    		<textarea style="margin-top: 20px; font-family: Courier New !important;" name="insert_in_header" id="insert_in_header" class="widefat" rows="8"><?php echo $this->settings['insert_in_header']; ?> </textarea>
		                    	</p>
		                    	<p for="insert_in_footer" style="padding: 0.3em 1em; border-left: 3px solid #05c2ff; border-right: 3px solid #05c2ff; background: #eafaff; color: #646464; padding-left: 15px; letter-spacing: 0.1px;">Scripts from this field will be printed before <strong> <code>&lt;/body&gt;</code> </strong> tag. Do not place plain text in this!</p>
		                    	<p>
		                    		<textarea style="margin-top: 20px; font-family: Courier New !important;" name="insert_in_footer" id="insert_in_footer" class="widefat" rows="8"><?php echo $this->settings['insert_in_footer']; ?></textarea>
		                    	</p>
		                    	<?php wp_nonce_field( 'additional-scripts', $this->plugin->name.'_nonce' ); ?>
		                    	<p>
									<input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e( 'Save' ); ?>" />
								</p>
						    </form>
	                    </div>
	                </div>
	                <!-- /postbox -->
				</div>
				<!-- /normal-sortables -->
    		</div>
    		<!-- /post-body-content -->

    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container">
    			<?php require_once(ADD_SCRIPT_DIR . '/inc/metaboxes.php'); ?>
    		</div>
    		<!-- /postbox-container -->
    	</div>
	</div>
</div>