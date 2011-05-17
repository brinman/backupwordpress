<?php

/**
 * Fallback for creating zip archive if zip command is
 * unnavailable.
 *
 * Uses the PCLZIP library that ships with WordPress
 *
 * @todo support zipArchive
 * @param string $backup_filepath
 */
function hmbkp_archive_files_fallback( $backup_filepath ) {

	// Try PCLZIP
	require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );

	$archive = new PclZip( $backup_filepath );

	// Zip up everything
	if ( !hmbkp_get_database_only() )
		$archive->create( ABSPATH, PCLZIP_OPT_REMOVE_PATH, ABSPATH, PCLZIP_CB_PRE_ADD, 'hmbkp_pclzip_exclude' );

	// Only zip up the database
	if ( hmbkp_get_database_only() )
		$archive->create( hmbkp_path() . '/database_' . DB_NAME . '.sql', PCLZIP_OPT_REMOVE_PATH, hmbkp_path() );

}

function hmbkp_pclzip_exclude( $event, &$file ) {

	$excludes = hmbkp_exclude_string( 'pclzip' );

	// Include the database file
	if ( strpos( $file['filename'], 'database_' . DB_NAME . '.sql' ) !== false )
		$file['stored_filename'] = str_replace( str_replace( ABSPATH, '', hmbkp_path() ), '', $file['stored_filename'] );

	// Match everything else past the exclude list
	elseif ( preg_match( '(' . $excludes . ')', $file['filename'] ) )
		return false;

	return true;

}