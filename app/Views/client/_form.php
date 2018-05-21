<div class="form-group">
    <input type="text" class="form-control" name="firstname" value="<?= $client->firstname ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="lastname" value="<?= $client->lastname ?>">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="email" value="<?= $client->email ?>">
</div>
<div class="form-group">
    <input type="file" name="fileToUpload" id="fileToUpload" value="Select image">
</div>
<button type="submit" name="save" value="save" class="btn btn-primary">Save</button>