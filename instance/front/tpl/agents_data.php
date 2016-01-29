<tr>
                <td style="font-weight:bold;background-color:#e4f3e5">Agent Name</td>
                <td style="font-weight:bold;background-color:#e4f3e5">Email</td>
                <td style="font-weight:bold;background-color:#e4f3e5">Phone</td>
            </tr>
<?php foreach ($agents as $each_agents): ?>
    <tr>
        <td>
            <div><?php print $each_agents['name']; ?></div>
        </td>
        <td><div><?php print $each_agents['email']; ?></div></td>
        <td><div><input type="text" class="form-control" value="<?php print $each_agents['phone'] ?>" onblur="doSavePhone(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>
    </tr>
<?php endforeach; ?>