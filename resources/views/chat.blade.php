@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
           
        </div>
        <div class="col-md-4 card w-75">
            <div class="card-body">
                <h5 class="card-title">Please Read</h5>
                <p class="card-text">Note: Open incognito window so you can create/login another account see actual chat conversation/push notification of new chat message </p>
            </div>
        </div>
    </div>
</div>
@endsection