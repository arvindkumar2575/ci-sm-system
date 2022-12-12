console.log('login.js loaded')



$("form#1-login-form").submit(function (e) {
    e.preventDefault()
    let url = manageURL+'/auth'
    let data = {}
    data.username = $(this).find("input[name=email]").val();
    data.password = $(this).find("input[name=password]").val();
    data.form_type = $(this).find("input[name=form_type]").val();
    let remember = $(this).find("input[name=remember_me]").is(':checked');
    let emailValidator = validation.email(data.username);
    let passwordValidator = validation.password(data.password);
    // console.log(data,emailValidator,passwordValidator)
    if(emailValidator && passwordValidator){
        common.ajaxCall(url,"GET",data,(res)=>{
            if(res.status && res.id!=undefined && res.id!=null){
                window.location.href=manageURL+'/'+res.id+'/dashboard'
            }
        },(err)=>{
            console.log(err)
        })
    } 
});


