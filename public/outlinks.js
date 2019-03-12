let params = new URLSearchParams(window.location.search);
try {
    let url = new URL(params.get('url'));
    $.get('allowed.json', function(allowed) {
        if (allowed.includes(url.host)) {
            window.location.href = url.href;
        }
    })
    .always(function() {
        $('#secure').text(url.protocol === 'https:' ? '🔐 Yes' : '⚠️ No');
        $('#host').text(url.host);
        $('#url').text(url.href).prop('href', url.href);
        for (let param of params) {
            let tr = $('<tr>');
            tr.append($('<th>').text(param[0]));
            tr.append($('<td>').text(param[1]));
            $('#query').append(tr);
        }
    });
} catch (e) {
    $('#link-invalid').removeClass('d-none');
    $('#link-valid').addClass('d-none');
}
