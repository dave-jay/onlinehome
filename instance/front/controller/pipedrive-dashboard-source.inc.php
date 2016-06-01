<?php

/**
 * Admin side Login file
 * 
 * 

 * @version 1.0
 * @package lysoft
 * 
 */
$jsInclude = "pipedrive-dashboard-source.js.php";


$dashboard_title = "Source - Current Month";
$curr_month = '5';
$curr_year = '2016';
$prev_month = '4';
$prev_year = '2016';

//SELECT source, count(*) as `Total Deals` FROM `dashboard_pipedrive_deals` where  MONTH(added_date) = MONTH(CURDATE()) AND YEAR(added_date) = YEAR(CURDATE()) AND source!='' group BY `dashboard_pipedrive_deals`.`source` ORDER BY `Total Deals` DESC
$data_curr = q("
SELECT source, count(*) as `Total Deals`, 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $curr_month AND YEAR(added_date) = $curr_year AND out_table.source=in_table.source AND in_table.curr_stage='Submitted') submitted_count, 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $curr_month AND YEAR(added_date) = $curr_year AND out_table.source=in_table.source AND in_table.curr_stage='Approved') approved_count , 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $curr_month AND YEAR(added_date) = $curr_year AND out_table.source=in_table.source AND in_table.curr_stage='Funded') funded_count 
        FROM `dashboard_pipedrive_deals` as out_table 
WHERE   MONTH(added_date) = $curr_month AND 
        YEAR(added_date) = $curr_year AND 
        source!='' 
GROUP BY `out_table`.`source` 
ORDER BY `Total Deals` DESC
");
$data_prev = q("
SELECT source, count(*) as `Total Deals`, 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $prev_month AND YEAR(added_date) = $prev_year AND out_table.source=in_table.source AND in_table.curr_stage='Submitted') submitted_count, 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $prev_month AND YEAR(added_date) = $prev_year AND out_table.source=in_table.source AND in_table.curr_stage='Approved') approved_count , 
            (select count(*) from dashboard_pipedrive_deals as in_table where MONTH(added_date) = $prev_month AND YEAR(added_date) = $prev_year AND out_table.source=in_table.source AND in_table.curr_stage='Funded') funded_count 
        FROM `dashboard_pipedrive_deals` as out_table 
WHERE   MONTH(added_date) = $prev_month AND 
        YEAR(added_date) = $prev_year AND 
        source!='' 
GROUP BY `out_table`.`source` 
ORDER BY `Total Deals` DESC
");
$value_data = array();
$curr_submitted = array();
$curr_approved = array();
$curr_funded = array();
$curr_other = array();

$prev_submitted = array();
$prev_approved = array();
$prev_funded = array();
$prev_other = array();
foreach ($data_curr as $each) {
    $value_data[$each['source']]['source'] = $each['source'];
    $value_data[$each['source']]['current_count'] = $each['Total Deals'];
    $value_data[$each['source']]['prev_count'] = 0;
    $value_data[$each['source']]['curr_submitted_count'] = $each['submitted_count'];
    $value_data[$each['source']]['curr_approved_count'] = $each['approved_count'];
    $value_data[$each['source']]['curr_funded_count'] = $each['funded_count'];
    $value_data[$each['source']]['curr_other_count'] = ($each['Total Deals'] - ($each['submitted_count'] + $each['approved_count'] + $each['funded_count']));
    $value_data[$each['source']]['prev_submitted_count'] = 0;
    $value_data[$each['source']]['prev_approved_count'] = 0;
    $value_data[$each['source']]['prev_funded_count'] = 0;
    $value_data[$each['source']]['prev_other_count'] = 0;
}
foreach ($data_prev as $each) {
    if (isset($value_data[$each['source']]['source'])) {
        $value_data[$each['source']]['prev_count'] = $each['Total Deals'];
        $value_data[$each['source']]['prev_submitted_count'] = $each['submitted_count'];
        $value_data[$each['source']]['prev_approved_count'] = $each['approved_count'];
        $value_data[$each['source']]['prev_funded_count'] = $each['funded_count'];
        $value_data[$each['source']]['prev_other_count'] = ($each['Total Deals'] - ($each['submitted_count'] + $each['approved_count'] + $each['funded_count']));
    } else {
        $value_data[$each['source']]['source'] = $each['source'];
        $value_data[$each['source']]['current_count'] = '0';
        $value_data[$each['source']]['prev_count'] = $each['Total Deals'];
        $value_data[$each['source']]['curr_submitted_count'] = 0;
        $value_data[$each['source']]['curr_approved_count'] = 0;
        $value_data[$each['source']]['curr_funded_count'] = 0;
        $value_data[$each['source']]['curr_other_count'] = 0;
        $value_data[$each['source']]['prev_submitted_count'] = $each['submitted_count'];
        $value_data[$each['source']]['prev_approved_count'] = $each['approved_count'];
        $value_data[$each['source']]['prev_funded_count'] = $each['funded_count'];
        $value_data[$each['source']]['prev_other_count'] = ($each['Total Deals'] - ($each['submitted_count'] + $each['approved_count'] + $each['funded_count']));
    }
}
foreach ($value_data as $each) {
    $label_arr[] = $each['source'];
    $curr_arr[] = $each['current_count'];
    $prev_arr[] = $each['prev_count'];
    $curr_submitted[] = $each['curr_submitted_count'];
    $curr_approved[] = $each['curr_approved_count'];
    $curr_funded[] = $each['curr_funded_count'];
    $curr_other[] = $each['curr_other_count'];
    $prev_submitted[] = $each['prev_submitted_count'];
    $prev_approved[] = $each['prev_approved_count'];
    $prev_funded[] = $each['prev_funded_count'];
    $prev_other[] = $each['prev_other_count'];
}

if (isset($_REQUEST['changeGraph'])) {
    if ($_REQUEST['source'] == 'ALL') {
        include _PATH . "instance/front/tpl/pipedrive-dashboard-source-outer.php";
    } else {
        $dashboard_title = "Source - {$_REQUEST['source']}";
        foreach ($value_data as $each) {
            if ($_REQUEST['source'] == $each['source']) {
                $curr_arr = array();
                $prev_arr = array();
                $label_arr = array('Submitted','Approved','Funded','Other');
                $curr_arr[] = $each['curr_submitted_count'];
                $curr_arr[] = $each['curr_approved_count'];
                $curr_arr[] = $each['curr_funded_count'];
                $curr_arr[] = $each['curr_other_count'];
                $prev_arr[] = $each['prev_submitted_count'];
                $prev_arr[] = $each['prev_approved_count'];
                $prev_arr[] = $each['prev_funded_count'];
                $prev_arr[] = $each['prev_other_count'];
            }
        }
        include _PATH . "instance/front/tpl/pipedrive-dashboard-source-inner.php";
    }
    die;
}
_cg("page_title", "Source Dashboard");
?>