
    var cbox=getbox("sbc").getElementsByTagName("input");
    function getbox(id){
        return document.getElementById(id);
      }

    function changea(){
	          getbox("all").onchange=function(){  
	            if(this.checked){ 
	              checkchang(true);
	              }else{
	                
	              checkchang(false);
	              }
	            }
            }



    function checkchang(bo){
    			for(x=0;x<cbox.length;x++){
    				if(cbox[x].type="checkbox"){
    					if(cbox[x].disabled!=true)
    					{cbox[x].checked=bo;}

             		 }
          } 
        } 
    window.onload=function(){
    		changea();
    		getbox("lqall").onclick=function(){
    		var allid=yxuanzaaa();
    		location.href="?g=User&m=Share&a=lqall&allid="+allid;
    	}
    } 


   function yxuanzaaa(){
  			var val="";
  			var i=0;
   			for(x=0;x<cbox.length;x++){
   				if( cbox[x].checked){
   					if(i!=0){
   						val+=",";
					}
					i++;
   					val+=cbox[x].value;
   				}
              }
              return val;
	}
