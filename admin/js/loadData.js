load_data();

function load_data(query = "") {
  var form_data = new FormData();

  form_data.append("query", query);

  var ajax_request = new XMLHttpRequest();

  ajax_request.open("POST", "./process_data.php");

  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      console.log(ajax_request.responseText);
      var response = JSON.parse(ajax_request.responseText);

      var html = "";
      var serial_no = 1;
      if (response.length > 0) {
        for (var count = 0; count < response.length; count++) {
          console.log(response[count].image);
          console.log(response[count].description);
          console.log(response[count].name);
          html +=
            '<div class="card" style="max-height: 400px; box-sizing: border-box; transition: box-shadow 0.4s;">';
          html +=
            '<img class="card-img-top img-fluid" style="height: 150px; max-height: 75%;" src="./upload/' +
            response[count].image +
            '">';
          html +=
            '<div class="card-body d-flex flex-column p-0 mt-4" style="box-sizing: content-box">';
          html +=
            '<div class="px-3 d-flex flex-column justify-content-center align-items-start pb-3">';
          html +=
            '<h5 class="card-title m-0 w-100 px-0 text-start pb-3">' +
            response[count].name +
            " </h5>";
          html +=
            '<p class="card-text m-0 text-start">' +
            response[count].description +
            "</p>";
          html += "</div>";

          html +=
            '<a class="btn d-block btn-primary mt-auto text-start pl-3 py-2 border-0 rounded-0 rounded-bottom w-100 d-flex justify-content-between align-items-center" style="background: linear-gradient(84.57deg, #1b3d7d 0%, #4a6db0 100%);" href="delete_course_admin.php?id=' +
            response[count].id +
            '">Start course<i class="fa-solid fa-book ml-auto"></i></a>';

          html += "</div>";
          html += "</div>";
          serial_no++;
        }
      } else {
        html +=
          '<p class="no-criteria-p" style="width: 100%; margin: auto">No courses found matching your criteria. Please try something else.</p>';
      }
      document.getElementById("course-section").innerHTML = html;
    }
  };
}
