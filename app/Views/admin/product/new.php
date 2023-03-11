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

                    <form action="<?= route_to('admin.product.create'); ?>" method="post">

                        <?= csrf_field(); ?>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required" for="title">Наименование</label>
                                <input type="text" name="title" class="form-control <?= add_error_class($errors_data, 'title'); ?>" id="title" placeholder="Наименование товара" value="<?= old('title'); ?>">
                                <?= display_error($errors_data, 'title'); ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required" for="category_id">Категория</label>
                                <select class="form-control <?= add_error_class($errors_data, 'category_id'); ?>" name="category_id" id="category_id">
                                    <?= view_cell('\App\Libraries\Category::getCategoriesList', ['category_id' => 0]) ?>
                                </select>
                                <?= display_error($errors_data, 'category_id'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="required" for="price">Цена</label>
                                <input type="text" name="price" class="form-control <?= add_error_class($errors_data, 'price'); ?>" id="price" placeholder="Цена" value="<?= old('price') ?? 0; ?>">
                                <?= display_error($errors_data, 'price'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input name="status" id="status" class="form-check-input" type="checkbox" checked>
                                    <label for="status" class="form-check-label">Статус</label>
                                </div>

                                <div class="form-check">
                                    <input name="hit" id="hit" class="form-check-input" type="checkbox" <?= set_checkbox('hit', 'on') ?>>
                                    <label for="hit" class="form-check-label">Хит</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="keywords">Ключевые слова</label>
                                <input type="text" name="keywords" class="form-control <?= add_error_class($errors_data, 'keywords'); ?>" id="keywords" placeholder="Ключевые слова" value="<?= old('keywords'); ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="description">Мета-описание</label>
                                <input type="text" name="description" class="form-control <?= add_error_class($errors_data, 'description'); ?>" id="description" placeholder="Мета-описание" value="<?= old('description'); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="required" for="excerpt">Краткое описание товара</label>
                                <textarea name="excerpt" id="excerpt" class="form-control <?= add_error_class($errors_data, 'excerpt'); ?>"><?= old('excerpt'); ?></textarea>
                                <?= display_error($errors_data, 'excerpt'); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="content">Полное описание товара</label>
                                <textarea name="content" id="content" class="form-control editor"><?= old('content'); ?></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Основное фото</h3>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-success" id="add-base-img" onclick="popupBaseImage(); return false;">Загрузить</button>
                                        <div id="base-img-output" class="upload-images base-image"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Дополнительные фото</h3>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-success" id="add-gallery-img" onclick="popupGalleryImage(); return false;">Загрузить</button>
                                        <div id="gallery-img-output" class="upload-images gallery-image"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>

                    </form>

                </div>


            </div>

        </div>
    </div>

</div>

<script>
    function popupGalleryImage() {
        CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    const galleryImgOutput = document.getElementById( 'gallery-img-output' );

                    if (galleryImgOutput.innerHTML) {
                        galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    } else {
                        galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    }

                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    const baseImgOutput = document.getElementById( 'base-img-output' );

                    if (galleryImgOutput.innerHTML) {
                        galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    } else {
                        galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                    }

                } );
            }
        } );
    }
</script>

<script>
    function popupBaseImage() {
        CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    const baseImgOutput = document.getElementById( 'base-img-output' );
                    baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="img" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    const baseImgOutput = document.getElementById( 'base-img-output' );
                    baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + evt.data.resizedUrl + '"><input type="hidden" name="img" value="' + evt.data.resizedUrl + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
                } );
            }
        } );
    }
</script>

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

