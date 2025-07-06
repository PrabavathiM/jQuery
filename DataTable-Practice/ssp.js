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
            d.first_name = $('#first_name').val();
            d.office = $('#office').val();
            d.Salary = $('#Salary').val();
        }
    }   
    });
});
$('#search').on('click', function(){
 table.ajax.reload();
});