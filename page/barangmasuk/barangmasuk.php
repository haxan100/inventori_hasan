

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Barang Masuk
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>                                            
                                            <th>Kode Barang Masuk</th>
                                             <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                               <th>No. Rak</th>
                                                  <th>Tanggal</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                         <th>Nama User</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select tb_barang.* , tb_barang_masuk.* , tb_user.* from tb_user , tb_barang_masuk , tb_barang where tb_barang.kode_barang = tb_barang_masuk.kode_barang and tb_user.kode_user = tb_barang_masuk.kode_user ");
                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['kode_barang_masuk'];?></td>
                                            <td><?php echo @$data['nama_barang'];?></td>
                                            <td><?php echo @$data['jenis_barang'];?></td>
                                            <td><?php echo @$data['no_rak'];?></td>
                                            <td><?php echo @$data['tanggal_masuk'];?></td>
                                            <td><?php echo @$data['satuan'];?></td>
                                            <td><?php echo @$data['jumlah_masuk'];?></td>
                                            <td><?php echo @$data['nama_user'];?></td>
                                            <td class="text-center" style="vertical-align:middle;">
                                           
                                            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ... ???')" href="?page=barangmasuk&aksi=hapus&id=<?php echo $data['kode_barang_masuk'];?>&kode=<?php echo $data['kode_barang'];?>&jumlah=<?php echo $data['jumlah_masuk'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                            <a href="?page=barangmasuk&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i>Tambah Barang Masuk</a>

                    </div>
                </div>
        </div>
    </div>
