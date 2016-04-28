zm.FMatching = {
    idxUrl : "http://idx.me.zing.vn",
    fmUrl : "http://findfriend.me.zing.vn/matcher",
    friend_url : "http://me.zing.vn/jfr",
    provider : null,
    bxHandler : null,
    mytimerhandle : null,
    time : 0,
    mytime : 1000,
    bxProgress : null, 
    bxFriendList : null,
    PROGRESS_BAR_WIDTH : 288, 
    debug : true,
    nnotfriend : 0,
    count1 : 0,
    count2 : 0,
    source : "friend_invite", // default
    cb : null,
    checkall: true,
    bxFeed : null, 
    intervalID: null,
    iID: null,
    source_id: null,
    defaultMessage : "Tham gia mạng xã hội Zing Me với mình nhé.",
    init : function () {
        zm("#txtContent").change(function () {
            zm.FMatching.validateFeedBoxyContent();
        });
        
        zm('#find_friend_feed_msg_id').click(function() {
            this.focus();
        }).focus(function() {
            if (this.value == zm.FMatching.defaultMessage)
                this.value = '';
        }).blur(function() {
            if (this.value == '')
                this.value = zm.FMatching.defaultMessage;
        });
    },
    initBoxy : function () {
        if (zm.FMatching.bxHandler == null) {
            zm.FMatching.bxHandler = new zm.Boxy({
                title :"Tìm kiếm bạn bè từ mạng " + zm.FMatching.provider,
                autoFocus: false,
                contentClass:"lbx_widmid",
                modal: true,
                setPosition:function(){
                    this.moveTo("center", "center");
                },
                footer : false,
                closeButton : true
            });
        }
    },
    showProgress : function(percent) {
        if (percent > 100 || percent < 0) {
            return;
        }
        if (zm.FMatching.bxProgress == null) {
            zm.FMatching.bxProgress = new zm.Boxy({
                title: 'Tìm kiếm bạn bè từ mạng ' + zm.FMatching.provider,
                modal: true,
                setPosition:function(){
                    this.moveTo("center", "center")
                },
                contentClass:"lbx_widsml",
                content : '<div class="netsearchfrd_module"><div class="searchfrd_loaderbox"><div class="zme_loadingbar"><p class="zme_ldpertxt">Đang tìm <strong><span id="progressLabel"></span></strong></p><div class="zme_ldbar_border"><span id="progressBar" class="zme_progressbar"></span></div></div></div></div>',
                footer: false,
                closeButton : true
            });
        }
        if (zm.FMatching.bxProgress != null) {
            zm.FMatching.bxProgress.changeSettings({
                title: 'Tìm kiếm bạn bè từ mạng ' + zm.FMatching.provider
            });
            zm.FMatching.bxProgress.show();
        }
        zm('#progressBar').css('width', Math.floor(zm.FMatching.PROGRESS_BAR_WIDTH * percent / 100) + 'px');
        zm('#progressLabel').text(percent + '%');
        if (percent == 100) {
            setTimeout(function() {
                try {
                    zm.FMatching.bxProgress.hide();
                    zm.FMatching.bxProgress = null;
                    zm.FMatching.time = 0;
                } catch (err) {}
            }, 500);
        }
    },
    doProcess : function () {
        zm.FMatching.showProgress(0);
        zm.FMatching.setTimer();
    },
    openPopup : function (provider) {
        setTimeout(function() {
            var zmxcid = zmXCall.getXCallID();
            var callback = zm.FMatching.fmUrl + "/callback?zmxcid=" + zmxcid;
            var url = zm.FMatching.idxUrl + "/oauth/dialog?provider="+provider+"&callback="  + encodeURIComponent(callback) + "&t=" + Math.floor(Math.random()*10000);
            var newWindow = window.open(url,'_blank','height=500,width=500,left=400, top=180','resizable=yes','scrollbars=no','toolbar=no','status=no');
            return newWindow;
        }, 500);
    },
    openYahooPopup : function () {
        zm.FMatching.provider = "Yahoo";
        return zm.FMatching.openPopup(zm.FMatching.provider.toLowerCase());
    },
    openGooglePopup : function () {
        zm.FMatching.provider = "Google";
        return zm.FMatching.openPopup(zm.FMatching.provider.toLowerCase());
    },
    openFacebookPopup : function () {
        zm.FMatching.provider = "Facebook";
        return zm.FMatching.openPopup(zm.FMatching.provider.toLowerCase());
    },
    openTwitterPopup : function () {
        zm.FMatching.provider = "Twitter";
        return zm.FMatching.openPopup(zm.FMatching.provider.toLowerCase());
    },
    pushFeedToWall : function (friends) {
        var message = zm('#find_friend_feed_msg_id').val();
        var inviteUrl = zm.FMatching.fmUrl + "/invite";
        zmCore.getJSON(inviteUrl, {
            'provider' : zm.FMatching.provider,
            'message' : message,
            'friends' : friends,
            'source' : zm.FMatching.source
        }, function(resp){
            zm.FMatching.bxFeed.hide();
            zm("#find_friend_feed_boxy_id").remove();
            zm.FMatching.alertFinish();
        });
    },
    showPushFeedBoxy : function(provider, friends) {
        var content = '';
        content += '<div id="find_friend_feed_boxy_id">';
        content +=      '<div class="makefrdrowinfo">';
        content +=          '<div class="avtmakefrd">';
        content +=              '<strong>';
        content +=                  '<span id="feed_avatar_id_' + zmConfig.viewerId + '" >';
        content +=                  '</span>';
        content +=              '</strong>';
        content +=          '</div>';
        content +=          '<div class="infomakefrd">'
        content +=              'Hãy mời bạn bè của bạn tham gia mạng xã hội <strong>Zing Me - Mạng xã hội và giải trí online</strong>';
        content +=          '</div>';
        content +=      '</div>';
        content +=      '<div class="makefrdrowinfo">';
        content +=          '<p><span class="fl f12"><strong>Viết lời nhắn</strong></span><span class="fr">Giới hạn <span class="txtredmakefrd"><strong id="countmakeFriend">300</strong></span> ký tự</span><br class="clr"></p>';
        content +=          '<textarea id="find_friend_feed_msg_id" name="find_friend_feed_msg_id" class="textarea_makefrd">';
        content +=              zm.FMatching.defaultMessage;
        content +=          '</textarea>';
        content +=      '</div>';
        content += '</div>';
      
        zm.FMatching.bxFeed = new zm.Boxy({
            title: 'Đăng lên tường nhà ' + provider,
            content: content,
            modal: true,
            footer: true,
            closeButton : true,
            contentClass: "lbx_widmid",
            setPosition:function(){
                this.moveTo("center", "center");
            },
            okButton: "Đăng lên tường",
            onOk: function () {
                var valid = zm.FMatching.validateFeedBoxyContent();
                if (valid == false) {
                    return false;
                }
                zm.FMatching.pushFeedToWall(friends);
                return false;
            },
            cancelButton : "Bỏ qua", 
            onCancel: function () {
                zm("#find_friend_feed_boxy_id").remove();
                zm.FMatching.alertCancel();
            }, 
            onClose : function () {
                zm("#find_friend_feed_boxy_id").remove();
                zm.FMatching.alertCancel();
            }
        });
        if (zm.FMatching.bxFeed != null) {
            zwg.addWgItem(new wgItem("feed_avatar_id_" + zmConfig.viewerId, "ZMEA_" + zmConfig.viewerId +"?l=2&m=1&id=1"));
            zwg.fillWg();
            zm.FMatching.bxFeed.show();
            zm.FMatching.init();
        }
    },
    showInviteBoxy : function () {
        if (zm.FMatching.bxProgress != null) {
            zm.FMatching.bxProgress.hide();
            zm.FMatching.bxProgress = null;
            zm.FMatching.time = 0;
        }
        if (zm.FMatching.count2 > 0) {
            zm("#not_friend_ids_id").remove();
            zm("#no_zid_contacts_id").show();
        } else {
            zm.FMatching.alertFinish();
        }
        return;
    },
    makeFriend : function () {
        var obj = zm("#not_friend_ids_id .checkBR"); 
        var l = new Array();
        obj.each(function (){
            this.checked && l.push(zm(this).val());
        });
        if(l.length == 0 && zm.FMatching.nnotfriend > 0)
        {
            zm.Boxy.alert("Vui lòng chọn bạn bè để kết bạn.","Thông báo", 3000,{
                okButton: 'Đóng'
            });
            return;
        }
        var list = l.join(',');
        var source = 124; // default is yahoo
        var p = zm.FMatching.provider.toLowerCase();
        if (p == "google") {
            source = 125;
        } else if (p == "facebook") {
            source = 126;
        }
        if (list.length > 0) {
	    if (zm.FMatching.source == "find_friend_from_id" || zm.FMatching.source == "box_suggestion_wlc" || zm.FMatching.source == "find_friend_from_yblog") {
		var url = zm.FMatching.fmUrl + "/makefriend?list=" + list;
		zmCore.getJSON(url,function(content) {
		    // process response here
                });
	    } else {
		var url = zm.FMatching.friend_url + "/act/iaddrequest?list=" + list + "&source=" + source + "&cb=?";
		zmCore.getJSON(url,function(content) {
		    // process response here
                });
	    }
        }
        zm.FMatching.showInviteBoxy();
    },
    sendInvite : function () {
        var obj = zm("#no_zid_contacts_id .checkBR"); 
        var l = new Array();
        obj.each(function (){
            this.checked && l.push(zm(this).val());
        });
        if(l.length == 0)
        {
            zm.Boxy.alert("Vui lòng chọn bạn bè để gửi lời mời.","Thông báo", 3000,{
                okButton: 'Đóng'
            });
            return;
        }
        var friends = l.join(',');
        var provider = zm.FMatching.provider.toLowerCase();
        if (provider == "facebook" || provider == "twitter") {
            zm.FMatching.hideFriendListBoxy();
            zm.FMatching.showPushFeedBoxy(provider, friends);
        } else {
            if (zm.FMatching.source == "find_friend_from_yblog") {
	      sendYhmail(friends,'2');
	    } else {		  
		  var total=l.length;
		  var limit=100;
		  var part = parseInt(total/limit);
		  if (total%limit>0) part++;
		  for(i=0;i<part;i++){
		      from = i*limit;
		      end = (i+1)*limit;
		      friends = l.slice(from,end).join(',');
		      var inviteUrl = zm.FMatching.fmUrl + "/invite";
		      zmCore.getJSON(inviteUrl, {
			  'provider' : zm.FMatching.provider,
			  'friends' : friends,
			  'source' : zm.FMatching.source
		      }, function(resp){});
		  }		  
	    }
	    zm.FMatching.alertFinish();
        }
    }, 
    checkAll : function (divId) {
        if (zm.FMatching.checkall == true) {
            zm('#' + divId + ' input').attr('checked', '');
            zm.FMatching.checkall = false;
        } else {
            zm('#' + divId + ' input').attr('checked', 'checked');
            zm.FMatching.checkall = true;
        }
    }, 
    setTimer : function () {
        if(zm.FMatching.mytimerhandle != null) {
            zm.FMatching.stopTimer();
        }
        zm.FMatching.mytimerhandle = setTimeout("zm.FMatching.getStatusFindFriends()", zm.FMatching.mytime);
    }, 
    stopTimer : function () {
        clearTimeout(zm.FMatching.mytimerhandle);
    },
    getStatusFindFriends : function () {
        if (zm.FMatching.intervalID != null) {
            clearInterval(zm.FMatching.intervalID);
        }
        zm.FMatching.intervalID = setInterval( function () {
            zm.FMatching.time++;
            zm.FMatching.showProgress(zm.FMatching.time);
            if (zm.FMatching.time == 100) {
                clearInterval(zm.FMatching.intervalID);
                var message = "Quá trình kết nối với " + zm.FMatching.provider + " bị lỗi. Vui lòng thử lại.";
                zm.FMatching.alertErrorMessage(message);
                return;
            }
        }, 100);
	
        var viewerId = zmConfig.viewerId;
        var src = zm.FMatching.source;
        var requestUrl = zm.FMatching.fmUrl + "/matching?uid=" + viewerId + "&src=" + src + "&t=" + Math.floor(Math.random()*10000);
        zmCore.getJSON(requestUrl, {}, function(data) {
            if (zm.FMatching.iID != null) {
                clearInterval(zm.FMatching.iID);
            }
            zm.FMatching.iID = setInterval(function() {
                if (zm.FMatching.time < 100) {
                    clearInterval(zm.FMatching.intervalID);
                    clearInterval(zm.FMatching.iID);
                    if (data.error != 0) {
                        var msg1 = "Quá trình kết nối với " + zm.FMatching.provider + " bị lỗi. Vui lòng thử lại.";
                        zm.FMatching.alertErrorMessage(msg1);    
                        return;
                    }
                    if (data.count1 == 0 && data.count2 == 0) {
                        var msg2 = "Danh bạ của bạn hiện đang rỗng. Vui lòng thử với tài khoản khác.";
                        zm.FMatching.alertErrorMessage(msg2);
                        return;
                    }
                    zm.FMatching.nnotfriend = data.nnotfriend;
                    zm.FMatching.count1 = data.count1;
                    zm.FMatching.count2 = data.count2;
		    zm.FMatching.source_id = data.source_id;
                    if (data.count1 > 0) {
                        zm.FMatching.showProgress(100);
			 if (src == "find_friend_from_yblog") {
			    var url = zm.FMatching.fmUrl + "/makefriend?list=" + data.strIds;
			    zmCore.getJSON(url,function(content) {
				// process response here
			    });
			} else {
			    setTimeout(function() {
				zm.FMatching.showFriendListBoxy(data.content);
				var wCount = 0;
				var arr = data.strIds.split(",");
				for (var i = 0; i < arr.length; i++) {
				    var id = arr[i];
				    zwg.addWgItem(new wgItem("avatar_id_" + i,"ZMEA_" + id +"?l=2&m=1&id=1"));
				    zwg.addWgItem(new wgItem("full_name_id_" + i,"ZMED_" + id +"?l=2&id=1"));
				    wCount++;
				    if (wCount == 50) {
					zwg.fillWg();
					wCount = 0;
				    }
				}
				zwg.fillWg();
			    }, 500);
			    return;
			}
                    }
                    zm.FMatching.showFriendListBoxy(data.content);
                    zm.FMatching.showInviteBoxy();
                }
            }, 1000);
        });
        return;
    },
    hideFriendListBoxy : function () {
        if (zm.FMatching.bxFriendList != null) {
            zm.FMatching.bxFriendList.hide();
            zm.FMatching.bxFriendList = null;
            zm("#not_friend_ids_id").remove();
            zm("#no_zid_contacts_id").remove();
        }
    },
    alertFinish : function () {
        zm.FMatching.hideFriendListBoxy();
        if (zm.FMatching.bxProgress != null) {
            zm.FMatching.bxProgress.hide();
            zm.FMatching.bxProgress = null;
        }
        zm.FMatching.nnotfriend = 0;
        zm.FMatching.count1 = 0;
        zm.FMatching.count2 = 0;
        zm.FMatching.time = 0;
	if (window.fmDoFinish) {
	    fmDoFinish(zm.FMatching.provider, 1, zm.FMatching.source_id);
	} else if (window.fmDoFinishPush) {
            fmDoFinishPush(zm.FMatching.provider, 1);
        } else {
            zm.FMatching.alertMessage("Quá trình tìm bạn bè từ mạng " +zm.FMatching.provider+ " hoàn tất.");
        }
    },
    isValidDomain : function(domain) {
        if (domain == undefined) {
            return false;
        }
        if (domain == null || domain == "") {
            return false;
        }
        // validate domain
        var reg = new RegExp();
        reg.compile("^[A-Za-z]+://[A-Za-z0-9-_]+\\.[A-Za-z0-9-_%&\?\/.=]+$");
        if (!reg.test(domain)) {
            return false;
        }
        return true;
    },
    reloadCallback : function() {
        if (zm.FMatching.isValidDomain(zm.FMatching.cb) == true) {
            window.location = zm.FMatching.cb;
        }
    },
    alertMessage : function (content) {
        var tmp = new zm.Boxy({
            title: 'Thông báo',
            content: content,
            setPosition:function(){
                this.moveTo("center", "center");
            },
            okButton : "Đóng", 
            onOk: function () {
                zm.FMatching.reloadCallback();
            }, 
            onClose : function () {
                zm.FMatching.reloadCallback();
            }
        });
        if (tmp != null) {
            tmp.show();
        }
        setTimeout(function() {
            if (tmp != null) {
                tmp.hide();
            }
            zm.FMatching.reloadCallback();
        }, 3000);
    },
    alertCancel : function () {
        zm.FMatching.hideFriendListBoxy();
        if (zm.FMatching.bxProgress != null) {
            zm.FMatching.bxProgress.hide();
            zm.FMatching.bxProgress = null;
        }
        zm.FMatching.nnotfriend = 0;
        zm.FMatching.count1 = 0;
        zm.FMatching.count2 = 0;
        zm.FMatching.time = 0;
	if (window.fmDoFinish) {
	    fmDoFinish(zm.FMatching.provider, 0, zm.FMatching.source_id);
	} else if (window.fmDoFinishPush) {
            fmDoFinishPush(zm.FMatching.provider, 0);
        } else {
            zm.FMatching.alertMessage("Bạn đã hủy bỏ việc chia sẻ thông tin qua mạng " +zm.FMatching.provider+ ".");
        }
    }, 
    alertErrorMessage : function (message) {
        zm.Boxy.alert(message,"Thông báo", 3000,{
            okButton: 'Đóng',
            setPosition:function(){
                this.moveTo("center", "center");
            }
        });
        if (zm.FMatching.bxProgress != null) {
            zm.FMatching.bxProgress.hide();
            zm.FMatching.time = 0;
        }
    },
    showFriendListBoxy : function (content) {
        zm.FMatching.bxFriendList = new zm.Boxy({
            title :"Tìm kiếm bạn bè từ mạng " + zm.FMatching.provider,
            autoFocus: false,
            contentClass:"lbx_widmid",
            content : content,
            setPosition:function(){
                this.moveTo("center", "180");
            },
            footer : false,
            closeButton : true,
            onClose: function () {
                zm("#not_friend_ids_id").remove();
                zm("#no_zid_contacts_id").remove();
            }
        });
        if (zm.FMatching.bxFriendList != null) {
            zm.FMatching.bxFriendList.show();
            zm("#not_friend_ids_id").show();
            zm("#no_zid_contacts_id").hide();
        }
    }, 
    validateFeedBoxyContent : function ()  {
        var msg = zm("#find_friend_feed_msg_id").val();
        var len = msg.length;
        if (msg == "" || msg == undefined) {
            zm.Boxy.alert("Vui lòng nhập nội dung tin nhắn.","Thông báo", 3000,{
                okButton: 'Đóng',
                setPosition:function(){
                    this.moveTo("center", "center");
                }
            });
            zm("#find_friend_feed_msg_id").focus();
            return false;
        }
        if (len > 300) {
            zm.Boxy.alert("Nội dung tin nhắn không được vượt quá 300 ký tự.","Thông báo", 3000,{
                okButton: 'Đóng',
                setPosition:function(){
                    this.moveTo("center", "center");
                }
            });
            zm("#find_friend_feed_msg_id").focus();
            return false;
        }
        return true;
    }
};

zm.ready(function(){
    zwgConf.avaWidth = 50;
    zwgConf.avaHeight = 50;
    zm.FMatching.init();
    
    zm('#btnFindFriendFromYahoo').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromYahoo').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromYahoo').attr("href");
        zm.FMatching.openYahooPopup();
    });
    zm('#btnFindFriendFromGoogle').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromGoogle').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromGoogle').attr("href");
        zm.FMatching.openGooglePopup();
    });
    zm('#btnFindFriendFromFacebook').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromFacebook').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromFacebook').attr("href");
        zm.FMatching.openFacebookPopup();
    });
    
    zm('#btnFindFriendFromYahoo2').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromYahoo2').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromYahoo2').attr("href");
        zm.FMatching.openYahooPopup();
        return false;
    });
    zm('#btnFindFriendFromGoogle2').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromGoogle2').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromGoogle2').attr("href");
        zm.FMatching.openGooglePopup();
    });
    zm('#btnFindFriendFromFacebook2').click(function(e){
        e.preventDefault();
        zm.FMatching.source = zm('#btnFindFriendFromFacebook2').attr("rel");
        zm.FMatching.cb = zm('#btnFindFriendFromFacebook2').attr("href");
        zm.FMatching.openFacebookPopup();
    });
}); 
