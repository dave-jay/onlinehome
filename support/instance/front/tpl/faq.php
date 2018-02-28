<?php include _PATH."instance/front/controller/common_search.inc.php";?>
<div class="uk-section section-sub-nav uk-padding-remove-bottom">
    <div class="uk-container">
        <div uk-grid>
            <div class="uk-width-2-3">
                <ul class="uk-breadcrumb uk-visible">
                    <li><a href="<?php echo _U ?>home">Home</a></li>
                    <li><span href="">Frequently Asked Questions</span></li>
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
    <div class="uk-container">
        <div class="uk-grid-medium" uk-grid>
            <div class="uk-width-1-4 uk-visible text-dark sidebar">
                <div uk-sticky="offset: 50">
                    <h3>Table of Contents</h3>
                    <ul class="uk-list uk-list-large">
                        <li><a href="#target1" uk-scroll="offset: 50">General Questions</a></li>
                        <li><a href="#target2" uk-scroll="offset: 50">Before Journey</a></li>
                        <li><a href="#target3" uk-scroll="offset: 50">On Journey</a></li>
                        <li><a href="#target4" uk-scroll="offset: 50">After Journey</a></li>
                        <li><a href="#target5" uk-scroll="offset: 50">Technical Questions</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-3-4">
                <h1>Frequently Asked Questions</h1>
                <p class="uk-text-lead uk-margin-large-bottom">Here are answers to most common questions. Can't find an answer? Call us!</p>

                <h2 id="target1">General Questions</h2>
                <ul class="list-faq" uk-accordion="multiple: true">
                    <li>
                        <h3 class="uk-accordion-title">Transfer account ownership</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Shipping options page settings</h3>
                        <div class="uk-accordion-content">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eeprehenderit in voluptate velit esse cillum doloreu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Setting up product attributes</h3>
                        <div class="uk-accordion-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor eprehenderit in voluptate velit esse cillum dolore incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Downloadable product</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                </ul>

                <h2 id="target2">User Account</h2>
                <ul class="list-faq" uk-accordion="multiple: true">
                    <li>
                        <h3 class="uk-accordion-title">Manage payment settings and invoices</h3>
                        <div class="uk-accordion-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor eprehenderit in voluptate velit esse cillum dolore incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Pricing and plans guide</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Setting your company office hours</h3>
                        <div class="uk-accordion-content">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eeprehenderit in voluptate velit esse cillum doloreu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                        </div>
                    </li>
                </ul>

                <h2 id="target3">Shipping Methods</h2>
                <ul class="list-faq" uk-accordion="multiple: true">
                    <li>
                        <h3 class="uk-accordion-title">Shipping components</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Shipping options page settings</h3>
                        <div class="uk-accordion-content">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eeprehenderit in voluptate velit esse cillum doloreu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Customizing Forms</h3>
                        <div class="uk-accordion-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor eprehenderit in voluptate velit esse cillum dolore incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Increasing server memory</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                </ul>

                <h2 id="target4">Troubleshooting</h2>
                <ul class="list-faq" uk-accordion="multiple: true">
                    <li>
                        <h3 class="uk-accordion-title">Manage user comments</h3>
                        <div class="uk-accordion-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor eprehenderit in voluptate velit esse cillum dolore incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Multiple installs on one domain</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Fully Responsive Design</h3>
                        <div class="uk-accordion-content">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eeprehenderit in voluptate velit esse cillum doloreu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                        </div>
                    </li>
                </ul>
                <h2 id="target5">Technical Questions</h2>
                <ul class="list-faq" uk-accordion="multiple: true">
                    <li>
                        <h3 class="uk-accordion-title">Problems with booking online – what should I do?  </h3>
                        <div class="uk-accordion-content">
                            <p>

                                If you are experiencing problems with booking online, the problems are most likely due to your internet browser. You have the following options to solve the problem:

                                Use a different browser.
                                Empty your cache and delete your cookies and then restart your browser and try again.
                                Update your browser. We use very high security standards and our sites are optimized for new versions of browsers. you can find the latest versions of each browsers with the following links: <a href="https://www.mozilla.org/en-US/firefox/new/">Firefox</a> / <a href="https://support.microsoft.com/en-us/products/internet-explorer#touchweb=touchvidtab1">Internet Explorer </a>/ <a href="https://www.google.com/intl/en/chrome/browser/desktop/index.html">Google Chrome</a>

                                You have not received a confirmation email? Please check if the confirmation email has been sent to your spam folder.

                                If you have still not managed to find a solution to your problem, then please call <b>+00 (0)00 000 000 000</b>*. We are always happy to help you.
                            </p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Can I change, rebook or cancel my booking myself?  </h3>
                        <div class="uk-accordion-content">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eeprehenderit in voluptate velit esse cillum doloreu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Setting up product attributes</h3>
                        <div class="uk-accordion-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor eprehenderit in voluptate velit esse cillum dolore incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </li>
                    <li>
                        <h3 class="uk-accordion-title">Downloadable product</h3>
                        <div class="uk-accordion-content">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure eprehenderit in voluptate velit esse cillum dolore dolor reprehenderit.</p>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>