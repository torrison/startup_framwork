<script src="/files/outside/js/auth.js"></script>

<script>

    $(function(){
        <?php if (isset($_GET['reg'])) { ?>

        var cookie_req_user_type = $.cookie('req_user_type');

        setTimeout ( function(){
            if (typeof cookie_req_user_type !== 'undefined')
            {
                $.removeCookie('req_user_type', { path: '/' });
                $.cookie('req_user_type', <?php echo intval($_GET['reg']); ?>, { expires: 1, path: '/' });
            }
            else {
                $.cookie('req_user_type', <?php echo intval($_GET['reg']); ?>, { expires: 1, path: '/' });
            }
        });


        <?php } ?>
    });

</script>