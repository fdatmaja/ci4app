<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Form Edit Comic</h2>
            <form action="<?= base_url('comics/update/' . $comic['id']); ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
                <input type="hidden" name="oldCover" value="<?= $comic['cover']; ?>">
                <div class="row mb-3">
                    <label for="Title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" name="title" autofocus value="<?= (old('title')) ? old('title') : $comic['title']; ?>">
                        <div id="titleFeedback" class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="writer" class="col-sm-2 col-form-label">Writer</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('writer')) ? 'is-invalid' : ''; ?>" id="writer" name="writer" value="<?= (old('writer')) ? old('writer') : $comic['writer']; ?>">
                        <div id="writerFeedback" class="invalid-feedback">
                            <?= $validation->getError('writer'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('publisher')) ? 'is-invalid' : ''; ?>" id="publisher" name="publisher" value="<?= (old('publisher')) ? old('publisher') : $comic['publisher']; ?>">
                        <div id="publisherFeedback" class="invalid-feedback">
                            <?= $validation->getError('publisher'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-2">
                        <img src="<?= base_url('/img/' . $comic['cover']); ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('cover')) ? 'is-invalid' : ''; ?>" id="cover" name="cover" onchange="previewImg()">
                            <label class="custom-file-label" for="cover"><?= (old('cover')) ? old('cover') : $comic['cover']; ?></label>
                            <div id="coverFeedback" class="invalid-feedback">
                                <?= $validation->getError('cover'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>