@extends('layout.app')

@section('title', 'Data Kategori')
@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Kategori
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <a href="#modal-form" data-toggle="modal" class ="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formulir Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-10">
                <form class="form-kategori">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="28" rows="8" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
    <script>
        $(function(){

            $.ajax({
                url: '/api/categories',
                success: function ({data}) {

                    let row;

                    data.map(function name(val, index) {
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.nama_kategori}</td>
                            <td>${val.deskripsi}</td>
                            <td><img src="/uploads/${val.gambar}" width = "150"></td>
                            <td>
                                <a href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit Data</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus Data</a>
                            </td>
                        </tr>
                        `;
                    });

                    $('tbody').append(row)
                }
            });

            $(document).on('click', '.btn-hapus', function(){
                const id = $(this).data('id')
                const token = localStorage.getItem('token')

                confirm_dialog = confirm('Apakah anda yakin?');


                if (confirm_dialog) {
                    $.ajax({
                        url : '/api/categories/' + id,
                        type : "DELETE",
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        success : function (data) {
                            if (data.message=='success') {
                                alert('Data Telah Dihapus')
                                location.reload()
                            }
                        }
                    });

                }

            });

            $('.modal-tambah').click(function(){
                $('#modal-form').modal('show')
                $('input[name="nama_kategori"]').val('')
                $('textarea[name="deskripsi"]').val('')



                $('.form-kategori').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : 'api/categories',
                        type : 'POST',
                        data : frmdata,
                        cache:false,
                        contentType: false,
                        processData: false,    
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        success : function(data){
                            if (data.success) {
                                alert('Data Berhasil Ditambahkan')
                                location.reload();
                            }
                        }
                    })
                });
            });

            $(document).on('click', '.modal-ubah', function(){
                $('#modal-form').modal('show')
                const id = $(this).data('id');

                $.get('api/categories/' + id, function({data}){
                    $('input[name="nama_kategori"]').val(data.nama_kategori);
                    $('textarea[name="deskripsi"]').val(data.deskripsi);
                });

                $('.form-kategori').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/categories/${id}?_method=PUT`,
                        type : 'POST',
                        data : frmdata,
                        cache:false,
                        contentType: false,
                        processData: false,    
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        success : function(data){
                            if (data.success) {
                                alert('Data Berhasil Diubah')
                                location.reload();
                            }
                        }
                    })
                });

            });

        });
    </script>
@endpush