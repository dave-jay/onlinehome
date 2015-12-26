<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Pipedrive Agents List
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <table class="table" border='0' style="width:100%;">
            <tr>
                <td style="width:15%;font-weight:bold;background-color:#e4f3e5">Deal Source</td>
                <td style="width:85%;font-weight:bold;background-color:#e4f3e5">Agent List</td>
            </tr>
            <?php foreach ($agents as $each_agents): ?>
            <tr>
                <td>
                    <div><?php print $each_agents['name']?></div>
                    <span><?php print $each_agents['']?></span>
                    
                </td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

