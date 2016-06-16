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
//$curr_month = '5';
//$curr_year = '2016';
$prev_month = '4';
$prev_year = '2016';
$curr_start_date = "2016-05-01 00:00:00";
$curr_end_date = "2016-05-31 23:59:59";
$prev_start_date = "2016-04-01 00:00:00";
$prev_end_date = "2016-04-30 23:59:59";
$curr_graph_label = "May";
$prev_graph_label = "April";
if (isset($_REQUEST['changeGraph']) || isset($_REQUEST['changeDashboard']) || isset($_REQUEST['changeMatrix'])) {
    if (isset($_REQUEST['duration'])) {
        if ($_REQUEST['duration'] == 'TODAY') {
            $curr_start_date = date('Y-m-d 00:00:00');
            $curr_end_date = date('Y-m-d 23:59:59');
            $prev_start_date = date('Y-m-d 00:00:00', strtotime("-1 day"));
            $prev_end_date = date('Y-m-d 23:59:59', strtotime("-1 day"));
            $curr_graph_label = "Today";
            $prev_graph_label = "Yesterday";
        } elseif ($_REQUEST['duration'] == 'CURRENT_WEEK') {
            $curr_start_date = date('Y-m-d 00:00:00', strtotime('monday this week'));
            $curr_end_date = date('Y-m-d 23:59:59', strtotime('sunday this week'));
            $prev_start_date = date('Y-m-d 00:00:00', strtotime('monday last week'));
            $prev_end_date = date('Y-m-d 23:59:59', strtotime('sunday last week'));
            $curr_graph_label = "Curr. Week";
            $prev_graph_label = "Prev. Week";
        } elseif ($_REQUEST['duration'] == 'CURRENT_WEEK_TO_DATE') {
            $curr_start_date = date('Y-m-d 00:00:00', strtotime('monday this week'));
            $curr_end_date = date('Y-m-d 23:59:59');
            $prev_start_date = date('Y-m-d 00:00:00', strtotime('monday last week'));
            $prev_end_date = date('Y-m-d 23:59:59', strtotime("-1 week"));
            $curr_graph_label = "Curr. Week";
            $prev_graph_label = "Prev. Week";
        } elseif ($_REQUEST['duration'] == 'CURRENT_MONTH') {
            $curr_start_date = date('Y-m-d 00:00:00', strtotime('first day of this month'));
            $curr_end_date = date('Y-m-d 23:59:59', strtotime('last day of this month'));
            $prev_start_date = date('Y-m-d 00:00:00', strtotime('first day of last month'));
            $prev_end_date = date('Y-m-d 23:59:59', strtotime('last day of last month'));
            $curr_graph_label = "Curr. Month";
            $prev_graph_label = "Prev. Month";
        } elseif ($_REQUEST['duration'] == 'CURRENT_MONTH_TO_DATE') {
            $curr_start_date = date('Y-m-d 00:00:00', strtotime('first day of this month'));
            $curr_end_date = date('Y-m-d 23:59:59');
            $prev_start_date = date('Y-m-d 00:00:00', strtotime('first day of last month'));
            $prev_end_date = date('Y-m-d 23:59:59', strtotime("-1 month"));
            $curr_graph_label = "Curr. Month";
            $prev_graph_label = "Prev. Month";
        } elseif ($_REQUEST['duration'] == 'CURRENT_YEAR') {
            $curr_start_date = date('Y-01-01 00:00:00');
            $curr_end_date = date('Y-12-31 23:59:59');
            $prev_start_date = date('Y-01-01 00:00:00', strtotime('last year'));
            $prev_end_date = date('Y-12-31 23:59:59', strtotime('last year'));
            $curr_graph_label = "Curr. Year";
            $prev_graph_label = "Prev. Year";
        }
    } else {
        $curr_start_date = $_SESSION['curr_start_date'];
        $curr_end_date = $_SESSION['curr_end_date'];
        $prev_start_date = $_SESSION['prev_start_date'];
        $prev_end_date = $_SESSION['prev_end_date'];
        $curr_graph_label = $_SESSION['curr_graph_label'];
        $prev_graph_label = $_SESSION['prev_graph_label'];
    }
}
$_SESSION['curr_start_date'] = $curr_start_date;
$_SESSION['curr_end_date'] = $curr_end_date;
$_SESSION['prev_start_date'] = $prev_start_date;
$_SESSION['prev_end_date'] = $prev_end_date;
$_SESSION['curr_graph_label'] = $curr_graph_label;
$_SESSION['prev_graph_label'] = $prev_graph_label;

//SELECT source, count(*) as `Total Deals` FROM `dashboard_pipedrive_deals` where  MONTH(added_date) = MONTH(CURDATE()) AND YEAR(added_date) = YEAR(CURDATE()) AND source!='' group BY `dashboard_pipedrive_deals`.`source` ORDER BY `Total Deals` DESC
$data_curr = q("
SELECT source, count(*) as `Total Deals`, 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$curr_start_date' AND added_date <= '$curr_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Submitted') submitted_count, 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$curr_start_date' AND added_date <= '$curr_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Approved') approved_count , 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$curr_start_date' AND added_date <= '$curr_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Funded') funded_count 
        FROM `dashboard_pipedrive_deals` as out_table 
WHERE   added_date >= '$curr_start_date' AND added_date <= '$curr_end_date' AND 
        source!='' 
GROUP BY `out_table`.`source` 
ORDER BY `Total Deals` DESC
");
$data_prev = q("
SELECT source, count(*) as `Total Deals`, 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$prev_start_date' AND added_date <= '$prev_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Submitted') submitted_count, 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$prev_start_date' AND added_date <= '$prev_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Approved') approved_count , 
            (select count(*) from dashboard_pipedrive_deals as in_table where added_date >= '$prev_start_date' AND added_date <= '$prev_end_date' AND out_table.source=in_table.source AND in_table.curr_stage='Funded') funded_count 
        FROM `dashboard_pipedrive_deals` as out_table 
WHERE    added_date >= '$prev_start_date' AND added_date <= '$prev_end_date' AND 
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
if (isset($_REQUEST['changeMatrix'])) {
    include _PATH."instance/front/tpl/pipedrive-dashboard-source-matrix.php";
    die;
}
if (isset($_REQUEST['changeGraph']) || isset($_REQUEST['changeDashboard'])) {
    if ($_REQUEST['source'] == 'ALL') {
        include _PATH . "instance/front/tpl/pipedrive-dashboard-source-outer.php";
    } else {
        $dashboard_title = "Source - {$_REQUEST['source']}";
        $label_arr = array('Submitted', 'Approved', 'Funded', 'Other');
        $curr_arr = array(0,0,0,0);
        $prev_arr = array(0,0,0,0);
        foreach ($value_data as $each) {
            if ($_REQUEST['source'] == $each['source']) {
                $curr_arr = array();
                $prev_arr = array();
                $label_arr = array('Submitted', 'Approved', 'Funded', 'Other');
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