<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    
    public function GetMyData($passed_table = null, $passed_columns = null, $passed_where = null) {
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		* Easy set variables
		*/
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = $passed_columns;
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		/* DB table to use */
		$sTable = $passed_table;
		App::uses('ConnectionManager', 'Model');
		$dataSource = ConnectionManager::getDataSource('default');
		/* Database connection information */
		$gaSql['root']       = $dataSource->config['login'];
		$gaSql['']   = $dataSource->config['password'];
		$gaSql['user']         = $dataSource->config['database'];
		$gaSql['localhost']     = $dataSource->config['host'];
		//yprint_r( $sIndexColumn);
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		* If you just want to use the basic configuration for DataTables with PHP server-side, there is
		* no need to edit below this line
		*/
		/*
		* Local functions
		*/
		function fatal_error ( $sErrorMessage = '' )
		{
		    header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		    die( $sErrorMessage );
		}
		/*
		* MySQL connection
		*/
		if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['localhost'], $gaSql['root'], $gaSql['']  ) )
		{
		    fatal_error( 'Could not open connection to server' );
		}
		if ( ! mysql_select_db( $gaSql['user'], $gaSql['link'] ) )
		{
		    fatal_error( 'Could not select database ' );
		}
		/*
		* Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
		    $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
		    intval( $_GET['iDisplayLength'] );
		}
		/*
		* Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
		    $sOrder = "ORDER BY  ";
		    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		    {
		        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
		        {
		            $sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
		            ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
		        }
		    }
		    $sOrder = substr_replace( $sOrder, "", -2 );
		    if ( $sOrder == "ORDER BY" )
		    {
		        $sOrder = "";
		    }
		}
		/*
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
		    $sWhere = "WHERE (";
		        for ( $i=0 ; $i<count($aColumns) ; $i++ )
		        {
		            $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		        }
		        $sWhere = substr_replace( $sWhere, "", -3 );
		        $sWhere .= ')';
		}
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
		    if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		    {
		        if ( $sWhere == "" )
		        {
		            $sWhere = "WHERE ";
		        }
		        else
		        {
		            $sWhere .= " AND ";
		        }
		        $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		    }
		}
		if ( $sWhere != ""){
			if ($passed_where != "")
			$sWhere .= " AND ";
				$sWhere .= $passed_where;
		} else{
			if ($passed_where != ""){
				$sWhere = "WHERE ";
				$sWhere .= $passed_where;
			}
		}
		// echo $sWhere;
		/*
		* SQL queries
		* Get data to display
		*/
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
		$rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		/* Data set length after filtering */
		$sQuery = "
		SELECT FOUND_ROWS()
		";
		$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
		$iFilteredTotal = $aResultFilterTotal[0];
		/* Total data set length */
		$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
		";
		$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		$aResultTotal = mysql_fetch_array($rResultTotal);
		$iTotal = $aResultTotal[0];
		/*
		* Output
		*/
		$output = array(
		/*"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
		*/
		"draw" => intval($_GET['sEcho']),
		"recordsTotal" => $iTotal,
		"recordsFiltered" => $iFilteredTotal,
		"data" => array()
		);
		while ( $aRow = mysql_fetch_array( $rResult ) )
		{
		    $row = array();
		    for ( $i=0 ; $i<count($aColumns) ; $i++ )
		    {
		        if ( $aColumns[$i] == "version" )
		        {
		            /* Special output formatting for 'version' column */
		            $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
		        }
		        else if ( $aColumns[$i] != ' ' )
		        {
		            /* General output */
		            $row[] = $aRow[ $aColumns[$i] ];
		        }
		    }
		    $output['data'][] = $row;
		}
		return $output;
	}
    
}
