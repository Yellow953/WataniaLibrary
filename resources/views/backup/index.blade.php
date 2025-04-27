@extends('layouts.app')

@section('title', 'backup')

@section('content')
<div class="container px-4">
    <h2 class="text-red my-5">Products</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('assets/images/excell.png') }}" alt="Excell" class="img-card img-fluid rounded">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-5 mb-5">
                <div class="import">
                    <h3 class="mb-4">Import Products</h3>
                    <p class="text-dark">Please use the sample excell format below before importing your products...</p>
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9 my-auto px-2">
                                <input type="file" name="file" accept=".xls,.xlsx,.csv" required class="form-control"
                                    id="inputGroupFile">
                            </div>
                            <div class=" col-md-3 my-auto">
                                <button type="submit" class="text-center btn btn-primary btn-sm my-3">
                                    <i class="fas fa-upload mr-2"></i>
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 my-auto">
                    <div class="card p-5 mb-5">
                        <div class="export">
                            <h3 class="mb-4">Export Products</h3>
                            <p class="text-dark">Export your products to Excell format...</p>
                            <a href="{{ route('products.export') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download mr-2"></i>Export To Excell
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <div class="card p-5 mb-5">
                        <div class="export">
                            <h3 class="mb-4">Download Sample Excell</h3>
                            <p class="text-dark">Please download this excell sample and fill it in order to import
                                products to your shop...</p>
                            <a href="{{ route('products.sample') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <h2 class="text-red my-5">Backup</h2>
    <div class="row">
        <div class="col-md-4 my-auto">
            <div class="card">
                <img src="{{ asset('assets/images/backup.png') }}" alt="Backup" class="img-card img-fluid rounded">
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-5 mb-5">
                <div class="import">
                    <h3 class="mb-4">Import Database</h3>
                    <form action="{{ route('backup.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9 my-auto px-2">
                                <input type="file" name="file" accept=".sql" required class="form-control"
                                    id="inputGroupFile">
                            </div>
                            <div class=" col-md-3 my-auto">
                                <button type="submit" class="text-center btn btn-primary btn-sm my-3">
                                    <i class="fas fa-upload mr-2"></i>
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card p-5 mb-5">
                <div class="export">
                    <h3 class="mb-4">Export Database</h3>
                    <a href="{{ route('backup.export') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-download mr-2"></i>Export Backup
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection