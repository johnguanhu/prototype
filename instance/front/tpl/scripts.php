<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            error : function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 404) {
                    //alert("Element not found.");
                } else {
                    //alert("Error: " + textStatus + ": " + errorThrown);
                    //alert("Internet Down");
                    //$("#Internet_popup").modal("show");                    
                }
                console.log("Error Code: "+jqXHR.status+"\nError: " + textStatus + ": " + errorThrown);
            }
        });
    });
    var _U = '<?php print _U ?>';

    function showWait() {
        $("#waitBar").slideDown('slow');
    }

    function hideWait() {
        $("#waitBar").slideUp('slow');
    }

    var genericFun = function() {
        l(_U + delUrl);
        $("#myModal").modal("hide");
    }

    function l(url) {
        location.href = url;
    }

    function _invokeTooltips() {
        $("[data-toggle='tooltip']").tooltip();
        $(".breakdownLabel").click(function() {
            $(".breakdowns").hide();
            $(this).parent().children("div.shadow").toggle();
            return false;
        })

    }
    function doShowWakeUpInterval(id) {

    }


    $(document).ready(function() {
        _invokeTooltips();

    });


    function showPopup(content, title) {
        $("#_genericPopup .modal-body").html(content);
        $("#_genericPopup .modal-title").html(title);
        $("#_genericPopup").modal("show");
    }

    function _error(msg) {
        try {
            $("#error_msg_content").html(msg);
            $("#error_msg_jquery").show();
            setTimeout(function() {
                $("#error_msg_jquery").hide('slow');
            }, 2000);
        } catch (e) {

        }
    }

    function _success(msg) {
        try {
            $("#success_msg_content").html(msg);
            $("#success_msg_jquery").show();
            setTimeout(function() {
                $("#success_msg_jquery").hide();
            }, 2000);
        } catch (e) {

        }
    }
    
    function CloaseAllModal(){
        $('.modal').modal('hide');
    }
</script>
<div class="modal fade" id="Internet_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-error" style="">
                    Internet connection seems to be disconnected. Please try again.
                </div>
                </br>
                <div style="text-align:right;">
                    <button type="button" class="btn btn-primary" onclick="CloaseAllModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>