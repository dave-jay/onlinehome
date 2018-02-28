<div class="uk-section section-sub-nav uk-padding-remove-bottom">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-2-3">
                <ul class="uk-breadcrumb uk-visible">
                    <li><a href="<?php echo _U ?>home">Home</a></li>
                    <li><span>Sequence Basic</span></li>
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
                <article class="uk-article">
                    <header>
                        <h1 id='animation-repeat' class="uk-article-title uk-margin-bottom">What is Automated Sequence?</h1>                        
                    </header>
                    <div class="entry-content uk-margin-medium-top">
                        <p class="uk-text-lead">Automated Sequence is tool that sends the sequence of SMS and Email to customers on specific time.</p>
                        <h2>How Sequence is working?</h2>
                        <p>
                            When any new deal comes sequence starts automatically on specific time. also when deal comes into app-out stage, then sms and email sequence start.
                        </p>
                        <h2 id="sequence_start_stop">How to start and stop sequence?</h2>
                        <p>
                            We can start and stop sequence as per following.
                        </p>
                        <ol class="ol-pretty uk-list-large">
                            <!--<li>
                                App Level Sequence start or stop<br>
                                <div><img style="margin-top:18px;border:3px solid #F9F9F9;box-shadow: 0 3px 20px rgba(0, 0, 0, 0.3);" src="<?php echo _MEDIA_URL ?>faqTheme/assets/img/app_seq.png"></div>
                            </li>-->
                            <li>
                                Deal Specific sequence start or stop
                                <div><img style="margin-top:18px;border:3px solid #F9F9F9;box-shadow: 0 3px 20px rgba(0, 0, 0, 0.3);" src="<?php echo _MEDIA_URL ?>faqTheme/assets/img/deal_seq.png"></div>
                            </li>                            
                        </ol>                        
                        <h2 id='sequence_hold' >How to hold sequence?</h2>
                        <p>
                            If you want to hold sequence for specific time, you can set date from pipedrive                            
                        </p>
                        <ul class="uk-list-large">
                            <li>
                                 set date into 'Hold Followup Sequence Until' for specific deal<br>
                                <div><img style="margin-top:18px;border:3px solid #F9F9F9;box-shadow: 0 3px 20px rgba(0, 0, 0, 0.3);" src="<?php echo _MEDIA_URL ?>faqTheme/assets/img/hold_seq.png"></div>
                            </li>
                        </ul>                        
                       
                    </div>

              
                    <div class="reply uk-margin-medium-top border-top padding-top">
                        <h3 class="uk-margin-medium-bottom">Leave a Comment</h3>
                        <form class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-2">
                                <input class="uk-input" type="text" placeholder="Name">
                            </div>
                            <div class="uk-width-1-2">
                                <input class="uk-input" type="email" placeholder="Email">
                            </div>
                            <div class="uk-width-1-1">
                                <textarea class="uk-textarea" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="uk-width-1-1">
                                <button class="uk-button uk-button-primary uk-width-1-1 uk-width-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
            <div class="uk-width-1-4">
                <div uk-sticky="offset: 100" class="scrollspy uk-sticky uk-active uk-card uk-card-small uk-card-body uk-padding-remove-top uk-visible">
                    <h3 class="uk-card-title">Table of Contents</h3>
                    <ul class="uk-nav uk-nav-default" uk-scrollspy-nav="closest: li; scroll: true; offset: 30">
                        <li><a href="#animation-repeat">Sequence Basic</a></li>
                        <li><a href="#sequence_start_stop">Sequence Start/Stop</a></li>
                        <li><a href="#sequence_hold">Sequence Hold</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>