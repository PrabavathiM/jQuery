$(document).ready(function (){
  table= $('#example').DataTable({
    searching: false,
    processing: true,
    serverSide: true,
    paging: true,
    pagingType:'full_numbers',
    pageLength:5,
    lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
    
    ajax: {
        url: 'ssp.php',
        type: 'POST',
        dataType: "json",
        data:function(d){
            d.fname = $('#fname').val();
        }

        // dataSrc: function(json){
            // console.log(json);      // display the send data
        //     return json.data
        // }
    }   
    });
});

$('#search').on('click', function(){
 table.ajax.reload();
});