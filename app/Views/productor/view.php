<h1>productor Details</h1>
<div class="card" style="width: 20rem;">
    <div class="card-block text-center">
        <h4 class="card-title"><?= $productor->nombre . ' ' . $productor->apellido; ?></h4>
        <p class="card-text"><?= $productor->dni; ?></p>
        <a href="/productor" class="btn btn-primary">productors</a>
    </div>
</div>