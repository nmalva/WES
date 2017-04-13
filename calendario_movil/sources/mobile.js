/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
/*DHX:Depend touchui.js*/
/*DHX:Depend dayevents.js*/

/*DHX:Depend touchui.css*/

if (!window.scheduler)
	window.scheduler = {	
		config:{},
		templates:{},
		xy:{},
		locale:{}
	};

/*Locale*/
if(!scheduler.locale)
	scheduler.locale = {};

scheduler.locale.labels = {
	list_tab : "List",
	day_tab : "Day",
	month_tab : "Month",
	icon_today : "Today",
	icon_save : "Save",
	icon_done : "Done",
	icon_delete : "Delete event",
	icon_cancel : "Cancel",
	icon_edit : "Edit",
	icon_back : "Back",
	icon_close : "Close form",
	icon_yes : "Yes",
	icon_no : "No",
	confirm_closing : "Your changes will be lost, are your sure ?",
	confirm_deleting : "The event will be deleted permanently, are you sure?",
	label_event:"Event",	
	label_start:"Start",
	label_end:"End",
	label_details:"Notes",
	label_from: "from",
	label_to: "to",
	label_allday: "All day",
	label_time: "Time"
};

/*Config*/

/*date*/

scheduler.config = {
	init_date : new Date(),
	form_date : "%d-%m-%Y %H:%i",
	form_all_day : "%d-%m-%Y",
	xml_date : "%Y-%m-%d %H:%i",
	item_date : "%d.%m.%Y",
	multi_day : "%l, %d %F %Y",
	header_date : "%d.%m.%Y",
	hour_date : "%H:%i",
	scale_hour : "%H",
	calendar_date : "%F %Y",
	form_rules : {
		end_date:function(value,obj){
			return (obj.start_date.valueOf() < value.valueOf());
		}
	},
	views : [],
	tab_views : [],
	server_utc: false
};

/*Dimensions*/
scheduler.xy = {
   	confirm_height : 231,
	confirm_width : 250,
	scale_width : 45,
	scale_height : 15,
	list_tab:54,
	day_tab:54,
	month_tab:68,
	icon_today : 72,
	icon_save : 100,
	icon_done : 100,
	icon_cancel : 100,
	icon_edit : 100,
	icon_back : 100,
	list_height: 42,
	month_list_height: 42
};

/*Templates*/
scheduler.templates = {
	selected_event : function(obj){
		var html = "", fts="", fte="";
		var start = obj.start_date;
		var end = obj.end_date;
		
		if(!start) return html;
		html += "<div  class='selected_event "+scheduler.templates.event_class(obj)+"' style='"+(obj.color?"background-color:"+obj.color+";":"")+(obj.fontColor||obj.textColor?"color:"+(obj.fontColor||obj.textColor):"")+"'>";
		html += "<div class='event_title'>"+obj.text+"</div>";
		
		if(dhx.Date.datePart(start).valueOf()==dhx.Date.datePart(end).valueOf()){
			var fd = dhx.i18n.dateFormatStr(start);
			fts = dhx.i18n.timeFormatStr(start);
			fte = dhx.i18n.timeFormatStr(end);
			html += "<div class='event_text'>"+fd+"</div>";
			html += "<div class='event_text'>"+scheduler.locale.labels.label_from+" "+fts+" "+scheduler.locale.labels.label_to+" "+fte+"</div>";
		}
		else{
			var fds = dhx.i18n.longDateFormatStr(start);
			var fde = dhx.i18n.longDateFormatStr(end);
			/*if not "all-day" event*/
			if(!(dhx.Date.datePart(start).valueOf()==start.valueOf()&&dhx.Date.datePart(end).valueOf()==end.valueOf())){
				fts = dhx.i18n.timeFormatStr(start)+" ";
				fte = dhx.i18n.timeFormatStr(end)+" ";
			}
			html += "<div class='event_text'>"+scheduler.locale.labels.label_from+" "+fts+fds+"</div>";
			html += "<div class='event_text'>"+scheduler.locale.labels.label_to+" "+fte+fde+"</div>";
		}
		if(obj.details&&obj.details!==""){
			html += "<div class='event_title'>"+scheduler.locale.labels.label_details+"</div>";
			html += "<div class='event_text'>"+obj.details+"</div>";
		}
		html += "</div>";
		return html;
	},
	calendar_event : function(date){
		return date+"<div class='day_with_events'></div>";
	},
	event_date: function(date){
		if(date.start_date)
			date = date.start_date;
		return dhx.i18n.dateFormatStr(date);
	},
	/*event_long_date: function(date){
		if(date.start_date)
			date = date.start_date;
		return dhx.i18n.longDateFormatStr(date);
	},*/
	event_time : function(obj){
		var start = obj.start_date;
		var end = obj.end_date;
		if(!(dhx.Date.datePart(start).valueOf()==start.valueOf()&&dhx.Date.datePart(end).valueOf()==end.valueOf()))
			return dhx.i18n.timeFormatStr(start);
		else
			return scheduler.locale.labels.label_allday;
	},
	event_marker : function(obj,type){
   		return "<div class='dhx_event_marker' "+(obj.color?"style='background-color:"+obj.color+"'":"")+"></div>";
	},
	event_title: function(obj,type){
		return "<div class='dhx_event_overall "+type.eventClass(obj,type)+"'><div class='dhx_day_title'>"+type.dateStart(obj.start_date)+"</div><div><div class='dhx_event_time'>"+type.timeStart(obj)+"</div>"+type.marker(obj,type)+"<div class='dhx_event_text' "+(obj.textColor?"style='color:"+obj.textColor:"")+"'>"+obj.text+"</div></div></div>";
	},
	month_event_title : function(obj,type){
		return "<div class='"+type.eventClass(obj,type)+"'>"+type.marker(obj,type)+"<div class='dhx_event_time'>"+type.timeStart(obj)+"</div><div class='dhx_event_text' "+(obj.textColor?"style='color:"+obj.textColor:"")+"'>"+obj.text+"</div></div>";
	},
	day_event: function(obj,type){
		return obj.text;
	},
	new_event_data: function(){
	    var hours = (dhx.Date.add(new Date(),1,"hour")).getHours();
		var start = dhx.Date.copy(this.coreData.getValue());
		start.setHours(hours);
		var end = dhx.Date.add(start,1,"hour");
		return {start_date:start,end_date:end};
	},
	event_class: dhx.Template("")
};


dhx.protoUI({
	name:"datetext",
	defaults:{
		iconWidth:25
	},
	_render_input: function(config, type, readonly, div) {
		var inputAlign = (config.inputAlign||"left");
		var labelAlign = (config.labelAlign||"left");
		var name = dhx.uid();
		//var html =  "<div class='dhx_inp_text_border' style='position:relative'>";
		var html = 	"<label class='dhx_inp_label' style='width: " + this._settings.labelWidth + "px; text-align: " + labelAlign + ";' onclick='' for='"+name+"'>" + (config.label||"") + "</label>";
		var width = this._settings.inputWidth-this._settings.labelWidth-40;
		if(width<0)
			width = 0;
		html +=	"<div class='dhx_inp_"+type+"' onclick='' style='width: " + width + "px; text-align: " + inputAlign + ";' >"+ (config.text||config.value||"") + "</div>";
		html +=	"<div class='dhx_arrow_icon'></div>";
		return "<div class='dhx_el_box' style='position:relative'>"+html+"</div>";
	},		
	_setValue:function(value){
		this._settings.value = (value||"");
		var format = (this._settings.dateFormatStr||dhx.i18n.dateFormatStr);
		this._settings.text = this._getBox().innerHTML = (typeof this._settings.value=="object"?(format(this._settings.value)):this._settings.value);
	},
	dateFormat_setter:function(value){
		this._settings.dateFormatStr = dhx.Date.dateToStr(value);
		return dhx.Date.strToDate(value);
	},
	getValue:function(){
		return this._settings.value||null;
	},
	_set_inner_size:function(){
		var config = this._settings;
		this._getBox().style.width = this.$width - config.labelWidth - config._cssConstant-config._outerPadding-config.iconWidth + "px";
	},
	_getBox: function() {
		return this._dataobj.firstChild.childNodes[1];
	}
}, dhx.ui.text);

dhx.ready(function(){
	dhx.callEvent("onBeforeSchedulerInit",[]);
	
	if (scheduler.locale&&scheduler.locale.date)
		dhx.Date.Locale = scheduler.locale.date;

	var config  = scheduler.config;
	var labels = scheduler.locale.labels;
	var templates = scheduler.templates;

	if(!config.form){
		config.form = [
			{view:"text",		label:labels.label_event,	name:'text'},
			{view:"datetext",	label:labels.label_start,	id:'start_date',name:'start_date', dateFormat:config.form_date},
			{view:"datetext",	label:labels.label_end,	id:'end_date',name:'end_date', dateFormat:config.form_date},
			{view:"toggle",	id:'allDay', label:"", options: [{value:"0",label:labels.label_time},{value:"1",label:labels.label_allday}], align: "right",value:"0"},
			{view:"textarea",	label:labels.label_details,	name:'details',		height:150}
		];
	}
	if(!config.calendar_hour){
		var hourPart = config.hour_date.match(/%[h,H]/gi);
		var aPart = config.hour_date.match(/%[a,A]/gi);
		config.calendar_hour = hourPart[0]+(aPart?" "+aPart[0]:"");
    }
	if(!config.bottom_toolbar){
		config.bottom_toolbar = [
 			{ view:"button",id:"today",label:labels.icon_today,inputWidth:scheduler.xy.icon_today, align:"left",width:scheduler.xy.icon_today+6},
 			{ view:"segmented", id:"buttons",selected:"list",align:"center",multiview:true, options:[
				{value:"list", label:labels.list_tab,width:scheduler.xy.list_tab},
				{value:"day", label:labels.day_tab,width:scheduler.xy.day_tab},
    			{value:"month", label:labels.month_tab,width:scheduler.xy.month_tab}
			]},
			{ view:"button",css:"add",id:"add", align:"right",label:"&nbsp;+&nbsp;",inputWidth:42,width:50},
			{ view:"label", label:"",inputWidth:42,width:50, batch:"readonly"}
		];
	}
	if(!config.day_toolbar){
		config.day_toolbar = [
			{view:'label',id:"prev",align:"left",label:"<div class='dhx_cal_prev_button'><div></div></div>"},
			{view:'label',id:"date",align:"center",width:200},
			{view:'label',id:"next",align:"right",label:"<div class='dhx_cal_next_button'><div></div></div>"}
		];
	}
	if(!config.selected_toolbar){
		config.selected_toolbar = [
			{view:'button', inputWidth:scheduler.xy.icon_back, css:"cancel", id:"back",align:"left",label:labels.icon_back},
			{view:'button', inputWidth:scheduler.xy.icon_edit, id:"edit",align:"right",label:labels.icon_edit}
		];
	}
	if(!config.form_toolbar){
		config.form_toolbar = [
			{view:'button', inputWidth:scheduler.xy.icon_cancel, id:"cancel",css:"cancel",align:"left",label:labels.icon_cancel},
			{view:'button', inputWidth:scheduler.xy.icon_save, id:"save",align:"right",label:labels.icon_save}
		];
	}
	if(!config.date_toolbar){
		config.date_toolbar = [
			{view:'button', width:scheduler.xy.icon_cancel, id:"cancel_date",css:"cancel",align:"left",label:labels.icon_cancel},
			{view:'label',id:"datetype",align:"center"},
			{view:'button', width:scheduler.xy.icon_done, id:"done",align:"right",label:labels.icon_done}
		];
	}
	
	/*List types*/
	var listType = {
		cssNoEvents:"no_events",
		padding:0,
		width:"auto",
		timeStart:templates.event_time,
		marker:templates.event_marker, 
		eventClass:templates.event_class
	};
	scheduler.types = {
		event_list:dhx.extend({
			name:"EventsList",
			css:"events",
			height:scheduler.xy.list_height,
			dateStart:templates.event_date,
			template:templates.event_title
		},listType),
		day_event_list:dhx.extend({
			name:"DayEventsList",
			css:"day_events",
			height:scheduler.xy.month_list_height,
			template:templates.month_event_title
		},listType)
	};
		
	dhx.Type(dhx.ui.list, scheduler.types.event_list);
	dhx.Type(dhx.ui.list, scheduler.types.day_event_list);

	dhx.DataDriver.scheduler = {
	    records:"/*/event"
	};
	dhx.extend(dhx.DataDriver.scheduler,dhx.DataDriver.xml);
    
	/*the views of scheduler multiview*/
	
	var tabViews = [
		{
			id:"list",
			view:"list",
			type:"EventsList",
			startDate:new Date()
		},
		{
			id:"day",
			rows:[
				{	
					id:"dayBar",
					view:"toolbar",
					css:"dhx_topbar",
					elements: config.day_toolbar
				},
				{
					id:"dayList",
					view:"dayevents"
				}
			]
		},
		{
			id:"month",
			rows:[
				{
					id:"calendar",
					view:"calendar",
					dayWithEvents: templates.calendar_event,
					calendarHeader:config.calendar_date,
					width:0
				},
				{
					id:"calendarDayEvents",
					view:"list",
					type:"DayEventsList"
				}
			]
			
		}
	].concat(config.tab_views);

	var delete_button = {view:"button", height:44,	label:labels.icon_delete,	id:'delete',type:"form" ,css:"delete"};
	if(screen.width>500){
		delete_button.width = 300;
		delete_button = { type:"clean",cols:[{},delete_button,{}] };
	}

	var views = [
		{
			rows:[
				{
					view:"multiview",
					id:"tabViews",
					cells: tabViews
				},
				{
					view:"toolbar",
					id:"bottomBar",
					type:"SchedulerBar",
					visibleBatch:"default",
					elements: config.bottom_toolbar
				}
			]
		},
		{
			id:"event",
			animate:{
				type:"slide",
				subtype:"in",
				direction:"top"
			},
			type:"clean",
			rows:[
				{
					id:"eventBar",
					view:"toolbar",
					type:"TopBar",
					css:"single_event",
					elements: config.selected_toolbar
				},
				{
					id:"eventTemplate",
					view:"template",
					template:templates.selected_event
				},
				delete_button,
				{	view:"template",height:20}
			]
		},
		{
			id:"form",
			rows:[
				{	
					id:"editBar",
					view:"toolbar",
					type:"TopBar",
					elements:config.form_toolbar 
				},
				{
					id:"editForm",
					view:"form",
					elements: config.form,
					rules: config.form_rules
				}
			]
		},
		{
			id:"formdate",
			rows:[
				{	
					id:"dateBar",
					view:"toolbar",
					type:"TopBar",
					elements:config.date_toolbar
				},
				{
					id:"dateForm",
					rows:[
						{view:"calendar", css:"form_calendar", id:"formCalendar", width:-1,height:-1, hourFormat:config.calendar_hour, timeSelect:1,hourStart:0},
						{view:"template", css:"form_template"}
					] 
				}
			]
		}
	].concat(config.views);
	
	dhx.protoUI({
		name:"scheduler",
	    defaults:{
			rows:[
				{
					view:"multiview",
					id:"views",
					cells: views
				}
			],
			color:"#color#",
			textColor:"#textColor#"
		},
		$init: function(){
	    	this.name = "Scheduler";
			this._viewobj.className += " dhx_scheduler";
			/*date format functions*/
			dhx.i18n.dateFormat = config.item_date;
			dhx.i18n.formDate = config.form_date;
			dhx.i18n.formAllDayFormat = config.form_all_day;
    		dhx.i18n.timeFormat = config.hour_date;
				
 		    dhx.i18n.fullDateFormat = config.xml_date;
 		    dhx.i18n.fullDateFormatUTC = config.server_utc;

		    dhx.i18n.longDateFormat = config.multi_day;
			dhx.i18n.headerFormatStr = dhx.Date.dateToStr( config.header_date);
			dhx.i18n.dateMethods = dhx.i18n.dateMethods.concat(["formDate","formAllDayFormat"]);

			dhx.i18n.setLocale();

			this.data.provideApi(this);
			this.data.scheme({
				$init:function(data){
					if(typeof data.start_date=="string")
						data.start_date	= dhx.i18n.fullDateFormatDate(data.start_date);
					if(typeof data.end_date=="string")
						data.end_date 	= dhx.i18n.fullDateFormatDate(data.end_date);
				}
			});
			this.$ready.push(this._initStructure);
		
			dhx.callEvent("onAfterSchedulerInit",[this]);
			
	    },
	    syncData:function(target, start, end){
	    	var events = this.getEvents(start, end);

			var tpull = target.data.pull = {};
	    	var torder = target.data.order = [];
			for (var i=0; i<events.length; i++){
				var id = events[i].id;
				torder.push(id);
				tpull[id]=events[i];
			}
	    },
		_syncAllViews:function(){ 
			this.syncData(this.$$("list"), scheduler.config.init_date, null);
			this.$$("list").render();
			
			this.coreData.callEvent("onChange",[]);
/*			this.$$("calendar").render();
			this.$$("calendarDayEvents").render();
			this.$$("dayList").render();
			*/
		},	    
		getTodayEvents:function(){
			var scheduler = this.getTopParent();

			var d = dhx.Date.datePart(scheduler.coreData.getValue());
			var next = dhx.Date.add(d,1,"day");
			scheduler.syncData(this, d, next);
		},
		_setMonthFlags:function(old_Date, new_Date){
				if (!this.isVisible()) return;
				var top = this.getTopParent();

				var start = dhx.Date.datePart(dhx.Date.copy(this.getVisibleDate()));
				start.setDate(1);
				var end = dhx.Date.add(start,1,"month");

				top._eventsByDate = {};
				var events = top.getEvents(start, end);

				while(start<end){
					var next = dhx.Date.add(start,1,"day");
					for (var i=0; i<events.length; i++)
						if (events[i].start_date < next && events[i].end_date > start )
							top._eventsByDate[start.valueOf()]=true;
					start = next;
				}
		},
	    _initStructure:function(){
			this._initToolbars();
			this._initmonth();
			
			//store current date
			this.coreData = new dhx.DataValue();
			this.coreData.setValue(config.init_date);
			
			this.$$("dayList").define("date",this.coreData);
			
			this.selectedEvent = new dhx.DataRecord();
			
			if(this.config.readonly){
				this.define("readonly",this.config.readonly);
			}
			else if(config.readonly)
				this.define("readonly",true);
			/*saving data*/
			if(this.config.save){
				var dp = dhx.dp({
					master:this,
					url:this.config.save
				});
				dp.attachEvent("onBeforeDataSend",this._onSchedulerUpdate);
			}
				
			if(this.$$("date"))
				this.$$("date").bind(this.coreData, null, dhx.i18n.headerFormatStr);
			
			this.data.attachEvent("onStoreUpdated", this._sortDates);
			this.data.attachEvent("onStoreUpdated", dhx.bind(this._syncAllViews, this));

			//custom data binding for day-list
			this.$$("dayList").define("dataFeed", this.getTodayEvents);
			this.$$("dayList").bind(this.coreData);

			this.$$("calendarDayEvents").define("dataFeed", this.getTodayEvents);
			this.$$("calendarDayEvents").bind(this.coreData);

			this.$$("calendar").bind(this.coreData);
			this.$$("calendar").attachEvent("onBeforeRender", this._setMonthFlags);
			/*to redraw calendar when coreDate got changed */
			this.coreData.attachEvent("onChange",dhx.bind(function(){
				this.$$("calendar").render();
			},this));

			this.data.attachEvent("onIdChange",dhx.bind(function(old,newId){
				this._syncAllViews();
			},this));
			
			this.$$("eventTemplate").bind(this);
			this.$$("editForm").bind(this);
			
			this.$$("list").attachEvent("onItemClick", dhx.bind(this._on_event_clicked, this));
			this.$$("dayList").attachEvent("onItemClick", dhx.bind(this._on_event_clicked, this));
			this.$$("calendarDayEvents").attachEvent("onItemClick", dhx.bind(this._on_event_clicked, this));

			/*Start and End date selection*/
			this.dateField = new dhx.DataValue();
			this.dateField.setValue("start_date");
			this.$$("datetype").bind(this.dateField, null, function(value){
			    return (value == "start_date"?labels.label_start:labels.label_end);
			});
		},
		_on_event_clicked:function(id){
			this._last_selected = (id||"").toString().split("#");
			if (this._last_selected[1])
				this.setCursor(null);
			this.setCursor(this._last_selected[0]);
			this.$$('event').show();
			/*if(this._checkAllDay(this.$$("start_date").getValue())&&this._checkAllDay(this.$$("end_date").getValue())){
				this.$$("start_date").config.dateFormat = dhx.i18n.formAllDayFormatStr;
				this.$$("end_date").config.dateFormat = dhx.i18n.formDateOnlyFormatStr;
			}*/
		},
		/*Sorts dates asc, gets hash of dates with event*/
		_sortDates:function(){
			this.blockEvent();
			this.sort(function(a,b){
				return a.start_date < b.start_date?-1:1;
			});
			this.unblockEvent();
		},
		/* Month Events view: sets event handlers */
		_initmonth:function(){
			this.$$("calendar").attachEvent("onDateSelect",dhx.bind(function(date){
				this.setDate(date);
			},this));
			
			this.$$("calendar").attachEvent("onAfterMonthChange",dhx.bind(function(date){
				var today = new Date();
				if(date.getMonth()===today.getMonth()&&date.getYear()===today.getYear())
					date = today;
				else
					date.setDate(1);
				this.setDate(date);
			},this));

			var dayFormat = this.$$("calendar").config.calendarDay;
			this.$$("calendar").config.calendarDay=dhx.bind(function(date){
				var html = dayFormat(date);
				if(this._eventsByDate && this._eventsByDate[date.valueOf()])
					return this.$$("calendar").config.dayWithEvents(html);
				return html;
			},this);
		},
		getEvents:function(from,to){
			if (!to) to = new Date(9999,0,1);

			var result = [];
			var evs = this.data.getRange();
			for(var i = 0; i < evs.length;i++){
				if (evs[i].start_date<to && evs[i].end_date>from)
					result.push(evs[i]);
			}
			return result;
		},
		/*applies selected date to all lists*/
		setDate:function(date, inc, mode){
			if (!date)
				date = this.coreData.getValue();
			else 
				date = dhx.Date.datePart(date);

			if (inc)
				date = dhx.Date.add(date, inc, mode);
			this.coreData.setValue(date);
		},
		_initToolbars:function(){
			this.attachEvent("onItemClick", function(id){
				
				var view_id = this.innerId(id);
				switch(view_id){
					case "today":
						this.setDate(new Date());	
						break;
					case "add":
						this._addEvent();
						break;
					case "prev":
						this.setDate(null, -1, "day");
						break;
			    	case "next":
			    		this.setDate(null, 1, "day");
			    		break;
			    	case "edit":
					    if(this.$$("delete"))
							this.$$("delete").show();
						this.define("editEvent",true);
						this.$$("form").show();
						this._setDefaultDates();
						break;
					case "cancel_date":
					case "back":
						this.$$("views").back();
						break;
					case "cancel":
						/*if(!this._settings.editEvent)
							this.remove(this.getCursor());*/
						this.callEvent("onAfterCursorChange",[this.getCursor()]);
						this.$$("views").back();
						break;
					case "save":
						if(this.$$("editForm").validate()){
							if(!this._settings.editEvent){
								var data = this.$$("editForm").getValues();
								data.id = dhx.uid();
								if(data.details&&this._trim(data.text)===""&&this._trim(data.details)!=="")
									data.text = data.details;
								this.add(data);
								this.setCursor(data.id);
							} else {
								this.$$("editForm").save();
							}
							//dhx.dp(this).save();
							this.setDate();
							this.$$("views").back();
						}
						break;
					case "delete":
						this._deleteEvent();
						break;
					case "start_date":
					case "end_date":
					    if(this.$$(view_id).name == "datetext")
							this._showDateForm(view_id);
						break;
					case "done":
						var field = this.dateField.getValue();
						var date = this.$$("formCalendar").getValue();
						this.$$(field).setValue(date);
						this._setDefaultDates();
						this.$$("views").back();
						this.$$("editForm").validate();
						break;
					case "allDay":
						this._setAllDay();
						break;
					default:
						//do nothing
						break;
				}		
			});
			this.attachEvent("onAfterTabClick", function(id, button){
				this.$$(button).show();
			});
			this.attachEvent("onBeforeTabClick", function(id, button){
				return this._confirmViewChange(button);
			});
		},
		readonly_setter:function(val){
			if(this.$$("add")){
			if (val){
					this.$$("bottomBar").showBatch("readonly");
					this.$$("add").hide();
					this.$$("edit").hide();
					this.$$("delete").hide();
				}
				else{
					this.$$("bottomBar").showBatch("default");
					this.$$("add").show();
					this.$$("edit").show();
					this.$$("delete").show();
				}
			}
			return val;
		},
		/*removes "No events" background*/
		_clearNoEventsStyle:function(){
			if(this.dataCount())
				this._viewobj.className = this._viewobj.className.replace(RegExp(this.type.cssNoEvents, "g"),"");
			else 
				this._viewobj.className += " "+this.type.cssNoEvents;
		},
		/*deletes the cursored event*/
		_deleteEvent: function(){
			var self = this;
			dhx.confirm({
				height:scheduler.xy.confirm_height,
				width:scheduler.xy.confirm_width,
				title: labels.icon_delete,
				message: labels.confirm_deleting,
				callback: function(result) {
					if (result){
						self.remove(self.getCursor());
						self.setDate();
						self.$$("views").back(1);
						
					}
				},
				labelOk:labels.icon_yes,
				labelCancel:labels.icon_no,
				css:"confirm",
				header:false
			});
		},
		/*adds the new event*/
		_addEvent:function(){
			/*if(this.$$("delete"))
				this.$$("delete").hide();*/
			this.define("editEvent",false);				
			this.$$("form").show();
			
			
			this.$$("editForm").clear();
			this.$$("editForm").setValues(templates.new_event_data.call(this));
			this._setDefaultDates();
		},
		eventDefaultDate:function(){
			
		},
		/*cofirm the view changing (necessary for edit form)*/
		_confirmViewChange:function(button){
			if(this.innerId(this.$$("views").getActive()) == "form"){
				var self = this;
				if(button!= "today")
					dhx.confirm({
						height:scheduler.xy.confirm_height,
						width:scheduler.xy.confirm_width,
						title: labels.icon_close,
						message: labels.confirm_closing,
						callback: function(result) {
							if (result){
								self.$$(button).show();
								self.$$("buttons").setValue(button);
							}
						},
						labelOk:labels.icon_yes,
						labelCancel:labels.icon_no,
						css:"confirm"
					});
				return false;
			}
			return true;
		},
		/*converts event dates for strings before they are sent*/
		_onSchedulerUpdate:function(data){
		    var i, obj;
			for(i = 0; i < data.length; i++){
				obj = data[i].data;
				obj.start_date = dhx.i18n.fullDateFormatStr(obj.start_date);
				obj.end_date = dhx.i18n.fullDateFormatStr(obj.end_date);
			}
		},
		/*displayes calendar for form dates*/
		_showDateForm:function(name){
			this.dateField.setValue(name);
			if(this.$$("editForm").elements["allDay"])
				this.$$("formCalendar").define("timeSelect", this.$$("editForm").elements["allDay"].getValue()=="0");
			this.$$("formdate").show();
			dhx.delay(function(){
				this.$$("formCalendar").resize();
				this.$$("formCalendar").selectDate(this.$$(name).getValue(),true);
			},this);
		},
		/*checks time of the date*/
		_checkAllDay:function(date){
			return date.valueOf()== dhx.Date.datePart(date).valueOf();
		},
		/*onclick handler for addDay toggle*/
		_setAllDay:function(){
			var format = (this.$$("allDay").getValue()=="1"?dhx.i18n.formAllDayFormatStr:dhx.i18n.formDateStr);
			var elements = this.$$("editForm").elements;
			var fields = [this.$$("start_date"),this.$$("end_date")];
			for(var i=0;i<2;i++){
				fields[i].config.dateFormatStr = format;
				if(elements["allDay"].getValue()!="1")
					fields[i].setValue(this._event_date[i]);
			}
			if(elements["allDay"].getValue()=="1"){
				fields[0].setValue(dhx.Date.datePart(this._event_date[0]));
				var end = dhx.Date.datePart(this._event_date[1]);
				if(end.valueOf()<=fields[0].getValue().valueOf())
				   end = dhx.Date.add(end,1,"day");
				 fields[1].setValue(end);
			}
		},
		/*called when editing form is shown. Creates copies of event dates and set allDay state*/
		_setDefaultDates:function(){
			this._event_date = [];
			var elements = this.$$("editForm").elements;
			this._event_date[0] = this.$$("start_date").getValue();
			this._event_date[1] = this.$$("end_date").getValue();
			var value = (this._checkAllDay(this._event_date[0])&&this._checkAllDay(this._event_date[1])&&(this._event_date[1].valueOf()>this._event_date[0].valueOf())?"1":"0");
			if(!elements["allDay"])
			   return;
			elements["allDay"].setValue(value);
			var format = (elements["allDay"].getValue()=="1"?dhx.i18n.formAllDayFormatStr:dhx.i18n.formDateStr);
			var fields = [this.$$("start_date"),this.$$("end_date")];
			for(var i=0;i<2;i++){
				fields[i].config.dateFormatStr = format;
				fields[i].setValue(this._event_date[i]);
			}
		},
		/*remove leading and end whitespaces*/
		_trim: function(value) {
			value = value.replace(/^ */g, '');
			value = value.replace(/ *$/g, '');
			return value;
		}
	}, dhx.IdSpace, dhx.DataLoader, dhx.ui.layout, dhx.EventSystem, dhx.Settings);
});
