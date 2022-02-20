<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="<?= base_url('/comics/create'); ?>" class="btn btn-primary mt-3">Add New Comic</a>
            <h1 class="mt-2">Comics List</h1>
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($comics as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="<?= base_url("/img/" . $c['cover']); ?>" alt="cover" class="cover"></td>
                            <td><?= $c['title']; ?></td>
                            <td><a href="<?= base_url('/comics/' . $c['slug']); ?>" class="btn btn-success">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>