$(document).ready(function(){
	$('#auto-search').on('keyup', function(){
		var query = $(this).val();
		$.ajax({
			url: "/search",
			type: "GET",
			data: {'search': query},
			success: function(data){
				$('#auto-search-list').html(data);
			}
		});
	});
});

document.addEventListener('DOMContentLoaded', function() {
    var inputField = document.getElementById('yourInputId');

    inputField.addEventListener('keyup', function() {
        var query = this.value;

        fetch('search?search=' + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => {
                document.getElementById('search_list').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    });
});