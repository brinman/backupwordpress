<div class="wrap<?php if ( hmbkp_in_progress() ) { ?> hmbkp_running<?php } ?>">

	<?php screen_icon( 'backupwordpress' ); ?>

	<h2><?php _e( 'Manage Backups', 'hmbkp' ); ?></h2>

<?php if ( hmbkp_possible() ) : ?>

	<?php include_once( HMBKP_PLUGIN_PATH . '/admin.backups.php' ); ?>

<?php else : ?>

	<p><strong><?php _e( 'You need to fix the issues detailed above before BackUpWordPress can start.', 'hmbkp' ); ?></strong></p>

<?php endif; ?>

	<p class="howto"><?php printf( __( 'If you need help getting things working you are more than welcome to email us at %s and we\'ll do what we can to help.', 'hmbkp' ), '<a href="mailto:support@humanmade.co.uk">support@humanmade.co.uk</a>' ); ?></p>

</div>