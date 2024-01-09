<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('invite') }}
        </h2>
    </x-slot>
    
</x-app-layout>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action"{{ url('/invite') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Send invitation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection