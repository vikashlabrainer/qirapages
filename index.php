<?php
session_start();
if(!isset($_SESSION['logged'], $_SESSION['mobile'])){
	
	header("Location: login.php");
	
}
else{
?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/main.css?"<?php echo uniqid()?>>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- fontawesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<!-- jquery ui css  -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css" integrity="sha512-SsJq+mF6SR+NR5GizgVCURD39dLfHZg2MOJE5eoGUj0pm3Mcz0uxo370pC83L7+hnrxhXkcZeOcSOJrj0rULaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />




</head>
<body>
<div id="container" class="header">
 <img src="https://ftx-rp.netlify.app/img/ftx21.webp" class="logo"/>
<button id="publish-story"><i class="fas fa-arrow-square-right"></i></button>


<div class="blurred-box" id="generatebox" style="display:none">
<div class="back"></div>
<div class="registration-form">
  <header>
    <h1>Story, Ready?</h1>
    <sub>Finish this last step and you're done.</sub>
  </header>
<form>

  <div class="form__group">
  <textarea id="metadata" class="form__field" placeholder="Title of your story" rows="6"></textarea>
  <label for="message">Title of your story</label>
</div>
  <div class="form__group">
  <input type="text" id="costofstory" placeholder="Full Access Cost (INR 2- INR 9999)" onkeypress="return isNumber(event)" autocomplete="off" class="form__field">
  <label for="amount">Story Value (In INR)</label>
</div>
  <div class="padder">
              <button class="g-recaptcha publishbtn" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-theme="dark" data-callback='onSubmit'>Publish Now</button>

         
     </div>
 </form>
 
</div>
  
</div>



<div id="successcontainer" class="blurred-box" title="Story is now live!">
   <div>
      <header>
        <h1>Copy & Share</h1>
        <p>Protected Elements on your story will remain blurred for people till the payment is not done.</p>
      </header>
      <div>
        <div>
          <!-- COPY INPUT -->
		  <form class="form__group flexify">
          <input type="text"  class="form__field bigtext urltoshare" readonly="readonly"/>
		  
          <input type="button" value="Copy" class="copybutton"/>
		  </form>
        </div>
      </div>
     
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
<script src="script/main.js?"<?php echo uniqid()?>></script> 
<!-- End of libraries of editor js -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
<?php
}
?>