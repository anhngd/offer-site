var zmLightBox = {
	DEF_IFFILTER_VAL: "Nhập tên cần tìm",
	doRequest: function(url, method, data, success, error) {
		if (location.host == 'me.zing.vn')
			zm[method](url, data, {dataType: 'json'}, success, error);
		else {
			if (url.indexOf('http://') < 0)
				url = 'http://me.zing.vn' + url;
			if (url.indexOf('?') < 0)
				url += '?';
			else
				url += '&';
			if (data)
				url += zm.param(data) + '&cb=?';
			else
				url += 'cb=?';
			zm.getJSON(url, success);
		}
	},
	pokefriend: function (a, b) {
		var EVENT = zmConfig.EVENT == 'event' ? zmConfig.EVENT : '',
			BOXY_BANNER = (EVENT && zmConfig.EVENT_BANNER) ? zmConfig.IMAGE_URL + '/v3/images/event/' + zmConfig.EVENT_BANNER : '';
		zmLightBox.doRequest(a, 'post', null, function (a) {
			switch (a.type) {
				case "confirm":
					zm.Boxy.confirm(a.content, function () {
						var a = zmLightBox.checkMessageContent();
						if (a) zmLightBox.submitPokeFriend();
						else return false
					}, {
						title: b,
						okButton: b,
						cancelButton: "Đóng",
						header: BOXY_BANNER ? '<p><img width="445" src="' + BOXY_BANNER + '" /></p>' : '',
						contentClass: "lbx_widmid " + EVENT
					});
					break;
				case "alert":
					zm.Boxy.alert(a.content, b, 4e3);
					break;
				default:
					break
			}
		}, function () {
			zm.Boxy.alert("Có lỗi xảy ra, vui lòng nhấn F5 để refresh trang", "Thông báo")
		})
	},
	submitPokeFriend: function () {
		var a = zm("#cboPoke").val(),
			b = zm("#chkview").val(),
			c = zm("#url").val();
			
		var EVENT = zmConfig.EVENT == 'event' ? zmConfig.EVENT : '',
			BOXY_BANNER = (EVENT && zmConfig.EVENT_BANNER) ? zmConfig.IMAGE_URL + '/v3/images/event/' + zmConfig.EVENT_BANNER : '';	
		zmLightBox.doRequest(c, 'post', {cboPoke: a, chkview: b, isPost: true}, function (a) {
//			zm.Boxy.alert(a.content, "Chọc ghẹo")
			zm.Boxy.alert(a.content, 'Chọc ghẹo', null, {
						header: BOXY_BANNER ? '<p><img width="445" src="' + BOXY_BANNER + '" /></p>' : '',
						okButton: 'Đóng',
						contentClass: 'lbx_widmid ' + EVENT
					}
				);
		})
	},
	checkMessageContent: function () {
		if (zm("#content").val() != null && zm.trim(zm("#content").val()) == "") {
			zm.Boxy.alert("Vui lòng nhập nội dung tin nhắn!", "Thông Báo", "2000");
			return false
		} else return true
	},
	subcribe: function (a, b, c) {
		if (parseInt(zmConfig.viewerId) <= 0) {
			zm.Boxy.alert("Bạn vui lòng&nbsp;<a href=\"http://login.me.zing.vn?ref="+location.href+"\">Đăng nhập</a>&nbsp;để thực hiện chức năng này.", "Thông báo");
			return false
		}
		zm.post(a, {}, {
			dataType: "json",
			timeout: 5e3
		}, function (a) {
			if (a.status == "success") {
				zm(b).removeClass("btn_newprofile");
				zm(b).attr('onclick','').unbind('click');
				zm(b).html("<em style='float:left; margin:3px 10px 0 0'>" + a.content + "</em>");
				if (c != "viplist") {
					if (a.from == "fp"){
						setTimeout(function () {window.location = a.link},4000);
					}
					else if (a.from == "pi") window.location=zmConfig.ME_URL+"/pi/"+zmConfig.ownerName+"?updatefan=on";
					else if (a.from == "promotef") {
						zm('.sggpage .sggp_actbtn').show();
						zm(b).remove();
					} else {
						setTimeout(function () {window.location = zmConfig.PROFILE_URL + "/" + zmConfig.ownerName;},4000);
					}
				}
			} else {
				zm.Boxy.alert(a.content, a.title, 4e3)
			}
		}, function (a, b) {
			zm.Boxy.alert("Có lỗi xảy ra, vui lòng nhấn F5 để refresh trang", "Thông báo")
		})
	},
	deleteSubscribe: function (a, id) {
		var b = zm(a).attr("rel");
		zm.post(b, {}, {dataType: "json"}, function (b) {
			if (b.error == 0) {
				zm(a).html("<em>" + b.msg + "</em>");
				if(id && typeof id != 'undefined') {
					delete listVipJS[id];
					zm('.unlike_' + id).html("<em>" + b.msg + "</em>");
				}
			} else {
				zm.Boxy.alert('<div style="width:200px">' + b.msg + "</div>")
			}
		})
	},

	afterMakeFriend:function(res){
		if(res.error==0)
		{
			zm(".mt8").html("<em>Đã gởi yêu cầu kết bạn</em>");
			zm("#rmf").css("display", "none");
		}
	},

	reportAbuse: function (a, b) {
		zm.get(a, {
			dataType: "json"
		}, function (a) {
			if (a.type == "confirm") {
				zm.Boxy.confirm(a.content, function () {
					zmLightBox.acceptReportAbuse()
				}, {
					title: b,
					okButton: "Gởi",
					cancelButton: "Đóng",
					boxyClass: "pu_large pu_report"
				})
			} else {
				zm.Boxy.alert(a.content, "", 4e3)
			}
		})
	},
	acceptReportAbuse: function () {
		var a = "";
		zm("[name=abusetype]").each(function () {
			if (this.checked) {
				a += zm(this).val() + ","
			}
		});
		var b = zm("#txtabusecontent").val(),
		c = zm("#frmreport").attr("action");
		var cateid = zm("#category_id").val();
		zm.post(c, {
			content: b,
			abusetype: a,
			isPost: true,
			cateid: cateid
		}, {
			dataType: "json"
		}, function (a) {
			zm.Boxy.alert(a.content, "Báo profile xấu")
		})
	},
	introFriend: function (a, b) {
		zm.post(a, {}, {
			dataType: "json",
			timeout: 5e3
		}, function (a) {
			switch (a.type) {
				case "confirm":
					if (!zmLightBox.ifBoxy) {
						zmLightBox.ifBoxy = new zm.Boxy({
							title: b,
							okButton: b,
							content: '<div class="fl"><p class="font12 mbt10"><input type="checkbox" class="checkbox checkBR" id="ifcheckall"><span class="marl5"><label for="ifcheckall"> Chọn tất cả</label> <span id="iftotalcheck"></span></span></p>\n</div><div style="position: relative;" class="search-fr"><input  class="sharefrd" type="text" value="Nhập tên cần tìm" id="iffilter"><a href=""></a><img style="display: none; position: relative; right: 15px;" src="http://img.me.zdn.vn/v3/images/loadingi.gif" id="ifloading"></div><div class="clr"></div>' + a.content,
							cancelButton: "Đóng",
							contentClass: "lbx_widlar",
							onOk: function () {
								return zmLightBox.submitIntroFriend()
							}
						})
					} else {
						zmLightBox.ifBoxy.setContent('<div class="fl"><p class="font12 mbt10"><input type="checkbox" class="checkbox checkBR" id="ifcheckall"><span class="marl5"><label for="ifcheckall"> Chọn tất cả</label> <span id="iftotalcheck"></span></span></p>\n</div><div style="position: relative;" class="search-fr"><input  class="sharefrd" type="text" value="Nhập tên cần tìm" id="iffilter"><a href=""></a><img style="display: none; position: relative; right: 15px;" src="http://img.me.zdn.vn/v3/images/loadingi.gif" id="ifloading"></div><div class="clr"></div>' + a.content)
					}
					zm("#iffilter").click(function () {
						this.focus()
					}).focus(function () {
						if (this.value == zmLightBox.DEF_IFFILTER_VAL) this.value = ""
					}).blur(function () {
						if (!this.value) this.value = zmLightBox.DEF_IFFILTER_VAL
					}).keyup(function (a) {
						if (zmLightBox.ifFilterTimeout) clearTimeout(zmLightBox.ifFilterTimeout);
						var b = a.keyCode == 27;
						zmLightBox.ifFilterTimeout = setTimeout(function () {
							zmLightBox.filterIntroFriend(b)
						}, 400)
					});
					zm("#ifcheckall").click(function () {
						var a = zm("#lsFID").css("display") != "none" ? zm("#lsFID li .checked") : zm("#lsFIDF li .checked");
						if (this.checked) {
							a.show();
							zm("#iftotalcheck").html("| Đang chọn <strong>" + a.size() + "</strong> người")
						} else {
							a.hide();
							zm("#iftotalcheck").html("")
						}
					});
					zmLightBox.ifBoxy.show();
					break;
				case "alert":
					zm.Boxy.alert(a.content, a.title, 4e3);
					break;
				default:
					break
			}
		}, function (a) {
			zm.Boxy.alert("Có lỗi xảy ra, vui lòng nhấn F5 để refresh trang", "Thông báo")
		})
	},
	// Gioi thieu app den nhieu ban
	introFriendApp: function (url, title, applink, appname, apptype) {
		zm.post(url, {apl:applink, apn:appname, apt:apptype}, {
			dataType: "json",
			timeout: 5e3
		}, function (a) {
			switch (a.type) {
				case "confirm":
					if (!zmLightBox.ifBoxy) {
						zmLightBox.ifBoxy = new zm.Boxy({
							title: title,
							okButton: title,
							content: '<div class="fl"><p class="font12 mbt10"><input type="checkbox" class="checkbox checkBR" id="ifcheckall"><span class="marl5"><label for="ifcheckall"> Chọn tất cả</label> <span id="iftotalcheck"></span></span></p>\n</div><div style="position: relative;" class="search-fr"><input  class="sharefrd" type="text" value="Nhập tên cần tìm" id="iffilter"><a href=""></a><img style="display: none; position: relative; right: 15px;" src="http://img.me.zdn.vn/v3/images/loadingi.gif" id="ifloading"></div><div class="clr"></div>' + a.content,
							cancelButton: "Đóng",
							contentClass: "lbx_widlar",
							onOk: function () {
								return zmLightBox.submitIntroFriend()
							}
						})
					} else {
						zmLightBox.ifBoxy.setContent('<div class="fl"><p class="font12 mbt10"><input type="checkbox" class="checkbox checkBR" id="ifcheckall"><span class="marl5"><label for="ifcheckall"> Chọn tất cả</label> <span id="iftotalcheck"></span></span></p>\n</div><div style="position: relative;" class="search-fr"><input  class="sharefrd" type="text" value="Nhập tên cần tìm" id="iffilter"><a href=""></a><img style="display: none; position: relative; right: 15px;" src="http://img.me.zdn.vn/v3/images/loadingi.gif" id="ifloading"></div><div class="clr"></div>' + a.content)
					}
					zm("#iffilter").click(function () {
						this.focus()
					}).focus(function () {
						if (this.value == zmLightBox.DEF_IFFILTER_VAL) this.value = ""
					}).blur(function () {
						if (!this.value) this.value = zmLightBox.DEF_IFFILTER_VAL
					}).keyup(function (a) {
						if (zmLightBox.ifFilterTimeout) clearTimeout(zmLightBox.ifFilterTimeout);
						var b = a.keyCode == 27;
						zmLightBox.ifFilterTimeout = setTimeout(function () {
							zmLightBox.filterIntroFriend(b)
						}, 400)
					});
					zm("#ifcheckall").click(function () {
						var a = zm("#lsFID").css("display") != "none" ? zm("#lsFID li .checked") : zm("#lsFIDF li .checked");
						if (this.checked) {
							a.show();
							zm("#iftotalcheck").html("| Đang chọn <strong>" + a.size() + "</strong> người")
						} else {
							a.hide();
							zm("#iftotalcheck").html("")
						}
					});
					zmLightBox.ifBoxy.show();
					break;
				case "alert":
					zm.Boxy.alert(a.content, a.title, 4e3);
					break;
				default:
					break
			}
		}, function (a) {
			zm.Boxy.alert("Có lỗi xảy ra, vui lòng nhấn F5 để refresh trang", "Thông báo")
		})
	},
	// Gioi thieu app den 1 ban
	introApp2Friend: function (url, friendid, title, applink, appname, apptype) {
		zm.post(url, {friendid: friendid, apl:applink, apn:appname, apt:apptype}, {
			dataType: "json",
			timeout: 5e3
		}, function (data) {
			zm.Boxy.alert(data.content, title);
		});
		return true;
	},
	resetIfBoxy: function () {
		zm("#lsFID li .checked").hide();
		zm("#lsFIDF").html("");
		zm("#iftotalcheck").html("");
		zm("#ifcheckall").attr("checked", false);
		this.filterIntroFriend(true);
		zm("#iffilter").val(zmLightBox.DEF_IFFILTER_VAL)
	},
	introFriendMore: function (a) {
		zm.post(a, {}, {
			dataType: "json",
			timeout: 5e3
		}, function (a) {
			zm('#lsFID .hBtnC').remove();
			var endpoint = zm("#lsFID br").before(a.content);
			endpoint.remove();
			zmLightBox.filterIntroFriend()
		}, function () {
			zm.Boxy.alert("Có lỗi xảy ra, vui lòng nhấn F5 để refresh trang", "Thông báo")
		})
	},
	filterIntroFriend: function (a) {
		var b = zm("#iffilter");
		if (a) b.val("");
		var c = zm.trim(b.val());
		if (c && c != zmLightBox.DEF_IFFILTER_VAL) {
			var d = "http://search.me.zing.vn/friend/select?fl=userid&wt=json&q=friendids:" + zmConfig.viewerId + "%20AND%20pft_fullname:" + encodeURIComponent(c) + "&start=0&rows=100&json.wrf=?";
			zm("#ifloading").show();
			zm.getJSON(d, function (a) {
				if (a && c == zm.trim(zm("#iffilter").val())) {
					var b = "";
					for (var d = 0, e; e = a.response.docs[d]; d++) {
						var f = e.userid,
						g = "ifava_" + f,
						h = "ifn_" + f;
						b += '<li id="ifriend-' + f + '" onclick="zmLightBox.checkIntroFriend(this);">\n\t\t\t\t\t\t\t\t<span class="avatar" id="' + g + '"></span>\n\t\t\t\t\t\t\t\t<div class="user"> <span id="' + h + '"></span></div><div class="checked" style="display:none;"> </div>\n\t\t\t\t\t\t\t</li>';
						zwg.addItem(g, "ZMEA_" + f + "?id=1&size=50&width=42&height=42&l=0");
						zwg.addItem(h, "ZMED_" + f + "?id=1&l=0")
					}
					if (b == "") b = "Không tìm thấy bạn bè nào.";
					zm("#lsFID").hide();
					zm("#lsFIDF").html(b).show();
					zwg.fillWg();
					zm("#ifloading").hide()
				}
			})
		} else {
			zm("#lsFID").show();
			zm("#lsFIDF").hide()
		}
	},
	submitIntroFriend: function () {
		var friend = this.getCheckedIntroFriend();
		if (!friend) {
			zm.Boxy.alert("Bạn chưa chọn bạn bè để chia sẻ", "Thông báo");
			return false
		}

		var apn = zm("#apn").val();
		var apt = zm("#apt").val();
		var apl = zm("#apl").val();
		var b = zm("#urlsm").val();
		zm.post(b, {
			friend: friend,
			apn: apn,
			apt: apt,
			apl: apl,
			signkey: zmConfig.signkey,
			time: zmConfig.time
		}, {
			dataType: "json",
			timeout: 5e3
		}, function (a) {
			zm.Boxy.alert(a.content, "Thông báo")
		});
		return true
	},
	getCheckedIntroFriend: function () {
		var a = new Array,
		b = zm("#lsFID").css("display") != "none" ? zm("#lsFID li") : zm("#lsFIDF li");
		b.each(function () {
			var b = zm(this);
			if (b.css("display") != "none") {
				if (b.children(".checked").size() && b.children(".checked").css("display") != "none") a.push(b.attr("id").substr(8))
			}
		});
		return a.join(",")
	},
	checkIntroFriend: function (a) {
		var b = zm(a).children(".checked"),
		c = zm.intval(zm("#iftotalcheck strong").html());
		if (b.css("display") != "none") {
			b.hide();
			c--
		} else {
			b.show();
			c++
		}
		var d = "";
		if (c > 0) d = "| Đang chọn <strong>" + c + "</strong> người";
		zm("#iftotalcheck").html(d);
		var e = zm("#lsFID").css("display") != "none" ? zm("#lsFID li .checked").size() : zm("#lsFIDF li .checked").size();
		zm("#ifcheckall").attr("checked", c == e)
	},
	init: function () {
		zm("#zm_ps").click(function () {
			if (parseInt(zmConfig.viewerId) <= 0) {
				zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
				return false
			}
			var a = zm(this).parent().attr("rel");
			zmLightBox.subcribe(a, this, "");
			return false
		});
		zm("#idSubcribe").click(function () {
			if (parseInt(zmConfig.viewerId) <= 0) {
				zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
				return false
			}
			var a = zm(this).attr("rel");
			zmLightBox.subcribe(a, this, "");
			return false
		});
		zm("#idPoke").click(function () {
			if (parseInt(zmConfig.viewerId) <= 0) {
				zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
				return false
			}
			var a = this;
			if (a.nodeName.toLowerCase() != "a") a = a.parentNode;
			var b = zm(a),
			c = b.attr("rel"),
			d = b.attr("title");
			zmLightBox.pokefriend(c, d);
			return false
		});

	},
	acceptFriend: function (a) {
		zm.Boxy.alert(a, "Kết bạn", 4e3, {
			beforeHide: function () {
				window.location.reload()
			}
		})
	}
};
zmLightBox.init();
zm.ready(function () {
	zm("#zm_pmf").click(function () {
		if (parseInt(zmConfig.viewerId) <= 0) {
			zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
			return false
		}
		var a = zm(this).parent().attr("rel");
		var b = zm(this).parent().attr("source");
                var h = zm(this).parent().attr("h");
		zmFriendRequests.sendMakeFriendRequest(a, {}, {
			check_avatar: 1,
                        h: h,
			source: b
		});
		return false
	});
	zm("#idMakeFriend").click(function () {
		if (parseInt(zmConfig.viewerId) <= 0) {
			zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
			return false
		}
		var a = zm(this).attr("rel");
		var b = zm(this).attr("source");
                var h = zm(this).attr("h");
		zmFriendRequests.sendMakeFriendRequest(a, {}, {
			check_avatar: 1,
                        h: h,
			source: b
		});
		return false
	});
	zm("#idAbuse").click(function () {
		if (parseInt(zmConfig.viewerId) <= 0) {
			zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
			return false
		}
		var a = zm(this).attr("rel");
		var b = zm(this).attr("title");
		zmLightBox.reportAbuse(a, b);
		return false
	});
	zm("#idIntro").click(function () {
		if (parseInt(zmConfig.viewerId) <= 0) {
			zm.Boxy.alert("Bạn vui lòng đăng nhập để thực hiện chức năng này.", "Thông báo");
			return false
		}
		var a = this;
		if (a.nodeName.toLowerCase() != "a") a = a.parentNode;
		var b = zm(a),
		c = b.attr("rel"),
		d = b.attr("title");
		zmLightBox.introFriend(c, d);
		return false
	});
	if (typeof zmPAvaSrc != "undefined") {
		var a = 1,
		b, c, d, e = false;

		function f() {
			if (e) return;
			b = 0;
			e = true;
			var f = setInterval(function () {
				b += 20;
				var h = Math.floor(c * Math.sin(b / 200 * (Math.PI / 2)) * a) + (a == 1 ? g : d);
				if (h >= d) h = d;
				if (h <= g) h = g;
				zm("#avar-pf").css("height", h + "px");
				if (h >= d || h <= g) {
					clearInterval(f);
					a *= -1;
					a == 1 ? zm("#ava-zoom").removeClass("ava-zoomout") : zm("#ava-zoom").addClass("ava-zoomout");
					e = false
				}
			}, 20)
		}
		var g = 300,
		h = new Image;
		h.onload = function () {
			d = h.height;
			if (d > g) {
				zm("#avar-pf").css("height", g + "px").show();
				c = d - g;
				zm("#avar-pf").append('<a id="ava-zoom" href="#"></a>');
				zm("#ava-zoom").click(function () {
					f();
					return false
				})
			} else zm("#avar-pf").show()
		};
		h.src = zmPAvaSrc;
		zm("#avar-pf img").attr("src", zmPAvaSrc)
	}
});

