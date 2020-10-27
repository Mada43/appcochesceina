$(document).ready(function(){
  $("#marcas").change(function(){
    var aid = $("#marcas").val();
    $.ajax({
      url: 'data.php',
      method: 'post',
      data: 'marca_id=' + marca_id
    }).done(function(modelos){ //we will get the models when done the above steps
      console.log(modelos);
      //modelos = JSON.parse(modelos);
      $('#modelos').empty(); //resetting the option components in case there has been a previous setting
      modelos.forEach(function(modelo){
        $('#modelos').append('<option value=' + modelo.id_modelo + '>' + modelo.modelo + '</option>')
      })
    })
  })
})


// $(document).on('click','#showSeller',function(e){
//     $.ajax({    
//       type: "GET",
//       url: "backend-script.php",             
//       dataType: "html",                  
//       success: function(data){                    
//           $("#table-container").html(data); 
         
//       }
//   });
// });


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