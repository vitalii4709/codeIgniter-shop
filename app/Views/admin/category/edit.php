<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <?php
                    $errors_data = session()->has('errors') ? esc(session()->getFlashdata('errors')) : [];
                    ?>

                    <form action="<?= route_to('admin.category.update', $category['id']); ?>" method="post">

                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label class="required" for="title">Наименование</label>
                            <input type="text" name="title" class="form-control <?= add_error_class($errors_data, 'title'); ?>" id="title" placeholder="Наименование категории" value="<?= $category['title']; ?>">
                            <?= display_error($errors_data, 'title'); ?>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ключевые слова" value="<?= $category['keywords']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Мета-описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Мета-описание" value="<?= $category['description']; ?>">
                        </div>

                        

                        <button type="submit" class="btn btn-primary">Сохранить</button>

                    </form>

                </div>


            </div>

        </div>
    </div>

</div>

<script>
    // https://question-it.com/questions/3558262/kak-ja-mogu-sozdat-neskolko-redaktorov-s-imenem-klassa
    // https://ckeditor.com/docs/ckfinder/demo/ckfinder3/samples/ckeditor.html
    window.editors = {};
    document.querySelectorAll( '.editor' ).forEach( ( node, index ) => {
        ClassicEditor
            .create( node, {
                ckfinder: {
                    uploadUrl: '<?= base_url('assets/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json') ?>',
                },
                toolbar: [ 'ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'insertTable', 'blockQuote' ],
                image: {
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                    styles: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight'
                    ]
                }
            } )
            .then( newEditor => {
                window.editors[ index ] = newEditor
            } )
            .catch( error => {
                console.error( error );
            } );
    });

</script>

<?= $this->endSection(); ?>


