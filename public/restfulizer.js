// restfulizer.js
/**
* Author: Zizaco (http://forums.laravel.io/viewtopic.php?pid=32426)
* Tweaked by rydurham
*
* Restfulize any hyperlink that contains a data-method attribute by creating
* a mini form with the specified method and adding a trigger within the link.
* Requires jQuery!
*
* Ex:
* <a href="post/1" data-method="delete">destroy</a>
* // Will trigger the route Route::delete('post/(:id)')
*
*  - This method ignores elements that have a '.disabled' class
*  - Adding the '.action_confirm' class will trigger an optional confirm dialog.
*  - Adding the 'data-message' attribute will display a cusotm message in the confirm dialog.
*  - Adding the Session::token to 'data-token' will add a hidden input for needed for CSRF.
*/

$(document).ready(function() {
  $('[data-method]').not(".disabled").append(function() {
      var methodForm = "\n";
      methodForm += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n";
      methodForm += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n";
      if ($(this).attr('data-token')) {
        methodForm += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n";
      }
      if ($(this).attr('data-status')) {
        methodForm += "<input type='hidden' name='status' value='" + $(this).attr('data-status') + "'>\n";
      }
      methodForm += "</form>\n";
      return methodForm;
    })
    .removeAttr('href')
    .on('click', function(){
        var form = $(this).find('form');
        if($(this).hasClass('action_confirm')){
            swal({
              title: "Are you sure?",
              text: "Your will not be able to recover this action!",
              type: "error",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, I'm sure!",
              closeOnConfirm: true
            },
            function(isConfirm){
                if (isConfirm) {
                    form.submit();
                }
            });
        } else {
            form.submit();
        }

    });
});