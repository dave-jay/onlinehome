window.onload = function () {
    setTimeout(function () {
        loadMyButton();
    }, 5000);
    setTimeout(function () {
        loadMyAudioControl();
    }, 5000);
    setTimeout(function () {
        loadAllAudioControl();
    }, 5000);
    setTimeout(function () {
        loadCallControl();
    }, 5000);
}



chrome.runtime.onMessage.addListener(
        function (request, sender, sendResponse) {
            if (request.message === "clicked_browser_action") {
                var firstHref = $("a[href^='http']").eq(0).attr("href");
                chrome.runtime.sendMessage({"message": "open_new_tab", "url": firstHref});
            }
        }
);
function loadMyButton() {
    if (typeof $(".actions .stateActions").attr("class") != 'undefined' && typeof $("#my-message-btn").attr("id") == 'undefined') {
        var button = document.createElement("button");
        var text = document.createTextNode("Send Text");
        button.appendChild(text);
        button.setAttribute("id", "my-message-btn");
        button.setAttribute("class", "my-custom-btn");
        $(".actions .stateActions").append(button);
        document.getElementById('my-message-btn').addEventListener('click', openMyCustomPopup);
    }
    setTimeout(function () {
        loadMyButton();
    }, 5000);
}
function loadMyAudioControl() {
    if (typeof $(".icon-call").attr("class") != 'undefined') {
        var idOfCallRecord = '';
        $(".icon-call").each(function e() {
            $(this).parent().find(".contentHtml span").each(function e() {
                var mybtn = $(this);
                if (typeof mybtn.attr("class") == 'undefined' || mybtn.attr("class") == '') {
                    $.each(this.attributes, function () {
                        if (this.specified) {
                            if (this.name.indexOf("call-recording-id-") >= 0) {
                                idOfCallRecord = this.name.substring(18, 28);

                                var button = document.createElement("iFrame");
                                button.setAttribute("src", "https://www.leadpropel.com/admin/playAudio?call_detail_id=" + idOfCallRecord);
                                button.setAttribute("width", "380");
                                button.setAttribute("height", "110");
                                button.setAttribute("data-id", idOfCallRecord);
                                mybtn.html(button);
                                mybtn.attr("class", "set");
                            }
                        }
                    });
                }
            });
        });
    }
    setTimeout(function () {
        loadMyAudioControl();
    }, 5000);
}

function loadAllAudioControl() {
    if (typeof $(".organizationFields").attr("class") != 'undefined' || typeof $(".personFields").attr("class") != 'undefined') {
        var availableSection;
        if (typeof $(".organizationFields").attr("class") != 'undefined'){
            availableSection = $(".organizationFields");
        }else{
            availableSection = $(".personFields");
        }
        var dealId = window.location.href.substring(window.location.href.lastIndexOf("deal/")+5);
        var HtmlContents = "<div class='custom-leadpropel-intelligence'><iframe style='width:100%;height:100%;' src='https://www.leadpropel.com/admin/custom-intelligence?dealId="+dealId+"'></iframe></div>";
        availableSection.before(HtmlContents);        
    }else{
        setTimeout(function () {
            loadAllAudioControl();
        }, 5000);
    }
}

function loadCallControl() {
    if (typeof $(".otherFields").attr("class") != 'undefined') {
        var availableSection = $(".otherFields");        
        var dealId = window.location.href.substring(window.location.href.lastIndexOf("deal/")+5);
        var HtmlContents = "<div data-state='read' class='widget fieldsView'>";
        HtmlContents += "<div class='fieldsList'>";
        HtmlContents += "<div class='visible'>";
        HtmlContents += "<div class='item' style='color: green;padding:12px 16px;'>";
        HtmlContents += "<div id='call-customer-btn' style='display: inline;cursor:pointer;'>";
        HtmlContents += "<span style='display: inline-block; transform: rotate(90deg); margin-top: 1px; color: green;' class='icon-call'></span>&nbsp;&nbsp;Call to Customer";
        HtmlContents += "</div>";
        HtmlContents += "</div>";
        HtmlContents += "</div>";
        HtmlContents += "</div>";
        HtmlContents += "</div>";
        availableSection.before(HtmlContents);
        document.getElementById('call-customer-btn').addEventListener('click', openCallToCustomerPopup);
    }else{
        setTimeout(function () {
            loadCallControl();
        }, 5000);
    }
}


function openMyCustomPopup() {
    if (typeof $("#topbar_popup").attr("id") == "undefined") {
        $('body').prepend('<div id="topbar_popup"></div>');
        $('#topbar_popup').load(chrome.extension.getURL("dialog.html"));
    } else {
        $("#popupbg").fadeIn("fast");
        $("#popupcontent").fadeIn("fast");
    }
    //chrome.runtime.sendMessage({type:'request_password'});
}

function openCallToCustomerPopup(){
    if (typeof $("#topbar_call_popup").attr("id") == "undefined") {
        $('body').prepend('<div id="topbar_call_popup"></div>');
        $('#topbar_call_popup').load(chrome.extension.getURL("call_to_customer.html"));
    } else {
        $("#popupbgcall").fadeIn("fast");
        $("#popupcontentcall").fadeIn("fast");
    }
}
function closeMyCustomPopup() {
    $("#popupbg").fadeOut("slow");
    $("#popupcontent").fadeOut("slow");
}
function closeMyCallToCustomerPopup() {
    $("#popupbgcall").fadeOut("slow");
    $("#popupcontentcall").fadeOut("slow");
}
function testpopup() {
    var myIFrame = document.getElementById("my-popup-iframe");
    var content = myIFrame.contentWindow.document.body.innerHTML;
}