    const editor = new EditorJS({
      autofocus: false,
      
       placeholder: 'Let`s write an awesome story and earn! Marked content will be hidden for viewers unless they don`t purchase your story',
	   tools: {
     anchorTune: AnchorBlockTune,
     paragraph: {
      class: Paragraph,
      inlineToolbar: true,
      tunes: ['anchorTune']
    },
    header: {
      class: Header,
      tunes: ['anchorTune'],
    //   inlineToolbar: true,
    
      config: {
        placeholder: 'Title of your story',
        levels: [2, 3, 4],
       
        defaultLevel: 2
      }
      },
         Color: {
      class: ColorPlugin, // if load from CDN, please try: window.ColorPlugin
      config: {
         colorCollections: ['#FF1300','#EC7878','#9C27B0','#673AB7','#3F51B5','#0070FF','#03A9F4','#00BCD4','#4CAF50','#8BC34A','#CDDC39', '#FFF'],
         defaultColor: '#FF1300',
         type: 'text', 
      }     
    },
     
    
	
	   image: {
      class: ImageTool,
      tunes: ['anchorTune'],
      config: {
        endpoints: {
          byFile: 'api/sendtocloud.php' // Your backend file uploader endpoint
          
          
        }
 
      },
      inlineToolbar : true
      

    },
    list: {
      class: NestedList,
      tunes: ['anchorTune'],
      inlineToolbar: true,
    },
 
    
    embed: {
      class: Embed,
      tunes: ['anchorTune']
    },
     
	math: {
      class: MathTex, // for CDN: window.MathTex
      tunes: ['anchorTune']
    },
    
    
// 	code: CodeTool,
	 Marker: {
      class: Marker,
      shortcut: 'CMD+SHIFT+M',
    },
    
    
         

	
  }
    });



 // Adding functionality to button of header
  $("#publish-story").on("click", function() {
      
      $("#generatebox").fadeToggle( "fast");
      $("#success").hide();
    
  });
  // Ending functionality to button of header
  
  
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


// This function will help us get the number of character written
function textFromJson(json) {
    if (json === null || json === undefined) {
      return '';
    }
    if (!Array.isArray(json) && !Object.getPrototypeOf(json).isPrototypeOf(Object)) {
      return '' + json;
    }
    const obj = {};
    for (const key of Object.keys(json)) {
        obj[key] = textFromJson(json[key]);
    }
    return Object.values(obj).join(' ');
}



// alert function to handle different messages
// jqueryui framework is used here

function custom_alert( message, title ) {
    if ( !title )
        title = 'Alert';

    if ( !message )
        message = 'No Message to Display.';

    $('<div></div>').html( message ).dialog({
        title: title,
        resizable: false,
        modal: true,
        buttons: {
            'Ok': function()  {
                $( this ).dialog( 'close' );
            }
        }
    });
}


// This function is to perform action after clicking the publish now button 



  function onSubmit(token) {
  
         
    var response = grecaptcha.getResponse();
        
  if(response.length == 0) 
  { 
    //reCaptcha not verified
    custom_alert( 'Google Captcha Error', 'Alert' );
    // alert("please verify you are humann!"); 
    evt.preventDefault();
    return false;
  }
  else{
 editor.save().then((outputData) => {
     var tosend = JSON.stringify(outputData);
     var blogdata = (textFromJson(outputData));
     if(blogdata.length<100 || blogdata.length>100000){
        //  alert("Story is either too large or small.");
         
         custom_alert( 'Story is either too large or small.', 'Alert' );
         return false;
     }
     else{
     var uri_enc = encodeURIComponent(tosend);
     var metadata = $("#metadata").val();
     var costofstory = $("#costofstory").val();
     if(costofstory>=10000 || costofstory<2){
        //  alert("");
         custom_alert( 'Enter correct value of your story.[INR 2-9999]', 'Alert' );
          
         return false;
     }
     if(metadata.length<4 || metadata.length>200){
         
         custom_alert( 'Title of your story must be in the range [4-200]', 'Alert' );
         
         return false;
     }
     var captcha = response;
    
     $.ajax({
        type: 'POST',
        url: 'api/store.php',
        data: {
            "url":uri_enc,
            "metadata":metadata,
            "captcha": captcha,
            "amount":costofstory
            },
        
        
        success: function(response) {
            console.log(response);
            var response = JSON.parse(response);
            var status = response.statusCode;
				if(status=="200"){
				    $("#generatebox").hide();
				    $("#successcontainer").fadeToggle( "fast");
				   
                var url = response.link;
          var shareUrl = document.querySelector('.urltoshare');

             shareUrl.value = url;
				}
				else{
				     var error = response.error;
				      custom_alert( error, 'Alert' );
				}
        }
    });
}
}).catch((error) => {
  console.log('Saving failed: ', error)
});
}
grecaptcha.reset();
       }

