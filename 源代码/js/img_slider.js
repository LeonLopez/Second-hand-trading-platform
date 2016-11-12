$(document).ready(function(){

	var $img_index = $("div.img_index span"); //图片小下标
	var len = $img_index.length;
	var index = 0;
	var adTimer =null;

	$img_index.mouseover(function(){
		index = $img_index.index(this);//获取当前下标
		showImg(index);

	}).eq(0).mouseover();//初始状态显示第一张图

	$("#img_roll").hover(function(){
		if(adTimer){
			clearInterval(adTimer);
		}
	},function(){
		adTimer = setInterval(function(){
			showImg(index);
			index++;
			if(index==len){
				index=0;
			}
		},3000);
	}).trigger("mouseleave");

	function showImg(index){
		var $roll_obj = $("div#img_roll");
		$roll_obj.find("img").eq(index).stop(true,true).fadeIn().siblings().fadeOut();
		$(".img_index span").removeClass("selected").eq(index).addClass("selected");
	}
})