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

                                        {{-- <li>Test1: hello</li>
                                        <li>Test2: hello</li> --}}
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
                                {{-- <li>User1</li>
                                <li>User2</li> --}}
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
    
    const usersElement = document.getElementById('users');
    const messagesElement = document.getElementById('messages');

    // Canal de preencia
    Echo.join('chat')
        .here( (users) => {
            users.forEach((user, index) => {
                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.innerText = user.name;
                
                usersElement.appendChild(element);
            });
        })
        .joining( (user) => {

            let element = document.createElement('li');
            element.setAttribute('id', user.id);
            element.innerText = user.name;
            
            usersElement.appendChild(element);

        } )
        .leaving( (user)  => {
            let element = document.getElementById(user.id);

            element.parentElement.removeChild(element);
            
        })
        .listen('MessageSend', (e) => {     // Escuchara al evento? , MessageSend
            
            let element = document.createElement('li');
            element.innerText = e.user.name + ': ' + e.message;

            messagesElement.appendChild(element);
        });
    
    
</script>


{{-- Este script tomara los mensaje enviados y los mostrara --}}
<script>

    const sendElement = document.getElementById('send');
    const messageElement = document.getElementById('message');

    sendElement.addEventListener('click', (e) => {
        // primero evitar que el formulario se envie (se recargue)
        e.preventDefault();

        window.axios.post('/chat/message', {
            message: messageElement.value
        });
        
        messageElement.value = '';
    });
</script>

@endpush
