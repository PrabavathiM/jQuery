$(document).ready(function () {
  const table = $("#edit_user_data").DataTable({
    processing: true,
    serverSide: true,
    paging: true,
    searching: false,
    ordering: true,

    ajax: {
      url: "DB_server_processing.php",   
      type :"POST", 
      data: function (d) {
        d.filterEmail = $("#filterEmail").val();
        d.filterMobile = $("#filterMobile").val();
        d.filterDOB = $("#filterDOB").val();
      },   
    },
   columns: [
  { data: "id" }, 
  { data: "fullname" },
  { data: "email" }, 
  { data: "password" },
  { data: "mobile_number" },  
  { data: "age" },
  { data: "dob" },
  { data: "gender" },
  { data: "languages" },
  { data: "city" },
  { data: "skills" },
  { data: "message" },
  { data: "actions" }  
]

  });

  $("#filterEmail, #filterMobile, #filterDOB").on("keyup change", function () {
  table.draw();
  });

  $(document).on("click", ".editBtn", function () {
    const userId = $(this).closest("tr").find("td:first").text();
    window.location.href = "edit.php?id=" + userId;
  });

  $(document).on("click", ".deleteBtn", function () {
    const userId = $(this).data("id");
    const row = $(this).closest("tr");

    if (confirm("Are you sure you want to delete this user?")) {
      $.ajax({
        url: "delete.php",
        type: "POST",
        data: { id: userId },
        success: function (response) {
          alert("User deleted successfully.");
          row.remove();
        },
        error: function () {
          alert("Error deleting user.");
        },
      });
    }
  });
});
