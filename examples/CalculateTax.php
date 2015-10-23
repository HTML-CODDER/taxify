<?php
/**
 * Created by PhpStorm.
 * User: Tony DeStefano
 * Date: 10/22/15
 * Time: 2:13 PM
 */

require_once( 'config.php' );

try
{
	$taxify = new ZayconTaxify\Taxify( API_KEY, FALSE, TRUE );

	/* address */
	$destination_address = new ZayconTaxify\Address();
	$destination_address
		->setStreet1( '16201 E Indiana Ave' )
		->setCity( 'Spokane Valley' )
		->setState( 'WA' )
		->setPostalCode( '99216' );

	/* line */
	$line = new ZayconTaxify\TaxRequestLine();
	$line
		->setQuantity( 1 )
		->setItemKey( 'SKU001' )
		->setActualExtendedPrice( 100 )
		->setItemDescription( 'Some Product' )
		->setItemTaxabilityCode( '' );

	/* tax */
	$tax = new ZayconTaxify\Tax( $taxify );
	$tax
		->setDocumentKey( 'Order001' )
		->setTaxDate( time() )
		->setIsCommitted( TRUE )
		->setDestinationAddress( $destination_address )
		->addLine( $line );
	$tax_response = $tax->calculateTax();

	var_dump( $tax_response );
}
catch ( ZayconTaxify\Exception $e )
{
	var_dump( $e );
}