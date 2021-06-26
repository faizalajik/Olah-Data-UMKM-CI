<section class="bg-primary" id="about">
      <div class="container col-md-11">
        <h2 class="text-center">Pendataan UKM</a></h2>
        <div class="card">
            <div class="card-body">
                <h3>Data UKM</h3>

                <p>Cari :</p>

                <div class="form-group">
                    
                </div>
                <form action="/pegawai/cari" method="GET" class="form-inline">
                    <input class="form-control" type="text" name="cari" placeholder="Cari .." value="{{ old('cari') }}">
                    <input class="btn btn-primary ml-3" type="submit" value="CARI">
                </form>

                <br/>

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Desa</th>
                        <th>Sektor</th>
                        <th>Jenis Usaha</th>
                        <th>Jumlah Usaha</th>
                        <th>Tenaga Kerja</th>
                        <th>Nama Usaha</th>
                        <th>Lokasi Usaha</th>
                        <th>Omset</th>
                        <th>Asset</th>

                    </tr>
                    
                   
                </table>
                
            </div>
        </div>
      </div>
  </section>
