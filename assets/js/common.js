let common = {};
let validation = {};
let cookie = {};
let user = {};
let role = {};
let permission = {};
let menu = {};
let urlParams = new URLSearchParams(window.location.search);

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

common.popup_error = (message)=>{
    let espace = $('#spr')
    let error = message
    espace.find('.popup-title').html(error)
    espace.show()
    setTimeout(() => {
        espace.hide()
        espace.find('.popup-title').html("")
    }, 2000);
}

common.searchNameEmail = (val)=>{
    let url = manageURLAPI + '/search-name-email'
    data={q:val}
    common.ajaxCall(url, "GET", data, (res) => {
        if (res.status) {
            if(res.data.length>0){
                ls = '';
                res.data.forEach(e => {
                    ls+=`<li class="ss-list" data-id="`+e.id+`"><span class="user_name">`+e.email+`</span><span>(`+e.first_name+` `+e.last_name+`)</span></li>`
                });
                let elm = `<ul class="search-ul-list">`+ls+`</ul>`
                $('.filter-form .search-list').html(elm)
                $('.filter-form .search-list').show();
            }else{
                $('.filter-form .search-list').hide();
                $('.filter-form .search-list').html('')
            }
        } else {
            console.log(res)
        }
    }, (err) => {
        console.log(err)
    })
}

common.getCheckedPermissions = ()=>{
    let arr = new Array()
    return arr
}





// validation 
validation.email = (email)=>{
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(email==null || email==undefined || email==''){
        return 'Required email address!';
    }else if(email.match(emailRegex)){
        return true;
    }else{
        return 'Required valid email!';
    }
}
validation.password = (password)=>{
    if(password==null || password==undefined || password==''){
        return 'Required password';
    }else if(password.length>8 && password.length<20){
        return true;
    }else{
        return 'Password must be of length 8 to 20.';
    }
},
validation.text = (text,len=null)=>{
    if(text==null || text==undefined || text==''){
        return false;
    }else if(text.length>=len){
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








user.login = ()=>{
    let url = manageURLAPI + '/auth'
    let data = {}
    data.username = $("input[name=email]").val();
    data.password = $("input[name=password]").val();
    data.form_type = $("input[name=form_type]").val();
    let remember = $("input[name=remember_me]").is(':checked');
    let emailValidator = validation.email(data.username);
    let passwordValidator = validation.password(data.password);
    // console.log(data,emailValidator,passwordValidator)
    if (emailValidator == true && passwordValidator == true) {
        common.ajaxCall(url, "GET", data, (res) => {
            if (res.status && res.id != undefined && res.id != null) {
                window.location.href = manageURL + '/dashboard'
            } else {
                common.popup_error(res.message)
            }
        }, (err) => {
            console.log(err)
        })
    } else {
        let message = (emailValidator != true) ? emailValidator : passwordValidator
        common.popup_error(message)
    }
}
user.register = ()=>{
    let url = manageURLAPI + '/auth'
    let data = {}

    let first_name_elm = $('input[name=first_name]')
    if (first_name_elm.val() == "") {
        first_name_elm.addClass("field-focus-error")
        common.popup_error('First Name is required!')
        return false;
    }
    data.first_name = first_name_elm.val()

    let last_name_elm = $('input[name=last_name]')
    if (last_name_elm.val() == "") {
        last_name_elm.addClass("field-focus-error")
        return false;
    }
    data.last_name = last_name_elm.val()

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

    let password_repeat_elm = $('input[name=password_repeat]')
    if (password_repeat_elm.val() == "") {
        password_repeat_elm.addClass("field-focus-error")
        return false;
    }
    if (data.password != password_repeat_elm.val()) {
        common.popup_error("Password is not matched!")
        return false;
    }

    let gender_id_elm = $('select[name=gender_id]')
    if (gender_id_elm.val() == "") {
        gender_id_elm.addClass("field-focus-error")
        return false;
    }
    data.gender_id = gender_id_elm.val()

    let user_type_elm = $('select[name=user_type]')
    if (user_type_elm.val() == "") {
        user_type_elm.addClass("field-focus-error")
        return false;
    }
    data.user_type = user_type_elm.val()

    let remember = $("input[name=remember_me]").is(':checked');
    let emailValidator = validation.email(data.email);
    let passwordValidator = validation.password(data.password);
    data.form_type = $("input[name=form_type]").val();
    data.details = JSON.stringify(data);
    // console.log(data,emailValidator,passwordValidator)
    if (emailValidator && passwordValidator) {
        common.ajaxCall(url, "POST", data, (res) => {
            if (res.status && res.id != undefined && res.id != null) {
                common.popup_error(res.message)
                window.location.href = manageURL + '/dashboard'
            }else{
                common.popup_error(res.message)
            }
        }, (err) => {
            console.log(err)
        })
    }else{
        let message = (emailValidator != true) ? emailValidator : passwordValidator
        common.popup_error(message)
    }
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
user.editpermission = (id)=>{
    // alert("edit")
    window.location.href = manageURL+'/permission-user?uid='+id
}
user.savepermission = ()=>{
    // alert("edit")
    let form = $(document).find('form#edit-user-permissions-form')
    console.log(form)
}
user.save = ()=>{
    // alert("save")
    let url = manageURLAPI + '/edit-user'
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
    data.form_type = $("input[name=form_type]").val();
    data.id = urlParams.get('uid')
    // console.log(data,emailValidator,passwordValidator)
    if (emailValidator) {
        common.ajaxCall(url, "POST", data, (res) => {
            if (res.status && res.id != undefined && res.id != null) {
                window.location.href = manageURL + '/users'
            }
        }, (err) => {
            console.log(err)
        })
    }
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
}



// roles 
role.add = ()=>{
    let url = manageURLAPI + '/add-role'
    let data = {}

    let role_name_elm = $('input[name=name]')
    if (role_name_elm.val() == "") {
        role_name_elm.addClass("field-focus-error")
        return false;
    }
    data.name = role_name_elm.val()

    let display_name_elm = $('input[name=display_name]')
    if (display_name_elm.val() == "") {
        display_name_elm.addClass("field-focus-error")
        return false;
    }
    data.display_name = display_name_elm.val()

    data.remarks = $('textarea[name=remarks]').val()
    data.form_type = $("input[name=form_type]").val();
    common.ajaxCall(url, "POST", data, (res) => {
        if (res.status && res.id != undefined && res.id != null) {
            window.location.href = manageURL + '/roles'
        }
    }, (err) => {
        console.log(err)
    })
}
role.edit = (id)=>{
    window.location.href = manageURL+'/edit-role?id='+id
}
role.editpermission = (id)=>{
    // alert("edit")
    window.location.href = manageURL+'/permission-user?uid='+id
}
role.savepermission = ()=>{
    // alert("edit")
    let form = $(document).find('form#edit-user-permissions-form')
    console.log(form)
}
role.save = (id)=>{
    let url = manageURLAPI + '/edit-role'
    let data = {}

    data.name = $('input[name=name]').val()

    let display_name_elm = $('input[name=display_name]')
    if (display_name_elm.val() == "") {
        display_name_elm.addClass("field-focus-error")
        return false;
    }
    data.display_name = display_name_elm.val()

    data.remarks = $('textarea[name=remarks]').val()
    data.form_type = $("input[name=form_type]").val();
    data.id = urlParams.get('id')
    common.ajaxCall(url, "POST", data, (res) => {
        if (res.status && res.id != undefined && res.id != null) {
            window.location.href = manageURL + '/roles'
        }
    }, (err) => {
        console.log(err)
    })
}
role.delete = (id)=>{
    let url = manageURLAPI + '/delete-role'
    let data = {
        id:id
    }
    common.ajaxCall(url,"POST",data,(res)=>{
        if (res.status) {
            window.location.href = manageURL + '/roles'
        }else{

        }
    })
}



// permissions 
permission.add = ()=>{
    let url = manageURLAPI + '/add-permission'
    let data = {}

    let permission_name_elm = $('input[name=name]')
    if (permission_name_elm.val() == "") {
        permission_name_elm.addClass("field-focus-error")
        return false;
    }
    data.name = permission_name_elm.val()

    let display_name_elm = $('input[name=display_name]')
    if (display_name_elm.val() == "") {
        display_name_elm.addClass("field-focus-error")
        return false;
    }
    data.display_name = display_name_elm.val()

    data.parent = $('select[name=parent]').val()
    data.priority = $('input[name=priority]').val()
    data.routing_url = $('input[name=routing_url]').val()
    data.status = $('select[name=status]').val()
    data.remarks = $('textarea[name=remarks]').val()
    data.form_type = $("input[name=form_type]").val();
    common.ajaxCall(url, "POST", data, (res) => {
        if (res.status && res.id != undefined && res.id != null) {
            window.location.href = manageURL + '/permissions'
        }
    }, (err) => {
        console.log(err)
    })
}
permission.edit = (id)=>{
    window.location.href = manageURL+'/edit-permission?id='+id
}
permission.save = (id)=>{
    let url = manageURLAPI + '/edit-permission'
    let data = {}

    data.name = $('input[name=name]').val()

    let display_name_elm = $('input[name=display_name]')
    if (display_name_elm.val() == "") {
        display_name_elm.addClass("field-focus-error")
        return false;
    }
    data.display_name = display_name_elm.val()

    data.parent = $('select[name=parent]').val()
    data.priority = $('input[name=priority]').val()
    data.routing_url = $('input[name=routing_url]').val()
    data.status = $('select[name=status]').val()
    data.remarks = $('textarea[name=remarks]').val()
    data.form_type = $("input[name=form_type]").val();
    data.id = urlParams.get('id')
    common.ajaxCall(url, "POST", data, (res) => {
        if (res.status && res.id != undefined && res.id != null) {
            window.location.href = manageURL + '/permissions'
        }
    }, (err) => {
        console.log(err)
    })
}
permission.delete = (id)=>{
    let url = manageURLAPI + '/delete-permission'
    let data = {
        id:id
    }
    common.ajaxCall(url,"POST",data,(res)=>{
        if (res.status) {
            window.location.href = manageURL + '/permissions'
        }else{

        }
    })
}



