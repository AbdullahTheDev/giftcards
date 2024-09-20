@extends('admin.layout.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container py-3">
            <div class="card">
                <div class="card-header px-3 py-2">
                    <h3>Event Details</h3>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('admin.event.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Event Name</label>
                                    <input type="hidden" class="form-control border px-2" value="{{ $event->id }}"
                                        name="event_id" id="">
                                    <input type="text" class="form-control border px-2" value="{{ $event->showname }}"
                                        name="showname" id="">
                                </div>
                                <div class="col-6">
                                    <label for="">Event Url</label>
                                    <input type="text" class="form-control border px-2" value="{{ $event->name }}"
                                        name="name" id="">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Event Date</label>
                                    <input type="date" class="form-control border px-2" value="{{ $event->event_date }}"
                                        name="event_date" id="">


                                </div>
                                <div class="col-6">
                                    <label for="">Event Location</label>
                                    <input type="text" class="form-control border px-2" value="{{ $event->location }}"
                                        name="location" id="">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Event Description</label>
                                    <textarea name="description" class="form-control border px-2" id="" cols="30" rows="10">{{ $event->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <label for="eventImage">Event Image:</label>
                                <input type="file" name="image" id="eventImage" accept="image/*"
                                    onchange="previewImage(event, 'eventImagePreview')">

                                @if ($event->image ?? null)
                                    <img id="eventImagePreview" src="{{ asset($event->image) }}" alt="Event Image"
                                        style="max-width: 200px; display: block; margin-top: 10px;">
                                @else
                                    <img id="eventImagePreview" style="max-width: 200px; display: none; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <label for="">Event Banner</label>
                                <input type="file" name="banner" id="eventBanner" accept="image/*"
                                    onchange="previewImage(event, 'eventBannerPreview')">


                                @if ($event->banner ?? null)
                                    <img id="eventBannerPreview" src="{{ asset($event->banner) }}" alt="Event Banner"
                                        style="max-width: 200px; display: block; margin-top: 10px;">
                                @else
                                    <img id="eventBannerPreview" style="max-width: 200px; display: none; margin-top: 10px;">
                                @endif
                            </div>
                        </div>
                        <div class="mb3">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            function previewImage(event, previewId) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById(previewId);
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @endsection
