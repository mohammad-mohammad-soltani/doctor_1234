import $ from "jquery";

$(document).ready(function () {
    setTimeout(function () {
        $(".loader").addClass('hidden_loader');
        setTimeout(() => {
            document.querySelector('.hidden_loader').style.display = 'none';
        }, 500); // بعد از 0.5 ثانیه مقدار display را none کن

    } , 200)
});
let now_user;
let now_course;
$('.set_score').click((event) => {
    now_user = $(event.target).attr('student_national_code');
    now_course = $(event.target).attr('student_course');

    $('#set_score').show(400)

    $("#set_score .modal_title").html(`ثبت نمره برای ${$(event.target).attr('student_name')}`)
})
$("#send_score").click(() => {
    $.post({

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../api/set_score/"+now_user,
        data : {
            course : now_course,
            type : $("#score_type").val(),
            value : $("#score_value").val(),
            description : $("#score_description").val(),

        },
        success : (data) => {
            if(data.ok){
                $('#set_score').hide(400)
                message.success("ثبت نمره موفقیت آمیز بود")
            }else{
                message.error("مشکلی پیش آمد")


            }
        },

    }).fail(() => {
        message.error("مشکلی پیش آمد")
    })
})

const message = {
    success : (text) => {
        $("#message_alert p").html(text);
        $("#message_alert .ok_icon").removeClass("hidden2");
        $("#message_alert .error_icon").addClass("hidden2");
        $("#message_alert").attr("style" , "--alert-type-color : var(--color-blue-500) ; transform : translateY(0%");
        setTimeout(() => {
            $("#message_alert").attr("style" , " transform : translateY(150%");

        } , 3000);
    },
    error : (text) => {
        $("#message_alert p").html(text);
        $("#message_alert .error_icon").removeClass("hidden2");
        $("#message_alert .ok_icon").addClass("hidden2");
        $("#message_alert").attr("style" , "--alert-type-color : var(--color-red-600) ; transform : translateY(0%");
        setTimeout(() => {
            $("#message_alert").attr("style" , " transform : translateY(150%");

        } , 3000);
    }
}
$("#close_score_detail").click(() => {
    $(".modal").hide(400)
})
$(".show_details").click((e) => {
    $("#score_detail .modal_card .text").html($(e.target).attr("details"))
    $("#score_detail").show(500)
    document.querySelector('#score_detail').style.display = 'flex';
})
let score_id ;

$(".edite_score_btn").click((e) => {
    score_id = $(e.target).attr("score");
    $("#edite_score").show(400).css("display" , "flex")
    $("#score_edite_value").val($("#score_"+score_id).html())
})

$("#send_score_edite").click(() => {
    $.post({

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url : "../../../api/edit_score/"+score_id,
        data : {
            value : $("#score_edite_value").val(),

        },
        success : (data) => {
            if(data.ok){
                $('#edite_score').hide(400)
                $("#score_"+score_id).html($("#score_edite_value").val())
                message.success("ثبت نمره موفقیت آمیز بود")
            }else{
                message.error("مشکلی پیش آمد")


            }
        },

    }).fail(() => {
        message.error("مشکلی پیش آمد")
    })
})
$("#close_score_edite").click(() => {
    $('#edite_score').hide(400)

})

let delete_score_id ;
$(".delete_score_btn").click((e) => {
    delete_score_id = $(e.target).attr("score");
    if(confirm("آیا از حذف نمره مطمئن هستید ؟ این عمل قابل بازگردانی نیست")){
        $.post({

            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url : "../../../api/delete_score/"+delete_score_id,
            success : (data) => {
                if(data.ok){
                    $("#score_"+score_id).html($("#score_edite_value").val())
                    message.success("حذف نمره موفقیت آمیز بود")
                    $("#row_"+delete_score_id).remove()
                }else{
                    message.error("مشکلی پیش آمد")


                }
            },

        }).fail(() => {
            message.error("مشکلی پیش آمد")
        })
    }else{
        message.success("از حذف نمره صرف نظر شد")
    }
})
$("#save-attendance").click(() => {

    $("select.attendance").each(function(element)  {
        let list = [];
        if($(this).val() === "absent"){
            list.push($(this).attr("targetStudent"))
        }
        list = JSON.stringify(list);
        $.post({
            url : '/api/attendance/set/',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data : {
                course_id : $("#save-attendance").attr("courseId"),
                absent : list,
                session_id :  $("#save-attendance").attr("sessionId")
            },
            success:() => {
                message.success('ثبت و ذخیره با موفقیت انجام شد')

            }
        }).fail(() => {
            message.error("مشکلی پیش آمد")

        })

    })
})
