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
    setTimeout(function () {
        getEmailNotification();
    }, 10000);
    setTimeout(function () {
        getDealStatus();
    }, 15000);
}
var all_load_deal = [];
function getDealStatus() {    
    var need_to_load_deal = [];
    $(".status-open").each(function (){
        var cur_deal_id = $(this).data("deal-id");
        if(all_load_deal.indexOf(cur_deal_id)=='-1' && need_to_load_deal.length<30){
            need_to_load_deal.push(cur_deal_id);
            all_load_deal.push(cur_deal_id);
        }
    });
    console.log(need_to_load_deal);
    console.log(all_load_deal);
    if(need_to_load_deal.length>0)
        setSequenceStatusIcon(need_to_load_deal)
    setTimeout(function () {
        getDealStatus();
    }, 15000);
}
function setSequenceStatusIcon(need_to_load_deal){
    $.ajax({
        url: 'https://leadpropel.com/admin/deal_seq_status',
        data: {need_to_load_deal: need_to_load_deal},
        type: 'POST',
        dataType: 'json',
        success: function (r) {            
            $(".status-open").each(function (){
                var cur_deal_id = $(this).data("deal-id");
                if(need_to_load_deal.indexOf(cur_deal_id)!='-1'){
                    if(r[cur_deal_id]!=""){
                        myhtml = '<div style="position:absolute;bottom: 0;right: 5px;"><img style="height:20px;z-index:1000;" src="'+r[cur_deal_id]+'" /></div>';                                            
                    }else{
                        myhtml = '';
                    }
                    $(this).prepend(myhtml);
                    need_to_load_deal.push(cur_deal_id);
                    all_load_deal.push(cur_deal_id);
                }
            });

        }
    });
}

function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  if ("withCredentials" in xhr) {

    // Check if the XMLHttpRequest object has a "withCredentials" property.
    // "withCredentials" only exists on XMLHTTPRequest2 objects.
    xhr.open(method, url, true);

  } else if (typeof XDomainRequest != "undefined") {

    // Otherwise, check if XDomainRequest.
    // XDomainRequest only exists in IE, and is IE's way of making CORS requests.
    xhr = new XDomainRequest();
    xhr.open(method, url);

  } else {

    // Otherwise, CORS is not supported by the browser.
    xhr = null;

  }
  return xhr;
}

function getEmailNotification(){
    console.log('a');
    var xhr = createCORSRequest('GET', 'https://leadpropel.com/admin/email_tracking?pd_notifications=1');
    if (!xhr) {
      console.log('CORS not supported');
    }else{
        console.log('CORS supported');        
    }
    xhr.onload = function() {
         var responseText = xhr.responseText;
         res = jQuery.parseJSON(responseText);
         console.log(responseText);
         if(res.found=='1'){
             var msg = res.message;
             var lnk = res.message_link;
             var notification = new Notification('Wake Up!', {
                icon: 'https://leadpropel.com/admin/instance/front/media/img/lead-propel-logo.png',
                body: msg,
              });
              notification.onclick = function () {
                  window.open(lnk);      
                };
         }
         // process the response.
    };
    xhr.onerror = function() { console.log('There was an error!'); };
    xhr.send();
    setTimeout(function () {
        getEmailNotification();
    }, 10000);
}


chrome.runtime.onMessage.addListener(
        function (request, sender, sendResponse) {
            if (request.message === "clicked_browser_action") {
                var firstHref = $("a[href^='http']").eq(0).attr("href");
                chrome.runtime.sendMessage({"message": "open_new_tab", "url": firstHref});
            }
        }
);

document.addEventListener('DOMContentLoaded', function () {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
});
function loadMyButton() {
    if (Notification.permission !== "granted")
            Notification.requestPermission();
        
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