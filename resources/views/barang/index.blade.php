@extends('layout.app')

@section('title', 'Data Barang')
@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Barang
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
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Ukuran</th>
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
        <h5 class="modal-title">Formulir Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-10">
                <form class="form-barang">
                <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">SubKategori</label>
                        <select name="id_subkategori" id="id_subkategori" class="form-control">
                            @foreach ($subcategories as $category)
                            <option value="{{$category->id}}">{{$category->nama_subkategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Barang</label>
                        <input type="text" class="form-control" name="kode" placeholder="Kode Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="namabarang" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="text" class="form-control" name="stok" placeholder="Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="">Satuan</label>
                        <select name="satuan_id" id="satuan_id" class="form-control">
                            @foreach ($satuanbarangs as $satuanbarang)
                                <option value="{{$satuanbarang->id}}">{{$satuanbarang->satuan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" placeholder="Ukuran">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="30"
                        rows="10" required></textarea>
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

            function rupiah(angka)
            {
                const format = angka.toString().split('').reverse().join('');
                const convert = format.match(/\d{1,3}/g);
                return 'Rp ' + convert.join('.').split('').reverse().join('')
            }

            $.ajax({
                url: '/api/barangs',
                success: function ({data}) {

                    let row;

                    data.map(function name(val, index) {
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.category.nama_kategori}</td>
                            <td>${val.subcategory.nama_subkategori}</td>
                            <td>${val.kode}</td>
                            <td>${val.namabarang}</td>
                            <td>${rupiah(val.harga)}</td>
                            <td>${val.stok}</td>
                            <td>${val.satuanbarang ? val.satuanbarang.satuan : ''}</td>
                            <td>${val.ukuran}</td>
                            <td>${val.deskripsi}</td>
                            <td><img src="/uploads/${val.gambar}" width="150"></td>
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
                        url : '/api/barangs/' + id,
                        type : "DELETE",
                        headers: {
                            "Authorization": "Bearer" + token
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



                $('.form-barang').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : 'api/barangs',
                        type : 'POST',
                        data : frmdata,
                        cache:false,
                        contentType: false,
                        processData: false,    
                        headers: {
                            "Authorization": "Bearer" + token
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

                $.get('api/barangs/' + id, function({data}){
                    $('input[name="nama_kategori"]').val(data.nama_kategori);
                    $('textarea[name="deskripsi"]').val(data.deskripsi);
                });

                $('.form-barang').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/barangs/${id}?_method=PUT`,
                        type : 'POST',
                        data : frmdata,
                        cache:false,
                        contentType: false,
                        processData: false,    
                        headers: {
                            "Authorization": "Bearer" + token
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