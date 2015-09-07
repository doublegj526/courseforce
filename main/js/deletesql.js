var username = ${row2['class_id']};
alert(username);
window.onbeforeunload = function(){
    if (username != null){
      $.post('deleteentry.php', {dummy: username}, function(){
        //successful ajax request
      }).error(function(){
        alert('error... ohh no!');
      });
    }
}