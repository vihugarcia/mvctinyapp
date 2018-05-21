<h1>Client Details</h1>
<div class="card" style="width: 20rem;">
    <img class="card-img-top"
         src="<?php
            if ($client->image)
                echo '/uploads/' . $client->image;
            else
                echo '/img/guest.png'; ?>"
         alt="Card image cap">
    <div class="card-block text-center">
        <h4 class="card-title"><?= $client->firstname . ' ' . $client->lastname; ?></h4>
        <p class="card-text"><?= $client->email; ?></p>
        <a href="/client" class="btn btn-primary">Clients</a>
    </div>
</div>