<div class="table-responsive">
    <table class="table" id="data-table">
        <thead>
        <tr>
            <?php
            $i = 0;
            $col_data = "";
            foreach ($cols as $col) {
                if ($col != $key) {
                    echo "<th>" . ucwords( str_replace("_", " ", $col) ) . "</th>";
                    $col_data .= '{"data": '.$i.'},';
                }
                $i++;
            }
            ?>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
</div>
<script>
    var table;

    function del (id)
    {
        var conf = confirm("Are you sure you want to delete this item?");
        if (conf == true) {
            var param = {
                "id" : id
            };
            $.ajax({
                type: "POST",
                url: '/<?= $controller ?>/delete',
                data: param,
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    if (response == "success") {
                        table.ajax.reload();
                    }
                }
            });
        }
    }
</script>
<script type="text/javascript">
    $( document ).ready(function() {
        table = $('#data-table').DataTable({
            responsive: true,
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"/<?= $controller ?>/data", // json datasource
                type: "post"  // type of method  ,GET/POST/DELETE
            },
            columns: [
                <?= $col_data; ?>
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "center",
                    render: function (data, type, full, meta) {
                        return '<a href="/<?= $controller ?>/view/'+data[<?= $i-1 ?>]+'" title="View"><i class="fa fa-eye"></i></a>' + ' ' +
                            '<a href="/<?= $controller ?>/edit/'+data[<?= $i-1 ?>]+'" title="Edit"><i class="fa fa-pencil"></i></a>' + ' ' +
                            '<a href="#" title="Delete" onclick="del('+data[<?= $i-1 ?>]+')"><i class="fa fa-trash"></i></a>';
                    }
                }
            ]
        });
    });
</script>
