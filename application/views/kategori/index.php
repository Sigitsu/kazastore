<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h1>Data Kategori</h1>
        </div>
        <div class="card-body">
            <a class="btn btn-primary mb-2" s data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i> Tambah Kategori</a>
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive table-striped">
                <table width="100%" class="table table-sm" id="myTable">
                    <thead>
                        <tr>

                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kategori as $value) { ?>
                            <tr>

                                <td><?= $no++ ?></td>
                                <td><?= $value->nama_kategori; ?></td>
                                <td><?= $value->slug ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kategori/save" method="POST">
                <div class="modal-body">

                    <div class="form-group">

                        <div class="col-xs-8">


                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-8">
                            <label for="">Nama Kategori</label>
                            <input name="nama_kategori" id="kategori" onkeyup="create_slug()" class="form-control" type="text">

                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-8">
                            <label for="">Slug</label>
                            <input name="slug" id="slug" class="form-control" type="text">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>


        </div>
    </div>
</div>
<!-- end modal add -->
<script>
    $(function() {
        $('.alert').delay(3000).fadeOut(300);
    });

    function create_slug() {
        let kategori = $('#kategori').val();
        $('#slug').val(string_to_slug(kategori));
    }

    function string_to_slug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to = "aaaaeeeeiiiioooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }
</script>