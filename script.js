// var calendar;
// var Calendar = FullCalendar.Calendar;
// var events = [];



// $(function() {

   
//     if (!!scheds) {

//         Object.keys(scheds).map(k => {
//             var row = scheds[k]
//             events.push({ id: row.id, title: row.title, start: row.start_datetime, end: row.end_datetime });
//         });
//     }
    
//     var date = new Date()
//     var d = date.getDate(),
//         m = date.getMonth(),
//         y = date.getFullYear(),

//     calendar = new Calendar(document.getElementById('calendar'), {
//         initialView: 'dayGridWeek',
//         headerToolbar: {
//             left: 'prev,next today',
//             right: 'dayGridMonth,dayGridWeek,list',
//             center: 'title',
//         },
//         selectable: true,
//         themeSystem: 'bootstrap',
//         events: events,
//         eventClick: function(info) {
//             var details = $('#event-details-modal');
//             var id = info.event.id;

//             if (!!scheds[id]) {
//                 details.find('#start').text(scheds[id].sdate);
//                 details.find('#end').text(scheds[id].edate);
//                 details.find('#edit,#delete').attr('data-id', id);
//                 details.modal('show');


//             } else {
//                 alert("Event is undefined");
//             }
//         },
//         eventDidMount: function(info) {

//         },
//         editable: true
//     });


//     calendar.render();

//     // Form reset listener
//     $('#schedule-form').on('reset', function() {
//         $(this).find('input:hidden').val('');
//         $(this).find('input:visible').first().focus();
//     });

//     // // Edit Button
//     // $('#edit').click(function() {
//     //     var id = $(this).attr('data-id');

//     //     if (!!scheds[id]) {
//     //         var form = $('#schedule-form');

//     //         console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"));
//     //         form.find('[name="id"]').val(id);
//     //         form.find('[name="title"]').val(scheds[id].title);
//     //         form.find('[name="description"]').val(scheds[id].description);
//     //         form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"));
//     //         form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"));
//     //         $('#event-details-modal').modal('hide');
//     //         form.find('[name="title"]').focus();
//     //     } else {
//     //         alert("Event is undefined");
//     //     }
//     // });

//     // // Delete Button / Deleting an Event
//     // $('#delete').click(function() {
//     //     var id = $(this).attr('data-id');

//     //     if (!!scheds[id]) {
//     //         var _conf = confirm("Are you sure to delete this scheduled event?");
//     //         if (_conf === true) {
//     //             location.href = "./delete_schedule.php?id=" + id;
//     //         }
//     //     } else {
//     //         alert("Event is undefined");
//     //     }
//     // });
// });



document.addEventListener('DOMContentLoaded', function() {
  // scheds[i][0] = title
  // scheds[i][3] = days
  // scheds[i][4] = start
  // scheds[i][5] = end
  // scheds[i][6] = id

  var calendarEl = document.getElementById('calendar');
  var events = [];
  var newEvents = [];
  for(let i = 0; i < scheds.length; i++){
    events.push({id: scheds[i][6], title: scheds[i][0],daysOfWeek: scheds[i][3],startTime: scheds[i][4], endTime: scheds[i][5],startRecur:"2023-01-09",endRecur:"2023-04-30"});
  }


  var calendar = new FullCalendar.Calendar(calendarEl, {
       initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
    },
    eventClick: function(info) {
       var details = $('#event-details-modal');
       var id = info.event.id;
       var clickedOn = []
       for(let i=0; i <scheds.length;i++){
          if(scheds[i][6]==id){
              clickedOn = scheds[i];
          }
       }
      
      if(!!clickedOn ){
          details.find('#name').text(clickedOn[0]);
          details.find('#start').text(clickedOn[4]);
          details.find('#end').text(clickedOn[5]);
        
          details.find('#edit,#delete').attr('data-id', id);
          details.modal('show');
      }else{
        alert("Undefined");
      }

    },

    eventSources: [
    {
      events: events,
      // color:  '#cc0000',     // an option!
      // textColor: 'white' // an option!
    },
  ]
    
});

calendar.render(); 

 $("#formSubmit").on('click',function(){
    var title = document.getElementById('addTitle').value
    var date = document.getElementById("addDate").value;
    var startStr = document.getElementById("addStart").value;
    var endStr = document.getElementById("addEnd").value;
    
    var start = new Date(date + 'T' + startStr);
    var end = new Date(date + 'T' + endStr);

    calendar.addEvent({
        title: title,
        start: start,
        end: end
      });

});

});
