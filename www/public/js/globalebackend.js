function issue_request_serial(tree_id, type) {
    $.ajax({
        url: `/document/serial`,
        method: "POST",
        data: {
            tree_id: tree_id,
            type: type,
        },
        success: function (serial) {
            $("#serial").val(serial);
        },
    });
}

$(document).ready(function () {
    //start  setup token for the whole laravel app to send data or retrive data
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });
    //end  setup token for the whole app to send data or retrive data

    {
        let type = $(".type:checked").val();
        let tree_id = $(".organization:selected").attr("rootid");
        issue_request_serial(tree_id, type);
    }

    // type on change
    $(".type").click(function () {
        let type = $(this).val();
        let tree_id = $(".organization:selected").attr("rootid");
        console.log(type, tree_id);
        issue_request_serial(tree_id, type);
    });

    // type on change
    $(".organization-selector").change(function () {
        let type = $(".type:checked").val();
        let tree_id = $(".organization:selected").attr("rootid");
        console.log(type, tree_id);
        issue_request_serial(tree_id, type);
    });

    $(".suitcase-checkbox").click(function () {
        let suitcase_id = $(this).val();
        $.ajax({
            url: `/suitcase/activate/${suitcase_id}`,
            method: "GET",
            success: (state) => {
                if (state) {
                    $('.checked-row:checked').attr('checked', false)
                    $('.suitcase-checkbox').removeClass('checked-row')
                    $('.suitcase-checkbox').attr('disabled', false);
                    $('tr').removeClass('alert alert-info');
                    $(`#suticase-row${suitcase_id}`).addClass("alert alert-info");
                    $(this).attr('disabled', true);
                    $(this).addClass('checked-row');
                    $(`.checked-row`).attr("disabled", true);
                }
            },
        });
    });
    //start turn off auto complet for all app
    $("input").attr("autocomplete", "off");
    //endturn off auto complet for all app

    //select2 dropdown for the whole app
    $(".select").select2();
    //select2 dropdown for the whole app

    //date for the whole app
    $(".date").daterangepicker({
        singleDatePicker: true,
        locale: {
            format: "YYYY-MM-DD",
        },
    });
    //date for the whole app
    $(".organizationDashboard").click(function () {
        $(".treeview").animate(
            {
                width: "toggle",
                opacity: "toggle",
            },
            "slow"
        );
    });

    $(".delete").click(function () {
        event.preventDefault(); // prevent  the defalut
        return Swal.fire({
            title: "!هل تريد حذف",
            text: "لن تكون قادر علي استرجاع البيانات مرة اخري",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "نعم اريد الحذف!",
        }).then((result) => {
            let item = $(this).attr("value");
            if (result.value) {
                $("#deleteform" + item).submit(); // to resume the default
            }
        });
    });
    // end  confirm before delete

    // JQX Tree
    $("#jqxExpander").jqxExpander({
        showArrow: true,
        toggleMode: "click",
        width: "100%",
        height: "100%",
    });
    $.ajax({
        url: "/organization/tree",
        method: "GET",
        success: function (data) {
            var source = data;
            $("#jqxTree").jqxTree({
                source: source,
                width: "100%",
                height: "100%",
            });
            $("#jqxTree").jqxTree("selectItem", null);
        },
    });
    // JQX Tree
    $(".search").click(function () {
        let organization = $(".organization").val(),
            subject = $(".subject").val(),
            suitcase = $(".suitcase").val(),
            description = $(".description").val(),
            type = $(".type").val(),
            type_id = $(".type_id").val();

        $.ajax({
            url: `/search/document`,
            method: "POST",
            data: {
                organization_id: organization,
                subject_id: subject,
                suitcase_id: suitcase,
                description: description,
                type: type,
                type_id: type_id,
            },
            success: function (data) {
                console.log(data);
            },
        });
    });
});
