<h1>Report Generator</h1>

<div class="row">
    <div class="col-md-8">
        <form method="post" action="/report/show">
            <?php
            echo "<select name='tables[]' multiple class='form-control'>";
            foreach ($tables as $table) {
                foreach ($table as $key => $value) {
                    echo '<option value="$value">'.$value.'</option>';
                }
            }
            echo "</select>";
            ?>
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>