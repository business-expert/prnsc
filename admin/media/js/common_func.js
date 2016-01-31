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
            u = "<img src='media/img/ajax-loaders/ajax-loader-1.gif' />"
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


//function to keep tab on my picks
$.fn.srtoTabs = function (e) {
	$("#srtoTabsContent").children().hide();
	if($("#srtoTabs ul li.active a").attr("href")!=undefined)
	{
		current=$("#srtoTabs ul li.active a").attr("href");
		current=current.replace("#","");
		$("#srtoTabsContent").children("#"+current).show();
	}
	else
	{
		$("#srtoTabsContent").children(":first").show();
	}

    $("#srtoTabs ul li a").click(function (c) {
		c.preventDefault();
		c.stopPropagation();
		current=$(this).attr("href");
		if(current!=undefined)
		{
			$("#srtoTabs ul li").removeClass("active");
			$(this).parent("li").addClass("active");
			$("#srtoTabsContent").children().hide();
			current=current.replace("#","");
			$("#srtoTabsContent").children("#"+current).fadeIn(1000).animate({
                    duration: 'slow',
                    easing: 'easeOutElastic'
                });
		}
		
    })
};