console.log('login.js loaded')

$("form").find("input,textarea,select").click(function(e) {
    if($(this).hasClass("field-focus-error")){
        $(this).removeClass("field-focus-error")  
    }
})

$("form#1-login-form").submit(function (e) {
    e.preventDefault()
    user.login()
});


$("form#2-register-form").submit(function (e) {
    e.preventDefault()
    user.register()
});

// user 
$("form#add-user-form").submit(function (e) {
    e.preventDefault()
    user.add()
});

$("form#edit-user-form").submit(function (e) {
    e.preventDefault()
    user.save()
});

$("button.user-table-btn-edit").on("click", function () {
    let id = $(this).data('id');
    user.edit(id)
})

$("button.user-table-btn-delete").on("click", function () {
    let id = $(this).data('id');
    let val = confirm("Do you want to delete this user?")
    if (val == true) {
        user.delete(id)
    }
})


// role 
$("form#add-role-form").submit(function (e) {
    e.preventDefault()
    role.add()
});

$("form#edit-role-form").submit(function (e) {
    e.preventDefault()
    role.save()
});

$("button.role-table-btn-edit").on("click", function () {
    let id = $(this).data('role-id');
    role.edit(id)
})

$("button.role-table-btn-delete").on("click", function () {
    let id = $(this).data('role-id');
    let val = confirm("Do you want to delete this role?")
    if (val == true) {
        role.delete(id)
    }
})



// permission 
$("form#add-permission-form").submit(function (e) {
    e.preventDefault()
    permission.add()
});

$("form#edit-permission-form").submit(function (e) {
    e.preventDefault()
    permission.save()
});

$("button.permission-table-btn-edit").on("click", function () {
    let id = $(this).data('permission-id');
    permission.edit(id)
})

$("button.permission-table-btn-delete").on("click", function () {
    let id = $(this).data('permission-id');
    let val = confirm("Do you want to delete this permission?")
    if (val == true) {
        permission.delete(id)
    }
})


// menu 
$("form#add-menu-form").submit(function (e) {
    e.preventDefault()
    menu.add()
});

$("form#edit-menu-form").submit(function (e) {
    e.preventDefault()
    menu.save()
});

$("button.menu-table-btn-edit").on("click", function () {
    let id = $(this).data('menu-id');
    menu.edit(id)
})

$("button.menu-table-btn-delete").on("click", function () {
    let id = $(this).data('menu-id');
    let val = confirm("Do you want to delete this menu?")
    if (val == true) {
        menu.delete(id)
    }
})

