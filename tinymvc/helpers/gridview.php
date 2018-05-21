<table class="table table-responsive">
    <thead>
    <tr>
        <?php
            foreach ($cols as $col) {
                echo "<th>" . ucwords( str_replace("_", " ", $col) ) . "</th>";
            }
        ?>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $item) {
        echo "<tr>";
        foreach ($cols as $col) {
            echo "<td>" . $item[$col] . "</td>";
        }
        echo "<td><a href='/$controller/view/".$item[$key]."' class='btn btn-primary'>Details</a></td>";
        echo "<td><a href='/$controller/edit/".$item[$key]."' class='btn btn-success'>Edit</a></td>";
        echo "<td><a href='/$controller/delete/".$item[$key]."' class='btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
    $html = '<nav aria-label="Page navigation">';

    $html       .= '<ul class="pagination justify-content-left">';

    $class      = ( $page == 1 ) ? "disabled" : "page-item";
    $html       .= '<li class="' . $class . '"><a href="/'.$controller.'/page/' . ( $page - 1 ) . '" class="page-link">&laquo;</a></li>';

    if ( $start > 1 ) {
        $html   .= '<li><a href="/'.$controller.'/page/1" class="page-link">1</a></li>';
        $html   .= '<li class="disabled"><span class="page-link">...</span></li>';
    }

    for ( $i = $start ; $i <= $end; $i++ ) {
        $class  = ( $page == $i ) ? "active" : "";
        $html   .= '<li class="' . $class . '"><a href="/'.$controller.'/page/' . $i . '" class="page-link">' . $i . '</a></li>';
    }

    if ( $end < $last ) {
        $html   .= '<li class="disabled"><span>...</span></li>';
        $html   .= '<li><a href="/'.$controller.'/page/' . $last . '" class="page-link">' . $last . '</a></li>';
    }

    $class      = ( $page == $last ) ? "disabled" : "";
    $html       .= '<li class="' . $class . '"><a href="/'.$controller.'/page/' . ( $page + 1 ) . '" class="page-link">&raquo;</a></li>';

    $html       .= '</ul>';

    $html .= '</nav>';

    echo $html;
?>