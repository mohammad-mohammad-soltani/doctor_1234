import $ from "jquery";

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
