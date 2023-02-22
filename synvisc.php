<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

$smarty->assign( 'title', "Synvisc Test" );

$pdo = pdo_connect();

$reg_id = 436;
$first_injection = true;

// call database
$sql   = "SELECT * FROM data_treatment WHERE reg_id = {$reg_id} AND flag_first = " . ( $first_injection ? "'Y'" : "'N'" );
$stmt = $pdo->query( $sql );

// get results
$rows = $stmt->fetchAll();
if ( count( $rows ) == 1 ) {
    // Do the add injection
    // Setup Injection and voucher information
    $initial_injection_form_id = 61;
    $voucher_form_id = 18;

    // Add treatment
    $user_id          = 235;
    $hl_patient_fr_id = 0;
    $dt_injection     = $rows[ 0 ][ 'dt_treatment' ];
    $product          = $rows[ 0 ][ 'product' ];
    $lot_number       = $rows[ 0 ][ 'lot_number' ];

    // Add Initial Treatment
    $array_injection_data = [
        'pharma'          => 1,
        'form_id'         => $initial_injection_form_id,
        'user_id'         => $user_id,
        'field'           => [
            '11596' => [ 
                'patient_id' => $hl_patient_fr_id ],
            '11592' => [ 
                'product' => $product ],
            '11593' => [ 
                'dt_injection' => $dt_injection ],
            '11594' => [ 
                'lot_number' => $lot_number 
            ]
        ],
        'status'          => 7,
        'skip_validation' => 'Y'
    ];
}
?>
<pre><code><?php print_r( $array_injection_data); ?></code></pre>
