<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Comic Details</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('/img/' . $comic['cover']); ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comic['title']; ?></h5>
                            <p class="card-text"><b>Writer: </b><?= $comic['writer']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Publisher: </b><?= $comic['publisher']; ?></small></p>
                            <a href="<?= base_url('/comics/edit/' . $comic['slug']); ?>" class="btn btn-warning">Edit</a>

                            <form action="<?= base_url('/comics/' . $comic['id']); ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Comic?')">Delete</button>
                            </form>
                            <br><br>
                            <a href="<?= base_url('/comics'); ?>">Back to Comics List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>