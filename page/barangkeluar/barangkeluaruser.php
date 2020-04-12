

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Barang Keluar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>                                            
                                            <th>Kode Barang Keluar</th>
                                             <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                               <th>No. Rak</th>
                                                  <th>Tanggal</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                         <th>Nama User</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select tb_barang.* , tb_barang_keluar.* , tb_user.* from tb_user , tb_barang_keluar , tb_barang where tb_barang.kode_barang = tb_barang_keluar.kode_barang and tb_user.kode_user = tb_barang_keluar.kode_user ");
                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['kode_barang_keluar'];?></td>
                                            <td><?php echo @$data['nama_barang'];?></td>
                                            <td><?php echo @$data['jenis_barang'];?></td>
                                            <td><?php echo @$data['no_rak'];?></td>
                                            <td><?php echo @$data['tanggal_keluar'];?></td>
                                            <td><?php echo @$data['satuan'];?></td>
                                            <td><?php echo @$data['jumlah_keluar'];?></td>
                                            <td><?php echo @$data['nama_user'];?></td>
                                        
                                     
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                            <a href="?page=barangkeluar&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i>Tambah Barang Keluar</a>

                    </div>
                </div>
        </div>
    </div>
