<div id="tasksKanban" class="scrollS1"></div>
<script>
    function ready(fn){
        
        if (typeof $ !== "undefined") { 
        return $(fn);
        }
        window.addEventListener('load', fn);
    }

    ready(function () {

        var KanbanTasks = new jKanban({
                element: "#tasksKanban",
                gutter: "10px",
                widthBoard: "321px",
                // dragItems: true,
                dragBoards: false,
    
    
                click: function(el) {
                    console.log( el );
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
                        "id": $(value).children('div').data('id') ,
                        "order": currentOrder++
                    })
                    });
    
              
                    var id      = $(el).children('div').data('id');
                    var status  = target.parentElement.getAttribute("data-id");
                    var priority  = sorted.filter(el=>el.id == id)[0].order;
                    console.log({id,status,priority});
                    livewire.emit('updateTaskBoard', id,status,priority);
    
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
                dragendBoard: function (el) {
                    console.log(el);
                },
                boards: @json($boards)
            })
           
   
            var toDoButtonAtPosition = document.getElementById("addToDoAtPosition")
            toDoButtonAtPosition.addEventListener("click", function() {
                KanbanTasks.addElement( "1", { title: "Test Add at Pos", },1)
                console.log(KanbanTasks.getBoardElements("1"));
    
            })
    
    
            var allEle = KanbanTasks.getBoardElements("_todo")
            allEle.forEach(function(item, index) {
            })
    
    
    });
     
    
</script>