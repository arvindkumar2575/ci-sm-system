let common = {};
let validation = {};
let cookie = {};

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