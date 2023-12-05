@extends ('layout.app')
@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
        <div class="col-xxl-4 col-xl-12">
        <div class="card info-card customers-card" style="padding: 20px">
        <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th> No</th>
      <th> Nama</th>
      <th> Departemen</th>
      <th> alamat</th>
      <th> Gaji</th>
      <th> Aksi</th>

    
    </tr>
  </thead>
@php $no = $data->firstItem() @endphp
@foreach ($data as $karyawan)
<tr>
    <td>{{$no}}</td>
    <td>{{$karyawan->nama}}</td>
    <td>{{$karyawan->departemen}}</td>
    <td>{{$karyawan->alamat}}</td>
    <td>{{$karyawan->gaji}}</td>
    <td>
      <div class="div"style ="display:flex; gap:5px;">
            <a class="btn btn-sm btn-success" href="edit/{{$karyawan['id']}}"><i class="bi bi-pen"></i></a>
        <form action="/dashboard/{{$karyawan->id}}" style="display: in-block;" method="post">
        @csrf
        @method ('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data Dengan Nama ,{{$karyawan->nama}} ?')"><i class="bi bi-trash"></i></button>
        </form>
      </div>
    
    </td>
</tr>
@php $no++ @endphp
@endforeach

</table>
        {{$data->withQueryString()->links()}}

          </div>

        </div>
</section>

</main>
@endsection