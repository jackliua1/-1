//闅愯棌寰俊搴曢儴瀵艰埅
/*document.addEventListener('WeixinJSBridgeReady', function onBridgeReady(){
	WeixinJSBridge.call('hideToolbar');
});*/

var v = 1;
function musicPlay(){
	var media = document.getElementById("media");
	if(v==0){
		$(".music").append("<p class=\"mute\"></p>");
		media.pause();
		v=1;
	}else{
		media.play();
			$(".music .mute").remove();
		v=0;
	}
}

$(function(){
	$("#bookButton").click(function(){
		$("#bookButton").val('鎻愪氦涓�...').attr('disabled',true);
		var data = decodeURIComponent($('#post_message_1').serialize());
		
		var checkName  = $('#bookName').val();
	 	var checkPhone = $('#bookPhone').val();
	 	var checkCount = $('#bookCount').val();
	 	var checkCon   = $('#bookCon').val();
		
	 	if(checkName == ""){
	 		alert("濮撳悕涓嶈兘涓虹┖锛�");
	 		$("#bookButton").val('鎻愪氦').removeAttr('disabled');
	 		return false;
	 	}
	 	if(checkPhone == ""){
	 		alert("鎵嬫満涓嶈兘涓虹┖锛�");
	 		$("#bookButton").val('鎻愪氦').removeAttr('disabled');
	 		return false;
	 	}
	 	if(checkCount == ""){
	 		alert("浜烘暟涓嶈兘涓虹┖锛�");
	 		$("#bookButton").val('鎻愪氦').removeAttr('disabled');
	 		return false;
	 	}
	 	$("#bookButton").val('鎻愪氦涓�...').attr('disabled',true);

		//for(var i=0;i<30;i++){
			$.ajax({
				type: "POST",
				data:data,
				url: $('#post_message_1').attr('action'),
				dataType: "text",
				success: function(z){
					if(z=="true"){
						$("#bookButton").val('鎻愪氦瀹屾垚');
						alert("棰勭害鎴愬姛锛�");
						window.location.reload();
					}else{
						alert(z);
					}
				}
			});
		//}
	});

	$("#bookBtn").click(function(){
		$("#booking .mask").show();
		var scrollT = document.body.scrollTop;
		$("#booking .submitBox").css("top",scrollT+10+"px").slideToggle();
	});

	$(".bookWrap .close,.bookWrap .mask").click(function(){
		$(".mask").hide();
		$(this).parents(".bookWrap").find(".submitBox").slideToggle();
	});

	$(".faceWrap").click(function(){
		$(".faceWrap").slideToggle();	
		musicPlay();
	});
	
});

var isFirst = true;
function animateOne(){
	if(isFirst){
		$(".faceWrap").animate({top:'-=200'},function(){
			$(".faceWrap").animate({top:'+=200'});
		});
		isFirst = false;
	}
}
window.onload = function(){
	$(".loadingWrap").hide();
	animateOne();
}