$(document).on('click','#showSeller',function(e){
    $.ajax({    
      type: "GET",
      url: "backend-script.php",             
      dataType: "html",                  
      success: function(data){                    
          $("#table-container").html(data); 
         
      }
  });
});


// $(document).on('click','#showCars',function(e){
//   $.ajax({    
//     type: "GET",
//     url: "backend-script.php",             
//     dataType: "html",                  
//     success: function(data){                    
//         $("#table-container").html(data); 
       
//     }
// });
// });