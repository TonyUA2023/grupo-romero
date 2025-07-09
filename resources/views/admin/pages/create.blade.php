@extends('layouts.admin')

@section('title', 'Crear Nueva Página')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Crear Nueva Página</h2>
    
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.pages._form')
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                'insertTable', 'mediaEmbed', '|', 
                'undo', 'redo'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Párrafo', class: 'ck-heading_paragraph' },
                    { model: 'heading2', view: 'h2', title: 'Título 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Título 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Título 4', class: 'ck-heading_heading4' }
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection