<html>
    <head>
        <title>PDF Upload and Viewer</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ url('assets/images/favicon.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="">
            <div class="d-flex">
                <div class="col-3">
                    <div class="d-flex flex-column">
                        <div class="d-flex border py-3 px-3 shadow-sm">
                            <div class="col-md-3">
                                <label class="fw-500">FILES</label>
                            </div>
                            <div class="flex-fill">
                                <form method="POST" action="{{ url('upload-pdf') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="float-end">
                                        <label class="selFile" for="GetFile">Upload <i class="bi bi-upload"></i></label>
                                        <input name="pdfFile" type="file" id="GetFile" onchange="VerifyFileNameAndFileSize($(this));" accept=".pdf" style="display: none">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex border">
                            <div class="flex-fill docList">
                                @if(\Session::has('success'))
                                <div class="alert alert-dismissible alert-success fade show" role="alert">
                                    {!! \Session::get('success') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                <ul class="docViewList">
                                    @forelse($allfiles as $key=> $data)
                                    <li class="py-3 mb-3 ps-3" data-id="{{ $data->id }}">
                                        <label class="fw-bold">Document #{{ $data->id }}</label>
                                        <p class="m-0 mt-3">
                                            {{ Str::limit($data->file_name,40, ' ...') }}
                                        </p>
                                    </li>
                                    @empty
                                    <p class="text-center text-muted">No files found. Click on Upload to add files.</p>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-9">
                    <p class="note text-center text-muted py-5">
                        Click on file to preview.
                    </p>
                    <div class="viewer">
                        <div class="doc-header py-3 px-3 text-white">
                            Document #1
                        </div>
                        <div class="pdf">
                            <div id="holder">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.385/build/pdf.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="{{ url('assets/js/fileupload.js') }}"></script>
    </body>

</html>