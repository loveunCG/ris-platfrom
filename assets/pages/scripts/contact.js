var Contact = function() {

  return {
    //main function to initiate the module
    init: function() {
      var map;
      $(document).ready(function() {
        map = new GMaps({
          div: '#gmapbg',
          lat: -13.004333,
          lng: -38.494333
        });
        var marker = map.addMarker({
          lat: -13.004333,
          lng: -38.494333,
          title: 'Loop, Inc.',
          infoWindow: {
            content: "<b>Metronic, Inc.</b> 795 Park Ave, Suite 120<br>San Francisco, CA 94107"
          }
        });

        marker.infoWindow.open(map, marker);
      });
    }
  };

}();

jQuery(document).ready(function() {
  Contact.init();
});

$(document).ready(function(e) {
  $('#upload').on('click', function() {
    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
      url: 'http://localhost/ci3/index.php/ajaxupload/upload_file', // point to server-side controller method
      dataType: 'text', // what to expect back from the server
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(response) {
        $('#msg').html(response); // display success response from the server
      },
      error: function(response) {
        $('#msg').html(response); // display error response from the server
      }
    });
  });
});
