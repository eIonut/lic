
load_data();

function load_data(query = '')
{
	var form_data = new FormData();

	form_data.append('query', query);

	var ajax_request = new XMLHttpRequest();

	ajax_request.open('POST', './process_data.php');

	ajax_request.send(form_data);

	ajax_request.onreadystatechange = function()
	{
		if(ajax_request.readyState == 4 && ajax_request.status == 200)
		{
			console.log(ajax_request.responseText);
			var response = JSON.parse(ajax_request.responseText);

			var html = '';
			var serial_no = 1;
			if(response.length > 0)
			{
				
				for(var count = 0; count < response.length; count++)
				{
					console.log(response[count].course_image);
					console.log(response[count].course_description);
					console.log(response[count].course_name);
					
					html += '<div class="card">';
					html += '<img class="card-img-top" src="./upload/'+response[count].course_image+'">';
					html += '<div class="card-body">';
					html += '<h5 class="card-title">' + response[count].course_name +' </h5>';
					html += '<p class="card-text">' + response[count].course_description + '</p>';
					html += '<a class="btn-hover color-2" href="delete_course_admin.php?course_name='+response[count].course_name+'">More info</a>';
			
               		html += '</div>';
					html += '</div>';
					serial_no++;
				}
			}
			else
			{
				html += '<p class="no-criteria-p" style="width: 100%; margin: auto">No courses found matching your criteria. Please try something else.</p>';
			}
			document.getElementById('course-section').innerHTML = html;
			
		
			
		}
	}
}