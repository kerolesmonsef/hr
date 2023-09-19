@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/tasks.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jkanban@1.3.1/dist/jkanban.min.css" />
@endpush
@section('content')
    <div class="tasksPage">
        <div class="pageS1">

            <div class='sectionS2'>
                <div class="head flex align between">
                    <h3 class='small'>{{ __('All Tasks') }}</h3>
                    <div class='flex align gap-3'>
                        
                        @can('Task-Filter')
                            <button class='buttonS2 withBorder gap-4' id="toggleBtn" onclick="addNewCheckbox(event)">
                                {{ __('Filter') }}
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.9465 0.453125H4.79316H1.05317C0.413166 0.453125 0.0931657 1.22646 0.546499 1.67979L3.99983 5.13312C4.55317 5.68646 5.45317 5.68646 6.0065 5.13312L7.31983 3.81979L9.45983 1.67979C9.9065 1.22646 9.5865 0.453125 8.9465 0.453125Z"
                                        fill="#292D32" />
                                </svg>
                            </button>
                        @endcan

                        @can('Task-Create')
                            <a href="{{ route('tasks.create', ['view' => 'grid']) }}">
                                <button class='buttonS1 primary'>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                            fill="white" />
                                    </svg>
                                    {{ __('Add New') }}
                                </button>
                            </a>
                        @endcan

                    </div>
                </div>

                @can('Task-Filter')
                    @include('new-theme.tasks.filter')
                @endcan

            </div>

            <div class="search flex align gap-4">
                <div class="inputS1 gridViewSearch searchInput">
                    <input type="text" value="{{ request('search') }}" id="search" placeholder="{{ __('Search') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                            fill="#D9D9D9"></path>
                        <path
                            d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                            fill="#D9D9D9"></path>
                        <path
                            d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                            fill="#D9D9D9"></path>
                        <path
                            d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                            fill="#D9D9D9"></path>
                    </svg>
                </div>
                <div class="icons flex align gap-2">
                    <a href="{{ route('tasks.index') }}">
                        <div class="icon tableIcon ">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 7H21" stroke="#868686" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M3 12H21" stroke="#868686" stroke-width="1.5" stroke-linecap="round" />
                                <path d="M3 17H21" stroke="#868686" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                    </a>
                    <a href="/tasks/grid">
                        <div class="icon gridIcon active">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 10H7C9 10 10 9 10 7V5C10 3 9 2 7 2H5C3 2 2 3 2 5V7C2 9 3 10 5 10Z"
                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17 10H19C21 10 22 9 22 7V5C22 3 21 2 19 2H17C15 2 14 3 14 5V7C14 9 15 10 17 10Z"
                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M17 22H19C21 22 22 21 22 19V17C22 15 21 14 19 14H17C15 14 14 15 14 17V19C14 21 15 22 17 22Z"
                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M5 22H7C9 22 10 21 10 19V17C10 15 9 14 7 14H5C3 14 2 15 2 17V19C2 21 3 22 5 22Z"
                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tasksContainer">
                <div class="custom-canban">
                    @include('new-theme.tasks.kanban')
                </div>
                @livewire('task.view')
                @livewire('task.edit')

            </div>

            <div class="paginationS1 paginater flex gap-4 align">
                @include('new-theme.tasks.tasks-paginate')
            </div>


        </div>
    </div>
@endsection



@push('script')
    <script>
        $(document).ready(function() {
            $('.edit-task').click(function() {
                livewire.emit('editTaskModal', $(this).data('id'));
            })
        });

        $(document).ready(function() {
            function fetch_data() {
                $.ajax({
                    url: "{{ route('get.tasks.grid') }}",
                    data: {
                        "search": $('#search').val(),
                    },
                    success: function(data) {
                        $('.custom-canban').html('');
                        $('.custom-canban').html(data.search);
                        // KanbanTasks.boards = [];

                        $('.paginater').html('');
                        $('.paginater').html(data.paginate);

                        $(document).on('click', '.pagination a', function(event) {
                            event.preventDefault();
                            var query = $('#search').val();
                            var page = $(this).attr('href');
                            let position = page.search("&");
                            if (position == -1) {
                                href = page + '?search=' + query;
                            } else {
                                href = page + '&search=' + query;
                            }
                            window.location.replace(href);
                        });
                    }
                })
            }

            $(document).on('keyup', '#search', function() {
                fetch_data();
            });


        });
    </script>

    <script src="{{ url('new-theme/js/jkanban.min.js') }}"></script>



    <!-- show and  -->
    <script>
        const addNewCheckbox = (event, ) => {
            event.preventDefault()

            document.getElementById("filterSection").classList.toggle("hidden")
            document.getElementById("toggleBtn").classList.toggle("show")
        }
    </script>

    <script>
        var KanbanTasks = new jKanban({
            element: "#tasksKanban",
            gutter: "10px",
            widthBoard: "321px",
            // dragItems: true,
            dragBoards: false,


            click: function(el) {
                console.log(el);
                // var element = document.querySelector('.element');
                var id = $(el).children('div').data('id')
                livewire.emit('showTaskModal', id);
            },
            context: function(el, e) {
                console.log("Trigger on all items right-click!")
            },
            dropEl: function(el, target, source, sibling) {
                var id = $(el).children('div').data('id')
                var _target = $(target.parentElement);
                var sorted = [];
                var nodes = KanbanTasks.getBoardElements(_target.data("id"));
                var currentOrder = 0;
                nodes.forEach(function(value, index, array) {
                    console.log(value)
                    sorted.push({
                        "id": $(value).children('div').data('id'),
                        "order": currentOrder++
                    })
                });

                // console.log(sorted.filter(el=>el.id == id)[0].order )
                // console.log($(el).children('div').data('id'))

                var id = $(el).children('div').data('id');
                var status = target.parentElement.getAttribute("data-id");
                var priority = sorted.filter(el => el.id == id)[0].order;
                console.log({
                    id,
                    status,
                    priority
                });
                livewire.emit('updateTaskBoard', id, status, priority);

            },
            buttonClick: function(el, boardId) {
                console.log(el)
                console.log(boardId)
                // create a form to enter element
                var formItem = document.createElement("form")
                formItem.setAttribute("class", "itemform")
                formItem.innerHTML =
                    '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="CancelBtn" class="btn btn-default btn-xs pull-right">Cancel</button></div>'

                KanbanTasks.addForm(boardId, formItem)
                formItem.addEventListener("submit", function(e) {
                    e.preventDefault()
                    var text = e.target[0].value
                    KanbanTasks.addElement(boardId, {
                        title: text,
                    })
                    formItem.parentNode.removeChild(formItem)
                })
                document.getElementById("CancelBtn").onclick = function() {
                    formItem.parentNode.removeChild(formItem)
                }
            },
            dragendBoard: function(el) {
                console.log(el);
            },
            {{-- boards: @json($boards) --}}
        })


        var toDoButtonAtPosition = document.getElementById("addToDoAtPosition")
        toDoButtonAtPosition.addEventListener("click", function() {
            KanbanTasks.addElement("1", {
                title: "Test Add at Pos",
            }, 1)
            console.log(KanbanTasks.getBoardElements("1"));

        })


        var allEle = KanbanTasks.getBoardElements("_todo")
        allEle.forEach(function(item, index) {})
    </script>
    @livewireScripts
@endpush

@push('script')
    @livewireStyles
@endpush
