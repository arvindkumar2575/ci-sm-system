console.log('login.js loaded')



$("form#1-login-form").submit(function (e) {
    e.preventDefault()
    user.login()
});


$("form#2-register-form").submit(function (e) {
    e.preventDefault()
    user.register()
});


$("form#add-user-form").submit(function (e) {
    e.preventDefault()
    user.add()
});

$("form#edit-user-form").submit(function (e) {
    e.preventDefault()
    user.save()
});

$("button.table-btn-edit").on("click", function () {
    let id = $(this).data('id');
    user.edit(id)
})
$("button.table-btn-delete").on("click", function () {
    let id = $(this).data('id');
    let val = confirm("Do you want to delete this user?")
    if (val == true) {
        user.delete(id)
    }
})


