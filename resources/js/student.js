import $ from "jquery";
import '@majidh1/jalalidatepicker';
$("#open-sidebar-btn").click(() => {
    $(".side_bar").css("transform" , 'translateX( 0) ')
})

$("#close-sidebar").click(() => {
    $(".side_bar").css("transform" , 'translateX( 100%) ')
})
let notif_status = false;
$("#notif_btn").click((e) => {
    if(!notif_status){
        $("#notif_box").fadeIn("fast")
        notif_status = true;
    }else{
        $("#notif_box").fadeOut("fast")
        notif_status = false;
    }

})
$("#notif_close_btn").click((e) => {
    $("#notif_box").fadeOut("fast")
    setTimeout(() => {
        notif_status = false;
    } , 300)
})
let profile_status = false;

$("#profile-btn").click((e) => {
    if(!profile_status){
        $("#profile_box").fadeIn("fast")
        profile_status = true;
    }
    else if(profile_status){
        $("#profile_box").fadeOut("fast")
        profile_status = false;
    }

})
$("#profile_close_btn").click((e) => {
    $("#profile_box").fadeOut("fast")
    setTimeout(() => {
        profile_status = false;
    } , 300)
})

const message = {
    show : (text , time = 2000) => {
        $("#alert_dialog").css("transform" , "translateY(0%)")
        $("#alert_dialog span").html(text)
        setTimeout(() => {
            $("#alert_dialog").css("transform" , "translateY(121%)")

        } , time)
    }
}

// message.show("خوش اومدی رفیق")

$("#save_settings").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/set_settings",
        data : {
            username : $("#username").val(),
            password : $("#password").val() ,
            user_phone : $("#phone").val(),
            parent_phone : $("#parent_phone").val(),
            biography : $("#bio").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("ویرایش اطلاعات با موفقیت انجام شد")
        }
    })
})
const default_username = $("#username").val();
$("#username").keyup(() => {
    if($("#username").val() != default_username){
        $.get({
            url : "../api/check_username/" + $("#username").val(),
            success : (data) => {
                if(!data.ok){
                    $("#username").addClass("invalid")
                }else{
                    $("#username").removeClass("invalid")

                }
            }
        })
    }
})
let imgURL;

$("#profile_pic").change((e) => {
    imgURL = URL.createObjectURL(e.target.files[0]);
    $("#profile_box").attr("src", imgURL);
    $("#save_profile_btn").show(500)
})

$(document).ready(() => {
    $(`a[href='${window.location}']`).parent().addClass("active")
    setTimeout(() => {
        $(".loading-box").fadeOut("slow")
    } , 1000)
})

$(".close-btn") .click(function (){
    $(`#${$(this).data('close')}`).fadeOut(300)
})
$(".add_origin").click(function () {
    $.get({
        url : '../api/get_origins' ,
        data : {
            id : $(this).data('clinic'),
        },
        success : (data) => {
            $("#origin_doctor").html("");
            data.forEach((e) => {
                console.log(e)
                $("#origin_doctor").append(`<option value="${e.id}">${e.name}</option>`)
            })
        }
    });
    $("#actions_popup").fadeOut(300)
    $("#add_origin").fadeIn(300).data('clinic' , $(this).data('clinic'))
})
$(".add_doctor").click(function () {
    $("#actions_popup").fadeOut(300)
    $("#add_doctor").fadeIn(300).data('clinic' , $(this).data('clinic'))
})



$("#new_clinic").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/add_clinic",
        data : {
            name : $("#clinic_name").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("افزودن کلینیک با موفقیت انجام شد")
        }
    })
})

$("#new_doctor").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/add_doctor",
        data : {
            name : $("#doctor_name").val(),
            username : $("#doctor_username").val(),
            password : $("#doctor_password").val(),
            clinic_id : $("#add_doctor").data('clinic')
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("افزودن پزشک به کلینیک با موفقیت انجام شد");
                $("#add_doctor").fadeOut(300);
            }
        }
    })
})

$("#new_origin").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/add_origin",
        data : {
            name : $("#origin_name").val(),
            username : $("#origin_username").val(),
            password : $("#origin_password").val(),
            clinic_id : $("#add_origin").data('clinic')
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("افزودن منشی به کلینیک با موفقیت انجام شد");
                $("#add_origin").fadeOut(300);
            }
        }
    })
})

$(".actions-btn").click(function () {
    $("#actions_popup").fadeIn(300)
    $("#clinic_settings_btn").prop('href' , `./${$(this).data('id')}`)
    $("#add_origin_btn").data('clinic' , $(this).data('id'))
    $("#add_doctor_btn").data('clinic' , $(this).data('id'))
    $("#delete_product_btn").data('product' , $(this).data('id'))
    $("#delete_calendar").data('calendar' , $(this).data('id'))
    $("#delete_calendar2 a").data('calendar' , $(this).data('id'))
    $("#edite_calendar").data('calendar' , $(this).data('id'))
    $("#edite_calendar_2").prop('href' , `./${$(this).data('id')}`)
    $("#edite_calendar_3").prop('href' , `Doctor/calendar/${$(this).data('id')}`)
    $("#view_calendar").data('calendar' , $(this).data('id'))
    $("#remove_clinic").data('clinic' , $(this).data('id'))
    $("#delete_category").data('clinic' , $(this).data('id'))
})
$("#delete_product_btn").click(function () {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/delete_product",
        data : {
            id : $(this).data('product'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف کالا / خدمات انجام شد");
                $("#actions_popup").fadeOut(300);
                $(`#col_${$(this).data('product')}`).fadeOut(300);
            }
        }
    })
});
$("#delete_category").click(function () {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "./api/delete_category",
        data : {
            id : $(this).data('clinic'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف کالا / خدمات انجام شد");
                $("#actions_popup").fadeOut(300);
                $(`#col_${$(this).data('clinic')}`).fadeOut(300);
            }
        }
    })
});
$("#delete_calendar").click(function () {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/delete_calendar",
        data : {
            id : $(this).data('calendar'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف نوبت مورد نظر انجام شد");
                $("#actions_popup").fadeOut(300);
                $(`#col_${$(this).data('calendar')}`).fadeOut(300);
            }
        }
    })
});
$("#delete_calendar2").click(function () {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "./api/delete_calendar",
        data : {
            id : $(this).data('calendar'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف نوبت مورد نظر انجام شد");
                $("#actions_popup").fadeOut(300);
                $(`#col_${$(this).data('calendar')}`).fadeOut(300);
            }
        }
    })
});

$("#remove_clinic").click(function () {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/delete_clinic",
        data : {
            id : $(this).data('clinic'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف کلینیک مورد نظر انجام شد");
                $("#actions_popup").fadeOut(300);
                $(`#col_${$(this).data('clinic')}`).fadeOut(300);
            }
        }
    })
});


$("#view_calendar").click(function () {
    window.location = `calendar/${$(this).data('calendar')}`
});

$("#new_product").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/add_product",
        data : {
            name : $("#product_name").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("افزودن محصول / خدمات با موفقیت انجام شد")
            // window.location.reload()
        }
    })
})
$("#new_category").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "./api/add_category",
        data : {
            name : $("#product_name").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("افزودن دسته بندی با موفقیت انجام شد")
            // window.location.reload()
        }
    })
})
jalaliDatepicker.startWatch({
    time : true
});


$("#new_calendar").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/add_calendar",
        data : {
            name : $("#ref_name").val(),
            product_line : $("#product_line").val(),
            product_type : $("#product_type").val(),
            product_val : $("#product_val").val(),
            payment_way : $("#payment_way").val(),
            introduce_way : $("#introduce_way").val(),
            coming_time : $("#coming_time").val(),
            serial_number : $("#serial_number").val(),
            doctor_name : $("#doctor_name").val(),
            other_prices : $("#other_prices").val(),
            timeofwork : $("#timeofwork").val(),
            goted_money : $("#goted_money").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("افزودن نوبت با موفقیت انجام شد")
            // window.location.reload()
        }
    })
})

$("#edite_calendar_2").click(function() {
    console.log($(this).data('calendar'))
})
$("#edite_calendar").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/edite_calendar",
        data : {
            id : $("#calendar_id").data('id'),
            name : $("#ref_name").val(),
            product_line : $("#product_line").val(),
            product_type : $("#product_type").val(),
            product_val : $("#product_val").val(),
            payment_way : $("#payment_way").val(),
            introduce_way : $("#introduce_way").val(),
            coming_time : $("#coming_time").val(),
            serial_number : $("#serial_number").val(),
            doctor_name : $("#doctor_name").val(),
            other_prices : $("#other_prices").val(),
            timeofwork : $("#timeofwork").val(),
            goted_money : $("#goted_money").val()
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : () => {
            message.show("ویرایش نوبت با موفقیت انجام شد")
            // window.location.reload()
        }
    })
})

$(".manage_doctor").click(function () {
    $("#actions_popup_doctor").fadeIn(300).data('doctor' , $(this).data('id'))
})
$(".manage_origin").click(function () {
    $("#actions_popup_origin").fadeIn(300).data('doctor' , $(this).data('id'))
})
$("#remove_doctor_from_clinic").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/delete_doctor",
        data : {
            id :    $("#actions_popup_doctor").data('doctor'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف پزشک مورد نظر انجام شد");
                $("#actions_popup_doctor").fadeOut(300);
                $(`#col_${$(this).data('doctor')}_doctor`).fadeOut(300);
            }
        }
    })
});
$("#remove_origin_from_clinic").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/delete_origin",
        data : {
            id :    $("#actions_popup_origin").data('doctor'),
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("حذف منشی مورد نظر انجام شد");
                $("#actions_popup_origin").fadeOut(300);
                $(`#col_${$(this).data('doctor')}_origin`).fadeOut(300);
            }
        }
    })
});
$("#edite_doctor").click(() => {
    $("#actions_popup_doctor").fadeOut(300);
    $("#edite_doctor_pop").fadeIn(300).data('doctor' , $("#actions_popup_doctor").data('doctor'));
    $.get({
        url : '../api/get_doctor',
        data : {
            id : $("#edite_doctor_pop").data('doctor')
        },
        success : (e) =>  {
            $("#doctor_name").val(e.name)
            $("#doctor_username").val(e.username)
        }
    })
})
$("#edite_origin").click(() => {
    $("#actions_popup_origin").fadeOut(300);
    $("#edite_origin_pop").fadeIn(300).data('doctor' , $("#actions_popup_origin").data('doctor'));
    $.get({
        url : '../api/get_origin',
        data : {
            id : $("#edite_origin_pop").data('doctor')
        },
        success : (e) =>  {
            $("#origin_name").val(e.name)
            $("#origin_username").val(e.username)
        }
    })
})
$("#edite_doctor_btn").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/edite_doctor",
        data : {
            name : $("#doctor_name").val(),
            username : $("#doctor_username").val(),
            password : $("#doctor_password").val(),
            doctor : $("#edite_doctor_pop").data('doctor')
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("ویرایش اطلاعات پزشک با موفقیت انجام شد");
                $("#edite_doctor_pop").fadeOut(300);
                $(`#col_${$("#edite_doctor_pop").data('doctor')}_doctor .name_v`).html($("#doctor_name").val())
            }
        }
    })
})

$("#edite_origin_btn").click(() => {
    $.post({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/edite_origin",
        data : {
            name : $("#origin_name").val(),
            username : $("#origin_username").val(),
            password : $("#origin_password").val(),
            doctor : $("#edite_origin_pop").data('doctor')
        },
        error: function(xhr, textStatus, error){

            if(xhr.status == 422){
                message.show(xhr.responseJSON.message , 3000)
            }
        },
        success : (data) => {
            if(data["ok"]){
                message.show("ویرایش اطلاعات منشی با موفقیت انجام شد");
                $("#edite_origin_pop").fadeOut(300);
                $(`#col_${$("#edite_origin_pop").data('doctor')}_doctor .name_v`).html($("#origin_name").val())
            }
        }
    })
})

