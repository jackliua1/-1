var bgClr='';

$(document).ready(function(){

	$('.tbCmn tbody tr').live('mouseenter',function(){
		$(this).css('backgroundColor','#D3F2FA');
	});

	$('.tbCmn tbody tr').live('mouseleave',function() {
		$(this).css('backgroundColor',bgClr);
	});
	$(".check-box").attr('checked',false);
	$("#check_all").live("click",function(event){
			if($("#check_all").hasClass('not_checked'))
			{
			  $("#check_all").removeClass('not_checked');
			  $(".check-box").attr('checked',true);
			}
			else
			{
			  $("#check_all").addClass('not_checked');
			  $(".check-box").attr('checked',false);
			}
      }); 
	  $("#tj").click(function(){
    // alert('ok');return false;
        var shuzu = [];
        var str="";
           $("input[type='checkbox']:checked").each(function(){
           str+=$(this).val()+"\r\n";
           shuzu.push($(this).val());
        })
        alert(str);
        
       // jquery ��������ֱ����һ��[]�Ϳ����ˣ���Ԫ�ؼ���������push
    });
});

