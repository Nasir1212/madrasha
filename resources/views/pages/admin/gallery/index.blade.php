@extends('layouts.admin')
@section('content')

<div class="container mt-4" style="font-family: SolaimanLipi, sans-serif;">
    <div class="row">
        <!-- ছবি আপলোড ফর্ম -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>নতুন ছবি যুক্ত করুন</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">ছবির শিরোনাম (Title):</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image" class="form-label">ছবি নির্বাচন করুন:</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" required>
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">আপলোড করুন</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ছবি ম্যানেজমেন্ট লিস্ট -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5>গ্যালারি ইমেজ লিস্ট</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>সিরিয়াল</th>
                                    <th>ছবি</th>
                                    <th>শিরোনাম</th>
                                    <th>অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($images as $key => $img)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ env('IMG_URL')}}/{{$img->image_path}}" alt="" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>{{ $img->title }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- এডিট বাটন (বুটস্ট্র্যাপ মডাল ট্রিগার) -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $img->id }}">
                                                ইডিট
                                            </button>

                                            <!-- ডিলিট ফর্ম -->
                                            <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ছবিটি মুছে ফেলতে চান?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">ডিলিট</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- প্রতিটা ইমেজের জন্য ডাইনামিক এডিট মডাল -->
                                <div class="modal fade" id="editModal{{ $img->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editModalLabel">গ্যালারি তথ্য ইডিট করুন</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.gallery.update', $img->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">ছবির শিরোনাম:</label>
                                                        <input type="text" name="title" class="form-control" value="{{ $img->title }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">বর্তমান ছবি:</label>
                                                        <div class="mb-2">
                                                            <img src="{{ env('IMG_URL')}}/{{$img->image_path}}" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                        </div>
                                                        <label class="form-label">নতুন ছবি (পরিবর্তন করতে চাইলে):</label>
                                                        <input type="file" name="image" class="form-control">
                                                        <small class="text-muted">ছবি পরিবর্তন না করতে চাইলে এটি ফাঁকা রাখুন।</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                                                    <button type="submit" class="btn btn-success">আপডেট করুন</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">কোনো ছবি আপলোড করা হয়নি।</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection