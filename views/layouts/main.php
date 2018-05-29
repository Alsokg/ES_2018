<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);

$menuPostfix = "";
$blogPostfix = "";
if (Yii::$app->language == "ru"){
    $menuPostfix = "-ru";
    $blogPostfix = "ru";
} else if(Yii::$app->language == "en"){
        $menuPostfix = "-en";
        $blogPostfix = "ru";
}

$session = Yii::$app->session;

// проверяем что сессия уже открыта
if (!$session->isActive){
    $session->open();
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="google-site-verification" content="dexoVWVV1Qfz5Dypz2BnCVXB9aD0gHA3m8vfxeEmQN4" />
<link rel="shortcut icon" href="../img/EnStudent.ico" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
   <link rel="stylesheet" href="/kids/css/kids.css?1.3">
   <link rel="stylesheet" href="/kids/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/1f6299aecd6768b2a4a13aa07a875d39_1.js" async></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NRFFXKT');</script>
<!-- End Google Tag Manager -->
<meta name="google-site-verification" content="Tfp6-PIk1b80PMG22jpZ0md6PJiQdrZBz-VE2qDVOiU" />
</head>
<body>
<?php $this->beginBody() ?>
    <header>
        <div class="h1">
            <div class="h2">
        <div class="lang-wrapper">
            <?php if ($this->params['langID'] == 0) { ?>
                <a href="<?= "/ru" . substr(Url::current(), 3);?>">RU</a>
                <a class="active" href="<?= "/uk" . substr(Url::current(), 3);?>">UA</a>
                <a href="<?= "/en" . substr(Url::current(), 3);?>">EN</a>
            <?php }  else if ($this->params['langID'] == 1){?>
                <a href="<?= "/uk" . substr(Url::current(), 3);?>">UA</a>
                <a class="active" href="<?= "/ru" . substr(Url::current(), 3);?>">RU</a>
                <a href="<?= "/en" . substr(Url::current(), 3);?>">EN</a>
            <?php } else if ($this->params['langID']) {?>
                <a href="<?= "/uk" . substr(Url::current(), 3);?>">UA</a>
                <a class="active" href="<?= "/en" . substr(Url::current(), 3);?>">EN</a>
                <a href="<?= "/ru" . substr(Url::current(), 3);?>">RU</a>
            <?php } ?>
        </div>
    <?php include ('common/menu.php'); ?>
        <div class="phone-wrapper">
            <span><?php echo $this->params['phones'][0]; ?></span>
            <div class="phone-popup">
                <?php $i=0; foreach ($this->params['phones'] as $phone) { ?>
                    <?php if ($i > 0) { ?>
                        <span><?= $phone; ?></span>
                    <?php } else { $i++;} ?>
                <?php } ?>
            </div>
            
        </div>
        </div>
        </div>
  
    </header>
    <div class="container">
        <?= $content ?>
    </div>

    <footer>
        <div class="wrapper flexbox">
            
            <ul class="link-list">
                <li><a href="<?= "https://englishstudent.net/".Yii::$app->language.""; ?>"><?= Yii::t('yii', 'CARDS') ?></a></li>
                <li><a href="<?= "https://englishstudent.net/".Yii::$app->language."/kids"; ?>"><?= Yii::t('yii', 'For Kids') ?></a></li>
            </ul>
            <ul class="link-list second-list">
                <li><a href=<?="https://englishstudent.net/blog/".$blogPostfix?>><?= Yii::t('yii', 'Blog') ?></a></li>
                <li><a href="<?="https://englishstudent.net/".Yii::$app->language."/about-us"?>"><?= Yii::t('yii', 'Publisher') ?></a></li>
            </ul>
            <ul class="link-list">
                <li><a href="<?="https://englishstudent.net/".Yii::$app->language."/contacts"?>"><?= Yii::t('yii', 'Contacts') ?></a></li>
                <li><a href="<?= "https://englishstudent.net/".Yii::$app->language."/partners"; ?>"><?= Yii::t('yii', 'Partners') ?></a></li>
		<li><a href="<?= "https://englishstudent.net/".Yii::$app->language."/helpfull"; ?>"><?= Yii::t('yii', 'Add-info') ?></a></li>
            </ul>
            <div class="contacts">
                <?php foreach($this->params['phones'] as $phone) { ?>
                    <p class="phone-f"><?= $phone; ?></p>
                <?php } ?>
                <ul class="social-list">
                    <li><a href="https://plus.google.com/u/0/101890302520258498295" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.facebook.com/englishstudentflashcards" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.instagram.com/english_student_flashcards/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <?php if (array_key_exists('seo',$this->params)){ ?>
            <p class="seo-text"><?php echo $this->params['seo']?></p>
        <?php } ?>
        <div class="copyright"><?=Yii::t('yii','Publisher');?> English Student <i class="fa fa-copyright" aria-hidden="true"></i> 2017</div>
        
    </footer>
<link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=cyrillic" rel="stylesheet" type='text/css'>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel="stylesheet" type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

<script type="text/javascript">
 
   window.fbAsyncInit = function() {
    FB.init({
      appId      : '198169410598597',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function getInfo() {
  FB.api('/me', 'GET', {
    fields: 'email,first_name,last_name,name,id,picture.width(150).height(150)'
  }, function(response) {
         $('input[name="image-src"]').val(response.picture.data.url);
         $('#preview').attr('src', response.picture.data.url);
         $('#preview2').attr('src', response.picture.data.url);
          $('input[name="name-comment"]').val(response.name);
          $('input[name="email-comment"]').val(response.email);
         
  });
}
  $('.fb').on('click',function(e){
    e.preventDefault();
   FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    getInfo();
  }
else{
  FB.login(function(response) {
          if (response.authResponse) {
              getInfo();
          }
    // handle the response
  }, {scope: 'email'});
}
  });
});
$('.signin-button').on('click', function(e){
  e.preventDefault();
  handleSignInClick();
  //ga('send', 'event', 'Отправка формы', 'Войти с помощью',  'Google Plus');
});  
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      function initClient() {
        gapi.client.init({
            apiKey: 'AIzaSyCGZEM2xJ0JdHGIEOiwJmRVJS1f8lkq5hs',
            discoveryDocs: ["https://people.googleapis.com/$discovery/rest?version=v1"],
            clientId: '770881395491-jd9jq9dq9tqoe9ic20ccu1g1h9nrph7n.apps.googleusercontent.com',
            scope: 'profile'
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        });
      }

      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
          makeApiCall();
        }
      }

      function handleSignInClick(event) {
        gapi.auth2.getAuthInstance().signIn();
        makeApiCall();
      }

      function handleSignOutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      function makeApiCall() {
        gapi.client.people.people.get({
          resourceName: 'people/me'
        }).then(function(response) {
          
           $('input[name="name-comment"]').val(response.result.names[0].givenName + " " + response.result.names[0].familyName);
          $('input[name="image-src"]').val(response.result.photos[0].url);
          $('#preview').attr('src', response.result.photos[0].url);
          $('#preview2').attr('src', response.result.photos[0].url);
           $('input[name="email-comment"]').val(response.result.emailAddresses[0].value);
           
        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });
      }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
<?php $this->endBody() ?>

<script>
 
    $('.phone-wrapper').on('click', function(){
       $(this).addClass('open'); 
    });
    $(document).click(function(event) { 
    if(!$(event.target).closest('.phone-wrapper').length) {
            $('.phone-wrapper').removeClass('open')
        
    }        
})
$('.toggle-menu').on('click', function(){
   $('.h2 nav').toggleClass('open');
   if ( $('.h2 nav').hasClass('open')){
       $('.h2 nav').css('display', 'block');
   }else{
       $('.h2 nav').css('display', 'none');
   }
});
    //$( "#phone" ).phoneValidator();
</script>
<script src="/js/all2.js"></script>
<script src="/kids/slick/slick.min.js"></script>
<link rel="stylesheet" href="/kids/slick/slick.css">
<link rel="stylesheet" href="/kids/slick/slick-theme.css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78152418-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'Y0GLcNFgUo';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>
<?php $this->endPage() ?>
