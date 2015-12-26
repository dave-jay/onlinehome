<?php

$agents = q("select * From pd_users ");

_cg("page_title", "Pipedrive Agents List");
$jsInclude = "agents.js.php";
