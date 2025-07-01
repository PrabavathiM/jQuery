$(document).ready(function () {
  $("#EditForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "edit.php?id=" + $("input[name='id']").val(),
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (res) {
        // console.log(res);
        if (res.status_code == "200") {
          $("#update_data").text("Successfully updated");
          var up_model = new bootstrap.Modal(document.getElementById("update_user"));
          up_model.show();
          $("#dashboard").on("click", function () {
            window.location.href = "dashboard.php";
          });
        } else {
          alert("Update failed");
        }
      },
      error: function () {
        alert("Error occurred while updating.");
      },
    });
  });
});
