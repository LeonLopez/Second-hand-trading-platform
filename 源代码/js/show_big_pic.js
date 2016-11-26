$(function(){
	var x = 10;
	var y = 20;
	$(".show_pic_list .show_big").mouseover(function(e){
		this.myTitle=this.title;
		this.title="";
		var imgTitle = this.myTitle? "<br/>" + this.myTitle : "";
		var show_big = "<div id='show_big'><img src='"+ this.href +"' alt='产品预览图'"+" 'width'='310px' "+"'height'='310px'/>"+imgTitle+"<\/div>"; //创建 div 元素
		$("body").append(show_big);	//把它追加到文档中	
		
		$("#show_big")
			.css({
				"top": (e.pageY+y) + "px",
				"left":  (e.pageX+x)  + "px",
			}).show("fast");	  //设置x坐标和y坐标，并且显示
	}).mouseout(function(){
		this.title = this.myTitle;	
		$("#show_big").remove();	 //移除 
    }).mousemove(function(e){
		$("#show_big")
			.css({
				"top": (e.pageY+y) + "px",
				"left":  (e.pageX+x)  + "px",
			});
	});
})