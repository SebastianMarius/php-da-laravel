
@vite(['resources/css/eventCard.css'])


{{ Auth::user()->role_id }}


<script>
    function saveToLocalStorage(event) {
        localStorage.setItem('event', event);
        const eventId = JSON.parse(event).id;
        console.log(JSON.parse(event).id);
        window.history.pushState('page2', 'Title', `/event/${eventId}/about`);
        window.location.reload();
    }
</script>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    
                    <div class="cards" id="eventCards">
                    @foreach ($events as $event)
                        <div class="card"  onclick="saveToLocalStorage('{{ $event }}')">
                            <button> Buy tickets</button>
                            <div class="card-image-container" style="background-image: url('build/assets/Hero-1.jpg'); background-size: cover; opacity: 0.5; height: 200px;"></div>
                            <div class="card-text-container">
                                <div class="card-header">
                                    <h2>{{$event->title}}</h2>
                                    <p>Start Date: {{$event->start_date}}</p>
                                    <p>Start Time: {{$event-> start_time}}</p>
                                    <p>End Time: {{$event-> end_time}}</p>
                                    <p>Location: {{$event-> location}}</p>

                                    @if(Auth::user()->role_id == 0)
                                    <div>
                                        <!-- <img class="action-icons" src="./assets/edit.svg" onclick="openEditModal(30)"> -->
                                        <a href="{{ url('events/'. $event->id ). '/edit' }}">Edit Event</a>
                                        <form action="{{ url('/events/' . $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="float:right">Delete event</button>
                                        </form>
                                        <!-- <img class="action-icons trash" src="./assets/delete.svg" onclick="deleteEvent(30)"> -->
                                    </div>
                                    @endif
                                  
                                </div>
                            </div>  
                         </div>
                        @endforeach
                    </div>
                  

                    
                   

           

                @if(Auth::user()->role_id == 0)
                coaie nu esti admin
            
                @else
                 <button> <a href="{{'/test/CreateEvent'}}">Create an event</a> </button>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
