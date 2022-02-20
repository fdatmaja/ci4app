<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>People List</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search keyword" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($people as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $p['name']; ?></td>
                            <td><?= $p['address']; ?></td>
                            <td><a href="<?= base_url('/people/' . $p['id']); ?>" class="btn btn-success">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('people', 'people_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>