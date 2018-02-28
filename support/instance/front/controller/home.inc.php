<?php

/**
 * Admin User Dashboard File
 * 
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 
 * 
 */


if ($_REQUEST['search'] == 1) {
    $search = _escape($_REQUEST['term']);
    $result = q("SELECT * FROM topics WHERE question LIKE '%{$search}%'");

    $data = array();
    foreach ($result as $key => $row) {
        $data[$key]['label'] = $row['question'];
        $data[$key]['id'] = $row['id'];
        $data[$key]['url'] = $row['url'];
    }

    echo json_encode($data);
    die;
}

$jsInclude = 'home.js.php';
?>