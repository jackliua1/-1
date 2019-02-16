// JavaScript Document

	function getdiv(id){ return document.getElementById(id); }
	function browserHeight(){
			return document.body.scrollHeight;
		}
	function browserWidth(){
			return document.body.scrollWidth;
		}
	getdiv("examplesdiv").style.height=browserHeight()+"px";
	getdiv("examplesdiv").style.width=browserWidth()+"px";
	var bot=browserWidth()*4;
	getdiv("examplesclidivbox").style.width=bot+"px";
 	var CDone=0;
 	var CDtwo=0;
	var movePX=0;
	var toumove=0;
	var kudu=browserWidth();
	
	function moveleft(){		
			if(toumove>CDtwo&&movePX>-bot+browserWidth()){ //判断marginleft值是否大于置内容容器的宽度，设置marginleft最多为置内容容器的宽度
				movePX-=0.01*browserWidth();//向左移动的速度，数值越大越快
				getdiv("examplesclidivbox").style.marginLeft=movePX+"px";//设置内容容器向左移动；
							
			} 
			if(movePX<-bot+browserWidth() ){//判断marginleft值是否大于置内容容器的宽度，设置marginleft最多为置内容容器的宽度
				getdiv("examplesclidivbox").style.marginLeft=-(browserWidth()*3)+"px";
				};
			toumove=CDtwo;	 
			
		} 
	
	function moveright(){		
			 	movePX+=0.05*browserWidth();//向左移动的速度，数值越大越快
				getdiv("examplesclidivbox").style.marginLeft=movePX+"px";//设置内容容器向左移动；
		 
			
		} 
	function suojinmove(){//用户没有完全拖出下一张图片的话，系统帮其完成拖动工作的方法
 
 	 if(CDone-CDtwo>70){
			movePX-=0.05*browserWidth();//向左移动的速度，数值越大越快
			getdiv("examplesclidivbox").style.marginLeft=movePX+"px";//设置内容容器向左移动；
			if(-movePX>=kudu){ 
			
				getdiv("examplesclidivbox").style.marginLeft=-kudu+"px";

				kudu+=browserWidth(); 
				return;
			}
			if(movePX>-bot+browserWidth()){
				setTimeout(suojinmove,10); 
			}
			
			if(movePX<-bot+browserWidth() ){//判断marginleft值是否大于置内容容器的宽度，设置marginleft最多为置内容容器的宽度
				getdiv("examplesclidivbox").style.marginLeft=-(browserWidth()*3)+"px";
				};
		}
		else{
			
				moveright(); 
				if(movePX<-kudu+browserWidth()){
				setTimeout(suojinmove,10); }
				else{
					getdiv("examplesclidivbox").style.marginLeft=-(kudu-browserWidth())+"px";
					}
			}
	}
	getdiv("examplesdiv").addEventListener('touchstart', function (e) { CDone=e.touches[0].clientX;});	
	getdiv("examplesdiv").addEventListener('touchmove', function (e) {    event.preventDefault(); CDtwo=e.touches[0].clientX ; moveleft(); });
	getdiv("examplesdiv").addEventListener('touchend', function (e) {suojinmove();
		 });
