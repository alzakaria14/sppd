<div class="pagetitle">
    <h1>Cetak Rekapan Perjalanan Dinas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Cetak Rekapan Perjalanan Dinas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Formulir Cetak Data Rekapan Perjalanan Dinas</h5>
                    <form action="" id="rekapForm" class="row g-3">
                        <div class="col-12 col-md-6 col-lg-6">
                            <label for="start-date" class="form-label">Dari Tanggal</label>
                            <input type="date" name="start-date" id="start-date" class="form-control">
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <label for="end-date" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="end-date" id="end-date" class="form-control">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" onclick="cetakRekap()">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>