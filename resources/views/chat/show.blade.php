@extends('layouts.app')

@push('styles')
<style type="text/css">
    
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    
                    <div class="row p-2">
                        <div class="col-10">

                            {{--  --}}
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" 
                                        class="list-unstyled overflow-auto"
                                        style="height: 45vh"
                                        >

                                        <li>Test1: hello</li>
                                        <li>Test2: hello</li>
                                    </ul>
                                </div>
                            </div>

                            {{--  --}}
                            <form action="">
                                <div class="row py-3">
                                    <div class="col-10">
                                        <input type="text" name="" id="message" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" id="send" class="btn-primary btn-block" >Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        

                        <div class="col-2">

                            <p><strong>Online now</strong></p>

                            <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh" >
                                <li>User1</li>
                                <li>User2</li>
                            </ul>

                        </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    
    
    
</script>
@endpush
