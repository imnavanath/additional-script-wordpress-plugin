<div class="wrap">
    <h1 style="text-align: center; border: 1px solid; border-color: black; border-radius: 25px; padding: 15px; background: darkgray; margin-bottom: 20px;">
        <?php _e( 'Additional Scripts / Styles for Header and Footer', 'additional-scripts'); ?>
    </h1>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-3">
            <div id="post-body-content">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox" style="font-family: Verdana, Geneva, sans-serif; text-align: center;">
                        <div class="inside"> 
                            <p style="font-size: 15px;"> <?php _e('You can either insert Script or CSS as per your requirements. Just FYI do not forget to wrap your code as per standards, as shown here.', 'additional-scripts'); ?> 
                            </p>

                            <p style="font-family: Verdana, Geneva, sans-serif;"> 
                                <?php _e('<i>For JS Script</i> -> <code>&lt;script type="text/javascript"&gt; YOUR CUSTOM JS CODE HERE &lt;/script&gt;</code>', 'additional-scripts'); ?>
                            </p>

                            <p style="font-family: Verdana, Geneva, sans-serif;">
                                <?php _e('<i>For CSS Style</i> -> <code>&lt;style type="text/css"&gt; YOUR CUSTOM CSS CODE GOES HERE &lt;/style&gt;</code>', 'additional-scripts'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ( isset( $this->message ) ) { ?>
        <div class="updated fade"><p><?php echo $this->message; ?></p></div>
        <?php
    }
    if ( isset( $this->errorMessage ) ) { ?>
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
		                    	<p for="AddScr_insert_in_header" style="padding: 0.3em 1em; border-left: 3px solid #05c2ff; border-right: 3px solid #05c2ff; background: #eafaff; color: #646464; padding-left: 15px; letter-spacing: 0.1px;">

                                    <?php _e( 'Scripts from this field will be printed in the <strong> <code>&lt;head&gt;</code> </strong> tag. Do not place plain text in this!', 'additional-scripts'); ?>

                                </p>

		                    	<p>		                    		
		                    		<textarea style="margin-top: 20px; font-family: Courier New !important;" name="AddScr_insert_in_header" id="AddScr_insert_in_header" class="widefat" rows="8"><?php echo $this->settings['AddScr_insert_in_header']; ?> </textarea>
		                    	</p>

		                    	<p for="AddScr_insert_in_footer" style="padding: 0.3em 1em; border-left: 3px solid #05c2ff; border-right: 3px solid #05c2ff; background: #eafaff; color: #646464; padding-left: 15px; letter-spacing: 0.1px;">

                                    <?php _e( 'Scripts from this field will be printed before <strong> <code>&lt;/body&gt;</code> </strong> tag. Do not place plain text in this!'); ?>

                                </p>

		                    	<p>
		                    		<textarea style="margin-top: 20px; font-family: Courier New !important;" name="AddScr_insert_in_footer" id="AddScr_insert_in_footer" class="widefat" rows="8"><?php echo $this->settings['AddScr_insert_in_footer']; ?></textarea>
		                    	</p>
		                    	<?php wp_nonce_field( 'additional-scripts', $this->AddScr_plugin->wpAddScript.'_nonce' ); ?>
		                    	<p>
									<input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e( 'Save' ); ?>" />
								</p>
						    </form>
	                    </div>
	                </div>
				</div>
    		</div>
    		<!-- script-container -->

    		<!-- Sidebar -->
    		<div id="postbox-container-1" class="postbox-container">
    			<?php require_once (ADD_SCRIPT_DIR . '/includes/metaboxes.php'); ?>
    		</div>
    		<!-- Postboxes -->
    	</div>
	</div>
</div>