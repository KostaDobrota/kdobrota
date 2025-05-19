@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Izmeni Proizvod
                        <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm float-end">NAZAD</a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>Kategorija</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Naziv</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Opis</label>
                                <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Cena</label>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Stanje na Lageru</label>
                                <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Istaknuto</label><br/>
                                <input type="checkbox" name="is_featured" {{ $product->is_featured ? 'checked' : '' }} />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Slika</label>
                                <input type="file" name="image" class="form-control" />
                                <div class="mt-2">
                                    @if($product->image_path)
                                        <img src="{{ asset($product->image_path) }}" width="60px" height="60px" alt="Slika Proizvoda" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end">Sačuvaj Izmene</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 