<div class="MyPageHeader">
    SMS Sequence Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="my_box first_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day1 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day1_1" data-type="fixed" id="rd_day1_1_sent_fixed" name="rd_day1_1_sent" value="fixed" <?php echo $data['day1_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day1_1" data-type="dynamic" id="rd_day1_1_sent_dynamic" name="rd_day1_1_sent" value="dynamic" <?php echo $data['day1_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day1_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day1_1_sent" id="day1_1_sent" value="<?php echo $data['day1_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day1_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day1_1_sent_dynamic_time" id="day1_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day1_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day1_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day1_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day1_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day1_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day1_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day1_1_sent_text" name="day1_1_sent_text" aria-invalid="false"><?php echo $data['day1_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                        
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day1 SMS (second)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day1_2" data-type="fixed" id="rd_day1_2_sent_fixed" name="rd_day1_2_sent" value="fixed" <?php echo $data['day1_2_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_2_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day1_2" data-type="dynamic" id="rd_day1_2_sent_dynamic" name="rd_day1_2_sent" value="dynamic" <?php echo $data['day1_2_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day1_2_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day1_2_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day1_2_sent" id="day1_2_sent" value="<?php echo $data['day1_2_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day1_2_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day1_2_sent_dynamic_time" id="day1_2_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day1_2_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day1_2_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day1_2_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day1_2_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day1_2_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day1_2_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day1_2_sent_text" name="day1_2_sent_text" aria-invalid="false"><?php echo $data['day1_2_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_2_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_2_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_2_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_2_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day1_2_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                        
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day2 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day2_1" data-type="fixed" id="rd_day2_1_sent_fixed" name="rd_day2_1_sent" value="fixed" <?php echo $data['day2_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day2_1" data-type="dynamic" id="rd_day2_1_sent_dynamic" name="rd_day2_1_sent" value="dynamic" <?php echo $data['day2_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day2_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day2_1_sent" id="day2_1_sent" value="<?php echo $data['day2_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day2_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day2_1_sent_dynamic_time" id="day2_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day2_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day2_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day2_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day2_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day2_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day2_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day2_1_sent_text" name="day2_1_sent_text" aria-invalid="false"><?php echo $data['day2_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day2 SMS (second)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day2_2" data-type="fixed" id="rd_day2_2_sent_fixed" name="rd_day2_2_sent" value="fixed" <?php echo $data['day2_2_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_2_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day2_2" data-type="dynamic" id="rd_day2_2_sent_dynamic" name="rd_day2_2_sent" value="dynamic" <?php echo $data['day2_2_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day2_2_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day2_2_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day2_2_sent" id="day2_2_sent" value="<?php echo $data['day2_2_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day2_2_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day2_2_sent_dynamic_time" id="day2_2_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day2_2_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day2_2_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day2_2_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day2_2_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day2_2_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day2_2_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day2_2_sent_text" name="day2_2_sent_text" aria-invalid="false"><?php echo $data['day2_2_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_2_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_2_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_2_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_2_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day2_2_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day3 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day3_1" data-type="fixed" id="rd_day3_1_sent_fixed" name="rd_day3_1_sent" value="fixed" <?php echo $data['day3_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day3_1" data-type="dynamic" id="rd_day3_1_sent_dynamic" name="rd_day3_1_sent" value="dynamic" <?php echo $data['day3_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day3_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day3_1_sent" id="day3_1_sent" value="<?php echo $data['day3_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day3_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day3_1_sent_dynamic_time" id="day3_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day3_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day3_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day3_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day3_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day3_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day3_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day3_1_sent_text" name="day3_1_sent_text" aria-invalid="false"><?php echo $data['day3_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day3 SMS (second)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day3_2" data-type="fixed" id="rd_day3_2_sent_fixed" name="rd_day3_2_sent" value="fixed" <?php echo $data['day3_2_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_2_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day3_2" data-type="dynamic" id="rd_day3_2_sent_dynamic" name="rd_day3_2_sent" value="dynamic" <?php echo $data['day3_2_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day3_2_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day3_2_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day3_2_sent" id="day3_2_sent" value="<?php echo $data['day3_2_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day3_2_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day3_2_sent_dynamic_time" id="day3_2_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day3_2_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day3_2_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day3_2_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day3_2_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day3_2_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day3_2_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day3_2_sent_text" name="day3_2_sent_text" aria-invalid="false"><?php echo $data['day3_2_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_2_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_2_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_2_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_2_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day3_2_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day4 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day4_1" data-type="fixed" id="rd_day4_1_sent_fixed" name="rd_day4_1_sent" value="fixed" <?php echo $data['day4_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day4_1" data-type="dynamic" id="rd_day4_1_sent_dynamic" name="rd_day4_1_sent" value="dynamic" <?php echo $data['day4_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day4_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day4_1_sent" id="day4_1_sent" value="<?php echo $data['day4_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day4_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day4_1_sent_dynamic_time" id="day4_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day4_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day4_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day4_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day4_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day4_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day4_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day4_1_sent_text" name="day4_1_sent_text" aria-invalid="false"><?php echo $data['day4_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day4 SMS (second)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day4_2" data-type="fixed" id="rd_day4_2_sent_fixed" name="rd_day4_2_sent" value="fixed" <?php echo $data['day4_2_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_2_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day4_2" data-type="dynamic" id="rd_day4_2_sent_dynamic" name="rd_day4_2_sent" value="dynamic" <?php echo $data['day4_2_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day4_2_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day4_2_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day4_2_sent" id="day4_2_sent" value="<?php echo $data['day4_2_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day4_2_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day4_2_sent_dynamic_time" id="day4_2_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day4_2_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day4_2_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day4_2_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day4_2_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day4_2_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day4_2_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day4_2_sent_text" name="day4_2_sent_text" aria-invalid="false"><?php echo $data['day4_2_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_2_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_2_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_2_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_2_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day4_2_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day5 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day5_1" data-type="fixed" id="rd_day5_1_sent_fixed" name="rd_day5_1_sent" value="fixed" <?php echo $data['day5_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day5_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day5_1" data-type="dynamic" id="rd_day5_1_sent_dynamic" name="rd_day5_1_sent" value="dynamic" <?php echo $data['day5_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day5_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day5_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day5_1_sent" id="day5_1_sent" value="<?php echo $data['day5_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day5_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day5_1_sent_dynamic_time" id="day5_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day5_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day5_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day5_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day5_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day5_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day5_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day5_1_sent_text" name="day5_1_sent_text" aria-invalid="false"><?php echo $data['day5_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day5_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day5_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day5_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day5_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day5_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="my_box" >
                <div class="my_box_heading">
                    <div style="float: left;">Day7 SMS (first)</div>
                    <div style="float: right;" class="fade_icon"><i class="fa fa-plus"></i></div>
                </div>
                <div class="my_box_body">
                    <div style="overflow: auto;" class="form-group">
                        <div style="padding-right: 0px;" class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
                            <label class="form-lbl">Time : </label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <div>
                                <input type="radio" class="radio_group" data-id="day7_1" data-type="fixed" id="rd_day7_1_sent_fixed" name="rd_day7_1_sent" value="fixed" <?php echo $data['day7_1_sent']['is_active']=="1"?"checked":""; ?>>&nbsp;<label for="rd_day7_1_sent_fixed">Fixed Time</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="radio_group" data-id="day7_1" data-type="dynamic" id="rd_day7_1_sent_dynamic" name="rd_day7_1_sent" value="dynamic" <?php echo $data['day7_1_sent']['is_active']!="1"?"checked":""; ?>>&nbsp;<label for="rd_day7_1_sent_dynamic">Dynamic Time</label>
                            </div>
                            <input style="<?php echo $data['day7_1_sent']['is_active']!="1"?"display:none;":""; ?>" aria-invalid="false" name="day7_1_sent" id="day7_1_sent" value="<?php echo $data['day7_1_sent']['time']; ?>" class="form-control valid">
                            <select style="<?php echo $data['day7_1_sent']['is_active']=="1"?"display:none;":""; ?>"  name="day7_1_sent_dynamic_time" id="day7_1_sent_dynamic_time" class="form-control valid">
                                <option value="0" <?php echo $data['day7_1_sent']['dynamic_time']==0?"selected":""; ?>>Instant</option>
                                <option value="60" <?php echo $data['day7_1_sent']['dynamic_time']==60?"selected":""; ?>>After 1 hour</option>
                                <option value="120" <?php echo $data['day7_1_sent']['dynamic_time']==120?"selected":""; ?>>After 2 hour</option>
                                <option value="180" <?php echo $data['day7_1_sent']['dynamic_time']==180?"selected":""; ?>>After 3 hour</option>
                                <option value="240" <?php echo $data['day7_1_sent']['dynamic_time']==240?"selected":""; ?>>After 4 hour</option>
                                <option value="300" <?php echo $data['day7_1_sent']['dynamic_time']==300?"selected":""; ?>>After 5 hour</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" style="clear: both; overflow: auto;">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                            <label class="form-lbl">SMS Text</label>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control valid" id="day7_1_sent_text" name="day7_1_sent_text" aria-invalid="false"><?php echo $data['day7_1_sent']['sms_text']; ?></textarea>
                        </div>  
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 token_text">
                            <div><a style="cursor: pointer" onclick="addDefaultText('day7_1_sent_text','[MERCHANTS NAME]')">[MERCHANTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day7_1_sent_text','[AGENTS NAME]')">[AGENTS NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day7_1_sent_text','[COMPANY NAME]')">[COMPANY NAME]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day7_1_sent_text','[AMOUNT REQUESTED]')">[AMOUNT REQUESTED]</a></div>
                            <div><a style="cursor: pointer" onclick="addDefaultText('day7_1_sent_text','[USE OF FUNDS]')">[USE OF FUNDS]</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>                    
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <input type="hidden" value="<?php echo $pipedriver_api_key['id']; ?>" name="hid_is_edit" id="hid_is_edit">
                <input type="hidden" value="<?php echo $first_time; ?>" name="is_first_time" id="is_first_time">
                <?php if ($first_time == 1): ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Save & Continue</button>
                <?php else: ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <?php endif; ?>
                <input id="btn_cancel" type="button" class="btn white-btn" value="Cancel">
            </div>
        </form>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_api_key: "required"
            },
            messages: {
                txt_api_key: "Please enter api key"

            }
        });

        $("#btn_cancel").click(function () {
            $("#txt_api_key").val($("#hid_api_key").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
        .my_box{
            border: 1px solid #1294d5; border-radius: 4px; margin-bottom: 10px;
        }
        .my_box_heading{
            padding: 6px; overflow: auto; background-color: #1294d5; color: white;cursor:pointer;
        }
        .my_box_body{
            padding-top: 14px;display: none;
        }
        
        .token_text a{
            color: #3498db;
        }
    </style>


</div>

