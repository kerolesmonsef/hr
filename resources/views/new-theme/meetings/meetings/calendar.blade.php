<div class="calendar p-4 pt-0">
    <div class="inputS1 calendarSelect">
        <img src="/new-theme/icons/arrowDown.svg" class="iconImg" />
        <input type="text" id="dateCalendar" value="Mar 2023" placeholder="Set The Time" name="datepicker"
            class="datePickerMonth2" autocomplete="off" onchange="setCalender(event)" />
    </div>
    <div id='calendar' class="calendar"></div>
</div>

@push('script')
    <script>
        let initialDate = new Date().toISOString().slice(0, 10);
        const events = @json($meetings);

        // ------------ change data-bs-target with the same data-bs-target modal in top

        const setCalender = (event) => {
            let month = getMonthFromString(event.target.value.slice(0, 3));
            let year = event.target.value.slice(4)

            let calendarEl = document.getElementById('calendar');
            let setCalander = new FullCalendar.Calendar(calendarEl, {
                initialDate: `${year}-${month.length === 1 ? `0${month}` : month}-01`,
                initialView: 'dayGridMonth',
                events,
                eventContent: function(arg) {
                    let arrayOfDomNodes = [];
                    let titleEvent = document.createElement('div');
                    // image event
                    let imgEventWrap = document.createElement('div')
                    if (arg.event.extendedProps.image_url) {
                        let imgEvent = `
                        <div class="tooltipS1"  data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
                            <div class="tooltip">${arg.event._def.title}</div>
                            <img src="${arg.event.extendedProps.image_url}" >
                            
                        </div>
                    `
                        imgEventWrap.classList = "fc-event-img"
                        imgEventWrap.innerHTML = imgEvent;
                    }
                    arrayOfDomNodes = [titleEvent, imgEventWrap]
                    return {
                        domNodes: arrayOfDomNodes
                    }
                },
            });
            setCalander.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: initialDate,
                events,
                eventContent: function(arg) {
                    let arrayOfDomNodes = [];
                    let titleEvent = document.createElement('div');
                    // image event
                    let imgEventWrap = document.createElement('div')
                    if (arg.event.extendedProps.image_url) {
                        let imgEvent = `
                    <div class="tooltipS1 get-data"  data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1"  data-id="${arg.event._def.publicId}">
                            <div class="tooltip">${arg.event._def.title}</div>
                            <img src="${arg.event.extendedProps.image_url}" >
                        </div>
                    `
                        imgEventWrap.classList = "fc-event-img"
                        imgEventWrap.innerHTML = imgEvent;
                    }
                    arrayOfDomNodes = [titleEvent, imgEventWrap]
                    return {
                        domNodes: arrayOfDomNodes
                    }
                },
            });

            calendar.render();
        });
    </script>


    <script>
        function getMonthFromString(monthStr) {
            let getMonth = new Date(monthStr + '-1-01').getMonth() + 1

            return getMonth.toString()
        }

        flatpickr(".datePickerMonth2", {
            plugins: [
                new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "M Y",
                    altFormat: "F Y",
                }),
            ],
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.get-data').click(function() {
                livewire.emit('showModal', $(this).data('id'));
            });
            $('.edit-meeting').click(function() {
                livewire.emit('editModal', $(this).data('id'));
            })
        });
    </script>
@endpush
