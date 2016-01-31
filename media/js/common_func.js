var current;
$.fn.deleteData = function (e) {
    var t, n, r, i, s, o, u, a, f, l,clb=false,clf;
    $(this).click(function (c) {
        c.preventDefault();
        if (e.type == undefined) {
            t = "GET"
        } else {
            t = e.type
        }
        if (e.url == undefined) {
            n = "ajax/ajax.php"
        } else {
            n = e.url
        }
        if (e.data == undefined) {
            r = "ajaxcall=true"
        } else {
            r = e.data
        }
        if (e.mod == undefined) {
            i = "ajaxPluginDelete"
        } else {
            i = e.mod
        }
        if (e.datum == undefined) {
            s = $(this).attr("data")
        } else {
            s = e.datum
        }
        if (e.process == undefined) {
            u = "<img src='admin/media/img/ajax-loaders/ajax-loader-1.gif' />"
        } else {
            u = e.process
        }
		if(e.dataOnDeleted != undefined)
		{
			clf=e.dataOnDeleted;
			clb=true;
		}
        if (confirm("Sure you want to Delete")) {
            o = $(this).html();
            $(this).html(u);
            $.ajax({
                type: t,
                url: n,
                data: r + "&mod=" + i + "&datum=" + s,
                success: function (e) {
                    f = s.split(";");
                    l = f[f.length - 1];
					
						a = $.parseJSON(e);
						if (a.status == "OK") {
							$("#" + l).hide()
						} else if (a.status == "CONFIRM") {
							alert(a.msg)
						} else if (a.status == "NOT") {
							alert(a.msg)
						} else {
							alert("Unknown , Uncaught Exceptions")
						}
						$("#deleted_" + l).html(o);
						if(clb == true)
						{
							clf(e);
						}
                }
            })
        } else {
            return false
        }
    })
};


$.fn.checkUniqRecord = function (e) {
    var t, n, r, i, s, o, u;
    $(this).click(function (o) {
        if (e.type == undefined) {
            t = "GET"
        } else {
            t = e.type
        }
        if (e.url == undefined) {
            n = "ajax.php"
        } else {
            n = e.url
        }
        if (e.data == undefined) {
            r = "ajaxcall=true"
        } else {
            r = e.data
        }
        if (e.mod == undefined) {
            i = "checkUniqRecord"
        } else {
            i = e.mod
        }
        if (e.datum == undefined) {
            s = $(this).attr("data")
        } else {
            s = e.datum
        }
        $.ajax({
            async: false,
            type: t,
            url: n,
            data: r + "&mod=" + i + "&" + s,
            success: function (t) {
                datumObj = $.parseJSON(t);
                if (datumObj.status == "OK") {
                    e.dataUnique("Record is Unique", o)
                } else if (datumObj.status == "NO") {
                    o.preventDefault();
                    e.dataNotUnique("Record is Not Unique", o)
                }
            }
        })
    })
};





$.fn.sTabs = function (e) {
	$("#sTabsContent").children().hide();
	current=$.jStorage.get("current");
	if(current == "rules" || current == "picks" || current == "feed" || current == "standing" || current == "shop" || current == "news" || current == "nsc" || current == "account")
	{
		//Make any assumption from php end and set it into jStorage
		if($("#paymentCompleted")==true) {  }//Show payment success page that is Invoice 
		else 
		{
			$("#sTabsContent").children("#"+current).show(); 
			$("#sTabs ul li").removeClass("active");
			$("#sTabs ul li a#mainMenu_"+current).parent("li").addClass("active");
			
		}
		
	}
	else
	{
		if($("#sTabs ul li.active a").attr("href")!=undefined)
		{
			current=$("#sTabs ul li.active a").attr("href");
			current=current.replace("#","");
			$("#sTabsContent").children("#"+current).show();
		}
		else
		{
			$("#sTabsContent").children(":first").show();
		}
	}
	$(".container #sTabsContent .logoutBtm").show();
	
		$("#sTabs ul li a").click(function (c) {
			$("#beingprocessed").show();
			c.preventDefault();
			c.stopPropagation();
			current=$(this).attr("href");
			if(current!=undefined)
			{
				$("#sTabs ul li").removeClass("active");
				$(this).parent("li").addClass("active");
				$("#sTabsContent").children().hide();
				current=current.replace("#","");
				$.jStorage.set("current", current);
				$("#sTabsContent").children("#"+current).fadeIn(1000).animate({
						duration: 'slow',
						easing: 'easeOutElastic'
					});
			}
			$(".container #sTabsContent .logoutBtm").show();
			$("#beingprocessed").hide();
			
		});	
};




//function to keep tab on my picks
$.fn.srtoTabs = function (e) {
	$("#srtoTabsContent").children().hide();
	if($("ul#srtoTabs li a.selected").attr("href")!=undefined)
	{
		current=$("ul#srtoTabs li a.selected").attr("href");
		current=current.replace("#","");
		$("#srtoTabsContent").children("#"+current).show();
	}
	else
	{
		$("#srtoTabsContent").children(":first").show();
	}

    $("ul#srtoTabs li a").click(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this).attr("href");
		if(current!=undefined)
		{
			$("ul#srtoTabs li a").removeClass("selected");
			$(this).addClass("selected");
			$("#srtoTabsContent").children().hide();
			current=current.replace("#","");
			$("#srtoTabsContent").children("#"+current).fadeIn(1000).animate({
                    duration: 'slow',
                    easing: 'easeOutElastic'
                });
		}
		
    })
};



$.fn.srtoSelectTabs = function (e) {
    $("#selectedTabs").change(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this[this.selectedIndex]).val();
		$("#srtoTabsContent").children().hide();
		current=current.replace("#","");
		$("#srtoTabsContent").children("#"+current).fadeIn(1000).animate({
				duration: 'slow',
				easing: 'easeOutElastic'
			});
    });	
};







//### function ui for standing page
$.fn.srStngtoTabs = function (e) {
	$("#srStngtoTabsContent").children().hide();
	if($("#srStngtoTabs ul li a.selected").attr("href")!=undefined)
	{
		current=$("#srStngtoTabs ul li a.selected").attr("href");
		current=current.replace("#","");
		$("#srStngtoTabsContent").children("#"+current).show();
	}
	else
	{
		$("#srStngtoTabsContent").children(":first").show();
	}

    $("#srStngtoTabs ul li a").click(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this).attr("href");
		if(current!=undefined)
		{
			$("#srStngtoTabs ul li a").removeClass("selected");
			$(this).addClass("selected");
			$("#srStngtoTabsContent").children().hide();
			current=current.replace("#","");
			$("#srStngtoTabsContent").children("#"+current).fadeIn(1000).animate({
                    duration: 'slow',
                    easing: 'easeOutElastic'
                });
		}
		
    })
};


//### function ui for standing page On select box as responsive
$.fn.srStngtoSelectTabs = function (e) {
    $("#srStngSelectedTabs").change(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this[this.selectedIndex]).val();
		$("#srStngtoTabsContent").children().hide();
		current=current.replace("#","");
		$("#srStngtoTabsContent").children("#"+current).fadeIn(1000).animate({
				duration: 'slow',
				easing: 'easeOutElastic'
			});
    })
};




















	
	
	




//function Tab management of Account Tab
$.fn.srActToTabs = function (e) {
$("#srActToTabsContent").children().hide();
current=$.jStorage.get("currentAccountTab");
if(current == "at1" || current == "at2" || current == "at3")
{
	//Make any assumption from php end and set it into jStorage
	$("#srActToTabsContent").children("#"+current).show(); 
	$("ul#srActToTabs li a").removeClass("selected");
	$("ul#srActToTabs li a#accountMenu_"+current).addClass("selected");
}
else
{
	
	
	if($("ul#srActToTabs li a.selected").attr("href")!=undefined)
	{
		current=$("ul#srActToTabs li a.selected").attr("href");
		current=current.replace("#","");
		$("#srActToTabsContent").children("#"+current).show();
	}
	else
	{
		$("#srActToTabsContent").children(":first").show();
	}
	
}
    $("ul#srActToTabs li a").click(function (c) {
		c.preventDefault();
		c.stopPropagation();
		$(".hideOnClickonAnyTab").hide();
		current=$(this).attr("href");
		if(current!=undefined)
		{
			$("ul#srActToTabs li a").removeClass("selected");
			$(this).addClass("selected");
			$("#srActToTabsContent").children().hide();
			current=current.replace("#","");
			$.jStorage.set("currentAccountTab", current);
				
			
			$("#srActToTabsContent").children("#"+current).fadeIn(1000).animate({
                    duration: 'slow',
                    easing: 'easeOutElastic'
                });
		}
		
    })
};


//Small Device Selected option from drop-down
$.fn.srActToSelectTabs = function (e) {
    $("#srActToselected").change(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this[this.selectedIndex]).val();
		$("#srActToTabsContent").children().hide();
		current=current.replace("#","");
		$("#srActToTabsContent").children("#"+current).fadeIn(1000).animate({
				duration: 'slow',
				easing: 'easeOutElastic'
			});
    });	
};
//END function Tab management of Account Tab
