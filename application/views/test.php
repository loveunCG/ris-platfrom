<!-- BEGIN CONTENT BODY -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <button id="toast-push">open</button>
            <button id="modal-open">open</button>
        </div>


    </div>
</div>

<script type="text/javascript">
    $(document.body).ready(function () {

        var toast = new ax5.ui.toast({
        containerPosition: "top-right",
        onStateChanged: function() {
            console.log(this);
        }
    });

    $('#toast-push').click(function() {
        toast.push('Toast message', function() {
            // close toast
            console.log(this);
        });
    });
        var modal = new ax5.ui.modal({
            theme: "bg-blue",
            header: {
                title: ' <i class="fa fa-commenting"></i>远程门诊',
                btns: {
                    minimize: {
                        label: '<i class="fa fa-minus-circle" aria-hidden="true"></i>',
                        onClick: function () {
                            modal.minimize();
                        }
                    },
                    restore: {
                        label: '<i class="fa fa-plus-circle" aria-hidden="true"></i>',
                        onClick: function () {
                            modal.restore();
                        }
                    },
                    close: {
                        label: '<i class="fa fa-times-circle" aria-hidden="true"></i>',
                        onClick: function () {
                            modal.close();
                            window.location.reload();
                        }
                    }
                }
            }
        });

        $('#modal-open').click(function () {
            modal.open({
                    width: 320,
                    iframe: {
                        method: "get",
                        url: "http://192.168.1.120:8080/chat/22",
                        param: "callBack=modalCallBack"
                    },                
                fullScreen: function () {
                    return ($(window).width() < 600);
                }
            },
                function () {

                    var btn = jQuery(
                            '<button class="btn btn-primary" type="button">' +
                            'Modal Close</button>')
                        .click(function () {
                            modal.close();

                        });

                    // this.$["body-frame"]
                    //     .css({
                    //         padding: 50
                    //     })
                    //     .html(btn);

                });
        });

    });
</script>