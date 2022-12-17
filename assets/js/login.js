console.log('login.js loaded')



$("form#1-login-form").submit(function (e) {
    e.preventDefault()
    let url = manageURLAPI + '/auth'
    let data = {}
    data.username = $(this).find("input[name=email]").val();
    data.password = $(this).find("input[name=password]").val();
    data.form_type = $(this).find("input[name=form_type]").val();
    let remember = $(this).find("input[name=remember_me]").is(':checked');
    let emailValidator = validation.email(data.username);
    let passwordValidator = validation.password(data.password);
    // console.log(data,emailValidator,passwordValidator)
    if (emailValidator && passwordValidator) {
        common.ajaxCall(url, "GET", data, (res) => {
            if (res.status && res.id != undefined && res.id != null) {
                window.location.href = manageURL + '/' + res.id + '/dashboard'
            }
        }, (err) => {
            console.log(err)
        })
    }
});


$("form#2-register-form").submit(function (e) {
    e.preventDefault()
    let url = manageURLAPI + '/auth'
    let data = {}

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
    if(data.password!=password_repeat_elm.val()){
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
                window.location.href = manageURL + '/' + res.id + '/dashboard'
            }
        }, (err) => {
            console.log(err)
        })
    }
});


$("form#add-user-form").submit(function (e) {
    e.preventDefault()
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
});


