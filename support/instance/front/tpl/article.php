<?php include _PATH."instance/front/controller/common_search.inc.php";?>
<div class="uk-section section-sub-nav uk-padding-remove-bottom">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-2-3">
                <ul class="uk-breadcrumb uk-visible">
                    <li><a href="<?php echo _U ?>home">Home</a></li>
                    <li><span>List Of the Article</span></li>
                </ul>
            </div>
            <div class="uk-width-1-3">
                <div class="uk-margin">
                    <form class="uk-search uk-search-default">
                        <a href="" class="uk-search-icon-flip" uk-search-icon></a>
                        <input id="autocomplete" class="uk-search-input" type="search" autocomplete="off" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div class="border-top"></div>
    </div>
</div>

<div class="uk-section uk-section-small uk-padding-remove-bottom section-content">
    <div class="uk-container uk-position-relative">
        <div uk-grid>
            <div class="uk-width-3-4">
                <article class="uk-article uk-padding-remove-bottom">                    
                    <div class="entry-content uk-margin-medium-top ">
                        <h2 id="animation-basic">Basic Information</h2>
                        <p>Automated Sequence is tool that sends the sequence of SMS and Email to customers on specific time. When any new deal comes sequence starts automatically on specific time. also when deal comes into app-out stage, then sms and email sequence start. </p>
                        <h2 id="animation-1"><li>Initial Sequence</li></h2>
                        <p>When any new deals comes, Initial Sequence sends sms and emails to customer on specific time.</p>
                        <a class="right" href="<?php echo _U ?>article_initial_seq" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-2"><li>App-Out Sequence</li></h2>
                        <p>When deals comes into the 'app-out' stage, App-Out Sequence sends sms and emails to customer on specific time.</p>
                        <a class="right" href="<?php echo _U ?>article_appout_seq" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-3"><li>Start Sequence</li></h2>
                        <p>When any new deal comes sequence starts automatically on specific time. also when deal comes into app-out stage, then sms and email sequence start. </p>
                        <a class="right" href="<?php echo _U ?>article_seq_basic#sequence_start_stop" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-4"><li>Stop Sequence</li></h2>
                        <p>set 'Follow-Up Sequence' flag to 'OFF' from deal details to stop sequence.(Note: It will start automatically if the deal stage is change)</p>
                        <a class="right" href="<?php echo _U ?>article_seq_basic#sequence_start_stop" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-5"><li>Hold Sequence</li></h2>
                        <p>If you want to hold sequence for specific time, you can set date from pipedrive. set date into 'Hold Followup Sequence Until' for specific deal</p>
                        <a class="right" href="<?php echo _U ?>article_seq_basic#sequence_hold" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-6"><li>Initail Sequence Timing</li></h2>
                        <p>Initail Sequence for SMS and Email is fixed. It sends SMS and Emails on the specific time.</p>
                        <a class="right" href="<?php echo _U ?>article_initial_seq" style="float: right;"><span>Read More</span></a>

                        <h2 id="animation-7"><li>App-Out Sequence Timing</li></h2>
                        <p>App-Out Sequence for SMS and Email Time is fixed. It sends SMS and Emails on the specific time.</p>
                        <a class="right" href="<?php echo _U ?>article_appout_seq" style="float: right;"><span>Read More</span></a>
                </article>
            </div>
            <div class="uk-width-1-4">
                <div uk-sticky="offset: 100" class="scrollspy uk-sticky uk-active uk-card uk-card-small uk-card-body uk-padding-remove-top uk-visible">
                    <h5 class="uk-card-title">List Of Article</h5>

                    <div style="margin: 0px;padding: 0px;width: 100%;
                         height: 255px;overflow-x: hidden;">
                        <ul class="uk-nav uk-nav-default" uk-scrollspy-nav="closest: li; scroll: true; offset: 30">
                            <li><a href="#animation-basic">Basic Information</a></li>
                            <li><a href="#animation-1">Initial Sequence</a></li>
                            <li><a href="#animation-2">App Out Sequence</a></li>
                            <li><a href="#animation-3">Start Sequence</a></li>
                            <li><a href="#animation-4">Stop Sequence</a></li>
                            <li><a href="#animation-5">Hold Sequence</a></li>
                            <li><a href="#animation-6">Initial Sequence Timing</a></li>
                            <li><a href="#animation-7">App Out Sequence Timing</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>