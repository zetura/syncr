@extends('layouts.master')

@section('title', 'Ticket: '.$ticket->name)

@section('content')
    <h1>{{ $ticket->name }}</h1>
    <h4>{{ $ticket->getCategory() }}</h4>
    @if($ticket->project)<div class="small"><a href="{{ route('project.show', $ticket->project->id) }}">{{ $ticket->project->name }}</a></div>@endif

    <div class="row">
        <div class="large-12 columns">
            {{ $ticket->description }}
        </div>
    </div>
    <div class="row">
        <div class="large-4 medium-4 columns">
            Status: {{ $ticket->getStatus() }}
        </div>
        <div class="large-4 medium-4 columns">
            Priority: {{ $ticket->getPriority() }}
        </div>
        <div class="large-4 medium-4 columns">
            @if($ticket->user)
            Owned by: <a href="{{ route('user.show', $ticket->user->id) }}">{{ $ticket->user->name }}</a>
            @else
            No user assigned
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-4 medium-4 columns">
            Date start: {{ $ticket->getDateStart() }}
        </div>
        <div class="large-4 medium-4 columns">
            Estimate: {{ $ticket->getEstimate() }}
        </div>
        <div class="large-4 medium-4 columns">
            Deadline: {{ $ticket->getDateEnd() }}
        </div>
    </div>

    @if(\Auth::user()->hasRight(\App\Right::TICKET_MODIFY))
        <a class="button small round" href="{{ route('ticket.edit', $ticket->id) }}">Edit ticket</a>
    @endif

@stop