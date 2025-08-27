@extends('layout.main')

@section('title', 'Event Creation')

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Event Creation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Event Management</a></li>
                                <li class="breadcrumb-item active">Create Event</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="eventTitle" class="form-label">Event Title</label>
                                    <input type="text" name="event_title" class="form-control" placeholder="Event Title"
                                        id="eventTitle" value="{{ old('event_title') }}">
                                    @error('event_title')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div><!--end col-->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="TicketPrice" class="form-label">Ticket Price</label>
                                    <input type="text" name="ticket_price" class="form-control"
                                        placeholder="Ticket Price" id="TicketPrice" value="{{ old('ticket_price') }}">
                                    @error('ticket_price')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Max Ticket Limit</label>
                                    <input type="number" name="max_tickets_per_user" placeholder="Max ticket limit/user"
                                        class="form-control" min="1" value="{{ old('max_tickets_per_user', 1) }}">
                                    @error('max_tickets_per_user')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" value="{{ old('end_date') }}"
                                        class="form-control" placeholder="Start Date" id="startDate">
                                    @error('start_date')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control"
                                        placeholder="End Date" id="endDate">
                                    @error('end_date')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="drawTime" class="form-label">Draw Time</label>
                                    <input type="date" name="draw_time" value="{{ old('draw_time') }}"
                                        class="form-control" placeholder="Draw Time" id="drawTime">
                                    @error('draw_time')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Event Banner</label>
                                    <input type="file" name="banner" class="form-control" id="bannner">
                                    @error('banner')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Event Rules</label>
                                    <input type="file" name="rules" class="form-control" id="bannner">
                                    @error('rules')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Cause / Beneficiary</label>
                                    <textarea name="cause" class="form-control">{{ old('cause') }}</textarea>
                                    @error('cause')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-start">
                                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-info">Save & Publish</button>
                                </div>



                            </div><!--end col-->
                        </div><!--end row-->
                    </form>

                </div>

            </div>

        </div>
        <!-- container-fluid -->
    </div>

@endsection
