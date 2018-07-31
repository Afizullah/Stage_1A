
    <!-- JavaScript -->


    <!-- Slimscroll JavaScript -->
    <script type="text/javascript">
        function alertError(error){
            $(function () {
                $.notify(error, "error");
            });
        }
        function alertSuccess(error){
            $(function () {
                $.notify(error, "success");
            });
        }
        function alertWarnin(error){
            $(function () {
                $.notify(error, "warn");
            });
        }
        
        function initSelect2(element,params){
            $(element).select2(params);
        }
        $(document).ready(function() {
            initSelect2(".basicSelect2",{
                placeholder: "Séléctionnez les membres",
                allowClear: true,
            });
        });
    </script>
    <style media="screen">
        .select2-container--default .select2-selection--multiple .select2-selection__rendered li{
            
            color:blue;
        }

    </style>
    <script src="<?php echo PATH_TEMPLATE; ?>/dist/js/jquery.slimscroll.js"></script>

    <!-- Init JavaScript -->
    <script src="<?php echo PATH_TEMPLATE; ?>/dist/js/init.js"></script>
    </body>

</html>
