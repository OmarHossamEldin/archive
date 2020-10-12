$(document).ready(function() {
    /*-------------------------Start DashboardManu Page-----------------------------*/
    $(".dashbordManu").css("minHeight",$(window).height()-60); 
    
    $(".documentDashboard").click(function(){
        $(".purchasesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.suitcaseDashboardSubDash").slideUp();
        $(".salesSubDash").slideToggle();
    });
    $(".locale-changer").change(function(){
        let locale = $(this).val();
        $.ajax({
            url: `/lang`,
            method: "POST",
            data: {
                lang: locale
            },
            success:function(data){
                console.log(data);
                //location.reload();
            }
        });
    });
    $(".subjectDashboard").click(function(){
        $(".purchasesSubDash,.salesSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.suitcaseDashboardSubDash").slideUp();
        $(".stockSubDash").slideToggle();
    });
    $(".organizationDashboard").click(function(){
        $(".salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.supplierSubDash,.customerSubDash,.employerSubDash,.suitcaseDashboardSubDash").slideUp();
        $(".purchasesSubDash").slideToggle();
        $(".treeView").animate({
            width: 'toggle',
            opacity: "toggle"
        })
    });
    $(".suitcaseDashboard").click(function(){
        $(".purchasesSubDash,.salesSubDash,.stockSubDash,.importSubDash,.expenseSubDash,.employerSubDash,.supplierSubDash,.customerSubDash").slideUp();
        $(".suitcaseDashboardSubDash").slideToggle();
    });
    /*--------------------------End DashboardManu Page------------------------------*/
    
    /*------------------------------Start Date Page---------------------------------*/
    $('.date').daterangepicker({autoClose:true,
                                    singleDatePicker: true,
                                    locale: {format: 'YYYY-MM-DD'},
                                    startDate:new Date(),
                                    singleDate: true
                                    }); 
    /*-------------------------------End Date Page----------------------------------*/
});