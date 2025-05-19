@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">Додај нови производ</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('editor.index') }}">Контролна табла</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('editor.products.index') }}">Производи</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Додај нови</li>
                </ol>
            </nav>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('editor.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="name" class="form-label">Назив производа</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Опис</label>
                            <textarea name="description" id="description" rows="8" required
                                class="form-control tinymce-editor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4">
                            <label for="category_id" class="form-label">Категорија</label>
                            <select name="category_id" id="category_id" required
                                class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Изаберите категорију</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label">Цена (RSD)</label>
                            <div class="input-group">
                                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                                    class="form-control @error('price') is-invalid @enderror">
                                <span class="input-group-text">RSD</span>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="stock" class="form-label">Залиха</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required
                                class="form-control @error('stock') is-invalid @enderror">
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Слика производа</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text">Максимална величина: 2MB</div>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" 
                                    class="form-check-input @error('is_featured') is-invalid @enderror"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Истакнути производ
                                </label>
                                @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('editor.products.index') }}" class="btn btn-light">Откажи</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Сачувај производ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
</style>
@endpush

@push('scripts')
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        language: 'sr',
        height: 300,
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        images_upload_handler: function (blobInfo, success, failure) {
            failure('Image upload is not supported in demo mode');
        }
    });
</script>
@endpush
@endsection 