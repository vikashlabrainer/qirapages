<?php
session_start();
require __DIR__ .'/config/dbconnect.php';	
require __DIR__ .'/razorpay-php/Razorpay.php';
include __DIR__ .'/define.php';	
include __DIR__ .'/functions/function.php';
use Razorpay\Api\Api;
if(isset($_GET['url'])){
$url = mysqli_real_escape_string($conn,trim($_GET['url']));	
$sql= "SELECT * FROM ".TABLE_NAME." WHERE uniqlink= '$url'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
	
{ 
try {
$api = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$amount= $row['amount'];
$title_sql = $row['title'];
	//////////////////////////////////////////////////////
	$orderData = [
    'receipt'         => 12345,
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];

if (RAZORPAY_CURRENCY !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=RAZORPAY_CURRENCY&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][RAZORPAY_CURRENCY] * $amount / 100;
}
$data = [
    "key"               => RAZORPAY_KEY,
    "amount"            => $amount,
    "name"              => "QiraPages Story",
    "description"       => $title_sql,
    "image"             => "",
         
    "prefill"           => [
    
    
    
    ],
    "notes"             => [
    "address"           => "NEWBIE",
    "merchant_order_id" => $row['uniqlink'],
    "shopping_order_id" => "3456",
    ],
    "theme"             => [
    "color"             => "#20253f"
    ],
    "order_id"          => $razorpayOrderId,
   
];

if (RAZORPAY_CURRENCY !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json_payment = json_encode($data);
//catch exception
}
catch(Exception $e) {
  echo 'Order ID creation failed' ;
  
  exit();
}


$json = $row['json'];

//decoding the json 

$jsonx = urldecode($json);
$jsonx = json_decode($jsonx,true);

foreach($jsonx["blocks"] as $item){
    // print_r($item);
    $i=0;
    
    if(isset($item["tunes"]["anchorTune"]["anchor"])){
    if($item["tunes"]["anchorTune"]["anchor"]=="hide"){
        // echo("<br>Match Found");
        // print_r($item['data']['file']);
        if($item["type"]=="image"){
        $temp = $item['data']['file'];
        $secret = encrypt($temp['url']);
        
        $temp['url']= DOMAIN_NAME."/qirapages/api/img.php?url=$secret";
        
        $item["data"]["file"] = $temp;
        }
         if($item["type"]=="paragraph"){
        $temp = $item['data']['text'];
        $temp = "<img src= '".DOMAIN_NAME."/qirapages/img/1.svg' style='width:100%'/>";
        
        $item["data"]["text"] = $temp;
        }
          if($item["type"]=="math"){
              $item["type"]="paragraph";
        $temp = $item['data']['text'];
        $temp = "<img src= '".DOMAIN_NAME."/qirapages/img/2.svg' style='width:100%'/>";
        
        $item["data"]["text"] = $temp;
        }
          if($item["type"]=="list"){
              $item["type"]="paragraph";
        $vc=[];
        $vc["text"]=$temp;
         $item["data"]= $vc;
        
       
        }
         if($item["type"]=="embed"){
			$item["type"]="paragraph";

        $temp = "<img src= '".DOMAIN_NAME."/qirapages/img/1.svg' style='width:100%'/>";
        $vc=[];
        $vc["text"]=$temp;
           $item["data"]= $vc;
    
        }
    }
    
    
    $i=$i+1;
    
    }
    $newJsonString[] = $item;
}


$jsonx['blocks']= $newJsonString;

$jsonx = htmlspecialchars_decode(json_encode($jsonx));
//print_r($jsonx);

} 
else{
	
	echo("no file found");
}
}
else{
	
	
	// ERROR DUE TO PARAMETER NOT FOUND
	echo("URL Malformed");
	
}

?>


<!doctype HTML>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/main.css?id="<?php echo uniqid()?>>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- fontawesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<!-- jquery ui css  -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css" integrity="sha512-SsJq+mF6SR+NR5GizgVCURD39dLfHZg2MOJE5eoGUj0pm3Mcz0uxo370pC83L7+hnrxhXkcZeOcSOJrj0rULaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>

.ce-block__content{
     -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;

   /*
     Introduced in IE 10.
     See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
   */
   -ms-user-select: none;
   user-select: none;
}
.ce-toolbar{
    display:none;
}
.image-tool__caption{
    display:none;
}

</style>


</head>
<body>
<div id="container" class="header">
 <img src="https://ftx-rp.netlify.app/img/ftx21.webp" class="logo"/>
<button id="publish-story"><i class="fas fa-arrow-square-right"></i></button>


<div class="blurred-box" id="generatebox" style="display:none">
<div class="back"></div>
<div class="registration-form">
  <header>
    <h1>Purchase full access to this story</h1>
    <sub>Already purchased, click here</sub>
  </header>
 <button id="rzp-button1">Purchase Now</button>
    <?php
 
  require __DIR__ .'/checkout/checkout.php';	
  
  ?>

 
</div>
  
</div>



<div id="successcontainer" class="blurred-box" title="Story is now live!">
   <div>
      <header>
        <h1>Success!</h1>
        <p>You have now full access to this story. Thank you for using our platform</p>
      </header>
         
    </div>
</div>



</div>


<div id="editorjs"></div>



<!-- Adding libraries of editor js -->

<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@1.2.2/dist/bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-text-color-plugin@1.1.22/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@2.7.0/dist/bundle.js" integrity="sha256-TO0KUJTgmEP+BAy/7sBE0S7S7tMyXYMdpnrLZhPGEiM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-math@1.0.2/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.3.0"></script> 
<script src="https://cdn.jsdelivr.net/npm/editorjs-text-alignment-blocktune@latest"></script> 
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@2.8.0/dist/bundle.js" integrity="sha256-2AB9mmeBFiQRLsgAFDJe1buZSDDpO4aSpJlDlW008EQ=" crossorigin="anonymous"></script>
<script src="script/bundle.js"></script> 
<!-- End of libraries of editor js -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>



<script>
function getCookie(name) {
    var cname = name + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++){
        var c = ca[i];
        while(c.charAt(0) == ' '){
            c = c.substring(1);
        }
        if(c.indexOf(cname) == 0){
            return c.substring(cname.length, c.length);
        }
    }
    return "";
}
	
 const editor = new EditorJS({
      autofocus: false,
      data: <?php echo $jsonx?>,
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
	

	</script>
	<script>
	
		
	</script>

<script src="script/public.js?"<?php echo uniqid()?>></script> 

</body>
</html>


