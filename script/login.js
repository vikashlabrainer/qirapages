document.querySelector("#frm1").addEventListener("submit", function(e){
    
        e.preventDefault();    //stop form from submitting
		sendotp();
});
document.querySelector("#otpbox").addEventListener("submit", function(e){
    
        e.preventDefault();    //stop form from submitting
	    validateotp();
});

document.querySelector("#changemobile11").addEventListener("click", function(e){
    
        e.preventDefault();    //stop form from submitting
	    changemail();
});

function sendotp(){

var basedomain= document.location.origin;
var mobile = document.getElementById("mobilex").value;
var xsrf = document.getElementById("xsrf").value;
//console.log(email);
var xhr = new XMLHttpRequest();
xhr.withCredentials = true;
xhr.addEventListener("readystatechange", function() {
  if(this.readyState === 4) {
      var jsonResponse = JSON.parse(this.responseText);
	 // console.log(jsonResponse.token);
	  var status = jsonResponse.statusCode;
	  var reponder = document.getElementById("responder");
	  if(status==200){
		  
		  var token = jsonResponse.token;
		   var success = jsonResponse.msg;
		  
		  document.getElementById("frm1").style.display="none";
		  document.getElementById("otpbox").style.display="flex";
		  responder.innerHTML=success;
		  responder.className="success";
		  
	  }
	  else{
		  
		  var error = jsonResponse.error;
		  responder.innerHTML=error;
		  responder.className="error";
		  
		  
		  
	  }
	  
	  
  }
});

xhr.open("POST", basedomain+"/qirapages/api/sendotp.php", true);

xhr.send(JSON.stringify({

	mobile : mobile,
	xsrf  : xsrf

}));
}

function validateotp(){
	var basedomain= document.location.origin;
	var userotp = document.getElementById("userotp").value;
	var tokentovalidate = document.getElementById("xsrf-otp").value;
	var xhr = new XMLHttpRequest();
	xhr.withCredentials = true;
	xhr.addEventListener("readystatechange", function() {
		if(this.readyState === 4) {
			
			     var jsonResponse = JSON.parse(this.responseText);
	 
	  var status = jsonResponse.statusCode;
	  var reponder = document.getElementById("responder");
	  if(status==200){
		  
		 
		   var success = jsonResponse.msg;
		  
		  responder.innerHTML="<a href='dashboard.php'>Go to dashboard</a>";
		 responder.className="success";
		 var form2 = document.getElementById("otpbox");
		 form2.style.display="none";
		 
		  
	  }
	   else if(status==401){
		  
		 
		  var error = jsonResponse.error;
		  
		  responder.innerHTML=error;
		  responder.className="error";
		  
		  document.getElementById("otpbox").style.display="none";
		  document.getElementById("unsubscribe").style.display="flex";
		  
	  }
	  else{
		  
		  var error = jsonResponse.error;
		  
		  responder.innerHTML=error;
		  responder.className="error";
		  
		   
		  
		  
		  
	  }
		}
		});

	xhr.open("POST", basedomain+"/qirapages/api/validateotp.php", true);

	xhr.send(JSON.stringify({

	otp : userotp,
	token : tokentovalidate

	}));
	}

