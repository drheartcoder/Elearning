window.fbAsyncInit = function() {
    FB.init({
      appId      : '936795189855884',
      status     : true, 
      cookie     : true, 
      xfbml      : true,
      version    : 'v2.4'
    });
  };
// Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) { return; }
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
  

function FBLogin(redirect_url)
{
  redirect_url = redirect_url ? redirect_url : false;

  FB.login(function(fb_response){
    if(fb_response.authResponse){
      FB.api('/me', 'get', {fields: 'email,first_name,last_name'}, function(profile_response) {
        var email = profile_response.email;
        var fname = profile_response.first_name;
        var lname = profile_response.last_name;
        var fb_token = FB.getAuthResponse()['accessToken'];

        var datastr="email="+email+"&fname="+fname+"&lname=+"+lname+'&fb_token='+fb_token+"&_token="+csrf_token;

        
        jQuery.ajax({
            headers:{'X-CSRF-Token': csrf_token},
            url:SITE_URL+'/fblogin',
            type:'POST',
            data:datastr,
            dataType:'json',
            beforeSend: function(){
              $('#loader_image').show();
            },
            success:function(response)
            {
              if(response.status=="SUCCESS")
              {
                if(redirect_url != false)
                {
                  window.location.href =SITE_URL+redirect_url;
                }
                else
                {
                  window.location.href =SITE_URL+'/profile';
                  //alert('Logged In');
                }

              }
              else
              {
                $("#login_action_status").html("<div class='alert alert-danger'><strong>Error: </strong>"+response.msg+"<span> <a class='close' data-dismiss='alert'><i class='fa fa-times'></i></a></span></div>");
                setTimeout(function()
                {
                   $("#login_action_status").empty(); 
                },10000);
              }

              return false;
            },
            complete: function(){
              $('#loader_image').hide();
            }
          });
        
          return false;
      });
    }
  }, 
  {scope: 'public_profile,email'});
}

function FBLogout()
{
  FB.logout(function(response) {
    window.location.href =SITE_URL+'/logout';
  });
}

/*(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = SITE_URL+"/js/front/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));*/