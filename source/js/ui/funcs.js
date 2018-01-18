$.fn.state = function(state) { 
  switch(state){
      case false:
          $(this).prop("disabled", true);
          $(this).addClass('disabled');
          break;
      case true:
          $(this).prop("disabled", false);
          $(this).removeClass('disabled');
          break;
  }
  return;
};

$.fn.active = function(state) {
  switch(state){
      case false:
          $(this).removeClass('active');
          break;
      case true:
          $(this).addClass('active');
          break;
  }
  return;
};

$.fn.style = function() {
    
}