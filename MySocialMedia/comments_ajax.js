$(document).on('submit','#userForm',function(e){
    e.preventDefault();
   
    $.ajax({
    method:"POST",
    url: "comment_add.php",
    data:$(this).serialize(),
    success: function(data){
    $('#msg').html(data);
    $('#userForm').find('input').val('')
}});
});