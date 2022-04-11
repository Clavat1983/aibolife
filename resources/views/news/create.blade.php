@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ニュース登録</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                        @csrf
                        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                        <div>
                            <label for="news_body">本文</label>
                            <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                        </div>
                        <p>&nbsp;</p>

                        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
                        <div>
                            <label for="news_body">本文</label>
                            <textarea class="ckeditor" name="news_body" id="news_body">{{old('news_body')}}</textarea>
                        </div>
                        <script>
                                ClassicEditor
                                        .create( document.querySelector( '#news_body' ) )
                                        .then( editor => {
                                                console.log( editor );
                                        } )
                                        .catch( error => {
                                                console.error( error );
                                        } );
                        </script> --}}

                        <button>登録</button>
                    </form>
                    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
