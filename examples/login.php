<html> 
<body onload="load()"><!--在onload事件中处理事件插拨及检查是否已经安装了客户端服务程序-->

<script src="Syunew6.js"></script><!--定要包含有我们的UK单元包-->
<script language="javascript" type="text/javascript">
<!--

var bConnect=0;
 
function load()
{
	if (frmlogin.KeyID.value!="")return ;
	//如果是IE10及以下浏览器，则跳过不处理
    if(navigator.userAgent.indexOf("MSIE")>0 && !navigator.userAgent.indexOf("opera") > -1) return;
    try
    {
        var s_pnp=new SoftKey6W();
         s_pnp.Socket_UK.onopen = function() 
        {
               bConnect=1;//代表已经连接，用于判断是否安装了客户端服务
        } 
        
        //在使用事件插拨时，注意，一定不要关掉Sockey，否则无法监测事件插拨
        s_pnp.Socket_UK.onmessage =function got_packet(Msg) 
        {
            var PnpData = JSON.parse(Msg.data);
            if(PnpData.type=="PnpEvent")//如果是插拨事件处理消息
            {
                if(PnpData.IsIn) 
                {
                        alert("UKEY已被插入，被插入的锁的路径是："+PnpData.DevicePath);
                }
                else
                {
                        alert("UKEY已被拨出，被拨出的锁的路径是："+PnpData.DevicePath);
                }
            }
        } 
        
        s_pnp.Socket_UK.onclose = function()
        {
            
        }
   }
   catch(e)  
   {  
        alert(e.name + ": " + e.message);
        return false;
    }  
}

-->
</SCRIPT>
<?php

require __DIR__ . "/../../autoload.php";

use Mdanter\Ecc\EccFactory;
use Mdanter\Ecc\SM2\sm2sm3;

session_start();

if (!empty($_POST['KeyID']) )
{

	//获取客户端返回的唯一ID
	echo "<p>";
	echo "KeyID是：";
	echo $_POST['KeyID'];
	echo "</p>";


	//获取客户端返回设置在Key中的用户用户身份

	echo  "<p>" ;
	echo  "用户身份是：" ;
	echo   $_POST['UserName'];
	echo   "</p>" ;

	//输出当前随机数
	echo "<p>";
	echo "随机数是：";
	echo $_POST['rnd'];
	echo "</p>";

	//返回用户锁对随机数的加密结果
	echo "<p>";
	echo "用户返回的对随机数进行签名的结果是：";
	echo $_POST['return_EncData'];
	echo "</p>";
	
	
	//这里在服务器端对随机数进行同样的验签运算

	 //要进行验签的消息
	$strData=$_SESSION['rnd'];
	

	
	//使用与加密锁对应的公钥对数据进行签名，该公钥可以根据用户名从数据库中取得，这里使用了固定的值进行演示
    //密钥对可以是每一把都不相同，也可以是都相同，如果是不相同的可以根据用户名在从数据库中获取对应的公钥，可以根据安全性及自身具体情况而定，这里使用了一个固定的值
    //与之例子要相应的私钥是“128B2FA8BD433C6C068C8D803DFF79792A519A55171B1B650C23661D15897263”，需要将对应的私钥及公钥设置到锁中
	$HexPubKeyX="D5548C7825CBB56150A3506CD57464AF8A1AE0519DFAF3C58221DC810CAF28DD";
    $HexPubKeyY="921073768FE3D59CE54E79A49445CF73FED23086537027264D168946D479533E";
	$adapter = EccFactory::getAdapter();
    $generator = EccFactory::getNistCurves()->generator256();
	$sm2=new sm2sm3();
    $r=$sm2->YtVerfiyBySoft("AAA",$strData,$HexPubKeyX,$HexPubKeyY,$_POST['return_EncData'],$generator);
	  
	echo "<p>";
	echo "服务器算的结果是：";
	echo "<p>";
  //验证签名是否有效，如果有效就认为是合法用户，由于使用了随机数，从而实现了一次一密的高安全性，可以用于高安全性的身份验证
  if ($r)
	{
		echo "该用户是合法用户,用户身份是：" . $_POST['UserName'];
	}
	else
	{
		echo "该用户不是合法用户";
	}
	echo "</p>";
	echo "<p>";
	echo "<p>";
	echo "<p>";
	
}
else
{
	srand((double)microtime()*1000000);
	$_SESSION['rnd'] =rand() . rand();
	
?>

<SCRIPT LANGUAGE=javascript>
 var digitArray = new Array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');

function toHex( n ) {

        var result = ''
        var start = true;

        for ( var i=32; i>0; ) {
                i -= 4;
                var digit = ( n >> i ) & 0xf;

                if (!start || digit != 0) {
                        start = false;
                        result += digitArray[digit];
                }
        }

        return ( result == '' ? '0' : result );
}
function login_onclick() 
{
	 //如果是IE10及以下浏览器，则使用AVCTIVEX控件的方式
	if(navigator.userAgent.indexOf("MSIE")>0 && !navigator.userAgent.indexOf("opera") > -1) return Handle_IE10();

	//判断是否安装了服务程序，如果没有安装提示用户安装
    if(bConnect==0)
    {
        window.alert ( "未能连接服务程序，请确定服务程序是否安装。");return false;
    }
    
   	var DevicePath,ret,n,mylen,Pin,ChipID;
	try
	{
		//由于是使用事件消息的方式与服务程序进行通讯，
        //好处是不用安装插件，不分系统及版本，控件也不会被拦截，同时安装服务程序后，可以立即使用，不用重启浏览器
        //不好的地方，就是但写代码会复杂一些
        var s_simnew1=new SoftKey6W(); //创建UK类
			
		 s_simnew1.Socket_UK.onopen = function() {
	   	   s_simnew1.ResetOrder();//这里调用ResetOrder将计数清零，这样，消息处理处就会收到0序号的消息，通过计数及序号的方式，从而生产流程
	    } 
		    
		 //写代码时一定要注意，每调用我们的一个UKEY函数，就会生产一个计数，即增加一个序号，较好的逻辑是一个序号的消息处理中，只调用我们一个UKEY的函数
	    s_simnew1.Socket_UK.onmessage =function got_packet(Msg) 
	    {
	        var UK_Data = JSON.parse(Msg.data);
	        if(UK_Data.type!="Process")return ;//如果不是流程处理消息，则跳过
	        //alert(Msg.data);
	        switch(UK_Data.order) 
	        {
	            case 0:
	                {
	                    s_simnew1.FindPort(0);//查找加密锁
	                }
	                break;//!!!!!重要提示，如果在调试中，发现代码不对，一定要注意，是不是少了break,这个少了是很常见的错误
	            case 1:
	                {
	                    if( UK_Data.LastError!=0){window.alert ( "未发现加密锁，请插入加密锁");s_simnew1.Socket_UK.close();return false;} 
	                    DevicePath=UK_Data.return_value;//获得返回的UK的路径
	                    
	                    s_simnew1.GetChipID(DevicePath);//返回芯片唯一ID
	                }
	                break;
	            case 2:
	                {
	                    if( UK_Data.LastError!=0){window.alert("返回芯片唯一ID时出现错误，错误码为："+UK_Data.LastError.toString());s_simnew1.Socket_UK.close();return false;} 
                        frmlogin.KeyID.value = UK_Data.return_value;
                        
                        //从锁中取出用户身份，与签名后的数据一并送到服务端进行验证。以验证用户身份
                        s_simnew1.GetSm2UserName(DevicePath); 
	                }
	                break;	
	            case 3:
	                {
	                    if( UK_Data.LastError!=0){window.alert("返回用户身份时出现错误，错误码为："+UK_Data.LastError.toString());s_simnew1.Socket_UK.close();return false;} 
                        frmlogin.UserName.value = UK_Data.return_value;
                        
                        //使用默认的PIN码
                        Pin="123"
                        //这里使用锁中的私钥对身份-用户名及消息-随机数的进行数字签名,使用默认的PIN码，返回签名后的数据
                        s_simnew1.YtSign(frmlogin.rnd.value,Pin,DevicePath);
	                }
	                break;
	            case 4:
	                {
	                    if( UK_Data.LastError!=0){window.alert("进行签名时出现错误，错误码为："+UK_Data.LastError.toString());s_simnew1.Socket_UK.close();return false;} 
	                    frmlogin.return_EncData.value=UK_Data.return_value;

	                     //!!!!!注意，这里一定要主动提交，
                         frmlogin.submit(); 
                         
	                     //所有工作处理完成后，关掉Socket
	                     s_simnew1.Socket_UK.close();
	                }
	                break;	    

                }
	     }
    	    
		 s_simnew1.Socket_UK.onclose = function(){

	     }
		 return true;
	 }

	 catch(e)  
	  {  
		alert(e.name + ": " + e.message);
		return false;
	  }  

}

function Handle_IE10() 
{
	var DevicePath,ret,n,mylen,Pin;
	try
	{
			//建立操作我们的锁的控件对象，用于操作我们的锁

		    aObject=new ActiveXObject("Syunew6A.s_simnew6");

            
            //查找是否存在锁,这里使用了FindPort函数
			DevicePath = aObject.FindPort(0);
			if( aObject.LastError!= 0 )
			{
				window.alert ( "未发现加密锁，请插入加密锁.");
				
				return false;
			}
			
			 //'读取锁的唯一ID
            frmlogin.KeyID.value=aObject.GetChipID(DevicePath);
            if( aObject.LastError!= 0 )
			{
	            window.alert( "返回芯片唯一ID时出现错误，错误码为："+aObject.LastError.toString());
		        return false;
			}
			
			//从锁中取出用户身份，与签名后的数据一并送到服务端进行验证。以验证用户身份
			frmlogin.UserName.value=aObject.GetSm2UserName(DevicePath);
			if( aObject.LastError!= 0 )
			{
				window.alert(  "返回用户身份时出现错误，错误码为："+aObject.LastError.toString());
				return false;
			}            
           
            
            //使用默认的PIN码
            Pin="123";
    
			//这里使用锁中的私钥对身份-用户名及消息-随机数的进行数字签名,使用默认的PIN码，返回签名后的数据
			frmlogin.return_EncData.value=aObject.YtSign(frmlogin.rnd.value,Pin,DevicePath);
			if( aObject.LastError!= 0 )
			{
					window.alert( "进行签名时出现错误，错误码为："+aObject.LastError.toString());
					return false;
			}
			frmlogin.submit();	 
			
			return true;

		}
	catch (e) 
	{
		alert(e.name + ": " + e.message);
	}
}
</SCRIPT> 
 
 <form name="frmlogin" method="post" action="login.php">
 <div>
 要验证通过，需要使用我们的开发工具设置SM2算法密钥对到锁中：<br />
  私钥： 128B2FA8BD433C6C068C8D803DFF79792A519A55171B1B650C23661D15897263<br />
公钥X： D5548C7825CBB56150A3506CD57464AF8A1AE0519DFAF3C58221DC810CAF28DD<br />
公钥Y： 921073768FE3D59CE54E79A49445CF73FED23086537027264D168946D479533E<br />
        <br />
        <br />
        <br />
<input name="KeyID" type="text" id="KeyID" size="20" />
<input name="UserName" type="text" id="UserName" size="20" />
<input name="Password" type="text" id="Password" size="20" /> 
<input name="rnd" type="text" id="rnd"  value="<?php echo $_SESSION['rnd'] ?>"  />
<input name="return_EncData" type="text" id="return_EncData" value=""   />
<!--/重要，这里的类型一定不能是Submit，否则无法完全处理所有的消息，就提交上去了，一定要主动提交-->
<input type="button" name="Submit" value="提交" onclick="login_onclick()"/>
</div>
</form>
</BODY>
</HTML>
<?php
}
?>