/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
/*DHX:Depend mobile.js*/
/*DHX:Depend mobile_recurring.css*/

(function(){

var labels = scheduler.locale.labels;
var xy = scheduler.xy;
var config = scheduler.config;
	
config.recurring = true;
config.endless_date = new Date(9999,1,1);
labels.recurring = {
	none:"Never",
	daily:"Daily",
	day:"day(s)",
	every:"Every",
	weekly: "Weekly",
	week:"week(s) on",
	each:"Each",
	on_day: "on the",
	monthly: "Monthly",
	month: "month(s)",
	month_day:"on what day of the month",
	week_day:"on what day of the week",
	yearly: "Yearly",
	year: "year(s) in",
	counters:["the first","the second","the third", "the fourth", "the fifth"],
	never:"Never",
	repeat:"Repeat",
	end_repeat:"End repeat",
	endless_repeat:"Endless repeat",
	end_repeat_label: "Repeat will end by"
};
xy.recurring = {
	label_end_repeat: 140,
	label_end_by: 240,
	label_every: 65,
	work_days:180
};


scheduler.templates.selected_event_old = scheduler.templates.selected_event;
scheduler.templates.selected_event = function(ev){
	if (!ev.rec_type)	
		return scheduler.templates.selected_event_old(ev);
	else{
		var id = $$("scheduler")._last_selected;
		if (!id || !id[1])
			return scheduler.templates.selected_event_old(ev);

		var sd = ev.start_date;
		var ed = ev.end_date;
		ev.start_date = new Date(id[1]*1000);
		ev.end_date = new Date(id[1]*1000+ev.event_length*1000);
				
		var html = scheduler.templates.selected_event_old(ev);

		ev.start_date = sd;
		ev.end_date = ed;
		return html;
	}
};

	
dhx.protoUI({
	name:"datecells",
	defaults:{
		x_count:7,
		cellHeight:36
	},
	_id:"dhx_d_c",
	$init:function(){
		this._dataobj = this._viewobj;
	},
	on_click:{
		dhx_cal_day_num:function(e,id){
			if(id)
			this.define("activeCell",id);
		}
	},
	activeCell_setter:function(id){
		this._settings.activeCell = id;
		this.render();
		return id;
	},
	render:function(){
		if(this.isVisible(this._settings.id)){
			var c = 1;
			var html = '<table cellspacing="0" cellpadding="0" class="dhx_rec_table"><tbody>';
			var obj = this._settings.data;
			var cellWidth = (this.$width/this._settings.x_count);
			
			for(var i in obj){
				var style = "";
				var className = "dhx_cal_day_num";
				if(cellWidth)
					style += ";width:"+cellWidth+"px";
				style += ";height:"+this._settings.cellHeight+"px;line-height:"+this._settings.cellHeight+"px;";
				if(c%this._settings.x_count==1)
					html += "<tr>";
				html += "<td>";
				
				if(this._settings.activeCell==i)
					className+=" dhx_cal_selected_day";
				
				html += "<div dhx_d_c='"+i+"' class='"+className+"' style='"+style+"'>"+obj[i]+"</div>";
				html += "</td>";
				if(c%this._settings.x_count===0)
					html += "</tr>";
		   		c++;
		  	}
			var top_style="overflow: hidden;";
		    html += "</tbody></table>";
			this._viewobj.innerHTML = html;
		}
	},
	$setSize:function(x,y){
    	if(dhx.ui.view.prototype.$setSize.call(this,x,y)){
    		this.render();
    	}
 	},
	setValue:function(value){
		this.define("activeCell",value);
	},
	getValue:function(){
		return this._settings.activeCell;
	}
}, dhx.MouseEvents, dhx.ui.view, dhx.EventSystem);





dhx.protoUI({
	name:"rectext",
	_setValue:function(value){
		this._settings.value = (value||"");
		var type = "none";
		var recView = this.getTopParent().$$("recurring");
		var arr = this._settings.value.split("_");
		if(arr[0]!=="")
			type = recView._settings.typeToId[arr[0]];
		this._settings.text = this._getBox().innerHTML = labels.recurring[type];
	}
}, dhx.ui.datetext);
dhx.protoUI({
	name:"endrec",
	_setValue:function(date){
		this._settings.value = (date||"");
		var recView = this.getTopParent().$$("recurring");
		var text;
		if(typeof date=="object"){
			if(date.valueOf()==recView._settings.endlessDate.valueOf())
				text = labels.recurring.never;
			else
				text = (this._settings.dateFormatStr||dhx.i18n.dateFormatStr)(this._settings.value);
		}
		this._settings.text = this._getBox().innerHTML = (text||this._settings.value);
	}
}, dhx.ui.datetext);

dhx.protoUI({
	name:"radiuslist",
	defaults:{
		padding:10
	},
	$init:function(){
		this.$view.className += " dhx_rounded";
	},
	$setSize:function(x,y){
		if (dhx.ui.view.prototype.$setSize.call(this,x,y)){
			if(this._settings.padding){
				//this.$view.style.padding = this._settings.padding+"px";
				this._dataobj.style.width = this._content_width-this._settings.padding*2+"px";
				this._dataobj.style.height = this._content_height-this._settings.padding*2+"px";
			}
		}
	},
	setValue:function(value){
		if(this.item(value))
			this.select(value);
	},
	getValue:function(){
		return this.getSelected();
	}
},dhx.ui.list);

/*dhx.ui.daily*/
dhx.protoUI({
	name:"daily",
	setValue:function(data){
		if(typeof data == "object"&&data[0]=="day"){
			  if(!data[1]||data[1]=="")
				data[1] = 1;
			this.setValues({dayCount:data[1]});
		}
	},
	getValue:function(){
		var data = this.getValues();
		return ["day",data["dayCount"],"","","",""];
	}
}, dhx.ui.form);

/*dhx.ui.weekly*/
dhx.protoUI({
	name:"weekly",
	setValue:function(data){
		if(typeof data == "object"&&data[0]=="week"){
			if(!data[1]&&data[1]=="")
				data[1] = 1;
		    if(!data[4]||data[4]=="")
				data[4] = (data[5].getDay()+6)%7+1;

			this.setValues({weekCount:data[1],weekDays:""+data[4]});
		}
	},
	getValue:function(){
		var data = this.getValues();
		if(!data["weekDays"])
			data["weekDays"] = 1;
		return ["week",data["weekCount"],"","",data["weekDays"],""];
	}
}, dhx.ui.form);

/*dhx.ui.monthly*/
dhx.protoUI({
	name:"monthly",
	setValue:function(data){
		if(typeof data == "object"&&data[0]=="month"){
			var topParent = this.getTopParent();
			if(!data[1]&&data[1]=="")
				data[1] = 1;
			if(data[2]&&data[2]!="")
				topParent.$$("typeWeekM").expand();
			else{
				data[2] = (data[5].getDay()+6)%7+1;
				data[3] = Math.ceil(data[5].getDate()/7);
			}	
			this.setValues({monthCount:data[1],weekDayM:data[2],weekCountM:data[3],monthDayM:data[5].getDate()});
		}
	},
	getValue:function(){
		var data = this.getValues();
		var res = ["month",data["monthCount"],"","","",""];
		var topParent = this.getTopParent();
		if(topParent.$$("typeDayM")._settings.collapsed){
		   res[2] = data["weekDayM"];
		   res[3] = data["weekCountM"];
		}
		else{
		   res[5] = data["monthDayM"];
		}
		return res;
	}
}, dhx.ui.form);

/*dhx.ui.yearly*/
dhx.protoUI({
	name:"yearly",
	setValue:function(data){
		if(typeof data == "object"&&data[0]=="year"){
			var topParent = this.getTopParent();
			if(!data[1]&&data[1]=="")
				data[1] = 1;
			if(data[2]!="")
				topParent.$$("typeWeekY").setValue(1);
			else{
				topParent.$$("typeWeekY").setValue(0);
				data[2] = (data[5].getDay()+6)%7+1;
				data[3] = Math.ceil(data[5].getDate()/7);
			}
			topParent.$$("typeWeekY").callEvent("onItemClick",[]);
			this.setValues({yearCount:data[1],weekDayY:data[2],weekCountY:data[3],monthDayY:data[5].getMonth()});
		}
	},
	getValue:function(){
		var data = this.getValues();
		var res = ["year",data["yearCount"],"","","",""];
		var topParent = this.getTopParent();
		if(topParent.$$("typeWeekY").getValue()){
		   res[2] = data["weekDayY"];
		   res[3] = data["weekCountY"];
		}
		res[5] = data["monthDayY"];
		return res;
	}
}, dhx.ui.form);


dhx.attachEvent("onAfterSchedulerInit", function(scheduler){
	/*scheduler.data.extraParser = dhx.bind(function(data){
		data.start_date	= dhx.i18n.fullDateFormatDate(data.start_date);
		data.end_date 	= dhx.i18n.fullDateFormatDate(data.end_date);
	},scheduler);*/

	dhx.delay(function(){
		scheduler.$$('editForm').define("dataFeed", function(data){
			data = dhx.fullCopy(this.getTopParent().item(data));
			if (data.rec_type){
				data.endRepeat = data.end_date;
				data.end_date = new Date(data.start_date.valueOf()+data.event_length*1000);
			}
			this.setValues(data);
		});	
		scheduler.$$('editForm').getValuesOld = scheduler.$$('editForm').getValues;
		scheduler.$$('editForm').getValues = function(){
			var data = this.getValuesOld();
			if (data.rec_type){
				data.event_length = Math.round((data.end_date - data.start_date) / 1000);
				data.end_date = data.endRepeat||data.end_date;
			}
			return data;
		};
	});
	

	scheduler.getEventsOld = scheduler.getEvents;
	scheduler.getEvents = function(from,to){
		to = to||dhx.Date.add(from, 1, "month");

		var evs = this.getEventsOld(from, to);
		var out = [];
		for (var i = 0; i < evs.length; i++){
			if (evs[i].rec_type)
				this.repeat_date(evs[i], out, from, to);
			else 
				out.push(evs[i]);
		}
		out.sort(function(a,b){
			a = a.start_date;
			b = b.start_date;
			return a>b?1:(a<b?-1:0);
		});
		return out;
	};

	scheduler._rec_markers = {};
	scheduler._rec_markers_pull = {};
	scheduler._add_rec_marker = function(ev,time){
		ev._pid_time = time;
		this._rec_markers[ev.id] = ev;
		if (!this._rec_markers_pull[ev.event_pid]) this._rec_markers_pull[ev.event_pid] = {};
		this._rec_markers_pull[ev.event_pid][time]=ev;
	};
	scheduler._get_rec_marker = function(time, id){
		var ch = this._rec_markers_pull[id];
		if (ch) return ch[time];
		return null;	 
	};
	scheduler._get_rec_markers = function(id){
		return (this._rec_markers_pull[id]||[]);	
	};

	scheduler.data.scheme({
		$init:function(data){
			if(typeof data.start_date == "string")
				data.start_date	= dhx.i18n.fullDateFormatDate(data.start_date);
			if(typeof data.end_date == "string")
				data.end_date 	= dhx.i18n.fullDateFormatDate(data.end_date);

			if (data.event_pid)
				scheduler._add_rec_marker(data, data.event_length*1000);
		}
	});
	

	scheduler.transponse_size={
		day:1, week:7, month:1, year:12 
	};
	scheduler.day_week=function(sd,day,week){
		sd.setDate(1);
		week = (week-1)*7;
		var cday = sd.getDay();
		var nday=(day==7?0:(day*1))+week-cday+1;
		sd.setDate(nday<=week?(nday+7):nday);
	};
	scheduler.transpose_day_week=function(sd,list,cor,size,cor2){
		var cday = (sd.getDay()||7)-cor;
		for (var i=0; i < list.length; i++) {
			if (list[i]>cday)
				return sd.setDate(sd.getDate()+list[i]*1-cday-(size?cor:cor2));
		}
		scheduler.transpose_day_week(sd,list,cor+size,null,cor);
	};	
	scheduler.transpose_type = function(type){
		var f = "transpose_"+type;
		if (!dhx.Date[f]) {
			var str = type.split("_");
			var day = 60*60*24*1000;
			var step = scheduler.transponse_size[str[0]]*str[1];
			
			if (str[0]=="day" || str[0]=="week"){
				var days = null;
				if (str[4]){
					days=str[4].split(",");
					if (scheduler.config.start_on_monday){
						for (var i=0; i < days.length; i++)
							days[i]=(days[i]*1)||7;
						days.sort();
					}
				}
				
				
				dhx.Date[f] = function(nd,td){
					var delta = Math.floor((td.valueOf()-nd.valueOf())/(day*step));
					if (delta>0)
						nd.setDate(nd.getDate()+delta*step);
					if (days)
							scheduler.transpose_day_week(nd,days,1,step);
				};
				dhx.Date.add[type] = function(nd,inc){
					if (days){
						for (var count=0; count < inc; count++)
							scheduler.transpose_day_week(nd,days,0,step);	
					} else
						nd.setDate(nd.getDate()+inc*step);
					
					return nd;
				};
			}
			else if (str[0]=="month" || str[0]=="year"){
				dhx.Date[f] = function(nd,td){
					var delta = Math.ceil(((td.getFullYear()*12+td.getMonth()*1)-(nd.getFullYear()*12+nd.getMonth()*1))/(step));
					if (delta>=0)
						nd.setMonth(nd.getMonth()+delta*step);
					if (str[3])
						scheduler.day_week(nd,str[2],str[3]);
				};
				dhx.Date.add[type] = function(nd,inc){
					nd.setMonth(nd.getMonth()+inc*step);
					if (str[3])
						scheduler.day_week(nd,str[2],str[3]);
					return nd;
				};
			}
		}
	};
	scheduler.data.attachEvent("onStoreUpdated", function(id, data, mode){
		if (mode == "delete" || mode == "update"){
			this.blockEvent();
			var sub = scheduler._get_rec_markers(id);
            scheduler._rec_markers_pull[id] = null;
			for (var i in sub) {
			    if(sub.hasOwnProperty(i)){
				    id = sub[i].id;
				    if(this.item(id))
					    this.remove(id);
				}
			}
			this.unblockEvent();
		}
	});
	scheduler.repeat_date=function(ev,stack,from,to){
		if (ev.rec_type == "none")
			return;

		var td = new Date(ev.start_date.valueOf());
		ev.rec_pattern = ev.rec_type.split("#")[0];
		
		scheduler.transpose_type(ev.rec_pattern);
		dhx.Date["transpose_"+ev.rec_pattern](td, from);
		
		while (td<ev.start_date || (td.valueOf()+ev.event_length*1000)<=from.valueOf())
			td = dhx.Date.add(td,1,ev.rec_pattern);
		while (td < to && td < ev.end_date){
			var ch = this._get_rec_marker(td.valueOf(),ev.id);
			if (!ch){
				var ted = new Date(td.valueOf()+ev.event_length*1000);
				var copy=dhx.fullCopy(ev);
				//copy._timed = ev._timed;
				copy.text = ev.text;
				copy.start_date = td;
				copy.event_pid = ev.id;
				copy.id = ev.id+"#"+Math.ceil(td.valueOf()/1000);
				copy.end_date = ted;
	     
				var shift = copy.start_date.getTimezoneOffset() - copy.end_date.getTimezoneOffset();
				if (shift){
					if (shift>0) 
						copy.end_date = new Date(td.valueOf()+ev.event_length*1000-shift*60*1000);
					else {
						copy.end_date = new Date(copy.end_date.valueOf() + shift*60*1000);
					}
				}
								
				stack.push(copy);
			}
			td = dhx.Date.add(td,1,ev.rec_pattern);
		}		
	};

});


dhx.attachEvent("onBeforeSchedulerInit",function(){

	if(!config.form){
		config.form = [
			{view:"text",		label:labels.label_event,	name:'text'},
			{view:"datetext",	label:labels.label_start,	id:'start_date', name:'start_date', dateFormat:config.form_date},
			{view:"datetext",	label:labels.label_end,		id:'end_date', 	 name:'end_date', dateFormat:config.form_date},
			{view:"toggle",	id:'allDay', label:"", options: [{value:"0",label:labels.label_time},{value:"1",label:labels.label_allday}], align: "right",value:"0"},
			{view:"rectext",	label:labels.recurring.repeat,	id:'rec_type', readonly:true},
			{view:"textarea",	label:labels.label_details,	id:'details',		height:110},
			{view:"input",	type:"hidden", id:'event_length'}
		];
	}
		
	if(!config.recurring_bar){
		config.recurring_bar = [
			{view:'button', inputWidth:xy.icon_cancel, id:"recCancel",css:"cancel",align:"left",label:labels.icon_cancel,batch:"default"},
			{view:'button', inputWidth:xy.icon_done, id:"recDone",align:"right",label:labels.icon_done,batch:"default"},
			{view:'button', inputWidth:xy.icon_done, id:"recDone2",align:"right",label:labels.icon_done,batch:"other"},
			{view:'button', inputWidth:xy.icon_cancel, id:"recEndCancel",css:"cancel",align:"left",label:labels.icon_cancel,batch:"endRepeat"},
			{view:'button', inputWidth:xy.icon_done, id:"recEndDone",align:"right",label:labels.icon_done,batch:"endRepeat"}
		];
	}
	/*list of recurring types in the first view*/
	if(!config.recurring_views_list)
		config.recurring_views_list = [
				{id:"none",value:labels.recurring.none, readonly:true},
				{id:"daily",value:labels.recurring.daily},
				{id:"weekly",value:labels.recurring.weekly},
				{id:"monthly",value:labels.recurring.monthly},
				{id:"yearly",value:labels.recurring.yearly}
		];
	if(!scheduler.templates.rec_list_item){
		scheduler.templates.rec_list_item = function(obj, common){
			return obj.value +(!obj.readonly?"<div class='dhx_arrow_icon'></div>":"");
		};
	}
    /* the initial view, the with "repeat" options*/
	if(!config.rec_init_form)
		config.rec_init_form = [
			{height:5},
			{view:"radiuslist",id:"recList", height:234, select:true,css:"rec_list",value:"none",template:scheduler.templates.rec_list_item, datatype:"json",data:config.recurring_views_list, labelWidth:100},
			{},
			{
				type:"clean",
				cols:[
					{width:5},
					{view:"endrec", id:"endRepeat", labelWidth:xy.recurring.label_end_repeat,  label:labels.recurring.end_repeat},
					{width:5}
				]
			},
			{}
		];
	if(!config.end_repeat_form)
		config.end_repeat_form = [
			{
				type:"clean",
				cols:[
				{view:"radio", id:"endBy",width:310, labelWidth:xy.recurring.label_end_by, height:90, options:[
					{ label:labels.recurring.endless_repeat, value: "0" },
					{ label:labels.recurring.end_repeat_label, value: "1" }
				]},
				{}
			]},				
			{view:"calendar", id:"endByDate", css:"end_rep_calendar"}
		];
	 /*Daily view*/
    if(!config.daily_form)
		config.daily_form = [
			{
				height:10
			},
			{
				type:"clean",
				cols:[
					{view:"label", label:labels.recurring.every,width:xy.recurring.label_every},
					{view:"counter", id:"dayCount", name:"dayCount", value:1,width:125},
					{view:"label", label:labels.recurring.day}
				]
			}
		];
		
	/*Weekly view*/
	dhx.protoUI({
		name:"weeklist",
		defaults:{
			rows:[
				{
					type:"clean",
					cols:[
						{type:"clean", width:xy.recurring.work_days, rows:[
							{view:"checkbox",id:1,label:dhx.Date.Locale.day_full[1]},
							{view:"checkbox",id:2,label:dhx.Date.Locale.day_full[2]},
							{view:"checkbox",id:3,label:dhx.Date.Locale.day_full[3]},
							{view:"checkbox",id:4,label:dhx.Date.Locale.day_full[4]},
							{view:"checkbox",id:5,label:dhx.Date.Locale.day_full[5]}
						]},
						{type:"clean", rows:[
							{view:"checkbox",id:6,label:dhx.Date.Locale.day_full[6]},
							{view:"checkbox",id:7,label:dhx.Date.Locale.day_full[0]}
						]}
					]
				}
			]
		},
		getValue:function(){
			var values = this.getValues();
			var result = [];
			for(var d in values)
				if(values[d])
					result.push(d);
			return result.join();
		},
		setValue:function(values){
			var result={};
	        for(var i=1;i < 8;i++)
				result[i] =0;
			if(typeof values!="object")
				values = values.split(",");
			for(var i=0; i< values.length;i++)
                result[parseInt(values[i],10)] = 1;
			this.setValues(result);
		}
	}, dhx.MouseEvents, dhx.EventSystem, dhx.ui.form);
	if(!config.weekly_form)
		config.weekly_form = [
			{
				height:10
			},
			{
				type:"clean",
				cols:[
					{view:"label", label:labels.recurring.every,width:xy.recurring.label_every},
					{view:"counter", id:"weekCount", name:"weekCount", value:1,width:125},
					{view:"label", label:labels.recurring.week}
				]
			},
			{view:"weeklist",id:"weekDays", name:"weekDays"}
		];
	
	
	/*Monthly view*/
	var monthDays = {};
	for(var i=1;i<32;i++)
		monthDays[i]=i;
		
	if(!scheduler.templates.rec_month_d)
		scheduler.templates.rec_month_d = function(){
			return "<div class='radio'><div class='on'></div></div><div class='text'>"+labels.recurring.month_day+"</div>";
		};
	if(!scheduler.templates.rec_month_w)
		scheduler.templates.rec_month_w = function(){
			return "<div class='radio'><div class='on'></div></div><div class='text'>"+labels.recurring.week_day+"</div>";
		};
	
	if(!scheduler.templates.rec_month_d_blured)
		scheduler.templates.rec_month_d_blured = function(){
			return "<div class='radio blured'></div><div class='text'>"+labels.recurring.month_day+"</div>";
		};
	if(!scheduler.templates.rec_month_w_blured)
		scheduler.templates.rec_month_w_blured = function(){
			return "<div class='radio blured'></div><div class='text'>"+labels.recurring.week_day+"</div>";
		};
		
	if(!config.week_day_counters)
	   config.week_day_counters = [
			{value:1,label:labels.recurring.counters[0]},
			{value:2,label:labels.recurring.counters[1]},
			{value:3,label:labels.recurring.counters[2]},
			{value:4,label:labels.recurring.counters[3]},
			{value:5,label:labels.recurring.counters[4]}
		];
	if(!config.week_day_labels)
	   config.week_day_labels = [
			{value:1,label:dhx.Date.Locale.day_full[1]},
			{value:2,label:dhx.Date.Locale.day_full[2]},
			{value:3,label:dhx.Date.Locale.day_full[3]},
			{value:4,label:dhx.Date.Locale.day_full[4]},
			{value:5,label:dhx.Date.Locale.day_full[5]},
			{value:6,label:dhx.Date.Locale.day_full[6]},
			{value:7,label:dhx.Date.Locale.day_full[0]}
		];
	if(!config.monthly_form)
		config.monthly_form = [
			{
				height:10
			},
			{
				type:"clean",
				cols:[
					{view:"label", label:labels.recurring.every,width:xy.recurring.label_every},
					{view:"counter", id:"monthCount", value:1,width:125},
					{view:"label", label:labels.recurring.month},
					{view:"input",type:"hidden", name:"monthType",value:"Day",width:1}
				],
				height:50
			},
			{
				view:"accordion",
				id:"monthTypeSelect",
				rows:[
					{
						headerAltHeight:50,
						id:"typeDayM",
						header:scheduler.templates.rec_month_d,
						headerAlt:scheduler.templates.rec_month_d_blured,
						body:{
							view:"datecells",
							id:"monthDayM",
							data:monthDays
						}
					},
					{
						headerAltHeight:50,
						id:"typeWeekM",
						header:scheduler.templates.rec_month_w,
						headerAlt:scheduler.templates.rec_month_w_blured,
						body:{
							type:"clean",
							rows:[
								{},
								{
									type:"clean",
									cols:[
									{view:"select",value:1,id:"weekCountM", css:"", options:config.week_day_counters},
									{view:"select",value:1,id:"weekDayM", css:"", options:config.week_day_labels}
								]},
								{}
							]
						}
					}
				]
			}
		];
	if(!config.year_months){
		config.year_months = (scheduler.locale.date?scheduler.locale.date.month_short:dhx.Date.Locale.month_short);
	}
	/*Yearly view*/
	if(!config.yearly_form)
		config.yearly_form = [
			{
				height:10
			},
			{
				type:"clean",
				cols:[
					{view:"label", label:labels.recurring.every,width:xy.recurring.label_every},
					{view:"counter", id:"yearCount", value:1,width:125},
					{view:"label", label:labels.recurring.year}
				],
				height:50
			},
			{
				view:"datecells",
				id:"monthDayY",
				data:config.year_months,
				x_count:4,
				height:150
			},
			{
				view:"checkbox",label:labels.recurring.week_day, id:"typeWeekY", labelWidth:250, value:1
			},
			{
				id:"yearWeekRow",
				type:"clean",
				cols:[
					{view:"select",value:1,id:"weekCountY",options:config.week_day_counters},
					{view:"select",value:1,id:"weekDayY",options:config.week_day_labels}
				]
			}
			
		];
	
	/*recurring subviews*/
	if(!config.recurring_views)
		config.recurring_views = [
			{id:"recForm", view:"form", elements: config.rec_init_form, scroll:true},
			{id:"endRepeatForm", view:"form", elements: config.end_repeat_form},
			{id:"daily",view:"daily",elements: config.daily_form},
			{id:"weekly", view:"weekly", elements: config.weekly_form},
			{id:"monthly", view:"monthly", elements: config.monthly_form, type:"line"},
			{id:"yearly", view:"yearly", elements: config.yearly_form}
		];
	
	/*adds recurring view into cells collection of scheduler's multiview*/
	config.views.push({
		view:"recurring",
		id:"recurring"
	});
	
	/*recurring view definition*/
	dhx.protoUI({
		name:"recurring",
		defaults:{
			rows:[
				{view:"toolbar",id:"reccuringBar", css:"dhx_topbar", elements:config.recurring_bar, visibleBatch:"default"},
				{id:"recViews",cells:config.recurring_views}
			],
			typeToId:{"day":"daily","week":"weekly","month":"monthly","year":"yearly"},
			endlessDate: config.endless_date
		},
		$init: function() {
	  		this.name = "Recurring";
			this.$view.className += " dhx_recurring";
			this.$ready.push(this._setEvents);
		},
		_setEvents:function(){
			var idToType = {};
			for(var type in this._settings.typeToId)
				idToType[this._settings.typeToId[type]] = type;
			this.define("idToType",idToType);
			dhx.delay(function(){
				var topParent = this.getTopParent();
				topParent.$$("rec_type").attachEvent("onItemClick",this._showRecViewsList);
				topParent.$$("reccuringBar").attachEvent("onItemClick",dhx.bind(function(id){
					id = this.innerId(id);
					switch(id){
						case "recDone2":
						case "recEndCancel":
						 	this.$$("recViews").back();
							this.$$("reccuringBar").showBatch("default");
						 	break;
						case "recCancel":
						 	this.$$("views").back();
						 	break;
						case "recDone":
							this.$$("recurring")._applyRecurrence();
						 	this.$$("views").back();
						 	break;
						case "recEndDone":
							var endDate;
							if(this.$$("endBy").getValue()=="1")
								endDate = this.$$("endByDate").getValue();
							else
								endDate = this.$$("recurring")._settings.endlessDate;
							this.$$("endRepeat").setValue(endDate);
						 	this.$$("recViews").back();
							this.$$("reccuringBar").showBatch("default");
						 	break;
					}
				},topParent));
				topParent.$$("recList").attachEvent("onItemClick",dhx.bind(this._showRecView,topParent));
				topParent.$$("endRepeat").attachEvent("onItemClick",dhx.bind(function(id){
					this._showRecView.call(topParent,"endRepeatForm");
					topParent.$$("reccuringBar").showBatch("endRepeat");
					this._setEndDate();
				},this));
				
				if(topParent.$$("typeWeekY"))
					topParent.$$("typeWeekY").attachEvent("onItemClick",function(){
						if(this.getValue())
							topParent.$$("yearWeekRow").show();
						else
							topParent.$$("yearWeekRow").hide();
					});
				if(topParent.$$("endBy"))
					topParent.$$("endBy").attachEvent("onItemClick",function(){
						if(this.getValue() == "1")
							topParent.$$("endByDate").show();
						else
							topParent.$$("endByDate").hide();
					});
				topParent.$$("editForm").attachEvent("onItemClick", dhx.bind(function(id){
					id = this.innerId(id);
					if(id=="end_date"){
						this._showDateForm(id);
					}
				},topParent));			
				topParent.$$("weekly").elements.weekDays = topParent.$$('weekDays');
				topParent.$$("monthly").elements.monthDayM = topParent.$$('monthDayM');
				topParent.$$("yearly").elements.monthDayY = topParent.$$('monthDayY');
				topParent.$$("editForm").elements.endRepeat = topParent.$$('endRepeat');
				//topParent.$$("editForm").elements.end_date_rec = topParent.$$('end_date');
			},this);
		},
		_showRecViewsList:function(){
			var topParent = this.getTopParent(); 
			topParent.$$("recurring").show();
			if(topParent.$$("recForm")){
				topParent.$$("recForm").show();
				topParent.$$("recurring").setValue();
			}
		},
		_showRecView:function(id){
			if(this.$$(id)){
				//dhx.delay(function(){
					this.$$(id).show();
					
				//},this);
				this.$$("reccuringBar").showBatch("other");
			}
			if(!this.$$("endRepeat").getValue())
				this.$$("endRepeat").setValue(this.$$("recurring")._settings.endlessDate);
		},
		setValue:function(data){
			var topParent = this.getTopParent();
			data = (data||topParent.item(topParent.getCursor()));
			var recType = (topParent.$$("rec_type").getValue()||"_____").split("_");
			var config = topParent.$$("recurring")._settings;
			topParent.$$("recList").setValue(recType[0]!=""?config.typeToId[recType[0]]:"none");
			var typeArr;
			var startDate = topParent.$$("start_date").getValue();
			var values = {};
			for(var type in config.typeToId){
				if(type==recType[0]){
					recType.push(startDate);
					typeArr = dhx.copy(recType);
				}else{
					typeArr = [type,1,"","","",startDate];
				}
				topParent.$$(config.typeToId[type]).setValue(typeArr);
			}
		},
		getValue:function(){
			var topParent = this.getTopParent();
			var type = topParent.$$("recList").getSelected();
			return (type=="none"?["","","","","",""]:topParent.$$(type).getValue());
		},
		_applyRecurrence:function(){
			var topParent = this.getTopParent();
			var value = this.getValue();
			var startDate = topParent.$$("start_date").getValue();
			var endDate = topParent.$$("end_date").getValue();
			var length = endDate.valueOf()-startDate.valueOf();
			topParent.$$("event_length").setValue(length/1000);

			if(value[0]==""){
				topParent.$$("endRepeat").setValue(topParent.$$("end_date").getValue());
				topParent.$$("rec_type").setValue("");
				topParent.$$("event_length").setValue("");
				return;
			}
			else if(value[0]=="week"){
				startDate = dhx.Date.add(startDate,(-1)*(startDate.getDay()+6)%7,"day");
			}
			else if(value[0]=="month"){
				if(value[5]!="")
					startDate.setDate(value[5]);
				/*else
					startDate.setDate(1);*/
			}
			else if(value[0]=="year"&&value[5]){
				startDate.setMonth(value[5]);
				//startDate.setDate(1);
			}
			topParent.$$("start_date").setValue(startDate);
		    topParent.$$("end_date").setValue(new Date(startDate.valueOf()+length));
			value.pop();
		 	var repeat = "";
			if(topParent.$$("endBy").getValue()=="0")
 				repeat = "no";
			topParent.$$("rec_type").setValue(value.join("_")+"#"+repeat);
		},
		_setEndDate:function(){
			var topParent = this.getTopParent();
			var values = topParent.$$("editForm").getValues();
			var end =  values["end_date"];
			if(end.valueOf() == this._settings.endlessDate.valueOf()){
				topParent.$$("endBy").setValue("0");
				topParent.$$("endByDate").setValue(scheduler.config.end_by||dhx.Date.add(topParent.$$("end_date").getValue(),1,"year"));
			}
			else{
				topParent.$$("endBy").setValue("1");
				topParent.$$("endByDate").setValue(end);
			}
			this._setEndByVisibility();
		},
		_setEndByVisibility:function(){
			var topParent = this.getTopParent();
			var value = topParent.$$("endBy").getValue();
		    if(value == "1")
				topParent.$$("endByDate").show();
			else
				topParent.$$("endByDate").hide();
		}
	}, dhx.DataLoader, dhx.ui.form, dhx.EventSystem, dhx.Settings);
});




})();