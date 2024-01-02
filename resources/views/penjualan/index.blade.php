@extends('layout.app')

@section('title', 'Data Penjualan')
@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Penjualan
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
                        <th>Nomor Transaksi</th>
                        <th>Total Harga</th>
                        <th>Member</th>
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
        <h5 class="modal-title">Formulir penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-10">
                <form class="form-penjualan">
                    <div class="form-group">
                        <label for="">Nomor Transaksi</label>
                        <input type="text" class="form-control" name="nomortransaksi" placeholder="Nomor Transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga</label>
                        <input type="text" class="form-control" name="totalharga" placeholder="Total Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="">Member</label>
                        <select name="id_member" id="id_member" class="form-control">
                            @foreach ($members as $member)
                                <option value="{{$member->id}}">{{$member->nama_member}}</option>
                            @endforeach
                        </select>
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
                url: '/api/penjualans',
                success: function ({data}) {

                    let row;

                    data.map(function name(val, index) {
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.nomortransaksi}</td>
                            <td>${rupiah(val.totalharga)}</td>
                            <td>${val.member ? val.member.nama_member : ''}</td>
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
                        url : '/api/penjualans/' + id,
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
                $('input[name="nomortransaksi"]').val('')
                $('input[name="totalharga"]').val('')


                $('.form-penjualan').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : 'api/penjualans',
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

                $.get('api/penjualans/' + id, function({data}){
                    $('input[name="nomortransaksi"]').val(data.nomortransaksi);
                    $('input[name="totalharga"]').val(data.totalharga);
                });

                $('.form-penjualan').submit(function(e){
                    e.preventDefault()
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url : `api/penjualans/${id}?_method=PUT`,
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