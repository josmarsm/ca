<!-- Page Content -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/custom.css" rel="stylesheet" type="text/css">
<?php
include("../classes/connect.php");
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--Inicio do contúdo-->

                <table class= "table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th colspan="1" rowspan="1" style="width: 180px;" tabindex="0">Name</th>

                            <th colspan="1" rowspan="1" style="width: 220px;" tabindex="0">Description</th>

                            <th colspan="1" rowspan="1" style="width: 288px;" tabindex="0">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = mysql_query("select * from information");
                        $i = 0;
                        while ($fetch = mysql_fetch_array($query)) {
                            if ($i % 2 == 0)
                                $class = 'even';
                            else
                                $class = 'odd';

                            echo'<tr class="' . $class . '">

                                <td><span class= "xedit" id="' . $fetch['id'] . '">' . $fetch['name'] . '</span></td>

                                <td>' . $fetch['details'] . '</td>

                                <td>' . $fetch['status'] . '</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>

                <!--Fim do contúdo-->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script src="../assets/js/jquery.min.js"></script> 
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-editable.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.editable.defaults.mode = 'popup';
        $('.xedit').editable();
        $(document).on('click', '.editable-submit', function() {
            var x = $(this).closest('td').children('span').attr('id');
            var y = $('.input-sm').val();
            var z = $(this).closest('td').children('span');
            $.ajax({
                url: "process.php?id=" + x + "&data=" + y,
                type: 'GET',
                success: function(s) {
                    if (s == 'status') {
                        $(z).html(y);
                    }
                    if (s == 'error') {
                        alert('Error Processing your Request!');
                    }
                },
                error: function(e) {
                    alert('Error Processing your Request!!');
                }
            });
        });
    });
</script>