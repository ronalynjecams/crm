$(document).ready(function() {
    // get the data from php
	var cc=0;
	var passeddata = [];
	$("textarea.data").each(function(){
		cc++;
		passeddata[cc] = JSON.parse($(this).val());
	});
	
	// render data to pie
	var cnt=0;
	$("div.PiePendingApproved").each(function(){
		cnt++;
		var dataSet = passeddata[cnt];
        $.plot(this, dataSet, {
            series: {
                pie: {
                    show: true,
                    radius:1,
                    label: {
                        show:true,
                        radius: 3/4,
                        background: { 
                            opacity: 0.5,
                            color: 'white'
                        }
                    }
                }
            },
            legend: {
            show: false
            }
        });
    });
});