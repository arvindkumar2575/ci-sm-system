let common = {};
let validation = {};
let cookie = {};
let user = {};

common.ajaxCall = (url,type,data,onSucces,onError,onComplete)=>{
    let r = {}
    r.url = url
    r.type = type
    r.dataType = "json"
    r.header = {'x_key':'ajaxcallkey'}
    r.data = data
    r.success = onSucces
    r.error = onError
    r.complete = onComplete

    $.ajax(r)
}





// validation 
validation.email = (email)=>{
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(email==null && email==undefined){
        return false;
    }else if(email.match(emailRegex)){
        return true;
    }else{
        return false;
    }
}
validation.password = (password)=>{
    if(password==null && password==undefined){
        return false;
    }else if(password.length>8 && password.length<20){
        return true;
    }else{
        return false;
    }
},
validation.text = (text,len=null)=>{
    if(text==null && text==undefined){
        return false;
    }else if(text!="" && text.length>=len){
        return true;
    }else{
        return false;
    }
}
validation.isNumber = (n)=>{
    let number = parseInt(n)
    if(number==NaN){
        return false;
    }else if(number>0){
        return true;
    }else{
        return false;
    }
}


cookie.setCookie = (cName, cValue, expDays)=> {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

user.add = ()=>{
    let url = manageURLAPI + '/add-user'
    let data = {}

    let user_type_elm = $('select[name=user_type]')
    if (user_type_elm.val() == "") {
        user_type_elm.addClass("field-focus-error")
        return false;
    }
    data.user_type = user_type_elm.val()

    let gender_id_elm = $('select[name=gender_id]')
    if (gender_id_elm.val() == "") {
        gender_id_elm.addClass("field-focus-error")
        return false;
    }
    data.gender_id = gender_id_elm.val()

    let email_elm = $('input[name=email]')
    if (email_elm.val() == "") {
        email_elm.addClass("field-focus-error")
        return false;
    }
    data.email = email_elm.val()

    let password_elm = $('input[name=password]')
    if (password_elm.val() == "") {
        password_elm.addClass("field-focus-error")
        return false;
    }
    data.password = password_elm.val()

    let first_name_elm = $('input[name=first_name]')
    if (first_name_elm.val() == "") {
        first_name_elm.addClass("field-focus-error")
        return false;
    }
    data.first_name = first_name_elm.val()

    let last_name_elm = $('input[name=last_name]')
    if (last_name_elm.val() == "") {
        last_name_elm.addClass("field-focus-error")
        return false;
    }
    data.last_name = last_name_elm.val()

    data.verified = $("select[name=verified]").val()
    data.status = $("select[name=status]").val()
    let emailValidator = validation.email(data.email);
    let passwordValidator = validation.password(data.password);
    data.form_type = $("input[name=form_type]").val();
    data.details = JSON.stringify(data);
    // console.log(data,emailValidator,passwordValidator)
    if (emailValidator && passwordValidator) {
        common.ajaxCall(url, "POST", data, (res) => {
            if (res.status && res.id != undefined && res.id != null) {
                window.location.href = manageURL + '/users'
            }
        }, (err) => {
            console.log(err)
        })
    }
}
user.edit = (id)=>{
    // alert("edit")
    window.location.href = manageURL+'/edit-user?uid='+id
}
user.delete = (id)=>{
    let url = manageURLAPI + '/delete-user'
    let data = {
        id:id
    }
    common.ajaxCall(url,"POST",data,()=>{
        if (res.status && res.id != undefined && res.id != null) {
            window.location.href = manageURL + '/users'
        }
    })
    alert("delete"+id)
}
