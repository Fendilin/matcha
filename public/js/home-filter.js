var renderSuccess = function (data, status, xhr) {
	$("#match-container").html('');
	for (var i = 0; i < data.length; ++i)
    {
    	console.log(data);
        $('#mytemplate .profile-img').attr('src', '/img/' + data[i].file1);
        $('#mytemplate .username').html(data[i]['username']);
        // $('#mytemplate .age ').html(data[i].age);
        // $('#mytemplate .from').html(data[i].country + ' ' + data[i].state +'<br />' + data[i].city + ' ' + data[i].zip);
        $('#mytemplate .gender').html(data[i].gender);
        $('#mytemplate .orient').html(data[i].orient);
        $('#match-container').append($('#mytemplate').html());
    }
};

// -                $ret .= '<div class="col-xs-12 col-md-4 ticket">';
// -                $ret .= '<div class="row">';
// -                $ret .=            '<div class="profile-img col-xs-4" style="background: url(\'/img/user/' . $data['file_1'] . '\')"></div>';
// -                $ret .= '<div class="col-xs-8">';
// -                $ret .= '<p class="username">' . ucwords($data['username']) . '</p>';
// -                $ret .= '<p class="age">' . $data['score'] . '</p>';
// -                $ret .= '<p class="from">' . ucwords($data['country']) . '<br/>' . ucwords($data['city']) . ' ' . ucwords($data['zip']) . '</p>';
// -                $ret .= '</div>';
// -                $ret .= '<div class="gender">';
// -                if ($data['gender'] == 1) {
//     -                    $ret .= '<img id="gender-img" src="/img/male.png" alt="gender" title="gender"/><br />';
//     -                } elseif ($data['gender'] == 2) {
//     -                    $ret .= '<img id="gender-img" src="/img/female.png" alt="gender" title="gender"/><br />';
//     -                }
// -                $ret .= '</div>';
// -                $ret .= '<div class="orient">';
// -                if (($data['gender'] == 1 && $data['orientation'] == 1) || ($data['gender'] == 2 && $data['orientation'] == 2)) {
//     -                    $ret .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
//     -                } elseif (($data['gender'] == 1 && $data['orientation'] == 2) || ($data['gender'] == 2 && $data['orientation'] == 1)) {
//     -                    $ret .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
//     -                } elseif ($data['orientation'] == 3) {
//     -                    $ret .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
//     -                    $ret .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
//     -                }
// -                $ret .= '</div>';
// -                $ret .= '<a class="profile-link" href="/profile/' . $data['username'] . '"></a>';
// -                $ret .= '</div>';
// -                $ret .= '</div>';

var renderError = function (xhr, status, err) {
	console.error(xhr.responseText);
};

$(document).ready(function () {
	$('#sort').change(function (event) {
		$filter = $(this).val();

		$.ajax({
			url: '/sort-by',
			method: 'post',
			data: '{"filter": "'+$filter.toString()+'"}',
			contentType: 'application/json;charset=utf-8',
			dataType: 'json',
			context: document
		})
			.done(renderSuccess)
			.fail(renderError);
	});
});
