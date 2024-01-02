@extends('layout.app')

@section('title', 'Data Detail Penjualan')
@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Detail Penjualan
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
                        <th>Penjualan</th>
                        <th>Nama Barang</th>
                        <th>Kuantitas</th>
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
        <h5 class="modal-title">Detail Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-10">
                <form class="form-detailpenjualan">
                    <div class="form-group">
                        <label for="">Penjualan</label>
                        <select name="penjualan_id" id="penjualan_id" class="form-control">
                            @foreach ($penjualans as $penjualan)
                                <option value="{{$penjualan->id}}">{{$penjualan->id}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control">
                            @foreach ($barangs as $barang)
                                <option value="{{$barang->id}}">{{$barang->namabarang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Kuantitas</label>
                        <input type="text" class="form-control" name="kuantitas" placeholder="Kuantitas" required>
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
                url: '/api/detailpenjualans',
                success: function ({data}) {

                    let row;

                    data.map(function name(val, index) {
                        console.log(val.barang);
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.penjualan ? val.penjualan.id : ''}</td>
                            <td>${val.barang ? val.barang.namabarang : ''}</td>
                            <td>${val.kuantitas}</td>
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
                        url : '/api/detailpenjualans/' + id,
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
                $('input[name="kuantitas"]').val('')



                $('.form-detailpenjualan').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : 'api/detailpenjualans',
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

                $.get('api/detailpenjualans/' + id, function({data}){
                    $('input[name="kuantitas"]').val(data.kuantitas);
                });

                $('.form-detailpenjualan').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/detailpenjualans/${id}?_method=PUT`,
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