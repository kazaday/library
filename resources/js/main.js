function addBook(url,data = {},method = 'GET') {
    $('#btnModal').click();
    data['_token'] = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function(msg){
            $('#modalContent').html(msg);
        }
    });
}

function sendForm() {
    $.ajax({
        type: "POST",
        url: $('#createForm').attr('action'),
        data: $('#createForm').serialize(),
        success: function(msg){
            $('#close').click();
            setTimeout(function () {
                $('#container').html($(msg).find('#container').children());
                $('#modalContent').html('');
            },500);
        }
    });
}
