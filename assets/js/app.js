console.log('login.js loaded')

$(window).ready(function () {
    // $('#edit-user-form').css('display','none')

    $('.search-list').on('click', '.ss-list', function (e) {
        let user_name = $(this).find('.user_name').text()
        let uid = $(this).data('id')
        let action = $('input#name_email').data('action_in')
        $('input#name_email').val(user_name)
        let url = manageURLAPI + '/fetch-user-form'
        let data = {
            id: uid,
            form_btn: 'edit',
            action: action
        }
        common.ajaxCall(url, 'GET', data, (res) => {
            if(res.status){
                if(action=='edit_user'){
                    $('#add-edit-user-form').html(res.data)
                    urlParams.set('uid',uid)
                    window.history.replaceState(window.location.href, null, '?'+urlParams);
                }else if(action=='permission_user'){
                    $('#add-edit-permission-form').html(res.data)
                    urlParams.set('uid',uid)
                    window.history.replaceState(window.location.href, null, '?'+urlParams);
                }else{
                    $('#add-edit-permission-form').html('')
                }
            }
            console.log(res)
        }, (err) => {
            console.log(err)
        })

        // e.stopPropagation();
    })
})

$("form").find("input,textarea,select").click(function (e) {
    if ($(this).hasClass("field-focus-error")) {
        $(this).removeClass("field-focus-error")
    }
})

$(document).on("submit","form#1-login-form",function (e) {
    e.preventDefault()
    user.login()
});

$(document).on("submit","form#2-register-form",function (e) {
    e.preventDefault()
    user.register()
});




// user 
$(document).on("submit","form#add-user-form",function (e) {
    e.preventDefault()
    user.add()
});

$(document).on("submit","form#edit-user-form",function (e) {
    e.preventDefault()
    user.save()
});

$(document).on("submit","form#edit-user-permissions-form",function (e) {
    e.preventDefault()
    user.savepermission(this)
})

$(document).on("click","button.user-table-btn-permissions",function (e) {
    let id = $(this).data('id');
    user.editpermission(id)
})

$(document).on("click","button.user-table-btn-edit",function (e) {
    let id = $(this).data('id');
    user.edit(id)
})

$(document).on("click","button.user-table-btn-delete",function (e) {
    let id = $(this).data('id');
    let val = confirm("Do you want to delete this user?")
    if (val == true) {
        user.delete(id)
    }
})




// role 
$(document).on("submit","form#add-role-form",function (e) {
    e.preventDefault()
    role.add()
});

$(document).on("submit","form#edit-role-form",function (e) {
    e.preventDefault()
    role.save()
});

$(document).on("submit","form#edit-role-permissions-form",function (e) {
    e.preventDefault()
    role.savepermission(this)
})

$(document).on("click","button.role-table-btn-edit",function (e) {
    let id = $(this).data('role-id');
    role.edit(id)
})

$(document).on("click","button.role-table-btn-permissions",function (e) {
    let id = $(this).data('role-id');
    role.editpermission(id)
})

$(document).on("click","button.role-table-btn-delete",function (e) {
    let id = $(this).data('role-id');
    let val = confirm("Do you want to delete this role?")
    if (val == true) {
        role.delete(id)
    }
})



// permission 
$(document).on("submit","form#add-permission-form",function (e) {
    e.preventDefault()
    permission.add()
});

$(document).on("submit","form#edit-permission-form",function (e) {
    e.preventDefault()
    permission.save()
});

$(document).on("click","button.permission-table-btn-edit",function (e) {
    let id = $(this).data('permission-id');
    permission.edit(id)
})

$(document).on("click","button.permission-table-btn-delete",function (e) {
    let id = $(this).data('permission-id');
    let val = confirm("Do you want to delete this permission?")
    if (val == true) {
        permission.delete(id)
    }
})





$(document).on('keyup','input#name_email',function () {
    if (this.value.length > 2) {
        common.searchNameEmail(this.value)
    } else {
        $('.filter-form .search-list').hide();
        $('.filter-form .search-list').html('')
    }
})
$(document).mouseup(function (e) {
    var container = $(document).find("input#name_email");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.filter-form .search-list').hide();
    }
});


