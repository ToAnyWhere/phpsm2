
function SoftKey6W() 
{   
		var isIE11 = navigator.userAgent.indexOf('Trident') > -1 && navigator.userAgent.indexOf("rv:11.0") > -1;
	  var isEDGE= navigator.userAgent.indexOf("Edge") > -1;
    var u = document.URL;
    var url;
    if (u.substring(0, 5) == "https") {
    	if(isIE11 || isEDGE)
    	{
    		url = "wss://127.0.0.1:4007/xxx";
    	}
    	else
    	{
				url = "wss://localhost:4007/xxx";
			}
		} else {
			url = "ws://127.0.0.1:4007/xxx";
		}
    
    var Socket_UK;

	if (typeof MozWebSocket != "undefined") {
		Socket_UK = new MozWebSocket(url,"usbkey-protocol");
	} else {
		this.Socket_UK = new WebSocket(url,"usbkey-protocol");
	}
    	   
    this.FindPort = function(start) 
    { 
        var msg = 
        {
            FunName: "FindPort",
            start: start
        };
        this.Socket_UK.send(JSON.stringify(msg));
   };   
    
    this.FindPort_2 = function(start, in_data , verf_data)
    { 
         var msg = 
        {
            FunName: "FindPort_2",
            start: start,
            in_data: in_data,
            verf_data:verf_data
        };
        this.Socket_UK.send(JSON.stringify(msg)); 
    }; 
    
    this.FindPort_3= function(start,in_data,verf_data)
    { 
        var msg = 
        {
            FunName: "FindPort_3",
            start: start,
            in_data: in_data,
            verf_data:verf_data
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetVersion= function(Path)
    { 
        var msg = 
        {
            FunName: "GetVersion",
            Path: Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetVersionEx= function(Path)
    { 
        var msg = 
        {
            FunName: "GetVersionEx",
            Path: Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetID_1= function(Path)
    { 
        var msg = 
        {
            FunName: "GetID_1",
            Path: Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetID_2= function(Path)
    { 
        var msg = 
        {
            FunName: "GetID_2",
            Path: Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    
    this.sRead= function(Path)
    { 
        var msg = 
        {
            FunName: "sRead",
            Path: Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.sWrite = function(InData, Path)
    { 
         var msg = 
        {
            FunName: "sWrite",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg)); 
    }; 
    
    this.sWrite_2= function(InData, Path)
    { 
        var msg = 
        {
            FunName: "sWrite_2",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.sWrite_2Ex= function(InData,Path)
    { 
        var msg = 
        {
            FunName: "sWrite_2Ex",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.sWriteEx= function(InData,Path)
    { 
        var msg = 
        {
            FunName: "sWriteEx",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.sWriteEx_New= function(InData,Path)
    { 
        var msg = 
        {
            FunName: "sWriteEx_New",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.sWrite_2Ex_New= function(InData,Path)
    { 
        var msg = 
        {
            FunName: "sWrite_2Ex_New",
            InData: InData,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    
    this.SetBuf= function(InData,pos)
    { 
        var msg = 
        {
            FunName: "SetBuf",
            InData: InData,
            pos:pos
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetBuf= function(pos)
    { 
        var msg = 
        {
            FunName: "GetBuf",
            pos: pos
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };     
    
    this.YRead= function(Address,len, HKey,LKey,Path)
    { 
        var msg = 
        {
            FunName: "YRead",
            Address:Address,
            len:len,
            HKey:HKey,
            LKey:LKey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YWrite= function(Address,len,HKey,LKey,Path)
    { 
        var msg = 
        {
            FunName: "YWrite",
            Address:Address,
            len:len,
            HKey:HKey,
            LKey:LKey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YReadString= function(Address,len,HKey,LKey,Path)
    { 
        var msg = 
        {
            FunName: "YReadString",
            Address:Address,
            len:len,
            HKey:HKey,
            LKey:LKey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YWriteString= function(InString,Address,HKey,LKey,Path)
    { 
        var msg = 
        {
            FunName: "YWriteString",
            InString:InString,
            Address:Address,
            HKey:HKey,
            LKey:LKey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SetWritePassword= function(W_Hkey,W_Lkey,new_Hkey,new_Lkey,Path)
    { 
        var msg = 
        {
            FunName: "SetWritePassword",
            W_Hkey:W_Hkey,
            W_Lkey:W_Lkey,
            new_Hkey:new_Hkey,
            new_Lkey:new_Lkey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SetReadPassword= function(W_Hkey,W_Lkey,new_Hkey,new_Lkey,Path)
    { 
        var msg = 
        {
            FunName: "SetReadPassword",
            W_Hkey:W_Hkey,
            W_Lkey:W_Lkey,
            new_Hkey:new_Hkey,
            new_Lkey:new_Lkey,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
     
    this.DecString= function(InString,Key)
    { 
        var msg = 
        {
            FunName: "DecString",
            InString:InString,
            Key:Key
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.EncString= function(InString,Path)
    { 
        var msg = 
        {
            FunName: "EncString",
            InString:InString,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.EncString_New= function(InString,Path)
    { 
        var msg = 
        {
            FunName: "EncString_New",
            InString:InString,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.Cal= function(Path)
    { 
        var msg = 
        {
            FunName: "Cal",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.Cal_New= function(Path)
    { 
        var msg = 
        {
            FunName: "Cal_New",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SetCal_2= function(Key,Path)
    { 
        var msg = 
        {
            FunName: "SetCal_2",
            Key:Key,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SetCal_New= function(Key,Path)
    { 
        var msg = 
        {
            FunName: "SetCal_New",
            Key:Key,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SetEncBuf= function(InData,pos)
    { 
        var msg = 
        {
            FunName: "SetEncBuf",
            InData:InData,
            pos: pos
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetEncBuf= function(pos)
    { 
        var msg = 
        {
            FunName: "GetEncBuf",
            pos: pos
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    

    this.ReSet= function(Path)
    { 
        var msg = 
        {
            FunName: "ReSet",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };     
    
    this.MacAddr= function()
    { 
        var msg = 
        {
            FunName: "MacAddr"
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    
    this.GetChipID= function(Path)
    { 
        var msg = 
        {
            FunName: "GetChipID",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.StarGenKeyPair= function(Path)
    { 
        var msg = 
        {
            FunName: "StarGenKeyPair",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GenPubKeyY= function()
    { 
        var msg = 
        {
            FunName: "GenPubKeyY"
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GenPubKeyX= function()
    { 
        var msg = 
        {
            FunName: "GenPubKeyX"
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GenPriKey= function()
    { 
        var msg = 
        {
            FunName: "GenPriKey"
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetPubKeyY= function(Path)
    { 
        var msg = 
        {
            FunName: "GetPubKeyY",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetPubKeyX= function(Path)
    { 
        var msg = 
        {
            FunName: "GetPubKeyX",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.GetSm2UserName= function(Path)
    { 
        var msg = 
        {
            FunName: "GetSm2UserName",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.Set_SM2_KeyPair= function(PriKey,PubKeyX,PubKeyY,sm2UserName,Path )
    { 
        var msg = 
        {
            FunName: "Set_SM2_KeyPair",
            PriKey:PriKey,
            PubKeyX:PubKeyX,
            PubKeyY:PubKeyY,
            sm2UserName:sm2UserName,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this. YtSign= function(SignMsg,Pin,Path)
    { 
        var msg = 
        {
            FunName: "YtSign",
            SignMsg:SignMsg,
            Pin:Pin,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YtSign_2= function(SignMsg,Pin,Path)
    { 
        var msg = 
        {
            FunName: "YtSign_2",
            SignMsg:SignMsg,
            Pin:Pin,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YtVerfiy= function(id,SignMsg,PubKeyX, PubKeyY,VerfiySign,Path)
    { 
        var msg = 
        {
            FunName: "YtVerfiy",
            id:id,
            SignMsg:SignMsg,
            PubKeyX:PubKeyX,
            PubKeyY:PubKeyY,
            VerfiySign:VerfiySign,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SM2_DecString= function(InString,Pin,Path)
    { 
        var msg = 
        {
            FunName: "SM2_DecString",
            InString:InString,
            Pin:Pin,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.SM2_EncString= function(InString,Path)
    { 
        var msg = 
        {
            FunName: "SM2_EncString",
            InString:InString,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.YtSetPin= function(OldPin,NewPin,Path)
    { 
        var msg = 
        {
            FunName: "YtSetPin",
            OldPin:OldPin,
            NewPin:NewPin,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.FindU= function(start)
	{ 
        var msg = 
        {
            FunName: "FindU",
            start: start
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.FindU_2= function(start,in_data,verf_data)
	{ 
        var msg = 
        {
            FunName: "FindU_2",
            start: start,
            in_data: in_data,
            verf_data:verf_data
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.FindU_3= function(start,in_data,verf_data)
	{ 
        var msg = 
        {
            FunName: "FindU_3",
            start: start,
            in_data: in_data,
            verf_data:verf_data
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.IsUReadOnly= function(Path)
	{ 
        var msg = 
        {
            FunName: "IsUReadOnly",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.SetUReadOnly= function(Path)
	{ 
        var msg = 
        {
            FunName: "SetUReadOnly",
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
	this.SetHidOnly= function(IsHidOnly,Path)
	{ 
        var msg = 
        {
            FunName: "SetHidOnly",
            IsHidOnly:IsHidOnly,
            Path:Path
        };
        this.Socket_UK.send(JSON.stringify(msg));
    };   
    
    this.ResetOrder = function() 
    {
		 var msg = 
        {
            FunName: "ResetOrder"
        };
         this.Socket_UK.send(JSON.stringify(msg));
	 } 
	 
	this.ContinueOrder = function() 
    {
		 var msg = 
        {
            FunName: "ContinueOrder"
        };
         this.Socket_UK.send(JSON.stringify(msg));
	 } 

} 